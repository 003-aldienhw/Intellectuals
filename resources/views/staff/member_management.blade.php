@extends('main')
@section('title', 'Profil Anggota')
@section('content')
    <x-staff_navbar />
    <main class="pt-30 pl-60">
        <div class="flex flex-col items-center">
            <div class="flex w-full justify-between items-center pr-30 pl-30">
                <div class="flex items-center justify-center bg-[#3E008B] gap-2 w-20 h-10 p-1 rounded-lg">
                    <h1 class="text-lg font-bold text-[#7C3AED] text-lg">Edit</h1>
                    <img src="{{ asset('images/edit-svgrepo-com.png') }}" alt="ProfileIcon" width="30">
                </div>
                <img src="{{ asset('images/download-removebg-preview.png') }}" class="ml-10" alt="ProfileIcon" width="200">
                <div class="flex items-center justify-center bg-[#650000] gap-2 w-25 h-10 p-1 rounded-lg">
                    <h1 class="text-lg font-bold text-[#FF2B2B] text-lg">Hapus</h1>
                    <img src="{{ asset('images/trash-xmark-svgrepo-com.png') }}" alt="ProfileIcon" width="30">
                </div>
            </div>
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