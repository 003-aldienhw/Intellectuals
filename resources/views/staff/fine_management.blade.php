@extends('main')
@section('title', 'Detail Denda')
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
            <h1 class="font-display text-6xl">Denda</h1>
            <div class="flex flex-col mt-5 gap-3">
                <h1 class="font-bold">- Merusak Buku</h1>
                <h1 class="font-bold">- Membakar Buku </h1>
                <h1 class="font-bold">- Terlambat Mengembalikan Buku </h1>
                <h1 class="font-bold">- Meledakkan Buku </h1>
                <h1 class="font-bold">- Memakan Buku </h1>
            </div>
            <h1 class="font-bold mt-5 text-xl">Total : Rp.13.000.000</h1>
            <div class="flex w-full justify-between items-center pr-30 pl-30 mt-10 mb-5">
                <div class="flex items-center justify-center bg-[#3E008B] gap-2 w-20 h-10 p-1 rounded-lg">
                    <h1 class="text-lg font-bold text-[#7C3AED] text-lg">Edit</h1>
                    <img src="{{ asset('images/edit-svgrepo-com.png') }}" alt="ProfileIcon" width="30">
                </div>
                <div class="flex items-center justify-center bg-[#137000] gap-2 w-45 h-10 p-1 rounded-lg">
                    <h1 class="text-lg font-bold text-[#46FF21] text-lg">Tandai Selesai</h1>
                    <img src="{{ asset('images/correct-signal-svgrepo-com.png') }}" alt="ProfileIcon" width="25">
                </div>
                <div class="flex items-center justify-center bg-[#650000] gap-2 w-25 h-10 p-1 rounded-lg">
                    <h1 class="text-lg font-bold text-[#FF2B2B] text-lg">Hapus</h1>
                    <img src="{{ asset('images/trash-xmark-svgrepo-com.png') }}" alt="ProfileIcon" width="30">
                </div>
            </div>
        </div>
    </main>
@endsection