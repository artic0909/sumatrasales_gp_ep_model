@extends('admin.layouts.app')

@section('title', 'Executive Partners (EP)')

@section('content')
<div class="space-y-5">
    
    <!-- HEADER & FILTERS -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200/80">
        <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-blue-50 text-[#2964F2] text-[10px] font-black uppercase tracking-wider border border-blue-200">
                <span>Network Management</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mt-1">
                Executive Partner (EP) Applications
            </h1>
            <p class="text-xs text-slate-500 font-medium">
                Manage, review statutory declarations, and verify KYC for registered Executive Partners.
            </p>
        </div>

        <div class="flex items-center gap-2">
            <span class="px-3 py-1.5 rounded-xl bg-blue-50 text-[#2964F2] text-xs font-black border border-blue-200">
                Total EP: {{ $partners->total() }}
            </span>
            <a href="{{ route('partner.register') }}" target="_blank" class="px-3.5 py-1.5 rounded-xl bg-[#2964F2] hover:bg-blue-600 text-white text-xs font-bold transition shadow-xs inline-flex items-center gap-1">
                <span>+ New EP</span>
            </a>
        </div>
    </div>

    <!-- SEARCH & FILTER TOOLBAR -->
    <form action="{{ route('admin.ep.index') }}" method="GET" class="p-3.5 bg-white rounded-2xl border border-slate-200/90 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="relative w-full sm:w-80">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, code, email, phone..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
        </div>

        <div class="flex items-center gap-2 w-full sm:w-auto flex-wrap">
            <select name="status" onchange="this.form.submit()" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
                <option value="">All Statuses</option>
                <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending Review</option>
                <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>

            @if ($states->count() > 0)
                <select name="state" onchange="this.form.submit()" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 focus:border-[#2964F2] transition">
                    <option value="">All States</option>
                    @foreach ($states as $st)
                        <option value="{{ $st }}" {{ request('state') == $st ? 'selected' : '' }}>{{ $st }}</option>
                    @endforeach
                </select>
            @endif

            <button type="submit" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold transition">
                Filter
            </button>

            @if (request()->hasAny(['search', 'state', 'status']))
                <a href="{{ route('admin.ep.index') }}" class="px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold transition">
                    Reset
                </a>
            @endif
        </div>
    </form>

    <!-- EP DATA TABLE -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
        @if ($partners->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50/80 text-slate-400 font-bold uppercase tracking-wider text-[10px] border-b border-slate-100">
                        <tr>
                            <th class="py-3 px-4">Application Code</th>
                            <th class="py-3 px-4">Partner Name</th>
                            <th class="py-3 px-4">Status / Unique Code</th>
                            <th class="py-3 px-4">Contact Phone & Email</th>
                            <th class="py-3 px-4">City / State</th>
                            <th class="py-3 px-4">Aadhaar / PAN</th>
                            <th class="py-3 px-4">Applied Date</th>
                            <th class="py-3 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach ($partners as $partner)
                            <tr class="hover:bg-slate-50/80 transition">
                                <td class="py-3 px-4 font-mono font-bold text-slate-900 whitespace-nowrap">
                                    {{ $partner->application_code ?: 'SSPL-EP-'.$partner->id }}
                                </td>
                                <td class="py-3 px-4">
                                    <div class="font-bold text-slate-900">{{ $partner->name }}</div>
                                    <span class="inline-block text-[9px] px-1.5 py-0.2 rounded bg-blue-50 text-[#2964F2] font-black uppercase">Executive Partner</span>
                                </td>
                                <td class="py-3 px-4 whitespace-nowrap">
                                    @if($partner->isApproved())
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-emerald-50 text-emerald-700 font-mono font-black text-[11px] border border-emerald-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                            {{ $partner->approved_code }}
                                        </span>
                                    @elseif($partner->isRejected())
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-rose-50 text-rose-700 font-bold text-[10px] border border-rose-200">
                                            Rejected
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md bg-amber-50 text-amber-700 font-bold text-[10px] border border-amber-200">
                                            Pending
                                        </span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">
                                    <div class="font-bold text-slate-800">{{ $partner->phone }}</div>
                                    <div class="text-[10px] text-slate-400">{{ $partner->email }}</div>
                                </td>
                                <td class="py-3 px-4 text-slate-600">
                                    {{ $partner->city ?: 'N/A' }}{{ $partner->state ? ', ' . $partner->state : '' }}
                                </td>
                                <td class="py-3 px-4 font-mono text-[11px] text-slate-600">
                                    <div>A: {{ $partner->aadhaar_number }}</div>
                                    <div>P: {{ $partner->pancard_number }}</div>
                                </td>
                                <td class="py-3 px-4 text-slate-500 whitespace-nowrap">
                                    {{ $partner->created_at->format('d M Y, h:i A') }}
                                </td>
                                <td class="py-3 px-4 text-right space-x-1.5 whitespace-nowrap">
                                    <a href="{{ route('admin.ep.show', $partner->id) }}" class="px-2.5 py-1 rounded-lg bg-[#2964F2] hover:bg-blue-600 text-white text-[11px] font-bold transition inline-block">
                                        View Page
                                    </a>
                                    @if (!empty($partner->application_code))
                                        <a href="{{ route('partner.application.pdf', ['code' => $partner->application_code]) }}" target="_blank" class="px-2 py-1 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-600 text-[11px] font-bold transition inline-block">
                                            PDF ↗
                                        </a>
                                    @endif
                                    <form action="{{ route('admin.ep.destroy', $partner->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this partner record?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-2 py-1 rounded-lg bg-rose-50 hover:bg-rose-100 text-rose-600 text-[11px] font-bold transition">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- PAGINATION -->
            <div class="p-4 border-t border-slate-100">
                {{ $partners->links() }}
            </div>
        @else
            <div class="py-12 px-4 text-center">
                <div class="w-12 h-12 mx-auto rounded-xl bg-blue-50 text-[#2964F2] flex items-center justify-center mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                </div>
                <h3 class="text-sm font-bold text-slate-900">No Executive Partners found</h3>
                <p class="text-xs text-slate-500 mt-1">There are no registered Executive Partner records matching your filters.</p>
            </div>
        @endif
    </div>

</div>
@endsection
