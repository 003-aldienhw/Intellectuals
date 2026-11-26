@php
    $active_style = "bg-[#D9D9D9] text-[#00117E] font-bold";
    $isGuest = !auth()->check();

    $hasSearch = request()->routeIs('member.home', 'member.history', 'member.returning');
    $searchPlaceholder = match (true) {
        request()->routeIs('member.history') => 'Cari Riwayat / Denda...',
        request()->routeIs('member.returning') => 'Cari Pengembalian...',
        default => 'Cari Buku...',
    };
@endphp
<nav class="fixed bg-[#00117E] h-full w-55 text-center shadow-xl/50 z-40">
    <h1 class="font-display text-3xl m-5">Intellectuals</h1>

    <div class="flex flex-col w-full mt-20">
        <a href="{{ route('member.home') }}" class="flex text-lg h-20 items-center justify-center transition {{ request()->routeIs('member.home', 'member.borrowing.*') ? $active_style : 'hover:bg-[#213FFF]/40' }}">Beranda</a>

        @unless($isGuest)
            <a href="{{ route('member.history') }}" class="flex text-lg h-20 items-center justify-center transition {{ request()->routeIs('member.history', 'member.fine.*') ? $active_style : 'hover:bg-[#213FFF]/40' }}">History</a>
            <a href="{{ route('member.returning') }}" class="flex text-lg h-20 items-center justify-center transition {{ request()->routeIs('member.returning*') ? $active_style : 'hover:bg-[#213FFF]/40' }}">Pengembalian</a>
        @endunless
    </div>
</nav>
<nav class="fixed flex ml-55 items-center bg-[#00117E] p-5 h-20 shadow-xl/20 w-[calc(100%-13.75rem)] z-30">
    @if ($hasSearch)
        <div class="absolute left-1/2 -translate-x-1/2">
            <input type="text" id="memberSearchInput" placeholder="{{ $searchPlaceholder }}"
                class="bg-[#D9D9D9] w-70 h-10 px-3 rounded-lg text-[#000315] placeholder-[#666] focus:outline-none">
        </div>
    @endif

    <div class="ml-auto flex items-center gap-3">
        @if($isGuest)
            <div class="bg-[#8B0000] text-[#FF5D5D] px-2 py-1 mr-1 rounded-lg">
                <h1 class="font-display text-sm">Belum Login</h1>
            </div>
            <a href="{{ route('login') }}" class="font-bold hover:underline">Login</a>
            <img src="{{ asset('images/download-removebg-preview.png') }}" alt="ProfileIcon" width="60">
        @else
            <h1 class="font-bold">{{ auth()->user()->name }}</h1>
            <a href="{{ route('member.profile') }}">
                <img src="{{ asset('images/download-removebg-preview.png') }}" alt="ProfileIcon" width="60">
            </a>
        @endif
    </div>
</nav>