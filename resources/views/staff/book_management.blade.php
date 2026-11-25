@extends('main')
@section('title', 'Detail Buku')
@section('content')
    <x-staff_navbar />
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
            <p class="mt-5">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, a? Aliquam recusandae sunt, laudantium officia qui, explicabo iure enim atque quam voluptatem vitae consectetur? Quae, non. Velit doloremque tempora obcaecati, odit quas ipsum architecto quam mollitia ex minima minus tempore illum soluta pariatur eos vel totam alias porro unde facilis?</p>
            <div class="flex w-full justify-between items-center pr-30 pl-30 mt-10 mb-5">
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
    </main>
@endsection