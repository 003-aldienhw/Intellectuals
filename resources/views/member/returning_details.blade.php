@extends('main')
@section('title', 'Beranda')
@section('content')
    <x-member_navbar />
    <main class="pt-30 pl-60 flex gap-10">
        <div class="bg-[#00117E] p-5 w-100 h-full rounded-lg mb-15">
            <div class="bg-red-500 h-70 rounded-lg">
                book
            </div>
            <div class="flex flex-col gap-2 mt-5">
                <div class="flex">
                    <h1 class="font-bold">Tahun : </h1>
                    <h1 class="ml-auto">1945</h1>
                </div>
                <div class="flex">
                    <h1 class="font-bold">Halaman : </h1>
                    <h1 class="ml-auto">2</h1>
                </div>
                <div class="flex">
                    <h1 class="font-bold">Penulis : </h1>
                    <h1 class="ml-auto">Saya</h1>
                </div>
                <div class="flex">
                    <h1 class="font-bold">Kategori : </h1>
                    <h1 class="ml-auto">Sains</h1>
                </div>
                <div class="flex">
                    <h1 class="font-bold">ISBN : </h1>
                    <h1 class="ml-auto">978-602-8519-93-9</h1>
                </div>
            </div>
        </div>
        <div class="bg-[#00117E] p-5 w-full h-full rounded-lg mb-15 mr-5">
            <h1 class="font-display text-6xl">Buku1</h1>
            <div class="flex mt-5 w-70">
                <h1 class="font-bold">Tanggal Peminjaman : </h1>
                <h1 class="ml-auto">29/09/2009</h1>
            </div>
            <div class="flex mt-5 w-70">
                <h1 class="font-bold">Tenggat Pengembalian : </h1>
                <h1 class="ml-auto">29/09/2009</h1>
            </div>
            </div>
        </div>
    </main>
@endsection