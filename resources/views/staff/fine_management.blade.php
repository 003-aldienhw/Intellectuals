@extends('main')
@section('title', 'Detail Denda')
@section('content')
    <x-staff_navbar />
    <main class="pt-30 pl-60 pr-5">
        @if (session('success'))
            <div class="bg-[#137000] text-[#46FF21] p-4 rounded-lg mb-6 font-bold">{{ session('success') }}</div>
        @endif

        <div class="flex gap-10">
            <div class="bg-[#00117E] p-5 w-100 h-full rounded-lg mb-15 shrink-0">
                <div class="flex justify-center">
                    <img src="{{ asset('images/download-removebg-preview.png') }}" alt="ProfileIcon" width="180">
                </div>
                <div class="flex flex-col items-center gap-3 justify-center mt-5">
                    <h1 class="font-bold text-3xl">{{ $fine->member->name }}</h1>
                    <h1 class="font-bold text-xl">ID : {{ $fine->member->member_code }}</h1>
                </div>
                <div class="flex justify-center mt-8 mb-3">
                    <a href="{{ route('staff.members.show', $fine->member) }}" class="bg-[#213FFF] hover:bg-blue-600 px-5 py-2 flex justify-center items-center rounded-lg text-lg font-bold transition">
                        Lihat Profil
                    </a>
                </div>
            </div>

            <div class="bg-[#00117E] p-5 w-full h-full rounded-lg mb-15">
                <div class="flex justify-between items-center">
                    <h1 class="font-display text-5xl">Denda</h1>
                    <span class="px-4 py-1.5 rounded-lg font-bold {{ $fine->status === 'paid' ? 'bg-[#137000] text-[#46FF21]' : 'bg-[#650000] text-[#FF5D5D]' }}">
                        {{ $fine->status === 'paid' ? 'Selesai / Lunas' : 'Belum Dibayar' }}
                    </span>
                </div>

                @if ($fine->borrowing)
                    <p class="mt-3 text-sm text-gray-300">
                        Transaksi Peminjaman #{{ $fine->borrowing->id }} ({{ $fine->borrowing->borrow_date->format('d/m/Y') }}) —
                        Buku: {{ $fine->borrowing->details->map(fn($d) => $d->book->title)->join(', ') }}
                    </p>
                @endif

                <div class="flex flex-col mt-6 gap-3">
                    @foreach ($fine->violations as $violation)
                        <h1 class="font-bold text-lg">- {{ $violation }}</h1>
                    @endforeach
                </div>

                <h1 class="font-bold mt-6 text-2xl">Total : Rp {{ number_format($fine->total_amount, 0, ',', '.') }}</h1>

                <div class="flex w-full justify-center gap-10 items-center mt-10 mb-5">
                    <button type="button" onclick="document.getElementById('editFineModal').classList.remove('hidden')"
                        class="flex items-center justify-center bg-[#3E008B] hover:bg-purple-800 cursor-pointer gap-2 px-5 h-10 rounded-lg transition">
                        <span class="text-lg font-bold text-[#7C3AED]">Edit</span>
                        <img src="{{ asset('images/edit-svgrepo-com.png') }}" alt="Edit" width="24">
                    </button>

                    @if ($fine->status !== 'paid')
                        <form method="POST" action="{{ route('staff.fines.paid', $fine) }}">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="flex items-center justify-center bg-[#137000] hover:bg-green-800 cursor-pointer gap-2 px-5 h-10 rounded-lg transition">
                                <span class="text-lg font-bold text-[#46FF21]">Tandai Selesai</span>
                                <img src="{{ asset('images/correct-signal-svgrepo-com.png') }}" alt="Selesai" width="24">
                            </button>
                        </form>
                    @endif

                    <form method="POST" action="{{ route('staff.fines.destroy', $fine) }}" onsubmit="return confirm('Yakin ingin menghapus data denda ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex items-center justify-center bg-[#650000] hover:bg-red-900 cursor-pointer gap-2 px-5 h-10 rounded-lg transition">
                            <span class="text-lg font-bold text-[#FF2B2B]">Hapus</span>
                            <img src="{{ asset('images/trash-xmark-svgrepo-com.png') }}" alt="Hapus" width="24">
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div id="editFineModal" class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4">
            <div class="bg-[#00117E] border border-[#213FFF] w-full max-w-lg p-6 rounded-lg">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-display text-2xl">Edit Denda</h2>
                    <button type="button" onclick="document.getElementById('editFineModal').classList.add('hidden')" class="text-2xl font-bold cursor-pointer">&times;</button>
                </div>
                <form method="POST" action="{{ route('staff.fines.update', $fine) }}" class="flex flex-col gap-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <div class="flex justify-between items-center mb-1">
                            <label class="font-bold">Daftar Pelanggaran</label>
                            <button type="button" onclick="addEditViolationRow()" class="text-sm bg-[#213FFF] px-2.5 py-1 rounded font-bold cursor-pointer">
                                + Tambah Baris
                            </button>
                        </div>
                        <div id="editViolationList" class="flex flex-col gap-2">
                            @foreach ($fine->violations as $v)
                                <div class="flex gap-2">
                                    <input type="text" name="violations[]" value="{{ $v }}" required class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                                    <button type="button" onclick="this.parentElement.remove()" class="bg-[#650000] text-[#FF2B2B] px-3 rounded-lg font-bold cursor-pointer">&times;</button>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <label class="block mb-1 font-bold">Total Nominal Denda (Rp)</label>
                        <input type="number" name="total_amount" value="{{ $fine->total_amount }}" min="0" required class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                    </div>
                    <div class="flex justify-end gap-3 mt-4">
                        <button type="button" onclick="document.getElementById('editFineModal').classList.add('hidden')" class="px-4 py-2 rounded-lg bg-[#5B5B5B] cursor-pointer">Batal</button>
                        <button type="submit" class="px-6 py-2 rounded-lg bg-[#213FFF] font-bold cursor-pointer">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script>
        function addEditViolationRow() {
            const container = document.getElementById('editViolationList');
            const row = document.createElement('div');
            row.className = 'flex gap-2';
            row.innerHTML = `
                <input type="text" name="violations[]" placeholder="Jenis pelanggaran..." required class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                <button type="button" onclick="this.parentElement.remove()" class="bg-[#650000] text-[#FF2B2B] px-3 rounded-lg font-bold cursor-pointer">&times;</button>
            `;
            container.appendChild(row);
        }
    </script>
@endsection