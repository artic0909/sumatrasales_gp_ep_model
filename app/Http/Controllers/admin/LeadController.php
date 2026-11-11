<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Services\FacebookCapiService;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    /**
     * Display Facebook Leads listing with search & filters.
     */
    public function index(Request $request)
    {
        $query = Lead::query();

        // Search by keyword
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('ad_name', 'like', "%{$search}%")
                  ->orWhere('campaign_name', 'like', "%{$search}%")
                  ->orWhere('fb_leadgen_id', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status') && in_array($request->status, ['new', 'good_lead', 'bad_lead', 'contacted'])) {
            $query->where('status', $request->status);
        }

        // Filter by Meta CAPI sync status
        if ($request->filled('synced')) {
            if ($request->synced === 'synced') {
                $query->where('synced_to_fb', true);
            } elseif ($request->synced === 'unsynced') {
                $query->where('synced_to_fb', false);
            }
        }

        // Per page pagination
        $perPageInput = strtolower(trim((string) $request->input('per_page', '10')));
        if ($perPageInput === 'all') {
            $totalCount = (clone $query)->count();
            $perPage = max($totalCount, 1);
        } elseif (in_array((int)$perPageInput, [10, 20, 50, 100])) {
            $perPage = (int) $perPageInput;
        } else {
            $perPage = 10;
        }

        $leads = $query->latest()->paginate($perPage)->withQueryString();

        // Counters for quick stats
        $totalLeads  = Lead::count();
        $newCount    = Lead::where('status', 'new')->count();
        $goodCount   = Lead::where('status', 'good_lead')->count();
        $badCount    = Lead::where('status', 'bad_lead')->count();
        $syncedCount = Lead::where('synced_to_fb', true)->count();

        return view('admin.leads.ads.index', compact(
            'leads',
            'totalLeads',
            'newCount',
            'goodCount',
            'badCount',
            'syncedCount'
        ));
    }

    /**
     * Show the form for creating a new lead manually.
     */
    public function create()
    {
        return view('admin.leads.ads.create');
    }

    /**
     * Store a newly created lead in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email|max:255',
            'phone'         => 'nullable|string|max:50',
            'ad_name'       => 'nullable|string|max:255',
            'ad_id'         => 'nullable|string|max:100',
            'campaign_name' => 'nullable|string|max:255',
            'status'        => 'required|in:new,good_lead,bad_lead,contacted',
            'notes'         => 'nullable|string',
        ]);

        $lead = Lead::create($validated);

        // If marked as good lead right away, trigger Meta CAPI
        if ($lead->status === 'good_lead') {
            $capiResult = FacebookCapiService::sendStatusEvent($lead, 'QualifiedLead');
            if ($capiResult['success']) {
                $lead->update([
                    'synced_to_fb' => true,
                    'synced_at' => now(),
                ]);
            }
        }

        return redirect()->route('admin.leads.index')->with('success', 'Lead created successfully!');
    }

    /**
     * Display the specified lead.
     */
    public function show($id)
    {
        $lead = Lead::findOrFail($id);
        return view('admin.leads.ads.view', compact('lead'));
    }

    /**
     * Show the form for editing the specified lead.
     */
    public function edit($id)
    {
        $lead = Lead::findOrFail($id);
        return view('admin.leads.ads.edit', compact('lead'));
    }

    /**
     * Update the specified lead in storage.
     */
    public function update(Request $request, $id)
    {
        $lead = Lead::findOrFail($id);

        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'email'         => 'nullable|email|max:255',
            'phone'         => 'nullable|string|max:50',
            'ad_name'       => 'nullable|string|max:255',
            'campaign_name' => 'nullable|string|max:255',
            'status'        => 'required|in:new,good_lead,bad_lead,contacted',
            'notes'         => 'nullable|string',
        ]);

        $oldStatus = $lead->status;
        $lead->update($validated);

        // If status changed to good_lead and not synced yet, push to Meta CAPI
        if ($lead->status === 'good_lead' && ($oldStatus !== 'good_lead' || !$lead->synced_to_fb)) {
            $capiResult = FacebookCapiService::sendStatusEvent($lead, 'QualifiedLead');
            if ($capiResult['success']) {
                $lead->update([
                    'synced_to_fb' => true,
                    'synced_at' => now(),
                ]);
                return redirect()->route('admin.leads.index')->with('success', 'Lead updated and successfully synced to Meta CAPI as QualifiedLead!');
            } else {
                return redirect()->route('admin.leads.index')->with('warning', 'Lead updated, but Meta CAPI sync returned: ' . ($capiResult['error'] ?? 'Unknown error'));
            }
        }

        return redirect()->route('admin.leads.index')->with('success', 'Lead updated successfully!');
    }

    /**
     * Update lead review status and trigger CAPI feedback loop when marked as 'good_lead'.
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:new,good_lead,bad_lead,contacted'
        ]);

        $lead = Lead::findOrFail($id);
        $lead->status = $request->status;

        $syncedMessage = '';

        if ($request->status === 'good_lead') {
            $capiResult = FacebookCapiService::sendStatusEvent($lead, 'QualifiedLead');
            if ($capiResult['success']) {
                $lead->synced_to_fb = true;
                $lead->synced_at = now();
                $syncedMessage = ' and successfully synced with Meta CAPI (QualifiedLead event)!';
            } else {
                $syncedMessage = ', but Meta CAPI sync failed: ' . ($capiResult['error'] ?? 'Unknown error');
            }
        }

        $lead->save();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'status' => $lead->status,
                'synced_to_fb' => $lead->synced_to_fb,
                'message' => 'Lead status updated' . $syncedMessage
            ]);
        }

        return back()->with('success', 'Lead status updated to ' . ucfirst(str_replace('_', ' ', $lead->status)) . $syncedMessage);
    }

    /**
     * Explicitly trigger / resync Meta CAPI for a lead.
     */
    public function syncCapi($id)
    {
        $lead = Lead::findOrFail($id);
        $eventName = ($lead->status === 'good_lead') ? 'QualifiedLead' : 'Lead';

        $result = FacebookCapiService::sendStatusEvent($lead, $eventName);

        if ($result['success']) {
            $lead->update([
                'synced_to_fb' => true,
                'synced_at' => now(),
            ]);
            return back()->with('success', "Meta CAPI event ({$eventName}) sent successfully!");
        }

        return back()->with('error', 'Meta CAPI delivery failed: ' . ($result['error'] ?? 'Unknown error'));
    }

    /**
     * Delete a single lead.
     */
    public function destroy($id)
    {
        $lead = Lead::findOrFail($id);
        $lead->delete();

        return redirect()->route('admin.leads.index')->with('success', 'Lead deleted successfully.');
    }

    /**
     * Bulk delete leads.
     */
    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (!empty($ids)) {
            Lead::whereIn('id', $ids)->delete();
            return redirect()->route('admin.leads.index')->with('success', count($ids) . ' leads deleted successfully.');
        }

        return redirect()->route('admin.leads.index')->with('error', 'No leads selected for deletion.');
    }
}

