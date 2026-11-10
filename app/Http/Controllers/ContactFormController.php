<?php

namespace App\Http\Controllers;

use App\Mail\AdminContactInquiryNotification;
use App\Mail\ContactInquiryConfirmation;
use App\Models\ContactInquiry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ContactFormController extends Controller
{
    /**
     * Show the contact page with an encrypted anti-bot challenge.
     */
    public function showContactForm(): View
    {
        $n1 = rand(2, 9);
        $n2 = rand(1, 9);
        $challengeText = "{$n1} + {$n2}";
        $guardToken = encrypt(json_encode([
            'ans' => $n1 + $n2,
            'ts'  => time(),
        ]));

        return view('frontend.pages.contact', compact('challengeText', 'guardToken'));
    }

    /**
     * Store an inbound contact message with multi-layer bot & spam filtering.
     */
    public function store(Request $request): RedirectResponse
    {
        // =========================================================================
        // LAYER 1: INVISIBLE HONEYPOT TRAP
        // Automated bots scan and fill all hidden inputs. Legitimate users never see it.
        // =========================================================================
        $honeypotField = 'corporate_website_url';
        if ($request->filled($honeypotField)) {
            Log::warning('Bot inquiry blocked (honeypot triggered) from IP: ' . $request->ip());
            return redirect()->route('contact')
                ->with('inquiry_submitted', true)
                ->with('inquiry_data', ['name' => 'Visitor'])
                ->with('success', 'Your inquiry message has been submitted successfully!');
        }

        // =========================================================================
        // LAYER 2: SECURITY GUARD TOKEN (SPEED CHECK & ARITHMETIC VERIFICATION)
        // =========================================================================
        $guardToken = $request->input('_guard_token');
        if (empty($guardToken)) {
            return redirect()->back()->withInput()->with('error', 'Security verification token is missing. Please reload the page and try again.');
        }

        try {
            $guardData = json_decode(decrypt($guardToken), true);
            if (!is_array($guardData) || !isset($guardData['ans'], $guardData['ts'])) {
                throw new \Exception('Invalid guard token structure');
            }

            // Minimum fill time check: Humans take at least 3 seconds to complete the form
            $timeElapsed = time() - (int) $guardData['ts'];
            if ($timeElapsed < 3) {
                Log::warning("Bot inquiry blocked (submitted in {$timeElapsed}s) from IP: " . $request->ip());
                return redirect()->route('contact')
                    ->with('inquiry_submitted', true)
                    ->with('inquiry_data', ['name' => 'Visitor'])
                    ->with('success', 'Your inquiry message has been submitted successfully!');
            }

            // Verify arithmetic security calculation
            $userAnswer = (int) trim((string) $request->input('captcha_answer'));
            if ($userAnswer !== (int) $guardData['ans']) {
                return redirect()->back()->withInput()->withErrors([
                    'captcha_answer' => 'Incorrect answer for the security calculation. Please try again.',
                ]);
            }
        } catch (\Throwable $tokenEx) {
            Log::warning('Guard token validation failed from IP: ' . $request->ip() . ' - ' . $tokenEx->getMessage());
            return redirect()->back()->withInput()->with('error', 'Security check verification expired. Please reload the page and try again.');
        }

        // =========================================================================
        // LAYER 3: STRICT FIELD VALIDATION CONSTRAINTS
        // =========================================================================
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'min:2',
                'max:60',
                'regex:/^[\p{L}\s\.\'\-]+$/u', // Unicode letters, spaces, dots, hyphens only
            ],
            'phone' => [
                'required',
                'string',
                'min:8',
                'max:20',
                'regex:/^[0-9\+\-\s\(\)]{8,20}$/',
            ],
            'email' => [
                'required',
                'email',
                'max:120',
            ],
            'inquiry_type' => [
                'required',
                'string',
                Rule::in([
                    'Executive Partner (EP) Program',
                    'Ground Partner (GP) Program',
                    'Software & Development Services',
                    'Software / Product Support',
                    'Investor Relations',
                    'General Inquiries',
                ]),
            ],
            'message' => [
                'required',
                'string',
                'min:10',
                'max:3000',
            ],
            'captcha_answer' => ['required'],
        ], [
            'name.required'           => 'Please provide your full name.',
            'name.regex'              => 'Name can only contain letters, spaces, and dots (no links, symbols, or numbers).',
            'name.max'                => 'Name must not exceed 60 characters.',
            'phone.required'          => 'Please provide your contact phone or mobile number.',
            'phone.regex'             => 'Please enter a valid phone number (8-20 digits and optional country code).',
            'email.required'          => 'Please provide a valid email address.',
            'email.email'             => 'Please enter a valid email address format.',
            'inquiry_type.required'   => 'Please select an inquiry topic.',
            'inquiry_type.in'         => 'Please select a valid inquiry category.',
            'message.required'        => 'Please write your message or inquiry details.',
            'message.min'             => 'Your inquiry message must be at least 10 characters long.',
            'captcha_answer.required' => 'Please solve the security calculation to proceed.',
        ]);

        // =========================================================================
        // LAYER 4: HEURISTIC ANTI-SPAM CONTENT FILTERS (URLs & GAMBLING KEYWORDS)
        // =========================================================================
        $linkPattern = '/(https?:\/\/|www\.|ftp:\/\/|[a-z0-9\-\.]+\.(com|ru|net|org|xyz|top|site|club|vip|online|info|php|biz|me|io)\b)/i';

        if (preg_match($linkPattern, $validated['name'])) {
            return redirect()->back()->withInput()->withErrors([
                'name' => 'Links and website URLs are strictly forbidden in the Name field.',
            ]);
        }

        if (preg_match($linkPattern, $validated['message'])) {
            return redirect()->back()->withInput()->withErrors([
                'message' => 'For security reasons, external website links and URLs cannot be included in your inquiry message.',
            ]);
        }

        // Suspicious gambling/casino/promotional spam triggers
        $spamKeywords = [
            'slot platform', 'player drop', 'promo code', 'welcome bonus',
            'no upfront deposit', 'zero deposit', 'free spins', 'casino',
            'pasting your personal', 'before they shut it down', 'partner club',
            'active promo code', 'unlocked bonus', 'http://', 'https://'
        ];

        $combinedContent = strtolower($validated['name'] . ' ' . $validated['message']);
        foreach ($spamKeywords as $keyword) {
            if (str_contains($combinedContent, strtolower($keyword))) {
                Log::warning("Spam keyword '{$keyword}' detected from IP: " . $request->ip());
                // Return fake success so spammers do not re-engineer their bot payload
                return redirect()->route('contact')
                    ->with('inquiry_submitted', true)
                    ->with('inquiry_data', ['name' => $validated['name']])
                    ->with('success', 'Your inquiry message has been submitted successfully!');
            }
        }

        // Check for gibberish message (single continuous token with no spaces)
        if (strlen($validated['message']) > 5 && !str_contains(trim($validated['message']), ' ') && str_word_count($validated['message']) < 2) {
            return redirect()->back()->withInput()->withErrors([
                'message' => 'Please provide a clear and descriptive message with standard words.',
            ]);
        }

        // =========================================================================
        // LAYER 5: STORE CLEAN RECORD & DISPATCH EMAILS
        // =========================================================================
        try {
            $dataToStore = [
                'name'         => trim($validated['name']),
                'phone'        => trim($validated['phone']),
                'email'        => strtolower(trim($validated['email'])),
                'inquiry_type' => $validated['inquiry_type'],
                'message'      => trim($validated['message']),
                'ip_address'   => $request->ip(),
                'user_agent'   => $request->userAgent(),
                'status'       => 'unread',
            ];

            $inquiry = ContactInquiry::create($dataToStore);

            // Dispatch emails to user and admin
            try {
                // 1. Send confirmation email to user
                if (!empty($inquiry->email)) {
                    Mail::to($inquiry->email)->send(new ContactInquiryConfirmation($inquiry));
                }

                // 2. Send notification email to admin
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
