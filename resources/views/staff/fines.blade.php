@extends('main')
@section('title', 'Denda')
@section('content')
    <x-staff_navbar />
    <main class="pt-30 pl-60 pr-5">
        @if (session('success'))
            <div class="bg-[#137000] text-[#46FF21] p-4 rounded-lg mb-6 font-bold">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="bg-[#650000] text-[#FF5D5D] p-4 rounded-lg mb-6 font-bold">{{ $errors->first() }}</div>
        @endif

        <button type="button" onclick="document.getElementById('addFineModal').classList.remove('hidden')"
            class="flex items-center justify-center bg-[#00117E] hover:bg-[#213FFF] transition cursor-pointer gap-2 px-4 py-2 mb-10 rounded-lg">
            <span class="text-lg font-bold">Tambah Denda</span>
            <img src="{{ asset('images/plus-large-svgrepo-com.png') }}" alt="Tambah" width="26">
        </button>

        <div class="flex flex-col gap-6 mb-15">
            @forelse ($fines as $fine)
                <a href="{{ route('staff.fines.show', $fine) }}">
                    <div class="flex items-center bg-[#00117E] hover:ring-2 hover:ring-[#213FFF] transition min-h-25 p-3 rounded-lg">
                        <img src="{{ asset('images/download-removebg-preview.png') }}" class="mr-4" alt="ProfileIcon" width="80">
                        <div class="flex flex-col gap-2">
                            <h1 class="font-bold text-lg">{{ $fine->member->name }}</h1>
                            <h1>{{ implode(', ', $fine->violations) }}</h1>
                        </div>
                        <div class="ml-auto flex flex-col items-end gap-2">
                            <span class="font-bold text-lg">Rp {{ number_format($fine->total_amount, 0, ',', '.') }}</span>
                            <span class="px-3 py-1 rounded-lg text-xs font-bold {{ $fine->status === 'paid' ? 'bg-[#137000] text-[#46FF21]' : 'bg-[#650000] text-[#FF5D5D]' }}">
                                {{ $fine->status === 'paid' ? 'Selesai / Lunas' : 'Belum Dibayar' }}
                            </span>
                        </div>
                    </div>
                </a>
            @empty
                <div class="bg-[#00117E] p-8 rounded-lg text-center">Belum ada catatan denda.</div>
            @endforelse
        </div>

        <div id="addFineModal" class="{{ $preselectBorrowing ? '' : 'hidden' }} fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4 overflow-y-auto">
            <div class="bg-[#00117E] border border-[#213FFF] w-full max-w-lg p-6 rounded-lg my-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-display text-2xl">Tambah Denda Anggota</h2>
                    <button type="button" onclick="document.getElementById('addFineModal').classList.add('hidden')" class="text-2xl font-bold cursor-pointer">&times;</button>
                </div>
                <form method="POST" action="{{ route('staff.fines.store') }}" class="flex flex-col gap-4">
                    @csrf
                    <div>
                        <label class="block mb-1 font-bold">Pilih Anggota</label>
                        <select name="user_id" id="fineMemberSelect" required onchange="filterBorrowingsByMember()"
                            class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                            <option value="">-- Pilih Anggota --</option>
                            @foreach ($members as $member)
                                <option value="{{ $member->id }}" {{ $preselectBorrowing?->user_id === $member->id ? 'selected' : '' }}>
                                    {{ $member->name }} ({{ $member->member_code }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1 font-bold">Transaksi Peminjaman Sebelumnya</label>
                        <select name="borrowing_id" id="fineBorrowingSelect"
                            class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                            <option value="">-- Pilih Transaksi (Opsional) --</option>
                            @foreach ($borrowings as $b)
                                @php $titles = $b->details->map(fn($d) => $d->book->title)->join(', '); @endphp
                                <option value="{{ $b->id }}" data-member="{{ $b->user_id }}"
                                    {{ $preselectBorrowing?->id === $b->id ? 'selected' : '' }}>
                                    #{{ $b->id }} - {{ $titles }} ({{ $b->borrow_date->format('d/m/Y') }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label class="font-bold">Daftar Pelanggaran</label>
                            <button type="button" onclick="addViolationRow('violationList')"
                                class="text-sm bg-[#213FFF] px-2.5 py-1 rounded font-bold cursor-pointer">
                                + Tambah Baris
                            </button>
                        </div>
                        <div id="violationList" class="flex flex-col gap-2">
                            <input type="text" name="violations[]" placeholder="Contoh: Terlambat Mengembalikan Buku" required
                                class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1 font-bold">Total Nominal Denda (Rp)</label>
                        <input type="number" name="total_amount" min="0" placeholder="Contoh: 50000" required
                            class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                    </div>

                    <div class="flex justify-end gap-3 mt-4">
                        <button type="button" onclick="document.getElementById('addFineModal').classList.add('hidden')" class="px-4 py-2 rounded-lg bg-[#5B5B5B] cursor-pointer">Batal</button>
                        <button type="submit" class="px-6 py-2 rounded-lg bg-[#213FFF] font-bold cursor-pointer">Simpan Denda</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.getElementById('staffSearchInput')?.addEventListener('input', function () {
            const q = this.value.toLowerCase().trim();
            document.querySelectorAll('.searchable-item').forEach(el => {
                el.style.display = (!q || el.dataset.search.includes(q)) ? '' : 'none';
            });
        });
        function addViolationRow(containerId) {
            const container = document.getElementById(containerId);
            const row = document.createElement('div');
            row.className = 'flex gap-2';
            row.innerHTML = `
                <input type="text" name="violations[]" placeholder="Jenis pelanggaran..." required class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                <button type="button" onclick="this.parentElement.remove()" class="bg-[#650000] text-[#FF2B2B] px-3 rounded-lg font-bold cursor-pointer">&times;</button>
            `;
            container.appendChild(row);
        }

        function filterBorrowingsByMember() {
            const memberId = document.getElementById('fineMemberSelect').value;
            const options = document.querySelectorAll('#fineBorrowingSelect option');
            options.forEach(opt => {
                if (!opt.value) return;
                opt.hidden = memberId && opt.dataset.member !== memberId;
            });
        }
        document.addEventListener('DOMContentLoaded', filterBorrowingsByMember);
    </script>
@endsection