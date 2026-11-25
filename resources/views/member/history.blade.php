@extends('main')
@section('title', 'History')
@section('content')
    <x-member_navbar />
    <main class="pt-30 pl-60 pr-5">
        @if (session('success'))
            <div class="bg-[#137000] text-[#46FF21] p-4 rounded-lg mb-6 font-bold">{{ session('success') }}</div>
        @endif

        <div class="flex flex-col gap-6 mb-15">
            @forelse ($borrowings as $borrowing)
                @php
                    $book = $borrowing->details->first()?->book;
                    $statusLabel = match($borrowing->status) {
                        'pending' => ['text' => 'Menunggu Persetujuan', 'class' => 'bg-yellow-600/30 text-yellow-300'],
                        'approved' => ['text' => 'Sedang Dipinjam', 'class' => 'bg-[#213FFF]/40 text-blue-200'],
                        'return_pending' => ['text' => 'Menunggu Konfirmasi Kembali', 'class' => 'bg-purple-600/30 text-purple-200'],
                        'returned' => ['text' => 'Dikembalikan ' . $borrowing->return_date?->format('d/m/Y'), 'class' => 'bg-[#137000] text-[#46FF21]'],
                        'rejected' => ['text' => 'Ditolak', 'class' => 'bg-[#650000] text-[#FF5D5D]'],
                    };
                @endphp
                <div class="flex items-center bg-[#00117E] min-h-25 p-4 rounded-lg">
                    @if ($book?->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-20 h-22 object-cover rounded-lg mr-4">
                    @else
                        <div class="bg-red-500 w-20 h-22 rounded-lg mr-4 flex items-center justify-center text-xs text-center p-1">
                            {{ $book?->title ?? 'Buku' }}
                        </div>
                    @endif
                    <div class="flex flex-col gap-3">
                        <h1 class="font-bold text-lg">{{ $book?->title ?? 'Buku Dihapus' }}</h1>
                        <h1>Diajukan / Dipinjam {{ $borrowing->borrow_date->format('d/m/Y') }}</h1>
                    </div>
                    <div class="ml-auto flex flex-col items-end gap-2">
                        <span class="px-3 py-1 rounded-lg text-sm font-bold {{ $statusLabel['class'] }}">
                            {{ $statusLabel['text'] }}
                        </span>
                        @if ($borrowing->due_date && $borrowing->status !== 'returned')
                            <span class="text-sm text-gray-300">Tenggat: {{ $borrowing->due_date->format('d/m/Y') }}</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="bg-[#00117E] p-8 rounded-lg text-center">
                    <p>Belum ada riwayat peminjaman buku.</p>
                </div>
            @endforelse
        </div>
    </main>
@endsection