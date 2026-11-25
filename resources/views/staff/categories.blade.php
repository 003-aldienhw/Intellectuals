@extends('main')
@section('title', 'Kategori')
@section('content')
    <x-staff_navbar />
    <main class="pt-30 pl-60">
        <div class="flex items-center justify-center bg-[#00117E] gap-2 w-52 p-1 mb-10 rounded-lg">
            <h1 class="text-lg font-bold">Tambah Kategori</h1>
            <img src="{{ asset('images/plus-large-svgrepo-com.png') }}" alt="ProfileIcon" width="30">
        </div>
        <div class="flex flex-col gap-10 mb-15">
            <a href="/petugas/kategori/detail"><div class="flex items-center bg-[#00117E] h-25 p-3 rounded-lg mr-3">
                <div class="bg-red-500 w-20 h-22 rounded-lg mr-3">
                    category
                </div>
                <div class="flex flex-col gap-5">
                    <h1 class="font-bold text-lg">Sains</h1>
                    <h1>13291 Buku</h1>
                </div>
                <div class="h-full ml-auto">
                    <h1>Dibuat 10/09/2090</h1>
                </div>
            </div></a>
            <a href="/petugas/kategori/detail"><div class="flex items-center bg-[#00117E] h-25 p-3 rounded-lg mr-3">
                <div class="bg-red-500 w-20 h-22 rounded-lg mr-3">
                    category
                </div>
                <div class="flex flex-col gap-5">
                    <h1 class="font-bold text-lg">Sci-Fi</h1>
                    <h1>13291 Buku</h1>
                </div>
                <div class="h-full ml-auto">
                    <h1>Dibuat 10/09/2090</h1>
                </div>
            </div></a>
            <a href="/petugas/kategori/detail"><div class="flex items-center bg-[#00117E] h-25 p-3 rounded-lg mr-3">
                <div class="bg-red-500 w-20 h-22 rounded-lg mr-3">
                    category
                </div>
                <div class="flex flex-col gap-5">
                    <h1 class="font-bold text-lg">Novel</h1>
                    <h1>13291 Buku</h1>
                </div>
                <div class="h-full ml-auto">
                    <h1>Dibuat 10/09/2090</h1>
                </div>
            </div></a>
            <a href="/petugas/kategori/detail"><div class="flex items-center bg-[#00117E] h-25 p-3 rounded-lg mr-3">
                <div class="bg-red-500 w-20 h-22 rounded-lg mr-3">
                    category
                </div>
                <div class="flex flex-col gap-5">
                    <h1 class="font-bold text-lg">Action</h1>
                    <h1>13291 Buku</h1>
                </div>
                <div class="h-full ml-auto">
                    <h1>Dibuat 10/09/2090</h1>
                </div>
            </div></a>
        </div>
    </main>
@endsection