@extends('main')
@section('title', 'Beranda')
@section('content')
    <x-staff_navbar />
    <main class="pt-30 pl-60">
        <div class="flex flex-col gap-10 mb-15">
            <a href="/petugas/peminjaman"><div class="flex items-center bg-[#00117E] h-25 p-3 rounded-lg mr-3">
                <img src="{{ asset('images/download-removebg-preview.png') }}" class="mr-3" alt="ProfileIcon" width="100">
                <div class="flex flex-col gap-5">
                    <h1 class="font-bold text-lg">User1</h1>
                    <h1>Meminjam Buku1</h1>
                </div>
                <div class="h-full ml-auto">
                    <h1>10/09/2090</h1>
                </div>
            </div></a>
            <a href="/petugas/pengembalian"><div class="flex items-center bg-[#00117E] h-25 p-3 rounded-lg mr-3">
                <img src="{{ asset('images/download-removebg-preview.png') }}" class="mr-3" alt="ProfileIcon" width="100">
                <div class="flex flex-col gap-5">
                    <h1 class="font-bold text-lg">User2</h1>
                    <h1>Mengembalikan Buku1</h1>
                </div>
                <div class="h-full ml-auto">
                    <h1>10/09/2090</h1>
                </div>
            </div></a>
            <a href="/petugas/pengembalian"><div class="flex items-center bg-[#00117E] h-25 p-3 rounded-lg mr-3">
                <img src="{{ asset('images/download-removebg-preview.png') }}" class="mr-3" alt="ProfileIcon" width="100">
                <div class="flex flex-col gap-5">
                    <h1 class="font-bold text-lg">User3</h1>
                    <h1>Mengembalikan Buku1</h1>
                </div>
                <div class="h-full ml-auto">
                    <h1>10/09/2090</h1>
                </div>
            </div></a>
            <a href="/petugas/peminjaman"><div class="flex items-center bg-[#00117E] h-25 p-3 rounded-lg mr-3">
                <img src="{{ asset('images/download-removebg-preview.png') }}" class="mr-3" alt="ProfileIcon" width="100">
                <div class="flex flex-col gap-5">
                    <h1 class="font-bold text-lg">User4</h1>
                    <h1>Meminjam Buku1</h1>
                </div>
                <div class="h-full ml-auto">
                    <h1>10/09/2090</h1>
                </div>
            </div></a>
        </div>
    </main>
@endsection