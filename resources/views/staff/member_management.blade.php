@extends('main')
@section('title', 'Profil Anggota')
@section('content')
    <x-staff_navbar />
    <main class="pt-30 pl-60 pr-5">
        @if (session('success'))
            <div class="bg-[#137000] text-[#46FF21] p-4 rounded-lg mb-6 font-bold">{{ session('success') }}</div>
        @endif

        <div class="flex flex-col items-center">
            <div class="flex w-full justify-between items-center pr-20 pl-20">
                <button type="button" onclick="document.getElementById('editMemberModal').classList.remove('hidden')"
                    class="flex items-center justify-center bg-[#3E008B] hover:bg-purple-800 cursor-pointer gap-2 px-4 h-10 rounded-lg transition">
                    <span class="text-lg font-bold text-[#7C3AED]">Edit</span>
                    <img src="{{ asset('images/edit-svgrepo-com.png') }}" alt="Edit" width="24">
                </button>

                <img src="{{ asset('images/download-removebg-preview.png') }}" alt="ProfileIcon" width="180">

                <form method="POST" action="{{ route('staff.members.destroy', $member) }}" onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="flex items-center justify-center bg-[#650000] hover:bg-red-900 cursor-pointer gap-2 px-4 h-10 rounded-lg transition">
                        <span class="text-lg font-bold text-[#FF2B2B]">Hapus</span>
                        <img src="{{ asset('images/trash-xmark-svgrepo-com.png') }}" alt="Hapus" width="24">
                    </button>
                </form>
            </div>

            <h1 class="font-bold text-2xl mt-4">{{ $member->name }}</h1>

            <div class="flex flex-wrap justify-center gap-10 mt-10">
                <div>
                    <h1 class="mb-1">Nama</h1>
                    <input type="text" value="{{ $member->name }}" class="bg-[#5B5B5B] w-110 h-10 px-3 rounded-lg text-white" disabled>
                </div>
                <div>
                    <h1 class="mb-1">Status</h1>
                    <input type="text" value="{{ $member->status }}" class="bg-[#5B5B5B] w-110 h-10 px-3 rounded-lg text-white" disabled>
                </div>
                <div>
                    <h1 class="mb-1">No Telepon</h1>
                    <input type="text" value="{{ $member->phone ?? '-' }}" class="bg-[#5B5B5B] w-110 h-10 px-3 rounded-lg text-white" disabled>
                </div>
                <div>
                    <h1 class="mb-1">ID Anggota</h1>
                    <input type="text" value="{{ $member->member_code }}" class="bg-[#5B5B5B] w-110 h-10 px-3 rounded-lg text-white" disabled>
                </div>
            </div>

            <div class="flex gap-20 mt-10 mb-15">
                <div class="flex flex-col p-5 justify-around text-center w-44 h-44 bg-[#5D7DFF] rounded-lg">
                    <h1 class="font-bold text-[#00117E] text-lg">Buku yang Dipinjam</h1>
                    <h1 class="font-bold text-[#00117E] text-2xl">{{ $borrowedCount }}</h1>
                </div>
                <div class="flex flex-col p-5 justify-around text-center w-44 h-44 bg-[#78FF5D] rounded-lg">
                    <h1 class="font-bold text-[#0F7E00] text-lg">Buku yang Dikembalikan</h1>
                    <h1 class="font-bold text-[#0F7E00] text-2xl">{{ $returnedCount }}</h1>
                </div>
                <div class="flex flex-col p-5 justify-around text-center w-44 h-44 bg-[#FF5D5D] rounded-lg">
                    <h1 class="font-bold text-[#7E0000] text-lg">Total Denda</h1>
                    <h1 class="font-bold text-[#7E0000] text-xl">Rp {{ number_format($totalFines, 0, ',', '.') }}</h1>
                </div>
            </div>
        </div>

        <div id="editMemberModal" class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4">
            <div class="bg-[#00117E] border border-[#213FFF] w-full max-w-md p-6 rounded-lg">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-display text-2xl">Edit Data Anggota</h2>
                    <button type="button" onclick="document.getElementById('editMemberModal').classList.add('hidden')" class="text-2xl font-bold cursor-pointer">&times;</button>
                </div>
                <form method="POST" action="{{ route('staff.members.update', $member) }}" class="flex flex-col gap-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block mb-1 font-bold">Nama Anggota</label>
                        <input type="text" name="name" value="{{ $member->name }}" required class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                    </div>
                    <div>
                        <label class="block mb-1 font-bold">No Telepon</label>
                        <input type="text" name="phone" value="{{ $member->phone }}" class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                    </div>
                    <div>
                        <label class="block mb-1 font-bold">Status</label>
                        <select name="status" class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                            <option value="Aktif" {{ $member->status === 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Nonaktif" {{ $member->status === 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 font-bold">Password Baru (Kosongkan jika tidak diubah)</label>
                        <input type="password" name="password" class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                    </div>
                    <div class="flex justify-end gap-3 mt-4">
                        <button type="button" onclick="document.getElementById('editMemberModal').classList.add('hidden')" class="px-4 py-2 rounded-lg bg-[#5B5B5B] cursor-pointer">Batal</button>
                        <button type="submit" class="px-6 py-2 rounded-lg bg-[#213FFF] font-bold cursor-pointer">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection