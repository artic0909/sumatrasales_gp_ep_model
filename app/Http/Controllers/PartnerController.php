<?php

namespace App\Http\Controllers;

use App\Mail\AdminPartnerApplicationNotification;
use App\Mail\PartnerApplicationSubmitted;
use App\Models\Partner;
use App\Models\TermsCheck;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PartnerController extends Controller
{
    /**
     * Show the partner registration form.
     */
    public function create(): View
    {
        return view('frontend.pages.partner_reg');
    }

    /**
     * Store a new partner registration.
     */
    public function store(Request $request): RedirectResponse
    {
        // Check normalized uniqueness for phone, email, Aadhaar, and PAN
        $duplicateErrors = [];
        $phoneVal = trim((string) $request->input('phone'));
        $cleanPhone = preg_replace('/\D/', '', $phoneVal);
        $last10Phone = strlen($cleanPhone) >= 10 ? substr($cleanPhone, -10) : $cleanPhone;
        if (!empty($last10Phone) && Partner::where(function ($q) use ($phoneVal, $cleanPhone, $last10Phone) {
            $q->where('phone', $phoneVal)
              ->orWhere('phone', $cleanPhone)
              ->orWhereRaw("SUBSTR(REPLACE(REPLACE(REPLACE(phone, ' ', ''), '-', ''), '+', ''), -10) = ?", [$last10Phone]);
        })->exists()) {
            $duplicateErrors['phone'] = 'Already taken! This mobile number is already registered in our system.';
        }

        $cleanEmail = strtolower(trim((string) $request->input('email')));
        if (!empty($cleanEmail) && Partner::whereRaw("LOWER(email) = ?", [$cleanEmail])->exists()) {
            $duplicateErrors['email'] = 'Already taken! This email address is already registered in our system.';
        }

        $cleanAadhaar = preg_replace('/\s+/', '', (string) $request->input('aadhaar_number'));
        if (!empty($cleanAadhaar) && Partner::where(function ($q) use ($cleanAadhaar) {
            $q->where('aadhaar_number', $cleanAadhaar)
              ->orWhereRaw("REPLACE(aadhaar_number, ' ', '') = ?", [$cleanAadhaar]);
        })->exists()) {
            $duplicateErrors['aadhaar_number'] = 'Already taken! This Aadhaar card number is already registered in our system.';
        }

        $cleanPan = strtoupper(preg_replace('/\s+/', '', (string) $request->input('pancard_number')));
        if (!empty($cleanPan) && Partner::whereRaw("UPPER(REPLACE(pancard_number, ' ', '')) = ?", [$cleanPan])->exists()) {
            $duplicateErrors['pancard_number'] = 'Already taken! This PAN card number is already registered in our system.';
        }

        if (!empty($duplicateErrors)) {
            return redirect()->back()->withErrors($duplicateErrors)->withInput();
        }

        $isGp = $request->input('registration_type') === 'GP';

        $rules = [
            'registration_type'   => ['required', 'in:EP,GP'],
            'name'                => ['required', 'string', 'max:255'],
            'phone'               => ['required', 'string', 'max:20', 'unique:partners,phone'],
            'email'               => ['required', 'email', 'max:255', 'unique:partners,email'],
            'state'               => ['required', 'string', 'max:100'],
            'district'            => ['required', 'string', 'max:100'],
            'city'                => ['required', 'string', 'max:100'],
            'address'             => ['required', 'string', 'max:500'],
            'aadhaar_number'      => ['required', 'string', 'max:20', 'unique:partners,aadhaar_number'],
            'aadhaar_front_image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:20480'],
            'aadhaar_back_image'  => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:20480'],
            'pancard_number'      => ['required', 'string', 'max:20', 'unique:partners,pancard_number'],
            'pancard_front_image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:20480'],
            'pancard_back_image'  => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:20480'],
            'bank_account_number' => ['required', 'string', 'max:50'],
            'bank_name'           => ['required', 'string', 'max:255'],
            'ifsc_code'           => ['required', 'string', 'max:20'],
            'self_image'          => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:20480'],
            'interests'           => ['required', 'array', 'min:1'],
            'interests.*'         => ['string', 'in:Rani Matrimonial,Schoolwala,Doctorwala'],
            'terms_common'        => ['required', 'array', 'size:8'],
        ];

        if ($isGp) {
            $rules['terms_gp'] = ['required', 'array', 'size:3'];
        } else {
            $rules['terms_ep'] = ['required', 'array', 'size:5'];
        }

        $messages = [
            'phone.unique'                 => 'Already taken! This mobile number is already registered in our system.',
            'email.unique'                 => 'Already taken! This email address is already registered in our system.',
            'aadhaar_number.unique'        => 'Already taken! This Aadhaar card number is already registered in our system.',
            'pancard_number.unique'        => 'Already taken! This PAN card number is already registered in our system.',
            'interests.required'           => 'Please select at least one project you would like to work with (Rani Matrimonial, Schoolwala, or Doctorwala).',
            'interests.min'                => 'Please select at least one project you would like to work with.',
            'aadhaar_front_image.required' => 'Please upload your Aadhaar card front side image.',
            'aadhaar_back_image.required'  => 'Please upload your Aadhaar card back side image.',
            'pancard_front_image.required' => 'Please upload your PAN card front image.',
            'pancard_back_image.required'  => 'Please upload your PAN card back image.',
            'self_image.required'          => 'Please upload your applicant passport photo / self image.',
            'terms_common.required'        => 'Please read and accept all 8 common statutory declarations.',
            'terms_common.size'            => 'Please check and accept all 8 common statutory declarations.',
            'terms_gp.required'            => 'Please accept all 3 Ground Partner declarations.',
            'terms_gp.size'                => 'Please check and accept all 3 Ground Partner declarations.',
            'terms_ep.required'            => 'Please accept all 5 Executive Partner declarations.',
            'terms_ep.size'                => 'Please check and accept all 5 Executive Partner declarations.',
        ];

        $validated = $request->validate($rules, $messages);

        $imageFields = [
            'aadhaar_front_image',
            'aadhaar_back_image',
            'pancard_front_image',
            'pancard_back_image',
            'self_image',
        ];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $this->compressAndStoreImage($request->file($field), 'partner_documents');
            }
        }

        $applicationCode = $this->generateApplicationCode($validated['registration_type']);
        $validated['application_code'] = $applicationCode;

        $partner = Partner::create($validated);

        // Store structured statutory terms acceptance into terms_checks table
        $commonDeclarations = [
            'A1' => 'I am 18 years of age or older and competent to enter into a contract.',
            'A2' => 'All information, documents and work experience I have submitted are true, complete and my own. I understand that false information leads to rejection, termination and legal action.',
            'A3' => 'I have read, understood and agree to these Terms and Conditions, the Code of Conduct and the Commission Schedule for my selected Position.',
            'A4' => 'I have read the Privacy Policy and consent to Sumatra Sales Private Limited processing my personal data, including KYC and bank details, for the purposes in Section 10.2.',
            'A5' => 'I have paid no fee to register, and I understand that no income is guaranteed and commission is earned only on genuine, realised and verified sales.',
            'A6' => 'I will never collect money from any Customer in cash or into my own account.',
            'A7' => 'I agree to receive calls, SMS, WhatsApp and email from the Company about my account and the programme.',
            'A8' => 'I accept this as a valid electronic contract under Section 10A of the Information Technology Act, 2000, and my OTP verification as my acceptance.',
        ];

        $gpDeclarations = [
            'GP1' => 'I am registering as a Ground Partner on a commission-only basis under Schedule A.',
            'GP2' => 'I understand that I am an independent referral partner and not an employee, agent or franchisee of the Company, and that I am not entitled to any salary or employment benefit.',
            'GP3' => 'I will promote the Platforms only with Company-approved material and my own GP Code.',
        ];

        $epDeclarations = [
            'EP1' => 'I am applying as an Executive Partner on a fixed monthly amount plus commission basis under Schedule B.',
            'EP2' => 'I understand that this is an application only, and that my engagement, fixed amount, territory and engagement type will be stated in an Appointment Letter that I must accept separately.',
            'EP3' => 'I agree to attend an interview and to provide references and proof of experience on request.',
            'EP4' => 'I understand that the fixed amount depends on meeting the activity standards in my Appointment Letter and that targets may be set and reviewed.',
            'EP5' => 'I will not promote any competing business in my territory without the Company\'s written consent.',
        ];

        $termsChecksArray = [];
        $submittedCommon = (array) $request->input('terms_common', []);
        foreach ($commonDeclarations as $code => $text) {
            $termsChecksArray[] = [
                'code'    => $code,
                'section' => 'A. Common declarations',
                'text'    => $text,
                'checked' => in_array($code, $submittedCommon) ? 1 : 0,
            ];
        }

        if ($partner->registration_type === 'GP') {
            $submittedGp = (array) $request->input('terms_gp', []);
            foreach ($gpDeclarations as $code => $text) {
                $termsChecksArray[] = [
                    'code'    => $code,
                    'section' => 'B1. Ground Partner (GP)',
                    'text'    => $text,
                    'checked' => in_array($code, $submittedGp) ? 1 : 0,
                ];
            }
        } else {
            $submittedEp = (array) $request->input('terms_ep', []);
            foreach ($epDeclarations as $code => $text) {
                $termsChecksArray[] = [
                    'code'    => $code,
                    'section' => 'B2. Executive Partner (EP)',
                    'text'    => $text,
                    'checked' => in_array($code, $submittedEp) ? 1 : 0,
                ];
            }
        }

        TermsCheck::create([
            'partner_id'          => $partner->id,
            'terms_and_condition' => $termsChecksArray,
            'terms_version'       => 'Version 2.0',
            'ip_address'          => $request->ip(),
            'user_agent'          => $request->userAgent(),
            'accepted_at'         => now('Asia/Kolkata'),
        ]);

        // Send email notifications to applicant and admin
        try {
            // 1. Send confirmation email with application details to the applicant
            if (!empty($partner->email)) {
                Mail::to($partner->email)->send(new PartnerApplicationSubmitted($partner));
            }

            // 2. Send notification email with full application details to the admin
            $adminEmail = config('mail.admin_email', env('ADMIN_EMAIL', 'sumatra.sales2424@gmail.com'));
            if (!empty($adminEmail)) {
                Mail::to($adminEmail)->send(new AdminPartnerApplicationNotification($partner));
            }
        } catch (\Throwable $e) {
            Log::error('Partner Application Email Error: ' . $e->getMessage(), [
                'partner_id' => $partner->id,
                'application_code' => $partner->application_code,
                'trace' => $e->getTraceAsString(),
            ]);
        }

        $fullAddress = trim(implode(', ', array_filter([
            $validated['address'] ?? null,
            $validated['city'] ?? null,
            $validated['district'] ?? null,
            $validated['state'] ?? null,
        ])));

        return redirect()->route('home')->with('submission_success', [
            'role'             => $validated['registration_type'],
            'email'            => $validated['email'],
            'name'             => $validated['name'],
            'phone'            => $validated['phone'] ?? '',
            'address'          => $fullAddress,
            'application_code' => $applicationCode,
            'partner_id'       => $partner->id,
        ])->with(
            'success',
            'Your form is successfully submitted, wait for approval, after approve it your ' . ($validated['registration_type'] === 'GP' ? 'GP' : 'EP') . ' code will be send in you this email'
        );
    }

    /**
     * Compress and store an uploaded image file.
     * Resizes proportionally to max 1600px dimension and converts to compressed WebP (or JPEG).
     */
    protected function compressAndStoreImage(UploadedFile $file, string $folder = 'partner_documents'): string
    {
        // Fallback default store if GD extension is not loaded
        if (!extension_loaded('gd')) {
            return $file->store($folder, 'public');
        }

        $realPath = $file->getRealPath();
        $mime = $file->getMimeType() ?: (function_exists('mime_content_type') ? mime_content_type($realPath) : '');

        $image = null;
        switch ($mime) {
            case 'image/jpeg':
            case 'image/jpg':
                $image = @imagecreatefromjpeg($realPath);
                // Correct EXIF orientation for smartphone photos
                if ($image && function_exists('exif_read_data')) {
                    $exif = @exif_read_data($realPath);
                    if (!empty($exif['Orientation'])) {
                        switch ($exif['Orientation']) {
                            case 3:
                                $image = imagerotate($image, 180, 0);
                                break;
                            case 6:
                                $image = imagerotate($image, -90, 0);
                                break;
                            case 8:
                                $image = imagerotate($image, 90, 0);
                                break;
                        }
                    }
                }
                break;
            case 'image/png':
                $image = @imagecreatefrompng($realPath);
                break;
            case 'image/webp':
                $image = @imagecreatefromwebp($realPath);
                break;
        }

        if (!$image) {
            return $file->store($folder, 'public');
        }

        $origWidth  = imagesx($image);
        $origHeight = imagesy($image);

        // Cap dimensions at max 1600px proportionally
        $maxDimension = 1600;
        if ($origWidth > $maxDimension || $origHeight > $maxDimension) {
            if ($origWidth > $origHeight) {
                $targetWidth  = $maxDimension;
                $targetHeight = (int) round(($origHeight / $origWidth) * $maxDimension);
            } else {
                $targetHeight = $maxDimension;
                $targetWidth  = (int) round(($origWidth / $origHeight) * $maxDimension);
            }

            $resized = imagecreatetruecolor($targetWidth, $targetHeight);
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
            imagecopyresampled($resized, $image, 0, 0, 0, 0, $targetWidth, $targetHeight, $origWidth, $origHeight);
            imagedestroy($image);
            $image = $resized;
        }

        // Compress as WebP (quality 78) or JPEG (quality 80)
        ob_start();
        $extension = 'webp';
        if (function_exists('imagewebp')) {
            imagewebp($image, null, 78);
        } else {
            imagejpeg($image, null, 80);
            $extension = 'jpg';
        }
        $compressedData = ob_get_clean();
        imagedestroy($image);

        if (!$compressedData) {
            return $file->store($folder, 'public');
        }

        $fileName = Str::uuid() . '.' . $extension;
        $filePath = trim($folder, '/') . '/' . $fileName;

        Storage::disk('public')->put($filePath, $compressedData);

        return $filePath;
    }

    /**
     * Check if a field value is already taken in the partners table (Real-time AJAX check).
     */
    public function checkUnique(Request $request): \Illuminate\Http\JsonResponse
    {
        $field = $request->input('field');
        $value = trim((string) $request->input('value'));

        $allowedFields = ['phone', 'email', 'aadhaar_number', 'pancard_number'];
        if (!in_array($field, $allowedFields) || empty($value)) {
            return response()->json(['taken' => false]);
        }

        $query = Partner::query();

        if ($field === 'phone') {
            $cleanPhone = preg_replace('/\D/', '', $value);
            if (empty($cleanPhone)) {
                return response()->json(['taken' => false]);
            }
            $last10 = strlen($cleanPhone) >= 10 ? substr($cleanPhone, -10) : $cleanPhone;
            $query->where(function ($q) use ($value, $cleanPhone, $last10) {
                $q->where('phone', $value)
                  ->orWhere('phone', $cleanPhone)
                  ->orWhereRaw("SUBSTR(REPLACE(REPLACE(REPLACE(phone, ' ', ''), '-', ''), '+', ''), -10) = ?", [$last10]);
            });
        } elseif ($field === 'email') {
            $query->whereRaw("LOWER(email) = ?", [strtolower($value)]);
        } elseif ($field === 'aadhaar_number') {
            $cleanAadhaar = preg_replace('/\s+/', '', $value);
            $query->where(function ($q) use ($value, $cleanAadhaar) {
                $q->where('aadhaar_number', $value)
                  ->orWhereRaw("REPLACE(aadhaar_number, ' ', '') = ?", [$cleanAadhaar]);
            });
        } elseif ($field === 'pancard_number') {
            $cleanPan = strtoupper(preg_replace('/\s+/', '', $value));
            $query->whereRaw("UPPER(REPLACE(pancard_number, ' ', '')) = ?", [$cleanPan]);
        }

        $exists = $query->exists();

        $fieldLabels = [
            'phone'          => 'mobile number',
            'email'          => 'email address',
            'aadhaar_number' => 'Aadhaar card number',
            'pancard_number' => 'PAN card number',
        ];

        return response()->json([
            'taken'   => $exists,
            'message' => $exists ? "Already taken! This {$fieldLabels[$field]} is already registered in our system. Please use a different one." : '',
        ]);
    }

    /**
     * Generate a unique, professional Application Reference Code.
     * Format: SSPL-{YEAR}-{ROLE}-{RANDOM_6} (e.g. SSPL-2026-EP-8K9N2P)
     */
    protected function generateApplicationCode(string $role): string
    {
        $prefix = $role === 'GP' ? 'GP' : 'EP';
        $year = date('Y');

        do {
            $random = strtoupper(substr(str_shuffle('23456789ABCDEFGHJKLMNPQRSTUVWXYZ'), 0, 6));
            $code = "SSPL-{$year}-{$prefix}-{$random}";
        } while (Partner::where('application_code', $code)->exists());

        return $code;
    }

    /**
     * Download official Partner Application & Statutory Terms PDF.
     */
    public function downloadApplicationPdf(string $code)
    {
        $partner = Partner::with('termsCheck')->where('application_code', $code)->firstOrFail();

        $pdf = Pdf::loadView('frontend.pages.partner_application_pdf', compact('partner'))
            ->setPaper('a4', 'portrait')
            ->setOption([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => true,
                'defaultFont'          => 'sans-serif',
            ]);

        $safeCode = preg_replace('/[^A-Za-z0-9_-]/', '_', $partner->application_code);
        return $pdf->download("SumatraSales_Application_{$safeCode}.pdf");
    }

    /**
     * View/Stream official Partner Application & Statutory Terms PDF in browser tab.
     */
    public function viewApplicationPdf(string $code)
    {
        $partner = Partner::with('termsCheck')->where('application_code', $code)->firstOrFail();

        $pdf = Pdf::loadView('frontend.pages.partner_application_pdf', compact('partner'))
            ->setPaper('a4', 'portrait')
            ->setOption([
                'isHtml5ParserEnabled' => true,
                'isRemoteEnabled'      => true,
                'defaultFont'          => 'sans-serif',
            ]);

        $safeCode = preg_replace('/[^A-Za-z0-9_-]/', '_', $partner->application_code);
        return $pdf->stream("SumatraSales_Application_{$safeCode}.pdf");
    }
}

