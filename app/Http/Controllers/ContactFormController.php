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
        } catch (\Throwable $e) {
            Log::error('Contact Inquiry Email Error: ' . $e->getMessage(), [
                'inquiry_id' => $inquiry->id,
                'email'      => $inquiry->email,
                'trace'      => $e->getTraceAsString(),
            ]);
        }

        return redirect()->back()->with(
            'success',
            'Thank you for reaching out! Your inquiry message has been received successfully. A confirmation email has been sent to your inbox, and our administrative desk will respond promptly.'
        );
    }
}
