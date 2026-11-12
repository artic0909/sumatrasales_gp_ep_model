<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\LeadFollowup;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class LeadFollowupController extends Controller
{
    /**
     * Display a listing of all follow-up logs across all leads.
     */
    public function index(Request $request)
    {
        // Graceful check if table exists
        if (!Schema::hasTable('lead_followups')) {
            return view('admin.leads.followups.index', [
                'followups' => new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10),
                'totalFollowups' => 0,
                'callingCount' => 0,
                'whatsappCount' => 0,
                'bothCount' => 0,
                'todayCount' => 0,
                'tableMissing' => true,
            ]);
        }

        $query = LeadFollowup::with('lead');

        // Search by Lead Name, Phone, Email, Campaign, or Discussion Notes
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('notes', 'like', "%{$search}%")
                  ->orWhere('status', 'like', "%{$search}%")
                  ->orWhereHas('lead', function ($lq) use ($search) {
                      $lq->where('name', 'like', "%{$search}%")
                         ->orWhere('phone', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%")
                         ->orWhere('campaign_name', 'like', "%{$search}%")
                         ->orWhere('ad_name', 'like', "%{$search}%");
                  });
            });
        }

        // Filter by Type / Channel (calling, whatsapp, both)
        if ($request->filled('type') && in_array($request->type, ['calling', 'whatsapp', 'both', 'other'])) {
            $query->where('type', $request->type);
        }

        // Filter by Status / Outcome
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by Specific Lead
        if ($request->filled('lead_id')) {
            $query->where('lead_id', $request->lead_id);
        }

        // Filter by Date Range
        if ($request->filled('from_date')) {
            $query->whereDate('followup_date', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('followup_date', '<=', $request->to_date);
        }

        // Pagination
        $perPageInput = strtolower(trim((string) $request->input('per_page', '15')));
        if ($perPageInput === 'all') {
            $totalCount = (clone $query)->count();
            $perPage = max($totalCount, 1);
        } elseif (in_array((int)$perPageInput, [10, 15, 25, 50, 100])) {
            $perPage = (int) $perPageInput;
        } else {
            $perPage = 15;
        }

        $followups = $query->latest('followup_date')->paginate($perPage)->withQueryString();

        // Counters for KPI Stats
        $totalFollowups = LeadFollowup::count();
        $callingCount   = LeadFollowup::where('type', 'calling')->count();
        $whatsappCount  = LeadFollowup::where('type', 'whatsapp')->count();
        $bothCount      = LeadFollowup::where('type', 'both')->count();
        $todayCount     = LeadFollowup::whereDate('followup_date', Carbon::today())->count();

        return view('admin.leads.followups.index', compact(
            'followups',
            'totalFollowups',
            'callingCount',
            'whatsappCount',
            'bothCount',
            'todayCount'
        ));
    }

    /**
     * Store a new follow-up record for a specific lead.
     */
    public function store(Request $request, $leadId)
    {
        $request->validate([
            'type'               => 'required|in:calling,whatsapp,both,other',
            'notes'              => 'nullable|string|max:2000',
            'status'             => 'nullable|string|max:60',
            'followup_date'      => 'nullable|date',
            'next_followup_date' => 'nullable|date',
        ]);

        $lead = Lead::findOrFail($leadId);

        $followupDate = $request->filled('followup_date') 
            ? Carbon::parse($request->followup_date) 
            : Carbon::now();

        $nextFollowupDate = $request->filled('next_followup_date') 
            ? Carbon::parse($request->next_followup_date) 
            : null;

        $user = Auth::user();

        $followup = LeadFollowup::create([
            'lead_id'            => $lead->id,
            'type'               => $request->type,
            'notes'              => $request->notes,
            'status'             => $request->status,
            'followup_date'      => $followupDate,
            'next_followup_date' => $nextFollowupDate,
            'user_id'            => $user?->id,
            'created_by_name'    => $user?->name ?? 'Admin',
        ]);

        // If lead was 'new', update status to 'contacted'
        if ($lead->status === 'new') {
            $lead->update(['status' => 'contacted']);
        }

        // If the follow-up specifies an explicit lead status like 'good_lead' or 'bad_lead', update lead as well
        if ($request->filled('lead_status') && in_array($request->lead_status, ['good_lead', 'bad_lead', 'contacted', 'new'])) {
            $lead->update(['status' => $request->lead_status]);
        }

        $totalCount = $lead->followups()->count();

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Follow-up successfully recorded!',
                'count'   => $totalCount,
                'followup' => [
                    'id'                 => $followup->id,
                    'type'               => $followup->type,
                    'type_label'         => $followup->type_label,
                    'type_icon'          => $followup->type_icon,
                    'notes'              => $followup->notes,
                    'status'             => $followup->status,
                    'followup_date'      => $followup->followup_date ? $followup->followup_date->format('M d, Y h:i A') : 'Just now',
                    'followup_time_ago'  => $followup->followup_date ? $followup->followup_date->diffForHumans() : 'Just now',
                    'next_followup_date' => $followup->next_followup_date ? $followup->next_followup_date->format('M d, Y h:i A') : null,
                    'created_by_name'    => $followup->created_by_name ?: 'Admin',
                ],
            ]);
        }

        return back()->with('success', "Follow-up ({$followup->type_label}) logged successfully!");
    }

    /**
     * Get all follow-ups for a specific lead as JSON (for the modal).
     */
    public function getFollowups($leadId)
    {
        $lead = Lead::findOrFail($leadId);

        $followups = $lead->followups()->orderByDesc('followup_date')->get()->map(function ($f) {
            return [
                'id'                 => $f->id,
                'type'               => $f->type,
                'type_label'         => $f->type_label,
                'type_icon'          => $f->type_icon,
                'notes'              => $f->notes,
                'status'             => $f->status,
                'followup_date'      => $f->followup_date ? $f->followup_date->format('M d, Y h:i A') : 'N/A',
                'followup_time_ago'  => $f->followup_date ? $f->followup_date->diffForHumans() : '',
                'next_followup_date' => $f->next_followup_date ? $f->next_followup_date->format('M d, Y h:i A') : null,
                'created_by_name'    => $f->created_by_name ?: 'Admin',
            ];
        });

        return response()->json([
            'success'   => true,
            'lead'      => [
                'id'            => $lead->id,
                'name'          => $lead->name ?: 'Lead #' . $lead->id,
                'phone'         => $lead->phone,
                'email'         => $lead->email,
                'campaign_name' => $lead->campaign_name,
                'ad_name'       => $lead->ad_name,
                'status'        => $lead->status,
            ],
            'count'     => $followups->count(),
            'followups' => $followups,
        ]);
    }

    /**
     * Delete a follow-up record.
     */
    public function destroy($id)
    {
        $followup = LeadFollowup::findOrFail($id);
        $leadId = $followup->lead_id;
        $followup->delete();

        if (request()->wantsJson() || request()->ajax()) {
            $remainingCount = LeadFollowup::where('lead_id', $leadId)->count();
            return response()->json([
                'success' => true,
                'message' => 'Follow-up deleted successfully',
                'count' => $remainingCount,
            ]);
        }

        return back()->with('success', 'Follow-up log deleted successfully.');
    }
}

