@extends('main')
@section('title', 'Profil')
@section('content')
    <x-member_navbar />
    <main class="pt-30 pl-60">
        <div class="flex flex-col items-center">
            <img src="{{ asset('images/download-removebg-preview.png') }}" alt="ProfileIcon" width="200">
            <h1 class="font-bold text-2xl mt-5">User</h1>
            <div class="flex flex-wrap justify-center gap-10 mt-15">
                <div>
                    <h1>Nama</h1>
                    <input type="text" class="bg-[#5B5B5B] w-120 h-10 p-1 rounded-lg text-[#666]" disabled>
                </div>
                <div>
                    <h1>Status</h1>
                    <input type="text" class="bg-[#5B5B5B] w-120 h-10 p-1 rounded-lg text-[#666]" disabled>
                </div>
                <div>
                    <h1>No Telepon</h1>
                    <input type="text" class="bg-[#5B5B5B] w-120 h-10 p-1 rounded-lg text-[#666]" disabled>
                </div>
                <div>
                    <h1>ID Anggota</h1>
                    <input type="text" class="bg-[#5B5B5B] w-120 h-10 p-1 rounded-lg text-[#666]" disabled>
                </div>
            </div>
            <div class="flex gap-50 mt-10 mb-15">
                <div class="flex flex-col p-5 justify-around text-center w-40 h-50 bg-[#5D7DFF] rounded-lg">
                    <h1 class="font-bold text-[#00117E] text-lg">Buku yang Dipinjam</h1>
                    <h1 class="font-bold text-[#00117E] text-lg">200</h1>
                </div>
                <div class="flex flex-col p-5 justify-around text-center w-40 h-50 bg-[#78FF5D] rounded-lg">
                    <h1 class="font-bold text-[#0F7E00] text-lg">Buku yang Dikembalikan</h1>
                    <h1 class="font-bold text-[#0F7E00] text-lg">-200</h1>
                </div>
                <div class="flex flex-col p-5 justify-around text-center w-40 h-50 bg-[#FF5D5D] rounded-lg">
                    <h1 class="font-bold text-[#7E0000] text-lg">Total Denda</h1>
                    <h1 class="font-bold text-[#7E0000] text-lg">2000</h1>
                </div>
            </div>
        </div>
    </main>
@endsection