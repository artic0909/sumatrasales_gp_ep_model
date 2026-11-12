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

        // Filter by specific Ad Name or Ad ID
        if ($request->filled('ad')) {
            $adFilter = trim($request->ad);
            $query->where(function ($q) use ($adFilter) {
                $q->where('ad_id', $adFilter)
                  ->orWhere('ad_name', $adFilter);
            });
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

        // Get list of distinct Ads & Campaigns for filtering
        $availableAds = Lead::whereNotNull('ad_name')
            ->where('ad_name', '!=', '')
            ->select('ad_name', 'ad_id')
            ->distinct()
            ->orderBy('ad_name')
            ->get();

        return view('admin.leads.ads.index', compact(
            'leads',
            'totalLeads',
            'newCount',
            'goodCount',
            'badCount',
            'syncedCount',
            'availableAds'
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

    /**
     * Fetch past historical leads directly from Facebook Instant Forms.
     */
    public function syncPastLeads()
    {
        $rawToken = config('services.facebook.page_access_token') ?: env('FB_PAGE_ACCESS_TOKEN');
        $pageId = '1310217108840460';

        if (empty($rawToken)) {
            return back()->with('error', 'Cannot sync past leads: FB_PAGE_ACCESS_TOKEN is missing in .env');
        }

        $accessToken = FacebookCapiService::resolvePageAccessToken($rawToken, $pageId);

        try {
            $formsResponse = \Illuminate\Support\Facades\Http::timeout(15)->get("https://graph.facebook.com/v19.0/{$pageId}/leadgen_forms", [
                'access_token' => $accessToken,
                'limit' => 50,
            ]);

            if (!$formsResponse->successful()) {
                return back()->with('error', 'Failed to retrieve forms from Facebook: ' . $formsResponse->body());
            }

            $forms = $formsResponse->json('data') ?? [];
            $totalSynced = 0;

            foreach ($forms as $form) {
                $formId = $form['id'];
                $formName = $form['name'] ?? 'Instant Form';

                $leadsResponse = \Illuminate\Support\Facades\Http::timeout(20)->get("https://graph.facebook.com/v19.0/{$formId}/leads", [
                    'fields' => 'id,created_time,ad_id,ad_name,adset_id,adset_name,campaign_id,campaign_name,form_id,is_organic,field_data',
                    'access_token' => $accessToken,
                    'limit' => 100,
                ]);

                if ($leadsResponse->successful()) {
                    $leads = $leadsResponse->json('data') ?? [];

                    foreach ($leads as $leadItem) {
                        $leadgenId = $leadItem['id'];
                        $adId = $leadItem['ad_id'] ?? null;
                        $adName = $leadItem['ad_name'] ?? null;
                        $adsetId = $leadItem['adset_id'] ?? null;
                        $adsetName = $leadItem['adset_name'] ?? null;
                        $campaignId = $leadItem['campaign_id'] ?? null;
                        $campaignName = $leadItem['campaign_name'] ?? null;
                        $createdAt = isset($leadItem['created_time']) ? \Carbon\Carbon::parse($leadItem['created_time']) : now();

                        $fieldData = collect($leadItem['field_data'] ?? []);
                        $email = null;
                        $phone = null;
                        $fullName = null;

                        foreach ($fieldData as $field) {
                            $name = strtolower($field['name'] ?? '');
                            $val = $field['values'][0] ?? null;

                            if (in_array($name, ['email', 'user_email', 'work_email'])) {
                                $email = $val;
                            } elseif (in_array($name, ['phone_number', 'phone', 'contact_number', 'mobile_number'])) {
                                $phone = $val;
                            } elseif (in_array($name, ['full_name', 'name', 'first_name', 'last_name'])) {
                                if ($name === 'full_name' || empty($fullName)) {
                                    $fullName = $val;
                                }
                            }
                        }

                        // If ad_id exists and ad_name was not populated directly, fetch ad details
                        if ($adId && empty($adName)) {
                            $adRes = \Illuminate\Support\Facades\Http::timeout(5)->get("https://graph.facebook.com/v19.0/{$adId}", [
                                'fields' => 'name,campaign{name},adset{name}',
                                'access_token' => $accessToken,
                            ]);
                            if ($adRes->successful()) {
                                $adName = $adRes->json('name');
                                $campaignName = $campaignName ?? $adRes->json('campaign.name');
                                $adsetName = $adsetName ?? $adRes->json('adset.name');
                            }
                        }

                        Lead::updateOrCreate(
                            ['fb_leadgen_id' => $leadgenId],
                            [
                                'page_id'       => $pageId,
                                'form_id'       => $formId,
                                'form_name'     => $formName,
                                'ad_id'         => $adId,
                                'ad_name'       => $adName,
                                'adset_id'      => $adsetId,
                                'adset_name'    => $adsetName,
                                'campaign_id'   => $campaignId,
                                'campaign_name' => $campaignName,
                                'name'          => $fullName,
                                'email'         => $email,
                                'phone'         => $phone,
                                'status'        => 'new',
                                'raw_data'      => $leadItem,
                                'created_at'    => $createdAt,
                            ]
                        );

                        $totalSynced++;
                    }
                }
            }

            return back()->with('success', "Success! Synchronized {$totalSynced} past lead(s) from Facebook into your CRM.");
        } catch (\Throwable $e) {
            return back()->with('error', 'Exception while syncing past leads: ' . $e->getMessage());
        }
    }
}

