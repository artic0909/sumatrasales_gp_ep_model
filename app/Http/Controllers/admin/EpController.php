<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\PartnerApplicationApproved;
use App\Models\Partner;
use App\Services\PartnerCodeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class EpController extends Controller
{
    /**
     * Display Executive Partners (EP) management list with search & filters.
     */
    public function index(Request $request)
    {
        $query = Partner::where('registration_type', Partner::REGISTRATION_TYPE_EP);

        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('application_code', 'like', "%{$search}%")
                  ->orWhere('approved_code', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('state', 'like', "%{$search}%");
            });
        }

        if ($request->filled('state')) {
            $query->where('state', $request->state);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('interest')) {
            $interest = $request->interest;
            $query->whereJsonContains('interests', $interest);
        }

        $perPageInput = strtolower(trim((string) $request->input('per_page', '10')));
        if ($perPageInput === 'all') {
            $totalCount = (clone $query)->count();
            $perPage = max($totalCount, 1);
        } elseif (in_array((int)$perPageInput, [10, 20, 50, 100])) {
            $perPage = (int) $perPageInput;
        } else {
            $perPage = 10;
        }

        $partners = $query->latest()->paginate($perPage)->withQueryString();
        $states   = Partner::where('registration_type', Partner::REGISTRATION_TYPE_EP)
            ->whereNotNull('state')
            ->distinct()
            ->pluck('state');

        return view('admin.ep.index', compact('partners', 'states'));
    }

    /**
     * Bulk delete selected Executive Partner records.
     */
    public function bulkDestroy(Request $request)
    {
        $ids = (array) $request->input('ids', []);
        if (empty($ids)) {
            return back()->with('error', 'No partner applications selected for bulk deletion.');
        }

        $deletedCount = Partner::where('registration_type', Partner::REGISTRATION_TYPE_EP)
            ->whereIn('id', $ids)
            ->delete();

        return redirect()->route('admin.ep.index')->with('success', "{$deletedCount} Executive Partner applications have been successfully deleted.");
    }

    /**
     * Fetch complete details and documents of a specific Executive Partner on dedicated View page.
     */
    public function show($id)
    {
        $partner = Partner::with('termsCheck')
            ->where('registration_type', Partner::REGISTRATION_TYPE_EP)
            ->findOrFail($id);

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'data'    => $partner,
            ]);
        }

        $suggestedCodeData = PartnerCodeService::generateNextCode($partner);

        return view('admin.ep.show', compact('partner', 'suggestedCodeData'));
    }

    /**
     * Approve an Executive Partner application, generate unique code, and send acceptance email.
     */
    public function approve(Request $request, $id)
    {
        $partner = Partner::where('registration_type', Partner::REGISTRATION_TYPE_EP)->findOrFail($id);

        $autoCodeData = PartnerCodeService::generateNextCode($partner);
        $finalCode = strtoupper(trim((string) $request->input('approved_code', $autoCodeData['code'])));

        if (empty($finalCode)) {
            $finalCode = $autoCodeData['code'];
        }

        // Validate uniqueness
        $exists = Partner::where('approved_code', $finalCode)
            ->where('id', '!=', $partner->id)
            ->exists();

        if ($exists) {
            return back()->with('error', "The partner code '{$finalCode}' is already assigned to another partner. Please choose another code.");
        }

        $partner->status = Partner::STATUS_APPROVED;
        $partner->approved_code = $finalCode;
        $partner->approved_at = now();
        $partner->rejection_reason = null;
        $partner->save();

        // Record the issued sequence number
        $prefix = $autoCodeData['prefix'];
        if (str_starts_with($finalCode, $prefix)) {
            $numPart = substr($finalCode, strlen($prefix));
            if (is_numeric($numPart)) {
                PartnerCodeService::recordCodeIssued($prefix, (int) $numPart);
            }
        }

        // Send acceptance email
        $emailSent = false;
        if ($request->boolean('send_email', true) && !empty($partner->email)) {
            try {
                Mail::to($partner->email)->send(new PartnerApplicationApproved($partner));
                $emailSent = true;
            } catch (\Throwable $e) {
                Log::error("Failed to send EP approval email to {$partner->email}: " . $e->getMessage());
            }
        }

        $msg = "Application for '{$partner->name}' has been APPROVED with Unique Code: {$finalCode}.";
        if ($emailSent) {
            $msg .= " Acceptance email sent to {$partner->email}.";
        }

        return redirect()->route('admin.ep.show', $partner->id)->with('success', $msg);
    }

    /**
     * Reject an Executive Partner application.
     */
    public function reject(Request $request, $id)
    {
        $partner = Partner::where('registration_type', Partner::REGISTRATION_TYPE_EP)->findOrFail($id);

        $partner->status = Partner::STATUS_REJECTED;
        $partner->rejection_reason = $request->input('rejection_reason');
        $partner->save();

        return redirect()->route('admin.ep.show', $partner->id)->with('success', "Application for '{$partner->name}' marked as Rejected.");
    }

    /**
     * Resend official acceptance email to Executive Partner.
     */
    public function resendApprovalEmail($id)
    {
        $partner = Partner::where('registration_type', Partner::REGISTRATION_TYPE_EP)->findOrFail($id);

        if (!$partner->isApproved() || empty($partner->approved_code)) {
            return back()->with('error', "Cannot send approval email because this application is not yet approved.");
        }

        if (empty($partner->email)) {
            return back()->with('error', "This partner does not have a registered email address.");
        }

        try {
            Mail::to($partner->email)->send(new PartnerApplicationApproved($partner));
            return back()->with('success', "Acceptance email has been resent to {$partner->email}.");
        } catch (\Throwable $e) {
            Log::error("Failed to resend EP approval email to {$partner->email}: " . $e->getMessage());
            return back()->with('error', "Could not send email: " . $e->getMessage());
        }
    }

    /**
     * Delete an Executive Partner record.
     */
    public function destroy($id)
    {
        $partner = Partner::where('registration_type', Partner::REGISTRATION_TYPE_EP)->findOrFail($id);
        $name    = $partner->name;

        $partner->delete();

        return redirect()->route('admin.ep.index')->with('success', "Executive Partner application for '{$name}' has been deleted.");
    }
}
