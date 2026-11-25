@extends('main')
@section('title', 'Detail Pengembalian')
@section('content')
    <x-member_navbar />
    @php $book = $borrowing->details->first()?->book; @endphp
    <main class="pt-30 pl-60 pr-5">
        @if (session('error'))
            <div class="bg-[#650000] text-[#FF5D5D] p-4 rounded-lg mb-6 font-bold">{{ session('error') }}</div>
        @endif

        <div class="flex gap-10">
            <div class="bg-[#00117E] p-5 w-100 h-full rounded-lg mb-15 shrink-0">
                @if ($book?->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-70 object-cover rounded-lg">
                @else
                    <div class="bg-red-500 h-70 rounded-lg flex items-center justify-center font-display text-2xl">
                        {{ $book?->title ?? 'Buku' }}
                    </div>
                @endif
                <div class="flex flex-col gap-2 mt-5">
                    <div class="flex">
                        <h1 class="font-bold">Tahun :</h1>
                        <h1 class="ml-auto">{{ $book?->publication_year }}</h1>
                    </div>
                    <div class="flex">
                        <h1 class="font-bold">Halaman :</h1>
                        <h1 class="ml-auto">{{ $book?->pages }}</h1>
                    </div>
                    <div class="flex">
                        <h1 class="font-bold">Penulis :</h1>
                        <h1 class="ml-auto">{{ $book?->author }}</h1>
                    </div>
                    <div class="flex">
                        <h1 class="font-bold">Kategori :</h1>
                        <h1 class="ml-auto">{{ $book?->category?->name }}</h1>
                    </div>
                    <div class="flex">
                        <h1 class="font-bold">ISBN :</h1>
                        <h1 class="ml-auto">{{ $book?->isbn }}</h1>
                    </div>
                </div>
            </div>

            <div class="bg-[#00117E] p-5 w-full h-full rounded-lg mb-15">
                <h1 class="font-display text-5xl">{{ $book?->title }}</h1>

                <div class="flex mt-6 w-85">
                    <h1 class="font-bold">Tanggal Peminjaman :</h1>
                    <h1 class="ml-auto">{{ $borrowing->borrow_date->format('d/m/Y') }}</h1>
                </div>
                <div class="flex mt-4 w-85">
                    <h1 class="font-bold">Tenggat Pengembalian :</h1>
                    <h1 class="ml-auto">{{ $borrowing->due_date?->format('d/m/Y') ?? '-' }}</h1>
                </div>
                <div class="flex mt-4 w-85">
                    <h1 class="font-bold">Status :</h1>
                    <h1 class="ml-auto font-bold {{ $borrowing->status === 'return_pending' ? 'text-purple-300' : 'text-blue-300' }}">
                        {{ $borrowing->status === 'return_pending' ? 'Menunggu Konfirmasi Petugas' : 'Sedang Dipinjam' }}
                    </h1>
                </div>

                <div class="flex justify-center mt-12 mb-5">
                    @if ($borrowing->status === 'approved')
                        <form method="POST" action="{{ route('member.returning.request', $borrowing) }}">
                            @csrf
                            <button type="submit" class="bg-[#213FFF] hover:bg-blue-600 cursor-pointer px-8 py-2.5 rounded-lg text-lg font-bold transition">
                                Ajukan Pengembalian
                            </button>
                        </form>
                    @else
                        <span class="bg-[#5B5B5B] px-6 py-2.5 rounded-lg text-lg font-bold text-gray-200">
                            Pengembalian Sedang Diajukan
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </main>
@endsection