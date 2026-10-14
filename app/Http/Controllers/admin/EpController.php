<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

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
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('state', 'like', "%{$search}%");
            });
        }

        if ($request->filled('state')) {
            $query->where('state', $request->state);
        }

        $partners = $query->latest()->paginate(15)->withQueryString();
        $states   = Partner::where('registration_type', Partner::REGISTRATION_TYPE_EP)
            ->whereNotNull('state')
            ->distinct()
            ->pluck('state');

        return view('admin.ep.index', compact('partners', 'states'));
    }

    /**
     * Fetch complete details and documents of a specific Executive Partner.
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

        return redirect()->route('admin.ep.index');
    }

    /**
     * Delete an Executive Partner record.
     */
    public function destroy($id)
    {
        $partner = Partner::where('registration_type', Partner::REGISTRATION_TYPE_EP)->findOrFail($id);
        $name    = $partner->name;

        $partner->delete();

        return back()->with('success', "Executive Partner application for '{$name}' has been deleted.");
    }
}
