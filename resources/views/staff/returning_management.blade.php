@extends('main')
@section('title', 'Detail Peminjaman')
@section('content')
    <x-staff_navbar />
    <main class="pt-30 pl-60 flex gap-10">
        <div class="bg-[#00117E] p-5 w-100 h-full rounded-lg mb-15">
            <div class="flex justify-center">
                <img src="{{ asset('images/download-removebg-preview.png') }}" alt="ProfileIcon" width="200">
            </div>
            <div class="flex flex-col items-center gap-4 justify-center mt-5">
                <h1 class="font-bold text-4xl">User1</h1>
                <h1 class="font-bold text-2xl">ID : A0104092008</h1>
            </div>
            <div class="flex justify-center mt-10 mb-5">
                <a href="/petugas/anggota/detail" class="bg-[#213FFF] w-35 flex justify-center items-center rounded-lg text-lg font-bold">Lihat Profil</a>
            </div>
        </div>
        <div class="bg-[#00117E] p-5 w-full h-full rounded-lg mb-15 mr-5">
            <h1 class="font-display text-6xl">Pengembalian</h1>
            <div class="flex flex-col gap-10 mb-15 mt-5">
            <div class="flex items-center h-25 p-3 rounded-lg mr-3">
                <div class="bg-red-500 w-20 h-22 rounded-lg mr-3">
                    book
                </div>
                <div class="flex flex-col gap-5">
                    <h1 class="font-bold text-lg">Buku1</h1>
                    <h1>Sains</h1>
                </div>
                <div class="ml-auto">
                    <a href="/petugas/buku/detail" class="bg-[#213FFF] w-32 flex justify-center items-center rounded-lg text-lg font-bold">Lihat Buku</a>
                </div>
            </div>
            <div class="flex items-center h-25 p-3 rounded-lg mr-3">
                <div class="bg-red-500 w-20 h-22 rounded-lg mr-3">
                    book
                </div>
                <div class="flex flex-col gap-5">
                    <h1 class="font-bold text-lg">Buku2</h1>
                    <h1>Sains</h1>
                </div>
                <div class="ml-auto">
                    <a href="/petugas/buku/detail" class="bg-[#213FFF] w-32 flex justify-center items-center rounded-lg text-lg font-bold">Lihat Buku</a>
                </div>
            </div>
        </div>
            <div class="flex w-full justify-between items-center pr-30 pl-30 mt-10 mb-5">
                <div class="flex items-center justify-center bg-[#137000] gap-2 w-30 h-10 p-1 rounded-lg">
                    <h1 class="text-lg font-bold text-[#46FF21] text-lg">Terima</h1>
                    <img src="{{ asset('images/correct-signal-svgrepo-com.png') }}" alt="ProfileIcon" width="25">
                </div>
                <div class="flex items-center justify-center bg-[#650000] gap-2 w-30 h-10 p-1 rounded-lg">
                    <h1 class="text-lg font-bold text-[#FF2B2B] text-lg">Beri Denda</h1>
                </div>
            </div>
        </div>
    </main>
@endsection