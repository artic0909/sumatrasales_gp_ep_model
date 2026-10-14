<?php

namespace App\Http\Middleware;

use App\Models\Visitor;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitorMiddleware
{
    /**
     * Handle an incoming request and track visitor analytics.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track successful GET requests to user-facing pages
        if ($request->isMethod('GET') && $response->getStatusCode() < 400) {
            $path = $request->path();

            // Skip admin, api, static assets, livewire internal endpoints
            if (
                !$request->is('admin*') &&
                !$request->is('api*') &&
                !$request->is('storage*') &&
                !$request->is('flux*') &&
                !$request->is('livewire*') &&
                !$request->is('_boost*') &&
                !$request->is('up')
            ) {
                try {
                    $ip = $request->ip() ?: '127.0.0.1';
                    $userAgent = $request->userAgent() ?: 'Unknown';

                    // Detect device type
                    $device = 'Desktop';
                    if (preg_match('/(tablet|ipad|playbook|silk)|(android(?!.*mobi))/i', $userAgent)) {
                        $device = 'Tablet';
                    } elseif (preg_match('/(mobi|iphone|ipod|blackberry|opera mini|iemobile|wpdesktop)/i', $userAgent)) {
                        $device = 'Mobile';
                    }

                    // Detect browser
                    $browser = 'Unknown';
                    if (preg_match('/edg/i', $userAgent)) {
                        $browser = 'Edge';
                    } elseif (preg_match('/chrome|crios/i', $userAgent)) {
                        $browser = 'Chrome';
                    } elseif (preg_match('/firefox|fxios/i', $userAgent)) {
                        $browser = 'Firefox';
                    } elseif (preg_match('/safari/i', $userAgent) && !preg_match('/chrome/i', $userAgent)) {
                        $browser = 'Safari';
                    } elseif (preg_match('/opera|opr/i', $userAgent)) {
                        $browser = 'Opera';
                    }

                    Visitor::create([
                        'ip_address' => $ip,
                        'url'        => '/' . ltrim($path, '/'),
                        'method'     => 'GET',
                        'user_agent' => substr($userAgent, 0, 500),
                        'device'     => $device,
                        'browser'    => $browser,
                        'visited_at' => now('Asia/Kolkata'),
                    ]);
                } catch (\Throwable $e) {
                    // Fail silently so tracking never interrupts user experience
                }
            }
        }

        return $response;
    }
}
