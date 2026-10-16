@extends('admin.layouts.app')

@section('title', 'EP Application: ' . $partner->name)

@section('content')
<div class="space-y-6 max-w-6xl mx-auto">
    
    <!-- TOP NAVIGATION & ACTIONS BAR -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-slate-200">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.ep.index') }}" class="w-9 h-9 rounded-xl bg-white border border-slate-200 hover:bg-slate-100 flex items-center justify-center text-slate-600 transition shadow-2xs" title="Back to EP List">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
            </a>
            <div>
                <div class="flex items-center gap-2">
                    <span class="px-2 py-0.5 rounded-md bg-blue-50 text-[#2964F2] text-[10px] font-black uppercase tracking-wider border border-blue-200">
                        Executive Partner (EP)
                    </span>
                    <span class="text-xs font-mono font-bold text-slate-400">
                        {{ $partner->application_code ?: 'SSPL-EP-'.$partner->id }}
                    </span>
                </div>
                <h1 class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight mt-0.5">
                    {{ $partner->name }}
                </h1>
            </div>
        </div>

        <div class="flex items-center flex-wrap gap-2">
            <!-- STATUS BADGE -->
            @if($partner->isApproved())
                <span class="px-3 py-1.5 rounded-xl bg-emerald-50 text-emerald-700 text-xs font-black border border-emerald-200 flex items-center gap-1.5 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    APPROVED • <span class="font-mono text-emerald-800">{{ $partner->approved_code }}</span>
                </span>
            @elseif($partner->isRejected())
                <span class="px-3 py-1.5 rounded-xl bg-rose-50 text-rose-700 text-xs font-black border border-rose-200 flex items-center gap-1.5 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-rose-500"></span>
                    REJECTED
                </span>
            @else
                <span class="px-3 py-1.5 rounded-xl bg-amber-50 text-amber-700 text-xs font-black border border-amber-200 flex items-center gap-1.5 shadow-2xs">
                    <span class="w-2 h-2 rounded-full bg-amber-500"></span>
                    PENDING REVIEW
                </span>
            @endif

            @if (!empty($partner->application_code))
                <a href="{{ route('partner.application.pdf', ['code' => $partner->application_code]) }}" target="_blank" class="px-3.5 py-1.5 rounded-xl bg-white border border-slate-200 hover:bg-slate-50 text-slate-700 text-xs font-bold transition shadow-2xs inline-flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                    <span>Download PDF</span>
                </a>
            @endif

            <form action="{{ route('admin.ep.destroy', $partner->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this partner record completely?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-3 py-1.5 rounded-xl bg-rose-50 hover:bg-rose-100 text-rose-600 text-xs font-bold transition border border-rose-200 inline-flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                    <span>Delete</span>
                </button>
            </form>
        </div>
    </div>

    <!-- ACTION CALLOUT: APPROVAL / UNIQUE CODE WORKFLOW -->
    @if(!$partner->isApproved())
        <div class="p-5 sm:p-6 bg-linear-to-r from-blue-50 via-white to-blue-50/50 rounded-2xl border-2 border-[#2964F2]/30 shadow-sm">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="space-y-1.5 max-w-xl">
                    <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-blue-100 text-[#2964F2] text-[10px] font-black uppercase tracking-wider">
                        <span>Application Approval Action</span>
                    </div>
                    <h3 class="text-base sm:text-lg font-black text-slate-900">
                        Approve Candidate & Issue Official EP Code
                    </h3>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Approving this form assigns a sequential unique code based on the project selection (<span class="font-bold text-slate-800">Prefix: {{ $suggestedCodeData['prefix'] }}</span>). An official acceptance email will be automatically sent to <span class="font-bold text-slate-800">{{ $partner->email }}</span>.
                    </p>
                </div>

                <div class="shrink-0 w-full md:w-auto">
                    <form action="{{ route('admin.ep.approve', $partner->id) }}" method="POST" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                        @csrf
                        <div class="relative">
                            <label class="block text-[10px] font-bold uppercase tracking-wider text-slate-500 mb-1">Generated Unique Code</label>
                            <input type="text" name="approved_code" value="{{ $suggestedCodeData['code'] }}" required class="w-full sm:w-44 px-3 py-2 bg-white border-2 border-[#2964F2] rounded-xl font-mono text-sm font-black text-[#2964F2] tracking-wider focus:outline-none focus:ring-2 focus:ring-[#2964F2]/20 shadow-2xs">
                        </div>
                        
                        <div class="flex flex-col justify-end pt-5 sm:pt-0">
                            <label class="inline-flex items-center gap-1.5 text-xs text-slate-600 font-medium cursor-pointer mb-1.5">
                                <input type="checkbox" name="send_email" value="1" checked class="rounded text-[#2964F2] focus:ring-[#2964F2] w-4 h-4">
                                <span>Send acceptance email</span>
                            </label>
                            <button type="submit" class="px-5 py-2.5 rounded-xl bg-[#2964F2] hover:bg-blue-600 text-white text-xs font-black transition shadow-sm inline-flex items-center justify-center gap-1.5 cursor-pointer">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                <span>Approve & Send Email</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            @if(!$partner->isRejected())
                <div class="mt-4 pt-4 border-t border-blue-100 flex items-center justify-between text-xs">
                    <span class="text-slate-500">Need more information or cannot verify KYC?</span>
                    <button type="button" onclick="document.getElementById('reject-form-modal').classList.remove('hidden')" class="text-rose-600 hover:text-rose-800 font-bold hover:underline">
                        Reject Application →
                    </button>
                </div>
            @endif
        </div>
    @else
        <!-- APPROVED BANNER -->
        <div class="p-5 sm:p-6 bg-emerald-50/70 rounded-2xl border border-emerald-200 shadow-2xs flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-2xl bg-emerald-500 text-white flex items-center justify-center shrink-0 shadow-xs">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs font-bold text-emerald-800 uppercase tracking-wider">Officially Approved Executive Partner</span>
                        <span class="text-[11px] text-emerald-600 font-medium">• Approved on {{ $partner->approved_at ? $partner->approved_at->format('d M Y, h:i A') : 'N/A' }}</span>
                    </div>
                    <div class="flex items-center gap-3 mt-1">
                        <span class="font-mono text-2xl font-black text-emerald-900 tracking-wider">
                            {{ $partner->approved_code }}
                        </span>
                        <button type="button" onclick="navigator.clipboard.writeText('{{ $partner->approved_code }}'); alert('Copied partner code: {{ $partner->approved_code }}')" class="px-2 py-0.5 rounded-md bg-white border border-emerald-200 hover:bg-emerald-100 text-emerald-700 text-[11px] font-bold transition">
                            Copy Code
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <form action="{{ route('admin.ep.resendEmail', $partner->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="px-4 py-2 rounded-xl bg-white border border-emerald-300 hover:bg-emerald-50 text-emerald-800 text-xs font-bold transition shadow-2xs inline-flex items-center gap-1.5">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                        <span>Resend Acceptance Email</span>
                    </button>
                </form>
            </div>
        </div>
    @endif

    <!-- DETAILS GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- LEFT COLUMN: PROFILE & BASIC INFO -->
        <div class="space-y-6 lg:col-span-1">
            
            <!-- APPLICANT PROFILE CARD -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs p-5 space-y-4">
                <div class="flex items-center gap-4">
                    @if ($partner->self_image)
                        <a href="{{ asset('storage/' . $partner->self_image) }}" target="_blank" class="block group relative shrink-0">
                            <img src="{{ asset('storage/' . $partner->self_image) }}" alt="{{ $partner->name }}" class="w-16 h-16 rounded-2xl object-cover border border-slate-200 shadow-2xs group-hover:scale-105 transition">
                        </a>
                    @else
                        <div class="w-16 h-16 rounded-2xl bg-blue-50 text-[#2964F2] flex items-center justify-center font-black text-xl border border-blue-200 shrink-0">
                            {{ strtoupper(substr($partner->name, 0, 1)) }}
                        </div>
                    @endif
                    <div>
                        <h2 class="text-base font-black text-slate-900 leading-tight">{{ $partner->name }}</h2>
                        <p class="text-xs font-mono font-bold text-slate-500 mt-0.5">{{ $partner->application_code }}</p>
                        <span class="inline-block mt-1 text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-md bg-blue-50 text-[#2964F2] border border-blue-200">
                            Executive Partner
                        </span>
                    </div>
                </div>

                <div class="pt-3 border-t border-slate-100 space-y-3 text-xs">
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Phone Number</span>
                        <a href="tel:{{ $partner->phone }}" class="font-bold text-slate-900 hover:text-[#2964F2] transition mt-0.5 inline-block">
                            {{ $partner->phone }}
                        </a>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Email Address</span>
                        <a href="mailto:{{ $partner->email }}" class="font-bold text-slate-900 hover:text-[#2964F2] transition mt-0.5 inline-block break-all">
                            {{ $partner->email }}
                        </a>
                    </div>
                    <div>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Application Date</span>
                        <p class="font-semibold text-slate-700 mt-0.5">
                            {{ $partner->created_at ? $partner->created_at->timezone('Asia/Kolkata')->format('d M Y, h:i A') : now('Asia/Kolkata')->format('d M Y, h:i A') }} (IST)
                        </p>
                    </div>
                </div>
            </div>

            <!-- SELECTED PROJECTS / INTERESTS -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs p-5 space-y-3">
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider">Assigned Project(s)</h3>
                    <span class="text-[10px] font-mono font-bold text-blue-600 bg-blue-50 px-2 py-0.5 rounded border border-blue-200">
                        Tag: {{ $suggestedCodeData['prefix'] }}
                    </span>
                </div>
                
                @if (!empty($partner->interests) && is_array($partner->interests))
                    <div class="space-y-2">
                        @foreach ($partner->interests as $interest)
                            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-200/80 flex items-center justify-between text-xs">
                                <span class="font-bold text-slate-800">{{ $interest }}</span>
                                @if(str_contains(strtolower($interest), 'doctor'))
                                    <span class="px-2 py-0.5 rounded bg-blue-100 text-blue-800 font-mono font-bold text-[10px]">DW</span>
                                @elseif(str_contains(strtolower($interest), 'rani') || str_contains(strtolower($interest), 'matrimonial'))
                                    <span class="px-2 py-0.5 rounded bg-pink-100 text-pink-800 font-mono font-bold text-[10px]">RM</span>
                                @elseif(str_contains(strtolower($interest), 'school'))
                                    <span class="px-2 py-0.5 rounded bg-amber-100 text-amber-800 font-mono font-bold text-[10px]">SW</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-xs text-slate-500">All Sumatra Sales Projects (ALL)</p>
                @endif
            </div>

            <!-- BANK DETAILS CARD -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs p-5 space-y-3">
                <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider">Bank Account for Payouts</h3>
                <div class="space-y-2.5 text-xs">
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Bank Name</span>
                        <p class="font-bold text-slate-900 mt-0.5">{{ $partner->bank_name ?: 'N/A' }}</p>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Account Number</span>
                        <p class="font-mono font-bold text-slate-900 mt-0.5">{{ $partner->bank_account_number ?: 'N/A' }}</p>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">IFSC Code</span>
                        <p class="font-mono font-bold text-slate-900 mt-0.5">{{ $partner->ifsc_code ?: 'N/A' }}</p>
                    </div>
                </div>
            </div>

        </div>

        <!-- RIGHT COLUMN: KYC DOCUMENTS & DECLARATIONS -->
        <div class="space-y-6 lg:col-span-2">
            
            <!-- ADDRESS INFORMATION -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs p-5 space-y-4">
                <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider">Location & Registered Address</h3>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">City / Town</span>
                        <p class="font-bold text-slate-900 mt-0.5">{{ $partner->city ?: 'N/A' }}</p>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">District</span>
                        <p class="font-bold text-slate-900 mt-0.5">{{ $partner->district ?: 'N/A' }}</p>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">State</span>
                        <p class="font-bold text-slate-900 mt-0.5">{{ $partner->state ?: 'N/A' }}</p>
                    </div>
                    <div class="p-3 bg-slate-50 rounded-xl border border-slate-200/80 sm:col-span-3">
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wider block">Complete Street Address</span>
                        <p class="font-semibold text-slate-800 mt-0.5">{{ $partner->address ?: 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- KYC VERIFICATION & DOCUMENTS -->
            <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs p-5 space-y-4">
                <div class="flex items-center justify-between">
                    <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider">KYC Identification & Uploaded Documents</h3>
                    <span class="text-[11px] text-slate-500 font-medium">Click image to view in full resolution</span>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    
                    <!-- AADHAAR FRONT -->
                    <div class="space-y-1.5 p-3 rounded-xl bg-slate-50 border border-slate-200/80">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-bold text-slate-700">Aadhaar Card Front</span>
                            <span class="font-mono text-[11px] text-slate-500">{{ $partner->aadhaar_number }}</span>
                        </div>
                        @if ($partner->aadhaar_front_image)
                            <a href="{{ asset('storage/' . $partner->aadhaar_front_image) }}" target="_blank" class="block group relative aspect-video rounded-lg overflow-hidden bg-slate-200 border border-slate-200">
                                <img src="{{ asset('storage/' . $partner->aadhaar_front_image) }}" alt="Aadhaar Front" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-xs font-bold transition">
                                    Open Full Size ↗
                                </div>
                            </a>
                        @else
                            <div class="aspect-video rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 text-xs">
                                Not Uploaded
                            </div>
                        @endif
                    </div>

                    <!-- AADHAAR BACK -->
                    <div class="space-y-1.5 p-3 rounded-xl bg-slate-50 border border-slate-200/80">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-bold text-slate-700">Aadhaar Card Back</span>
                            <span class="font-mono text-[11px] text-slate-500">{{ $partner->aadhaar_number }}</span>
                        </div>
                        @if ($partner->aadhaar_back_image)
                            <a href="{{ asset('storage/' . $partner->aadhaar_back_image) }}" target="_blank" class="block group relative aspect-video rounded-lg overflow-hidden bg-slate-200 border border-slate-200">
                                <img src="{{ asset('storage/' . $partner->aadhaar_back_image) }}" alt="Aadhaar Back" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-xs font-bold transition">
                                    Open Full Size ↗
                                </div>
                            </a>
                        @else
                            <div class="aspect-video rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 text-xs">
                                Not Uploaded
                            </div>
                        @endif
                    </div>

                    <!-- PAN CARD FRONT -->
                    <div class="space-y-1.5 p-3 rounded-xl bg-slate-50 border border-slate-200/80">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-bold text-slate-700">PAN Card Front</span>
                            <span class="font-mono text-[11px] text-slate-500">{{ $partner->pancard_number }}</span>
                        </div>
                        @if ($partner->pancard_front_image)
                            <a href="{{ asset('storage/' . $partner->pancard_front_image) }}" target="_blank" class="block group relative aspect-video rounded-lg overflow-hidden bg-slate-200 border border-slate-200">
                                <img src="{{ asset('storage/' . $partner->pancard_front_image) }}" alt="PAN Front" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-xs font-bold transition">
                                    Open Full Size ↗
                                </div>
                            </a>
                        @else
                            <div class="aspect-video rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 text-xs">
                                Not Uploaded
                            </div>
                        @endif
                    </div>

                    <!-- APPLICANT PHOTO -->
                    <div class="space-y-1.5 p-3 rounded-xl bg-slate-50 border border-slate-200/80">
                        <div class="flex items-center justify-between text-xs">
                            <span class="font-bold text-slate-700">Applicant Photograph</span>
                            <span class="text-[11px] text-slate-400">Portrait Image</span>
                        </div>
                        @if ($partner->self_image)
                            <a href="{{ asset('storage/' . $partner->self_image) }}" target="_blank" class="block group relative aspect-video rounded-lg overflow-hidden bg-slate-200 border border-slate-200">
                                <img src="{{ asset('storage/' . $partner->self_image) }}" alt="Self Photograph" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-xs font-bold transition">
                                    Open Full Size ↗
                                </div>
                            </a>
                        @else
                            <div class="aspect-video rounded-lg bg-slate-100 border border-slate-200 flex items-center justify-center text-slate-400 text-xs">
                                Not Uploaded
                            </div>
                        @endif
                    </div>

                </div>
            </div>

            <!-- STATUTORY TERMS & CONDITIONS AUDIT -->
            @if ($partner->termsCheck)
                <div class="bg-white rounded-2xl border border-slate-200/90 shadow-2xs p-5 space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 pb-3 border-b border-slate-100">
                        <div>
                            <h3 class="text-xs font-black text-slate-900 uppercase tracking-wider">Statutory Terms Acceptance Audit</h3>
                            <p class="text-[11px] text-slate-500 mt-0.5">Electronic contract accepted in compliance with IT Act, 2000</p>
                        </div>
                        <div class="text-right text-[11px] font-mono text-slate-500">
                            <div>IP: <span class="font-bold text-slate-700">{{ $partner->termsCheck->ip_address ?: 'Recorded' }}</span></div>
                            <div>{{ $partner->termsCheck->accepted_at ? \Carbon\Carbon::parse($partner->termsCheck->accepted_at)->format('d M Y, h:i A') : 'N/A' }}</div>
                        </div>
                    </div>

                    @php
                        $declarations = is_array($partner->termsCheck->terms_and_condition) 
                            ? $partner->termsCheck->terms_and_condition 
                            : json_decode($partner->termsCheck->terms_and_condition, true) ?? [];
                    @endphp

                    <div class="space-y-2 max-h-72 overflow-y-auto pr-1">
                        @foreach ($declarations as $decl)
                            <div class="p-2.5 rounded-xl bg-slate-50 border border-slate-100 flex items-start gap-2.5 text-xs">
                                <div class="w-4 h-4 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0 mt-0.5">
                                    <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                </div>
                                <div>
                                    <span class="font-mono font-bold text-slate-800 text-[11px]">{{ $decl['code'] ?? 'Clause' }}</span>
                                    <p class="text-slate-600 mt-0.5 text-[11px] leading-relaxed">{{ $decl['text'] ?? '' }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

        </div>

    </div>

</div>

<!-- REJECT REASON MODAL -->
<div id="reject-form-modal" class="fixed inset-0 z-50 hidden bg-slate-950/80 backdrop-blur-sm p-4 flex items-center justify-center">
    <div class="bg-white rounded-2xl max-w-md w-full p-6 space-y-4 shadow-2xl border border-slate-200">
        <h3 class="text-base font-black text-slate-900">Reject Application</h3>
        <p class="text-xs text-slate-500">Please provide a reason for rejecting the application of <strong>{{ $partner->name }}</strong>.</p>
        
        <form action="{{ route('admin.ep.reject', $partner->id) }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs font-bold text-slate-700 mb-1">Reason for Rejection</label>
                <textarea name="rejection_reason" rows="3" placeholder="e.g. Incomplete KYC documentation, invalid PAN card..." class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-xs text-slate-800 focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500"></textarea>
            </div>

            <div class="flex items-center justify-end gap-2 pt-2 border-t border-slate-100">
                <button type="button" onclick="document.getElementById('reject-form-modal').classList.add('hidden')" class="px-4 py-2 rounded-xl bg-slate-100 text-slate-700 text-xs font-bold hover:bg-slate-200 transition">
                    Cancel
                </button>
                <button type="submit" class="px-4 py-2 rounded-xl bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold transition">
                    Confirm Rejection
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
