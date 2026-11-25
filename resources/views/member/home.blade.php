@extends('main')
@section('title', 'Beranda')
@section('content')
    <x-member_navbar />
    <main class="pt-30 pl-60">
        <div class="flex items-center justify-center bg-[#00117E] gap-2 w-30 p-1 mb-10 rounded-lg">
            <h1 class="text-lg font-bold">Kategori</h1>
            <img src="{{ asset('images/down-arrow-backup-2-svgrepo-com.png') }}" alt="ProfileIcon" width="30">
        </div>
        <div class="flex flex-wrap justify-flex-end gap-10 mb-15">
            <a href="/anggota/peminjaman"><div class="w-60 h-80 bg-[#00117E] rounded-lg">
                <h1>book</h1>
            </div></a>
            <a href="/anggota/peminjaman"><div class="w-60 h-80 bg-[#00117E] rounded-lg">
                <h1>book</h1>
            </div></a>
            <a href="/anggota/peminjaman"><div class="w-60 h-80 bg-[#00117E] rounded-lg">
                <h1>book</h1>
            </div></a>
            <a href="/anggota/peminjaman"><div class="w-60 h-80 bg-[#00117E] rounded-lg">
                <h1>book</h1>
            </div></a>
            <a href="/anggota/peminjaman"><div class="w-60 h-80 bg-[#00117E] rounded-lg">
                <h1>book</h1>
            </div></a>
            <a href="/anggota/peminjaman"><div class="w-60 h-80 bg-[#00117E] rounded-lg">
                <h1>book</h1>
            </div></a>
            <a href="/anggota/peminjaman"><div class="w-60 h-80 bg-[#00117E] rounded-lg">
                <h1>book</h1>
            </div></a>
            <a href="/anggota/peminjaman"><div class="w-60 h-80 bg-[#00117E] rounded-lg">
                <h1>book</h1>
            </div></a>
        </div>
    </main>
@endsection