<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display the dynamic website content & contact settings form.
     */
    public function index()
    {
        $settings = Setting::getAllCached();
        return view('admin.settings.index', compact('settings'));
    }

    /**
     * Update dynamic website settings across the platform.
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            // Hero section settings
            'hero_bg_image_file'      => 'nullable|image|mimes:jpeg,png,jpg,webp,avif|max:5120',
            'hero_bg_image_url'       => 'nullable|string|max:500',
            'remove_hero_bg_image'    => 'nullable|boolean',
            'hero_badge_text'         => 'nullable|string|max:200',
            'hero_title_1'            => 'nullable|string|max:150',
            'hero_title_2'            => 'nullable|string|max:150',
            'hero_title_3'            => 'nullable|string|max:150',
            'hero_subtitle'           => 'nullable|string|max:600',
            'hero_btn_primary_text'   => 'nullable|string|max:100',
            'hero_btn_primary_link'   => 'nullable|string|max:500',
            'hero_btn_secondary_text' => 'nullable|string|max:100',
            'hero_btn_secondary_link' => 'nullable|string|max:500',
            'hero_script_tagline'     => 'nullable|string|max:300',

            // Contact & Support settings
            'phone'                   => 'nullable|string|max:100',
            'email'                   => 'nullable|email|max:150',
            'support_email'           => 'nullable|email|max:150',
            'support_phone'           => 'nullable|string|max:100',
            'investor_email'          => 'nullable|email|max:150',
            'investor_phone'          => 'nullable|string|max:100',
            'investor_support_system' => 'nullable|string|max:500',
            'whatsapp_number'         => 'nullable|string|max:100',
            'office_address'          => 'nullable|string|max:500',
            'working_hours'           => 'nullable|string|max:200',
        ]);

        // Handle Hero Background Image
        if ($request->boolean('remove_hero_bg_image')) {
            Setting::set('hero_bg_image', null, 'hero');
        } elseif ($request->hasFile('hero_bg_image_file')) {
            $path = $request->file('hero_bg_image_file')->store('hero', 'public');
            Setting::set('hero_bg_image', 'storage/' . $path, 'hero');
        } elseif ($request->filled('hero_bg_image_url')) {
            Setting::set('hero_bg_image', trim($request->input('hero_bg_image_url')), 'hero');
        }

        // Exclude file/temporary inputs from generic loop
        $textFields = $request->except([
            '_token',
            'hero_bg_image_file',
            'hero_bg_image_url',
            'remove_hero_bg_image',
        ]);

        foreach ($textFields as $key => $value) {
            $group = match ($key) {
                'hero_badge_text', 'hero_title_1', 'hero_title_2', 'hero_title_3',
                'hero_subtitle', 'hero_btn_primary_text', 'hero_btn_primary_link',
                'hero_btn_secondary_text', 'hero_btn_secondary_link', 'hero_script_tagline' => 'hero',
                'support_email', 'support_phone' => 'support',
                'investor_email', 'investor_phone', 'investor_support_system' => 'investor',
                'office_address', 'working_hours' => 'general',
                default => 'contact',
            };

            Setting::set($key, $value, $group);
        }

        return back()->with('success', 'Website dynamic settings updated successfully! Changes are live across the site.');
    }
}
