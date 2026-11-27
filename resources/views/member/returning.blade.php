@extends('main')
@section('title', 'Pengembalian')
@section('content')
    <x-member_navbar />
    <main class="pt-30 pl-60 pr-5">
        @if (session('success'))
            <div class="bg-[#137000] text-[#46FF21] p-4 rounded-lg mb-6 font-bold">{{ session('success') }}</div>
        @endif

        <div class="flex flex-col gap-6 mb-15">
            @forelse ($borrowings as $borrowing)
                @php $book = $borrowing->details->first()?->book; @endphp
                <a href="{{ route('member.returning.details', $borrowing) }}" class="member-searchable" data-search="{{ strtolower(($book?->title ?? '') . ' ' . $borrowing->borrow_date->format('d/m/Y') . ' ' . ($borrowing->due_date?->format('d/m/Y') ?? '')) }}">
                    <div class="flex items-center bg-[#00117E] hover:ring-2 hover:ring-[#213FFF] transition min-h-25 p-4 rounded-lg">
                        @if ($book?->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-20 h-22 object-cover rounded-lg mr-4">
                        @else
                            <div class="bg-red-500 w-20 h-22 rounded-lg mr-4 flex items-center justify-center text-xs text-center p-1">
                                {{ $book?->title ?? 'Buku' }}
                            </div>
                        @endif
                        <div class="flex flex-col gap-3">
                            <h1 class="font-bold text-lg">{{ $book?->title ?? 'Buku' }}</h1>
                            <h1>Dipinjam {{ $borrowing->borrow_date->format('d/m/Y') }}</h1>
                        </div>
                        <div class="ml-auto flex flex-col items-end gap-2">
                            <h1>Tenggat {{ $borrowing->due_date?->format('d/m/Y') ?? '-' }}</h1>
                            <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $borrowing->status === 'return_pending' ? 'bg-purple-600/40 text-purple-200' : 'bg-[#213FFF]/40 text-blue-200' }}">
                                {{ $borrowing->status === 'return_pending' ? 'Menunggu Konfirmasi Petugas' : 'Sedang Dipinjam' }}
                            </span>
                        </div>
                    </div>
                </a>
                <div id="emptyMemberSearchState" class="hidden bg-[#00117E] p-8 rounded-lg text-center mb-15">
                    <p class="text-lg">Data tidak ditemukan.</p>
                </div>
            @empty
                <div class="bg-[#00117E] p-8 rounded-lg text-center">
                    <p>Tidak ada buku yang sedang dipinjam saat ini.</p>
                </div>
            @endforelse
        </div>
    </main>
    <script>
        document.getElementById('memberSearchInput')?.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            const items = document.querySelectorAll('.member-searchable');
            let visibleCount = 0;

            items.forEach(el => {
                const matches = !q || (el.dataset.search || '').includes(q);
                el.style.display = matches ? '' : 'none';
                if (matches) visibleCount++;
            });

            const emptyState = document.getElementById('emptyMemberSearchState');
            if (emptyState) {
                emptyState.classList.toggle('hidden', visibleCount > 0 || items.length === 0);
            }
        });
    </script>
@endsection