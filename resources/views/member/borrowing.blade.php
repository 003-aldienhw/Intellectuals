@extends('main')
@section('title', 'Peminjaman')
@section('content')
    <x-member_navbar />
    <main class="pt-30 pl-60 pr-5">
        @if (session('error'))
            <div class="bg-[#650000] text-[#FF5D5D] p-4 rounded-lg mb-6 font-bold">{{ session('error') }}</div>
        @endif

        <div class="flex gap-10">
            <div class="bg-[#00117E] p-5 w-100 h-full rounded-lg mb-15 shrink-0">
                @if ($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-70 object-cover rounded-lg">
                @else
                    <div class="bg-red-500 h-70 rounded-lg flex items-center justify-center font-display text-2xl">
                        {{ $book->title }}
                    </div>
                @endif

                <div class="flex flex-col gap-2 mt-5">
                    <div class="flex">
                        <h1 class="font-bold">Tahun :</h1>
                        <h1 class="ml-auto">{{ $book->publication_year }}</h1>
                    </div>
                    <div class="flex">
                        <h1 class="font-bold">Halaman :</h1>
                        <h1 class="ml-auto">{{ $book->pages }}</h1>
                    </div>
                    <div class="flex">
                        <h1 class="font-bold">Penulis :</h1>
                        <h1 class="ml-auto">{{ $book->author }}</h1>
                    </div>
                    <div class="flex">
                        <h1 class="font-bold">Kategori :</h1>
                        <h1 class="ml-auto">{{ $book->category->name }}</h1>
                    </div>
                    <div class="flex">
                        <h1 class="font-bold">ISBN :</h1>
                        <h1 class="ml-auto">{{ $book->isbn }}</h1>
                    </div>
                    <div class="flex">
                        <h1 class="font-bold">Stok Tersedia :</h1>
                        <h1 class="ml-auto {{ $book->stock > 0 ? 'text-[#46FF21]' : 'text-[#FF5D5D]' }}">{{ $book->stock }}</h1>
                    </div>
                </div>
            </div>

            <div class="bg-[#00117E] p-5 w-full h-full rounded-lg mb-15">
                <h1 class="font-display text-5xl">{{ $book->title }}</h1>
                <p class="mt-5 leading-relaxed text-gray-200">{{ $book->description ?? 'Tidak ada deskripsi buku.' }}</p>

                <div class="flex justify-center mt-10 mb-5">
                    @if ($activeBorrowing)
                        <span class="bg-[#5B5B5B] px-6 py-2.5 rounded-lg text-lg font-bold text-gray-200">
                            {{ $activeBorrowing->status === 'pending' ? 'Menunggu Persetujuan' : 'Sedang Kamu Pinjam' }}
                        </span>
                    @elseif ($book->stock < 1)
                        <span class="bg-[#650000] px-6 py-2.5 rounded-lg text-lg font-bold text-[#FF5D5D]">
                            Stok Habis
                        </span>
                    @else
                        <form method="POST" action="{{ route('member.borrowing.store', $book) }}">
                            @csrf
                            <button type="submit" class="bg-[#213FFF] hover:bg-blue-600 cursor-pointer px-8 py-2.5 flex justify-center items-center rounded-lg text-lg font-bold transition">
                                Pinjam Buku
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection