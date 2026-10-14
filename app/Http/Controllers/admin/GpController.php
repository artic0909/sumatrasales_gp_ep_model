<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class GpController extends Controller
{
    /**
     * Display Ground Partners (GP) management list with search & filters.
     */
    public function index(Request $request)
    {
        $query = Partner::where('registration_type', Partner::REGISTRATION_TYPE_GP);

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
        $states   = Partner::where('registration_type', Partner::REGISTRATION_TYPE_GP)
            ->whereNotNull('state')
            ->distinct()
            ->pluck('state');

        return view('admin.gp.index', compact('partners', 'states'));
    }

    /**
     * Fetch complete details and documents of a specific Ground Partner.
     */
    public function show($id)
    {
        $partner = Partner::with('termsCheck')
            ->where('registration_type', Partner::REGISTRATION_TYPE_GP)
            ->findOrFail($id);

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'data'    => $partner,
            ]);
        }

        return redirect()->route('admin.gp.index');
    }

    /**
     * Delete a Ground Partner record.
     */
    public function destroy($id)
    {
        $partner = Partner::where('registration_type', Partner::REGISTRATION_TYPE_GP)->findOrFail($id);
        $name    = $partner->name;

        $partner->delete();

        return back()->with('success', "Ground Partner application for '{$name}' has been deleted.");
    }
}
