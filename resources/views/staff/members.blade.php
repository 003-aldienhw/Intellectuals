@extends('main')
@section('title', 'Anggota')
@section('content')
    <x-staff_navbar />
    <main class="pt-30 pl-60 pr-5">
        @if (session('success'))
            <div class="bg-[#137000] text-[#46FF21] p-4 rounded-lg mb-6 font-bold">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="bg-[#650000] text-[#FF5D5D] p-4 rounded-lg mb-6 font-bold">{{ $errors->first() }}</div>
        @endif

        <button type="button" onclick="document.getElementById('addMemberModal').classList.remove('hidden')"
            class="flex items-center justify-center bg-[#00117E] hover:bg-[#213FFF] transition cursor-pointer gap-2 px-4 py-2 mb-10 rounded-lg">
            <span class="text-lg font-bold">Tambah Anggota</span>
            <img src="{{ asset('images/plus-large-svgrepo-com.png') }}" alt="Tambah" width="26">
        </button>

        <div class="flex flex-col gap-6 mb-15">
            @forelse ($members as $member)
                <a href="{{ route('staff.members.show', $member) }}">
                    <div class="flex items-center bg-[#00117E] hover:ring-2 hover:ring-[#213FFF] transition h-25 p-3 rounded-lg">
                        <img src="{{ asset('images/download-removebg-preview.png') }}" class="mr-4" alt="ProfileIcon" width="80">
                        <div class="flex flex-col gap-2">
                            <h1 class="font-bold text-lg">{{ $member->name }} <span class="text-sm text-gray-300">({{ $member->member_code }})</span></h1>
                            <h1>Bergabung {{ $member->created_at->format('d/m/Y') }}</h1>
                        </div>
                        <span class="ml-auto px-3 py-1 rounded-lg text-sm font-bold {{ $member->status === 'Aktif' ? 'bg-[#137000] text-[#46FF21]' : 'bg-[#650000] text-[#FF5D5D]' }}">
                            {{ $member->status }}
                        </span>
                    </div>
                </a>
            @empty
                <div class="bg-[#00117E] p-8 rounded-lg text-center">Belum ada anggota terdaftar.</div>
            @endforelse
        </div>

        <div id="addMemberModal" class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4">
            <div class="bg-[#00117E] border border-[#213FFF] w-full max-w-md p-6 rounded-lg">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-display text-2xl">Daftarkan Anggota</h2>
                    <button type="button" onclick="document.getElementById('addMemberModal').classList.add('hidden')" class="text-2xl font-bold cursor-pointer">&times;</button>
                </div>
                <form method="POST" action="{{ route('staff.members.store') }}" class="flex flex-col gap-4">
                    @csrf
                    <div>
                        <label class="block mb-1 font-bold">Nama Anggota (Untuk Login)</label>
                        <input type="text" name="name" required class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                    </div>
                    <div>
                        <label class="block mb-1 font-bold">No Telepon</label>
                        <input type="text" name="phone" class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                    </div>
                    <div>
                        <label class="block mb-1 font-bold">Status</label>
                        <select name="status" class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 font-bold">Password Akun</label>
                        <input type="password" name="password" required class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                    </div>
                    <div class="flex justify-end gap-3 mt-4">
                        <button type="button" onclick="document.getElementById('addMemberModal').classList.add('hidden')" class="px-4 py-2 rounded-lg bg-[#5B5B5B] cursor-pointer">Batal</button>
                        <button type="submit" class="px-6 py-2 rounded-lg bg-[#213FFF] font-bold cursor-pointer">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection