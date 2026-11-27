@extends('main')
@section('title', 'Beranda')
@section('content')
    <x-staff_navbar />
    <main class="pt-30 pl-60 pr-5">
        @if (session('success'))
            <div class="bg-[#137000] text-[#46FF21] p-4 rounded-lg mb-6 font-bold">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="bg-[#650000] text-[#FF5D5D] p-4 rounded-lg mb-6 font-bold">{{ session('error') }}</div>
        @endif

        <div class="flex flex-col gap-6 mb-15">
            @forelse ($activities as $activity)
                @php
                    $isBorrowing = $activity->status === 'pending';
                    $route = $isBorrowing
                        ? route('staff.borrowings.show', $activity)
                        : route('staff.returnings.show', $activity);
                    $bookTitles = $activity->details->map(fn ($d) => $d->book->title)->join(', ');
                @endphp
                <a href="{{ $route }}" class="searchable-item" data-search="{{ strtolower($activity->name . ' ' . $activity->activity_code . ' ' . $activity->status) }}">
                    <div class="flex items-center bg-[#00117E] hover:ring-2 hover:ring-[#213FFF] transition min-h-25 p-4 rounded-lg">
                        <img src="{{ asset('images/download-removebg-preview.png') }}" class="mr-4" alt="ProfileIcon" width="80">
                        <div class="flex flex-col gap-2">
                            <h1 class="font-bold text-lg">{{ $activity->member->name }}</h1>
                            <h1>
                                {{ $isBorrowing ? 'Mengajukan Pinjam:' : 'Mengajukan Pengembalian:' }}
                                <span class="font-bold">{{ $book?->title ?? 'Buku Dihapus' }}</span>
                            </h1>
                        </div>
                        <div class="ml-auto flex flex-col items-end gap-2">
                            <h1>{{ $activity->updated_at->format('d/m/Y') }}</h1>
                            <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $isBorrowing ? 'bg-yellow-600/30 text-yellow-300' : 'bg-purple-600/40 text-purple-200' }}">
                                {{ $isBorrowing ? 'Menunggu Persetujuan' : 'Ajuan Pengembalian' }}
                            </span>
                        </div>
                    </div>
                </a>
                <div id="emptySearchState" class="hidden bg-[#00117E] p-8 rounded-lg text-center mb-15">
                    <p class="text-lg">Data tidak ditemukan.</p>
                </div>
            @empty
                <div class="bg-[#00117E] p-8 rounded-lg text-center">
                    <p>Belum ada pengajuan peminjaman atau pengembalian yang menunggu konfirmasi.</p>
                </div>
            @endforelse
        </div>
    </main>
    <script>
        document.getElementById('staffSearchInput')?.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            const items = document.querySelectorAll('.searchable-item');
            let visibleCount = 0;

            items.forEach(el => {
                const matches = !q || (el.dataset.search || '').includes(q);
                el.style.display = matches ? '' : 'none';
                if (matches) visibleCount++;
            });

            const emptyState = document.getElementById('emptySearchState');
            if (emptyState) {
                emptyState.classList.toggle('hidden', visibleCount > 0 || items.length === 0);
            }
        });
    </script>
@endsection