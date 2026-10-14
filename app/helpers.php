<?php

use App\Models\Setting;

if (!function_exists('site_setting')) {
    /**
     * Retrieve dynamic site setting value with cache and default fallback.
     */
    function site_setting(string $key, ?string $default = null): ?string
    {
        return Setting::get($key, $default);
    }
}
