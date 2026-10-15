@extends('admin.layouts.app')

@section('title', 'Contact Inquiries')

@section('content')
<div class="space-y-6">

    <!-- HEADER & STATS BAR -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-slate-200/80">
        <div>
            <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 text-[10px] font-black uppercase tracking-wider border border-indigo-200">
                <span>Inbound Communication</span>
            </div>
            <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mt-1">
                Contact Messages & Inbound Leads
            </h1>
            <p class="text-xs text-slate-500 font-medium">
                Review inquiries received from visitors, potential partners, and client prospects across all portals.
            </p>
        </div>

        <!-- QUICK STAT PILLS -->
        <div class="flex items-center gap-2 flex-wrap">
            <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-white border border-slate-200 shadow-2xs">
                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                <span class="text-[11px] font-bold text-slate-500">Total:</span>
                <span class="text-xs font-black text-slate-900">{{ $totalInquiries }}</span>
            </div>
            <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-indigo-50 border border-indigo-200 shadow-2xs">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-600"></span>
                </span>
                <span class="text-[11px] font-bold text-indigo-700">Unread:</span>
                <span class="text-xs font-black text-indigo-800">{{ $unreadCount }}</span>
            </div>
            <div class="flex items-center gap-2 px-3 py-1.5 rounded-xl bg-emerald-50 border border-emerald-200 shadow-2xs">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                <span class="text-[11px] font-bold text-emerald-700">Read:</span>
                <span class="text-xs font-black text-emerald-800">{{ $readCount }}</span>
            </div>
        </div>
    </div>

    <!-- SEARCH & FILTER TOOLBAR -->
    <form action="{{ route('admin.contact.index') }}" method="GET" class="p-3.5 bg-white rounded-2xl border border-slate-200/90 shadow-xs flex flex-col md:flex-row items-center justify-between gap-3">
        <div class="relative w-full md:w-80">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name, email, phone, message..." class="w-full pl-9 pr-4 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition">
            <svg class="w-4 h-4 text-slate-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
        </div>

        <div class="flex items-center gap-2 w-full md:w-auto flex-wrap sm:flex-nowrap">
            <!-- Filter by Inquiry Type -->
            <select name="type" onchange="this.form.submit()" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition">
                <option value="">All Inquiry Types</option>
                @foreach ($types as $type)
                    <option value="{{ $type }}" {{ request('type') == $type ? 'selected' : '' }}>{{ $type }}</option>
                @endforeach
            </select>

            <!-- Filter by Status -->
            <select name="status" onchange="this.form.submit()" class="px-3 py-2 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-700 focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition">
                <option value="">All Statuses</option>
                <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread Only</option>
                <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read Only</option>
            </select>

            <button type="submit" class="px-4 py-2 rounded-xl bg-slate-800 hover:bg-slate-900 text-white text-xs font-bold transition">
                Filter
            </button>

            @if (request()->hasAny(['search', 'type', 'status']))
                <a href="{{ route('admin.contact.index') }}" class="px-3 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs font-bold transition">
                    Reset
                </a>
            @endif
        </div>
    </form>

    <!-- INBOX TABLE -->
    <div class="bg-white rounded-2xl border border-slate-200/90 shadow-xs overflow-hidden">
        @if ($inquiries->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-50/80 text-slate-400 font-bold uppercase tracking-wider text-[10px] border-b border-slate-100">
                        <tr>
                            <th class="py-3 px-4">Status</th>
                            <th class="py-3 px-4">Sender Details</th>
                            <th class="py-3 px-4">Inquiry Category</th>
                            <th class="py-3 px-4">Message Snippet</th>
                            <th class="py-3 px-4">Received At</th>
                            <th class="py-3 px-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-slate-700">
                        @foreach ($inquiries as $inquiry)
                            <tr class="hover:bg-slate-50/80 transition {{ $inquiry->status === 'unread' ? 'bg-indigo-50/20' : '' }}" id="row-inquiry-{{ $inquiry->id }}">
                                <!-- STATUS -->
                                <td class="py-3 px-4 whitespace-nowrap">
                                    @if ($inquiry->status === 'unread')
                                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-black bg-indigo-100 text-indigo-700 border border-indigo-200">
                                            <span class="w-1.5 h-1.5 rounded-full bg-indigo-600"></span>
                                            NEW
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-slate-100 text-slate-500">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-400"></span>
                                            READ
                                        </span>
                                    @endif
                                </td>

                                <!-- SENDER -->
                                <td class="py-3 px-4">
                                    <div class="font-bold text-slate-900 flex items-center gap-1.5">
                                        <span>{{ $inquiry->name }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 mt-0.5 text-[11px]">
                                        <a href="tel:{{ $inquiry->phone }}" class="text-blue-600 hover:underline flex items-center gap-1" title="Click to call">
                                            <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                                            {{ $inquiry->phone }}
                                        </a>
                                        <span class="text-slate-300">•</span>
                                        <a href="mailto:{{ $inquiry->email }}" class="text-slate-500 hover:text-indigo-600 hover:underline flex items-center gap-1" title="Click to email">
                                            <svg class="w-3 h-3 text-slate-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                                            {{ $inquiry->email }}
                                        </a>
                                    </div>
                                </td>

                                <!-- TYPE -->
                                <td class="py-3 px-4">
                                    @php
                                        $typeColor = 'bg-slate-100 text-slate-700 border-slate-200';
                                        if (str_contains(strtolower($inquiry->inquiry_type), 'executive partner') || str_contains(strtolower($inquiry->inquiry_type), 'ep')) {
                                            $typeColor = 'bg-blue-50 text-blue-700 border-blue-200';
                                        } elseif (str_contains(strtolower($inquiry->inquiry_type), 'ground partner') || str_contains(strtolower($inquiry->inquiry_type), 'gp')) {
                                            $typeColor = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                        } elseif (str_contains(strtolower($inquiry->inquiry_type), 'software') || str_contains(strtolower($inquiry->inquiry_type), 'app') || str_contains(strtolower($inquiry->inquiry_type), 'it')) {
                                            $typeColor = 'bg-purple-50 text-purple-700 border-purple-200';
                                        } elseif (str_contains(strtolower($inquiry->inquiry_type), 'investor')) {
                                            $typeColor = 'bg-amber-50 text-amber-700 border-amber-200';
                                        }
                                    @endphp
                                    <span class="inline-block px-2.5 py-1 rounded-lg text-[10px] font-bold border {{ $typeColor }}">
                                        {{ $inquiry->inquiry_type ?: 'General Inquiry' }}
                                    </span>
                                </td>

                                <!-- MESSAGE SNIPPET -->
                                <td class="py-3 px-4 max-w-xs">
                                    <p class="text-slate-600 line-clamp-2 leading-relaxed" title="{{ $inquiry->message }}">
                                        {{ $inquiry->message }}
                                    </p>
                                </td>

                                <!-- DATE -->
                                <td class="py-3 px-4 whitespace-nowrap text-slate-500">
                                    <div class="font-bold text-slate-700">
                                        {{ $inquiry->created_at ? $inquiry->created_at->timezone('Asia/Kolkata')->format('d M Y') : 'N/A' }}
                                    </div>
                                    <div class="text-[10px] text-slate-400">
                                        {{ $inquiry->created_at ? $inquiry->created_at->timezone('Asia/Kolkata')->format('h:i A') : '' }}
                                        ({{ $inquiry->created_at ? $inquiry->created_at->diffForHumans() : '' }})
                                    </div>
                                </td>

                                <!-- ACTIONS -->
                                <td class="py-3 px-4 text-right space-x-1.5 whitespace-nowrap">
                                    <!-- View Details Button -->
                                    <button type="button" onclick="openInquiryModal({{ json_encode([
                                        'id' => $inquiry->id,
                                        'name' => $inquiry->name,
                                        'phone' => $inquiry->phone,
                                        'email' => $inquiry->email,
                                        'inquiry_type' => $inquiry->inquiry_type ?: 'General Inquiry',
                                        'message' => $inquiry->message,
                                        'status' => $inquiry->status,
                                        'ip_address' => $inquiry->ip_address ?: 'Not recorded',
                                        'date' => $inquiry->created_at ? $inquiry->created_at->timezone('Asia/Kolkata')->format('d M Y, h:i A') : 'N/A',
                                        'time_ago' => $inquiry->created_at ? $inquiry->created_at->diffForHumans() : '',
                                    ]) }})" class="px-2.5 py-1 rounded-lg bg-indigo-50 hover:bg-indigo-100 text-indigo-700 text-[11px] font-bold transition">
                                        View Message
                                    </button>

                                    <!-- Toggle Status Button -->
                                    <form action="{{ route('admin.contact.toggleStatus', $inquiry->id) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="px-2 py-1 rounded-lg {{ $inquiry->status === 'unread' ? 'bg-slate-100 hover:bg-slate-200 text-slate-600' : 'bg-amber-50 hover:bg-amber-100 text-amber-700' }} text-[11px] font-bold transition" title="{{ $inquiry->status === 'unread' ? 'Mark as Read' : 'Mark as Unread' }}">
                                            {{ $inquiry->status === 'unread' ? 'Mark Read' : 'Unread' }}
                                        </button>
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="{{ route('admin.contact.destroy', $inquiry->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this inquiry from {{ addslashes($inquiry->name) }}?')">
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
                {{ $inquiries->links() }}
            </div>
        @else
            <!-- EMPTY STATE -->
            <div class="py-16 px-4 text-center">
                <div class="w-14 h-14 mx-auto rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center mb-3 border border-indigo-100">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                </div>
                <h3 class="text-sm font-bold text-slate-900">No Contact Messages Found</h3>
                <p class="text-xs text-slate-500 mt-1 max-w-sm mx-auto">
                    @if(request()->hasAny(['search', 'type', 'status']))
                        No inquiries match your current search or filter criteria. Try resetting your filters.
                    @else
                        Direct messages submitted through the website contact form will appear here with instant email notifications sent to both you and the sender.
                    @endif
                </p>
                @if(request()->hasAny(['search', 'type', 'status']))
                    <div class="mt-4">
                        <a href="{{ route('admin.contact.index') }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl bg-slate-900 text-white text-xs font-bold hover:bg-slate-800 transition">
                            Reset Filters
                        </a>
                    </div>
                @endif
            </div>
        @endif
    </div>

