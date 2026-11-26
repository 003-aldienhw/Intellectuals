@extends('main')
@section('title', 'Detail Denda')
@section('content')
    <x-member_navbar />
    <main class="pt-30 pl-60 pr-5">
        <div class="flex gap-10">
            <div class="bg-[#00117E] p-5 w-100 h-full rounded-lg mb-15 shrink-0">
                @if ($book?->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-70 object-cover rounded-lg">
                @else
                    <div class="bg-red-500 h-70 rounded-lg flex items-center justify-center font-display text-2xl text-center p-3">
                        {{ $book?->title ?? 'Tidak Ada Buku Terkait' }}
                    </div>
                @endif

                <div class="flex flex-col gap-2 mt-5">
                    <div class="flex">
                        <h1 class="font-bold">Tahun :</h1>
                        <h1 class="ml-auto">{{ $book?->publication_year ?? '-' }}</h1>
                    </div>
                    <div class="flex">
                        <h1 class="font-bold">Halaman :</h1>
                        <h1 class="ml-auto">{{ $book?->pages ?? '-' }}</h1>
                    </div>
                    <div class="flex">
                        <h1 class="font-bold">Penulis :</h1>
                        <h1 class="ml-auto">{{ $book?->author ?? '-' }}</h1>
                    </div>
                    <div class="flex">
                        <h1 class="font-bold">Kategori :</h1>
                        <h1 class="ml-auto">{{ $book?->category?->name ?? '-' }}</h1>
                    </div>
                    <div class="flex">
                        <h1 class="font-bold">ISBN :</h1>
                        <h1 class="ml-auto">{{ $book?->isbn ?? '-' }}</h1>
                    </div>
                </div>
            </div>

            <div class="bg-[#00117E] p-5 w-full h-full rounded-lg mb-15">
                <div class="flex justify-between items-start gap-4">
                    <h1 class="font-display text-5xl">{{ $book?->title ?? 'Detail Denda' }}</h1>
                    <span class="px-4 py-1.5 rounded-lg font-bold shrink-0 {{ $fine->status === 'paid' ? 'bg-[#137000] text-[#46FF21]' : 'bg-[#650000] text-[#FF5D5D]' }}">
                        {{ $fine->status === 'paid' ? 'Sudah Dibayar' : 'Belum Dibayar' }}
                    </span>
                </div>

                <div class="flex flex-col mt-6 gap-3">
                    <h2 class="font-bold text-lg text-blue-200">Daftar Pelanggaran :</h2>
                    @foreach ($fine->violations as $violation)
                        <h1 class="font-bold text-lg">- {{ $violation }}</h1>
                    @endforeach
                </div>

                <h1 class="font-bold mt-6 text-2xl">
                    Total : Rp {{ number_format($fine->total_amount, 0, ',', '.') }}
                </h1>

                <div class="mt-10 mb-5 bg-[#000315]/60 border border-[#213FFF] rounded-lg p-5">
                    @if ($fine->status === 'paid')
                        <p class="font-bold text-[#46FF21] text-base">
                            Denda ini telah lunas dan tercatat oleh petugas.
                        </p>
                    @else
                        <p class="font-bold text-base text-white">
                            Pembayaran Denda Dilakukan Secara Fisik ke Petugas
                        </p>
                        <p class="text-sm text-gray-200 mt-1.5 leading-relaxed">
                            Silakan datang langsung ke meja petugas perpustakaan dengan menyebutkan nama atau ID anggota (<span class="font-bold">{{ $fine->member->member_code }}</span>) untuk melakukan pembayaran denda sebesar <span class="font-bold text-[#FF5D5D]">Rp {{ number_format($fine->total_amount, 0, ',', '.') }}</span> secara tunai/fisik. Status denda akan diperbarui oleh petugas setelah pembayaran diterima.
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </main>
    <script>
        function filterBooks() {
            const query = (document.getElementById('memberSearchInput')?.value || '').toLowerCase().trim();
            const cards = document.querySelectorAll('.book-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const matchesCategory = !activeCategoryId || card.dataset.category === activeCategoryId;
                const matchesSearch = !query || card.dataset.search.includes(query);
                const show = matchesCategory && matchesSearch;

                card.style.display = show ? '' : 'none';
                if (show) visibleCount++;
            });

            document.getElementById('emptyFilterState').classList.toggle('hidden', visibleCount > 0 || cards.length === 0);
        }

        document.getElementById('memberSearchInput')?.addEventListener('input', filterBooks);
    </script>
@endsection