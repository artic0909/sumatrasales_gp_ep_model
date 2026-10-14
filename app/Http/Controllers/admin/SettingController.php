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

        foreach ($validated as $key => $value) {
            $group = match ($key) {
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
