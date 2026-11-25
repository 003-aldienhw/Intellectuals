@extends('main')
@section('title', 'Anggota')
@section('content')
    <x-staff_navbar />
    <main class="pt-30 pl-60">
        <div class="flex items-center justify-center bg-[#00117E] gap-2 w-50 p-1 mb-10 rounded-lg">
            <h1 class="text-lg font-bold">Tambah Anggota</h1>
            <img src="{{ asset('images/plus-large-svgrepo-com.png') }}" alt="ProfileIcon" width="30">
        </div>
        <div class="flex flex-col gap-10 mb-15">
            <a href="/petugas/anggota/detail"><div class="flex items-center bg-[#00117E] h-25 p-3 rounded-lg mr-3">
                <img src="{{ asset('images/download-removebg-preview.png') }}" class="mr-3" alt="ProfileIcon" width="100">
                <div class="flex flex-col gap-5">
                    <h1 class="font-bold text-lg">User1</h1>
                    <h1>Bergabung 29/09/2009</h1>
                </div>
            </div></a>
            <a href="/petugas/anggota/detail"><div class="flex items-center bg-[#00117E] h-25 p-3 rounded-lg mr-3">
                <img src="{{ asset('images/download-removebg-preview.png') }}" class="mr-3" alt="ProfileIcon" width="100">
                <div class="flex flex-col gap-5">
                    <h1 class="font-bold text-lg">User2</h1>
                    <h1>Bergabung 29/09/2009</h1>
                </div>
            </div></a>
            <a href="/petugas/anggota/detail"><div class="flex items-center bg-[#00117E] h-25 p-3 rounded-lg mr-3">
                <img src="{{ asset('images/download-removebg-preview.png') }}" class="mr-3" alt="ProfileIcon" width="100">
                <div class="flex flex-col gap-5">
                    <h1 class="font-bold text-lg">User3</h1>
                    <h1>Bergabung 29/09/2009</h1>
                </div>
            </div></a>
            <a href="/petugas/anggota/detail"><div class="flex items-center bg-[#00117E] h-25 p-3 rounded-lg mr-3">
                <img src="{{ asset('images/download-removebg-preview.png') }}" class="mr-3" alt="ProfileIcon" width="100">
                <div class="flex flex-col gap-5">
                    <h1 class="font-bold text-lg">User4</h1>
                    <h1>Bergabung 29/09/2009</h1>
                </div>
            </div></a>
        </div>
    </main>
@endsection