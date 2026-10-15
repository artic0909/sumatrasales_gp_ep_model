<?php

namespace App\Http\Controllers;

use App\Mail\AdminContactInquiryNotification;
use App\Mail\ContactInquiryConfirmation;
use App\Models\ContactInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    /**
     * Store an inbound contact message and dispatch confirmation & admin notification emails.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name'         => ['required', 'string', 'max:255'],
            'phone'        => ['required', 'string', 'max:50'],
            'email'        => ['required', 'email', 'max:255'],
            'inquiry_type' => ['required', 'string', 'max:100'],
            'message'      => ['required', 'string', 'max:5000'],
        ], [
            'name.required'         => 'Please provide your full name.',
            'phone.required'        => 'Please provide your contact phone or mobile number.',
            'email.required'        => 'Please provide a valid email address.',
            'email.email'           => 'Please enter a valid email address.',
            'inquiry_type.required' => 'Please select an inquiry topic.',
            'message.required'      => 'Please write your message or inquiry details.',
        ]);

        try {
            $validated['ip_address'] = $request->ip();
            $validated['user_agent'] = $request->userAgent();
            $validated['status'] = 'unread';

            $inquiry = ContactInquiry::create($validated);

            // Dispatch emails to user and admin
            try {
                // 1. Send confirmation email to user
                if (!empty($inquiry->email)) {
                    Mail::to($inquiry->email)->send(new ContactInquiryConfirmation($inquiry));
                }

                // 2. Send notification email to admin (sumatra.sales2424@gmail.com)
                $adminEmail = config('mail.admin_email', env('ADMIN_EMAIL', 'sumatra.sales2424@gmail.com'));
                if (!empty($adminEmail)) {
                    Mail::to($adminEmail)->send(new AdminContactInquiryNotification($inquiry));
                }
            } catch (\Throwable $mailEx) {
                Log::error('Contact Inquiry Email Delivery Warning: ' . $mailEx->getMessage(), [
                    'inquiry_id' => $inquiry->id,
                    'email'      => $inquiry->email,
                ]);
            }

            return redirect()->route('contact')->with('inquiry_submitted', true)->with('inquiry_data', [
                'name'         => $inquiry->name,
                'email'        => $inquiry->email,
                'phone'        => $inquiry->phone,
                'inquiry_type' => $inquiry->inquiry_type,
            ])->with('success', 'Your inquiry message has been submitted successfully! A confirmation email has been sent to your inbox.');

        } catch (\Throwable $e) {
            Log::error('Contact Inquiry Submission Failed: ' . $e->getMessage(), [
                'trace' => $e->getTraceAsString(),
            ]);

            return redirect()->back()->withInput()->with('inquiry_failed', true)->with(
                'error',
                'We could not process your inquiry at this moment. Please try again or reach out directly to our support desk.'
            );
        }
    }
}
