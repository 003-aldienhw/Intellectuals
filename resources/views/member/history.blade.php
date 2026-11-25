@extends('main')
@section('title', 'History')
@section('content')
    <x-member_navbar />
    <main class="pt-30 pl-60 pr-5">
        @if (session('success'))
            <div class="bg-[#137000] text-[#46FF21] p-4 rounded-lg mb-6 font-bold">{{ session('success') }}</div>
        @endif

        @if ($unpaidFines->isNotEmpty())
            <div class="bg-[#650000] border border-[#FF5D5D] text-white p-4 rounded-lg mb-8 flex items-center justify-between gap-4">
                <div>
                    <h1 class="font-bold text-lg text-[#FF5D5D]">Peringatan Denda Aktif!</h1>
                    <p class="text-sm mt-1">
                        Kamu memiliki {{ $unpaidFines->count() }} denda belum dibayar dengan total
                        <span class="font-bold text-[#FF5D5D]">Rp {{ number_format($unpaidFines->sum('total_amount'), 0, ',', '.') }}</span>.
                        Klik denda di bawah untuk melihat detail dan tata cara pembayaran langsung ke petugas.
                    </p>
                </div>
                <a href="{{ route('member.fine.details', $unpaidFines->first()) }}"
                    class="bg-[#FF5D5D] text-[#000315] hover:bg-red-400 transition px-4 py-2 rounded-lg font-bold shrink-0">
                    Lihat Detail
                </a>
            </div>
        @endif

        @if ($fines->isNotEmpty())
            <h2 class="font-display text-2xl mb-4">Daftar Denda</h2>
            <div class="flex flex-col gap-4 mb-10">
                @foreach ($fines as $fine)
                    @php $fineBook = $fine->borrowing?->details->first()?->book; @endphp
                    <a href="{{ route('member.fine.details', $fine) }}">
                        <div class="flex items-center bg-[#00117E] border {{ $fine->status === 'unpaid' ? 'border-[#FF5D5D]' : 'border-transparent' }} hover:ring-2 hover:ring-[#213FFF] transition min-h-24 p-4 rounded-lg">
                            @if ($fineBook?->cover)
                                <img src="{{ asset('storage/' . $fineBook->cover) }}" alt="{{ $fineBook->title }}" class="w-18 h-20 object-cover rounded-lg mr-4">
                            @else
                                <div class="bg-red-500 w-18 h-20 rounded-lg mr-4 flex items-center justify-center text-xs text-center p-1 font-bold">
                                    Denda
                                </div>
                            @endif
                            <div class="flex flex-col gap-1.5">
                                <h1 class="font-bold text-lg">{{ $fineBook?->title ?? 'Denda Umum' }}</h1>
                                <p class="text-sm text-gray-200">{{ implode(', ', $fine->violations) }}</p>
                            </div>
                            <div class="ml-auto flex flex-col items-end gap-2">
                                <span class="font-bold text-lg">Rp {{ number_format($fine->total_amount, 0, ',', '.') }}</span>
                                <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $fine->status === 'paid' ? 'bg-[#137000] text-[#46FF21]' : 'bg-[#650000] text-[#FF5D5D]' }}">
                                    {{ $fine->status === 'paid' ? 'Sudah Dibayar' : 'Belum Dibayar' }}
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        <h2 class="font-display text-2xl mb-4">Riwayat Peminjaman</h2>
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