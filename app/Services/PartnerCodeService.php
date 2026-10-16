<?php

namespace App\Services;

use App\Models\Partner;
use App\Models\Setting;

class PartnerCodeService
{
    /**
     * Determine the code prefix based on registration type and chosen project interests.
     * Examples:
     * - GP with all projects => GPALL
     * - GP with Doctorwala => GPDW
     * - GP with Rani Matrimonial => GPRM
     * - GP with Schoolwala => GPSW
     * - EP follows identical prefix logic starting with EP (e.g. EPALL, EPDW, EPRM, EPSW)
     */
    public static function determinePrefix(Partner $partner): string
    {
        $role = strtoupper($partner->registration_type === Partner::REGISTRATION_TYPE_GP ? 'GP' : 'EP');

        $interests = (array) ($partner->interests ?? []);
        $normalized = array_map(fn($item) => strtolower(trim((string) $item)), $interests);

        $hasDoctor = false;
        $hasRani = false;
        $hasSchool = false;

        foreach ($normalized as $item) {
            if (str_contains($item, 'doctor')) {
                $hasDoctor = true;
            } elseif (str_contains($item, 'rani') || str_contains($item, 'matrimonial')) {
                $hasRani = true;
            } elseif (str_contains($item, 'school')) {
                $hasSchool = true;
            }
        }

        $matchedCount = ($hasDoctor ? 1 : 0) + ($hasRani ? 1 : 0) + ($hasSchool ? 1 : 0);

        if ($matchedCount >= 3 || count($interests) >= 3) {
            $projectTag = 'ALL';
        } elseif ($matchedCount === 1) {
            if ($hasDoctor) {
                $projectTag = 'DW';
            } elseif ($hasRani) {
                $projectTag = 'RM';
            } else {
                $projectTag = 'SW';
            }
        } elseif ($matchedCount === 2) {
            if ($hasDoctor && $hasSchool) {
                $projectTag = 'DWSW';
            } elseif ($hasDoctor && $hasRani) {
                $projectTag = 'DWRM';
            } else {
                $projectTag = 'RMSW';
            }
        } else {
            // Default to ALL if not specified or unknown
            $projectTag = 'ALL';
        }

        return $role . $projectTag;
    }

    /**
     * Preview or generate the next sequential unique partner code.
     * Guaranteed to jump forward even if middle records are deleted.
     */
    public static function generateNextCode(Partner $partner, ?string $customPrefix = null): array
    {
        $prefix = $customPrefix ?: self::determinePrefix($partner);

        // Find max numerical suffix currently existing in partners table for this prefix
        $existingCodes = Partner::where('approved_code', 'LIKE', "{$prefix}%")
            ->pluck('approved_code');

        $maxExisting = 0;
        foreach ($existingCodes as $code) {
            $suffix = substr($code, strlen($prefix));
            if (is_numeric($suffix)) {
                $num = (int) $suffix;
                if ($num > $maxExisting) {
                    $maxExisting = $num;
                }
            }
        }

        // Also check persistent sequence tracking in Settings to prevent regression upon deletion
        $trackedSequence = (int) Setting::get("code_seq_{$prefix}", '0');

        $nextNumber = max($maxExisting, $trackedSequence) + 1;

        // Collision safety check
        do {
            $formattedNum = str_pad((string) $nextNumber, 3, '0', STR_PAD_LEFT);
            $candidateCode = $prefix . $formattedNum;

            if (!Partner::where('approved_code', $candidateCode)->where('id', '!=', $partner->id)->exists()) {
                break;
            }
            $nextNumber++;
        } while (true);

        return [
            'prefix'   => $prefix,
            'sequence' => $nextNumber,
            'code'     => $candidateCode,
        ];
    }

    /**
     * Commit the generated code sequence to persistent settings.
     */
    public static function recordCodeIssued(string $prefix, int $sequence): void
    {
        $current = (int) Setting::get("code_seq_{$prefix}", '0');
        if ($sequence > $current) {
            Setting::set("code_seq_{$prefix}", (string) $sequence, 'code_sequence');
        }
    }
}