</div>

<!-- INQUIRY DETAILS MODAL -->
<div id="inquiryModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <!-- Backdrop -->
    <div class="fixed inset-0 bg-slate-950/70 backdrop-blur-xs transition-opacity" onclick="closeInquiryModal()"></div>

    <!-- Modal Box -->
    <div class="min-h-full flex items-center justify-center p-4">
        <div class="relative bg-white rounded-3xl max-w-2xl w-full p-6 sm:p-8 shadow-2xl border border-slate-100 z-10 transition-all">
            
            <!-- Modal Header -->
            <div class="flex items-start justify-between gap-4 pb-4 border-b border-slate-100">
                <div>
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-indigo-50 text-indigo-700 text-[10px] font-black uppercase tracking-wider border border-indigo-200">
                        <span id="modal-type">Inquiry</span>
                    </div>
                    <h3 class="text-lg font-black text-slate-900 mt-1" id="modal-name">Sender Name</h3>
                    <p class="text-xs text-slate-400" id="modal-date">Received date</p>
                </div>
                <button type="button" onclick="closeInquiryModal()" class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 flex items-center justify-center transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <!-- Contact Details Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 py-4 border-b border-slate-100">
                <div class="p-3 bg-slate-50 rounded-xl">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Phone Number</span>
                    <a id="modal-phone-link" href="#" class="text-xs font-bold text-blue-600 hover:underline flex items-center gap-1 mt-0.5">
                        <svg class="w-3.5 h-3.5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                        <span id="modal-phone">+91 00000 00000</span>
                    </a>
                </div>

                <div class="p-3 bg-slate-50 rounded-xl">
                    <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400 block">Email Address</span>
                    <a id="modal-email-link" href="#" class="text-xs font-bold text-indigo-600 hover:underline flex items-center gap-1 mt-0.5">
                        <svg class="w-3.5 h-3.5 text-indigo-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                        <span id="modal-email">email@example.com</span>
                    </a>
                </div>
            </div>

            <!-- Full Message Body -->
            <div class="py-4 space-y-2">
                <span class="text-[10px] font-bold uppercase tracking-wider text-slate-400">Message / Inquiry Details</span>
                <div class="p-4 bg-slate-50/80 rounded-2xl border border-slate-200/80 text-xs text-slate-800 leading-relaxed whitespace-pre-line max-h-60 overflow-y-auto" id="modal-message">
                    ...
                </div>
            </div>

            <!-- Footer & Actions -->
            <div class="pt-4 flex flex-col sm:flex-row items-center justify-between gap-3 border-t border-slate-100">
                <span class="text-[10px] text-slate-400" id="modal-ip">
                    IP: 127.0.0.1
                </span>

                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <a id="modal-reply-btn" href="#" class="flex-1 sm:flex-initial inline-flex items-center justify-center gap-1.5 px-4 py-2 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold transition shadow-xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" /></svg>
                        <span>Reply via Email</span>
                    </a>
                    <button type="button" onclick="closeInquiryModal()" class="px-4 py-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-bold transition">
                        Close
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    function openInquiryModal(inquiry) {
        document.getElementById('modal-type').innerText = inquiry.inquiry_type || 'General Inquiry';
        document.getElementById('modal-name').innerText = inquiry.name;
        document.getElementById('modal-date').innerText = inquiry.date + (inquiry.time_ago ? ' (' + inquiry.time_ago + ')' : '');
        document.getElementById('modal-phone').innerText = inquiry.phone;
        document.getElementById('modal-phone-link').href = 'tel:' + inquiry.phone;
        document.getElementById('modal-email').innerText = inquiry.email;
        document.getElementById('modal-email-link').href = 'mailto:' + inquiry.email;
        document.getElementById('modal-message').innerText = inquiry.message;
        document.getElementById('modal-ip').innerText = 'IP Address: ' + inquiry.ip_address;
        document.getElementById('modal-reply-btn').href = 'mailto:' + encodeURIComponent(inquiry.email) + '?subject=' + encodeURIComponent('Regarding your inquiry: ' + (inquiry.inquiry_type || 'Sumatra Sales'));

        // Auto mark as read in background if unread
        if (inquiry.status === 'unread') {
            fetch('/admin/contact/' + inquiry.id, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            }).catch(console.error);
        }

        document.getElementById('inquiryModal').classList.remove('hidden');
    }

    function closeInquiryModal() {
        document.getElementById('inquiryModal').classList.add('hidden');
    }

    // Close on Escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeInquiryModal();
        }
    });
</script>
@endsection
