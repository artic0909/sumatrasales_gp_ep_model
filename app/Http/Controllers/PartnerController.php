<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
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
        $validated = $request->validate([
            'registration_type'   => ['required', 'in:EP,GP'],
            'name'                => ['required', 'string', 'max:255'],
            'phone'               => ['required', 'string', 'max:20'],
            'email'               => ['required', 'email', 'max:255'],
            'state'               => ['required', 'string', 'max:100'],
            'district'            => ['required', 'string', 'max:100'],
            'city'                => ['required', 'string', 'max:100'],
            'address'             => ['required', 'string', 'max:500'],
            'aadhaar_number'      => ['required', 'string', 'max:20'],
            'aadhaar_front_image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:20480'],
            'aadhaar_back_image'  => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:20480'],
            'pancard_number'      => ['required', 'string', 'max:20'],
            'pancard_front_image' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:20480'],
            'pancard_back_image'  => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:20480'],
            'bank_account_number' => ['required', 'string', 'max:50'],
            'bank_name'           => ['required', 'string', 'max:255'],
            'ifsc_code'           => ['required', 'string', 'max:20'],
            'self_image'          => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:20480'],
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
                $validated[$field] = $this->compressAndStoreImage($request->file($field), 'partner_documents');
            }
        }

        Partner::create($validated);

        return redirect()->route('home')->with('submission_success', [
            'role'  => $validated['registration_type'],
            'email' => $validated['email'],
            'name'  => $validated['name'],
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
}
