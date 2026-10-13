<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
        $validated = $request->validate([
            'registration_type'   => ['required', 'in:EP,GP'],
            'name'                => ['required', 'string', 'max:255'],
            'phone'               => ['required', 'string', 'max:20'],
            'email'               => ['required', 'email', 'max:255'],
            'state'               => ['required', 'string', 'max:100'],
            'district'            => ['required', 'string', 'max:100'],
            'city'                => ['required', 'string', 'max:100'],
            'address'             => ['required', 'string', 'max:500'],
            'aadhaar_number'      => ['required', 'string', 'max:30'],
            'aadhaar_front_image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'aadhaar_back_image'  => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'pancard_number'      => ['required', 'string', 'max:30'],
            'pancard_front_image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'pancard_back_image'  => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
            'bank_account_number' => ['required', 'string', 'max:50'],
            'bank_name'           => ['required', 'string', 'max:255'],
            'ifsc_code'           => ['required', 'string', 'max:20'],
            'self_image'          => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:5120'],
        ], [
            'aadhaar_front_image.required' => 'Please upload your Aadhaar card front side image.',
            'aadhaar_back_image.required'  => 'Please upload your Aadhaar card back side image.',
            'pancard_front_image.required' => 'Please upload your PAN card front image.',
            'pancard_back_image.required'  => 'Please upload your PAN card back image.',
            'self_image.required'          => 'Please upload your applicant passport photo / self image.',
        ]);

        $imageFields = [
            'aadhaar_front_image',
            'aadhaar_back_image',
            'pancard_front_image',
            'pancard_back_image',
            'self_image',
        ];

        foreach ($imageFields as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('partner_documents', 'public');
            }
        }

        Partner::create($validated);

        return redirect()->route('partner.register')->with(
            'success',
            'Thank you! Your Partner Registration (' . $validated['registration_type'] . ') has been submitted successfully. Our team will verify your KYC details and contact you shortly.'
        );
    }
}
