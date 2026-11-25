@php
    $active_style = "bg-[#D9D9D9] text-[#00117E] font-bold";
@endphp
<nav class="fixed bg-[#00117E] h-full w-55 text-center shadow-xl/50 z-40">
    <h1 class="font-display text-3xl m-5">Intellectuals</h1>

    <div class="flex flex-col w-full mt-20">
        <a href="{{ route('member.home') }}" class="flex text-lg h-20 items-center justify-center transition {{ request()->routeIs('member.home', 'member.borrowing.*') ? $active_style : 'hover:bg-[#213FFF]/40' }}">Beranda</a>
        <a href="{{ route('member.history') }}" class="flex text-lg h-20 items-center justify-center transition {{ request()->routeIs('member.history', 'member.fine.*') ? $active_style : 'hover:bg-[#213FFF]/40' }}">History</a>
        <a href="{{ route('member.returning') }}" class="flex text-lg h-20 items-center justify-center transition {{ request()->routeIs('member.returning*') ? $active_style : 'hover:bg-[#213FFF]/40' }}">Pengembalian</a>
    </div>
</nav>
<nav class="fixed flex ml-55 items-center bg-[#00117E] p-5 h-20 shadow-xl/20 w-[calc(100%-13.75rem)] z-30">
    <form action="{{ route('member.home') }}" method="GET" class="absolute left-1/2 -translate-x-1/2">
        @if(request('category'))
            <input type="hidden" name="category" value="{{ request('category') }}">
        @endif
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Buku..."
            class="bg-[#D9D9D9] w-70 h-10 px-3 rounded-lg text-[#000315] placeholder-[#666] focus:outline-none">
    </form>
    <div class="ml-auto flex items-center gap-3">
        <h1 class="font-bold">{{ auth()->user()->name }}</h1>
        <a href="{{ route('member.profile') }}">
            <img src="{{ asset('images/download-removebg-preview.png') }}" alt="ProfileIcon" width="60">
        </a>
    </div>
</nav>