@extends('main')
@section('title', 'Detail Kategori')
@section('content')
    <x-staff_navbar />
    <main class="pt-30 pl-60 flex gap-10">
        <div class="bg-[#00117E] p-5 w-96 h-full rounded-lg mb-15">
            <div class="bg-red-500 h-70 rounded-lg">
                category
            </div>
            <div class="flex justify-center mt-5">
                <h1 class="font-display text-5xl">Sains</h1>
            </div>
            <div class="flex w-full justify-between items-center mt-10 mb-5">
                <div class="flex items-center justify-center bg-[#3E008B] gap-2 w-20 h-10 p-1 rounded-lg">
                    <h1 class="text-lg font-bold text-[#7C3AED] text-lg">Edit</h1>
                    <img src="{{ asset('images/edit-svgrepo-com.png') }}" alt="ProfileIcon" width="30">
                </div>
                <div class="flex items-center justify-center bg-[#650000] gap-2 w-25 h-10 p-1 rounded-lg">
                    <h1 class="text-lg font-bold text-[#FF2B2B] text-lg">Hapus</h1>
                    <img src="{{ asset('images/trash-xmark-svgrepo-com.png') }}" alt="ProfileIcon" width="30">
                </div>
            </div>
        </div>
        <div class="flex flex-col w-full gap-10 mb-15">
            <a href=""><div class="flex items-center bg-[#00117E] h-25 p-3 rounded-lg mr-3">
                <div class="bg-red-500 w-20 h-22 rounded-lg mr-3">
                    book
                </div>
                <div class="flex flex-col h-full">
                    <h1 class="font-bold text-lg">Buku1</h1>
                </div>
                <div class="h-full ml-auto">
                    <h1>Dibuat 10/09/2090</h1>
                </div>
            </div></a>
            <a href=""><div class="flex items-center bg-[#00117E] h-25 p-3 rounded-lg mr-3">
                <div class="bg-red-500 w-20 h-22 rounded-lg mr-3">
                    book
                </div>
                <div class="flex flex-col h-full">
                    <h1 class="font-bold text-lg">Buku2</h1>
                </div>
                <div class="h-full ml-auto">
                    <h1>Dibuat 10/09/2090</h1>
                </div>
            </div></a>
            <a href=""><div class="flex items-center bg-[#00117E] h-25 p-3 rounded-lg mr-3">
                <div class="bg-red-500 w-20 h-22 rounded-lg mr-3">
                    book
                </div>
                <div class="flex flex-col h-full">
                    <h1 class="font-bold text-lg">Buku3</h1>
                </div>
                <div class="h-full ml-auto">
                    <h1>Dibuat 10/09/2090</h1>
                </div>
            </div></a>
            <a href=""><div class="flex items-center bg-[#00117E] h-25 p-3 rounded-lg mr-3">
                <div class="bg-red-500 w-20 h-22 rounded-lg mr-3">
                    book
                </div>
                <div class="flex flex-col h-full">
                    <h1 class="font-bold text-lg">Buku4</h1>
                </div>
                <div class="h-full ml-auto">
                    <h1>Dibuat 10/09/2090</h1>
                </div>
            </div></a>
        </div>
    </main>
@endsection