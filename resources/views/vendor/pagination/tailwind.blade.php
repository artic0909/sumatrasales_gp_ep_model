@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex flex-col sm:flex-row items-center justify-between gap-3 text-xs w-full">
        <div class="text-slate-500 font-medium">
            Showing <span class="font-bold text-slate-800">{{ $paginator->firstItem() ?? 0 }}</span> to <span class="font-bold text-slate-800">{{ $paginator->lastItem() ?? 0 }}</span> of <span class="font-bold text-slate-800">{{ $paginator->total() }}</span> results
        </div>

        <div class="inline-flex items-center gap-1 rounded-xl bg-white p-1 border border-slate-200/90 shadow-2xs">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="px-2.5 py-1.5 rounded-lg text-slate-300 cursor-not-allowed inline-flex items-center font-bold text-sm select-none" aria-disabled="true">
                    &lt;
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-2.5 py-1.5 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition inline-flex items-center font-bold text-sm select-none">
                    &lt;
                </a>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="px-2 py-1.5 text-slate-400 font-black tracking-widest text-xs select-none">
                        ...
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="px-3 py-1.5 rounded-lg bg-[#2964F2] text-white font-bold shadow-xs select-none">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1.5 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 font-bold transition select-none">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-2.5 py-1.5 rounded-lg text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition inline-flex items-center font-bold text-sm select-none">
                    &gt;
                </a>
            @else
                <span class="px-2.5 py-1.5 rounded-lg text-slate-300 cursor-not-allowed inline-flex items-center font-bold text-sm select-none" aria-disabled="true">
                    &gt;
                </span>
            @endif
        </div>
    </nav>
@else
    <div class="text-xs text-slate-500 font-medium">
        Showing <span class="font-bold text-slate-800">{{ $paginator->firstItem() ?? 0 }}</span> to <span class="font-bold text-slate-800">{{ $paginator->lastItem() ?? 0 }}</span> of <span class="font-bold text-slate-800">{{ $paginator->total() }}</span> results
    </div>
@endif
