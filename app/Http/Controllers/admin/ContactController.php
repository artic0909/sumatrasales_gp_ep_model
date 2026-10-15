<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\ContactInquiry;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display Contact Inquiries & Inbound Leads inbox with search & filters.
     */
    public function index(Request $request)
    {
        $query = ContactInquiry::query();

        // Search by keyword
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('inquiry_type', 'like', "%{$search}%")
                  ->orWhere('message', 'like', "%{$search}%");
            });
        }

        // Filter by inquiry type
        if ($request->filled('type')) {
            $query->where('inquiry_type', $request->type);
        }

        // Filter by status (read / unread)
        if ($request->filled('status') && in_array($request->status, ['read', 'unread'])) {
            $query->where('status', $request->status);
        }

        $inquiries = $query->latest()->paginate(15)->withQueryString();

        // Counters for quick stats
        $totalInquiries = ContactInquiry::count();
        $unreadCount    = ContactInquiry::where('status', 'unread')->count();
        $readCount      = ContactInquiry::where('status', 'read')->count();

        // Distinct inquiry types for filtering
        $types = ContactInquiry::whereNotNull('inquiry_type')
            ->distinct()
            ->pluck('inquiry_type');

        return view('admin.contact.index', compact(
            'inquiries',
            'totalInquiries',
            'unreadCount',
            'readCount',
            'types'
        ));
    }

    /**
     * Show single inquiry details and mark as read.
     */
    public function show($id)
    {
        $inquiry = ContactInquiry::findOrFail($id);

        if ($inquiry->status === 'unread') {
            $inquiry->update(['status' => 'read']);
        }

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'data' => [
                    'id'           => $inquiry->id,
                    'name'         => $inquiry->name,
                    'phone'        => $inquiry->phone,
                    'email'        => $inquiry->email,
                    'inquiry_type' => $inquiry->inquiry_type,
                    'message'      => $inquiry->message,
                    'status'       => $inquiry->status,
                    'ip_address'   => $inquiry->ip_address,
                    'created_at'   => $inquiry->created_at ? $inquiry->created_at->timezone('Asia/Kolkata')->format('d M Y, h:i A') : 'N/A',
                ],
            ]);
        }

        return redirect()->route('admin.contact.index');
    }

    /**
     * Toggle status between unread and read.
     */
    public function toggleStatus($id)
    {
        $inquiry = ContactInquiry::findOrFail($id);
        $newStatus = ($inquiry->status === 'unread') ? 'read' : 'unread';
        $inquiry->update(['status' => $newStatus]);

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'status'  => $newStatus,
            ]);
        }

        return back()->with('success', "Inquiry from {$inquiry->name} marked as {$newStatus}.");
    }

    /**
     * Delete an inquiry record.
     */
    public function destroy($id)
    {
        $inquiry = ContactInquiry::findOrFail($id);
        $name    = $inquiry->name;

        $inquiry->delete();

        return back()->with('success', "Contact inquiry from '{$name}' has been deleted.");
    }
}
