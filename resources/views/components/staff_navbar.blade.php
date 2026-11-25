@php
    $active_style = "bg-[#D9D9D9] text-[#00117E] font-bold";

    [$searchAction, $searchPlaceholder] = match (true) {
        request()->routeIs('staff.members.*') => [route('staff.members.index'), 'Cari Anggota...'],
        request()->routeIs('staff.books.*') => [route('staff.books.index'), 'Cari Buku...'],
        request()->routeIs('staff.categories.*') => [route('staff.categories.index'), 'Cari Kategori...'],
        request()->routeIs('staff.fines.*') => [route('staff.fines.index'), 'Cari Denda...'],
        default => [route('staff.home'), 'Cari Pengajuan / Buku...'],
    };
@endphp
<nav class="fixed bg-[#00117E] h-full w-55 text-center shadow-xl/50 z-40">
    <h1 class="font-display text-3xl m-5">Intellectuals</h1>

    <div class="flex flex-col w-full mt-20">
        <a href="{{ route('staff.home') }}" class="flex text-lg h-20 items-center justify-center transition {{ request()->routeIs('staff.home', 'staff.borrowings.*', 'staff.returnings.*') ? $active_style : 'hover:bg-[#213FFF]/40' }}">Beranda</a>
        <a href="{{ route('staff.members.index') }}" class="flex text-lg h-20 items-center justify-center transition {{ request()->routeIs('staff.members.*') ? $active_style : 'hover:bg-[#213FFF]/40' }}">Anggota</a>
        <a href="{{ route('staff.books.index') }}" class="flex text-lg h-20 items-center justify-center transition {{ request()->routeIs('staff.books.*') ? $active_style : 'hover:bg-[#213FFF]/40' }}">Buku</a>
        <a href="{{ route('staff.categories.index') }}" class="flex text-lg h-20 items-center justify-center transition {{ request()->routeIs('staff.categories.*') ? $active_style : 'hover:bg-[#213FFF]/40' }}">Kategori</a>
        <a href="{{ route('staff.fines.index') }}" class="flex text-lg h-20 items-center justify-center transition {{ request()->routeIs('staff.fines.*') ? $active_style : 'hover:bg-[#213FFF]/40' }}">Denda</a>
    </div>
</nav>
<nav class="fixed flex ml-55 items-center bg-[#00117E] p-5 h-20 shadow-xl/20 w-[calc(100%-13.75rem)] z-30">
    <form action="{{ $searchAction }}" method="GET" class="absolute left-1/2 -translate-x-1/2 flex items-center gap-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ $searchPlaceholder }}"
            class="bg-[#D9D9D9] w-70 h-10 px-3 rounded-lg text-[#000315] placeholder-[#666] focus:outline-none">
        @if (request()->filled('search'))
            <a href="{{ $searchAction }}" class="bg-[#213FFF] hover:bg-blue-600 px-3 h-10 flex items-center rounded-lg text-sm font-bold">
                Reset
            </a>
        @endif
    </form>
    <div class="ml-auto flex items-center gap-3">
        <div class="bg-[#8B0000] text-[#FF5D5D] px-2 py-1 mr-1 rounded-lg">
            <h1 class="font-display text-sm">Petugas</h1>
        </div>
        <h1 class="font-bold">{{ auth()->user()->name }}</h1>
        <a href="{{ route('staff.profile') }}">
            <img src="{{ asset('images/download-removebg-preview.png') }}" alt="ProfileIcon" width="60">
        </a>
    </div>
</nav>