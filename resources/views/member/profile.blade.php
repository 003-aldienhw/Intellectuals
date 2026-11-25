@extends('main')
@section('title', 'Profil')
@section('content')
    <x-member_navbar />
    <main class="pt-30 pl-60 pr-5">
        <div class="flex flex-col items-center">
            <img src="{{ asset('images/download-removebg-preview.png') }}" alt="ProfileIcon" width="180">
            <h1 class="font-bold text-2xl mt-3">{{ $user->name }}</h1>

            <div class="flex flex-wrap justify-center gap-10 mt-10">
                <div>
                    <h1 class="mb-1">Nama</h1>
                    <input type="text" value="{{ $user->name }}" class="bg-[#5B5B5B] w-110 h-10 px-3 rounded-lg text-white" disabled>
                </div>
                <div>
                    <h1 class="mb-1">Status</h1>
                    <input type="text" value="{{ $user->status }}" class="bg-[#5B5B5B] w-110 h-10 px-3 rounded-lg text-white" disabled>
                </div>
                <div>
                    <h1 class="mb-1">No Telepon</h1>
                    <input type="text" value="{{ $user->phone ?? '-' }}" class="bg-[#5B5B5B] w-110 h-10 px-3 rounded-lg text-white" disabled>
                </div>
                <div>
                    <h1 class="mb-1">ID Anggota</h1>
                    <input type="text" value="{{ $user->member_code }}" class="bg-[#5B5B5B] w-110 h-10 px-3 rounded-lg text-white" disabled>
                </div>
            </div>

            <div class="flex gap-20 mt-10 mb-10">
                <div class="flex flex-col p-5 justify-around text-center w-44 h-44 bg-[#5D7DFF] rounded-lg">
                    <h1 class="font-bold text-[#00117E] text-lg">Buku yang Dipinjam</h1>
                    <h1 class="font-bold text-[#00117E] text-2xl">{{ $borrowedCount }}</h1>
                </div>
                <div class="flex flex-col p-5 justify-around text-center w-44 h-44 bg-[#78FF5D] rounded-lg">
                    <h1 class="font-bold text-[#0F7E00] text-lg">Buku yang Dikembalikan</h1>
                    <h1 class="font-bold text-[#0F7E00] text-2xl">{{ $returnedCount }}</h1>
                </div>
                <div class="flex flex-col p-5 justify-around text-center w-44 h-44 bg-[#FF5D5D] rounded-lg">
                    <h1 class="font-bold text-[#7E0000] text-lg">Total Denda</h1>
                    <h1 class="font-bold text-[#7E0000] text-xl">Rp {{ number_format($totalFines, 0, ',', '.') }}</h1>
                </div>
            </div>

            <form method="POST" action="{{ route('logout') }}" class="mb-15">
                @csrf
                <button type="submit" class="bg-[#650000] hover:bg-red-800 text-[#FF2B2B] px-8 py-2.5 rounded-lg text-lg font-bold cursor-pointer transition">
                    Logout
                </button>
            </form>
        </div>
    </main>
@endsection