@extends('main')
@section('title', 'Detail Kategori')
@section('content')
    <x-staff_navbar />
    <main class="pt-30 pl-60 pr-5">
        @if (session('success'))
            <div class="bg-[#137000] text-[#46FF21] p-4 rounded-lg mb-6 font-bold">{{ session('success') }}</div>
        @endif

        <div class="flex gap-10">
            <div class="bg-[#00117E] p-5 w-96 h-full rounded-lg mb-15 shrink-0">
                @if ($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-full h-70 object-cover rounded-lg">
                @else
                    <div class="bg-red-500 h-70 rounded-lg flex items-center justify-center font-display text-2xl">
                        {{ $category->name }}
                    </div>
                @endif
                <div class="flex justify-center mt-5">
                    <h1 class="font-display text-4xl">{{ $category->name }}</h1>
                </div>
                <div class="flex w-full justify-between items-center mt-10 mb-5">
                    <button type="button" onclick="document.getElementById('editCategoryModal').classList.remove('hidden')"
                        class="flex items-center justify-center bg-[#3E008B] hover:bg-purple-800 cursor-pointer gap-2 px-4 h-10 rounded-lg transition">
                        <span class="text-lg font-bold text-[#7C3AED]">Edit</span>
                        <img src="{{ asset('images/edit-svgrepo-com.png') }}" alt="Edit" width="24">
                    </button>
                    <form method="POST" action="{{ route('staff.categories.destroy', $category) }}" onsubmit="return confirm('Menghapus kategori akan menghapus semua buku di dalamnya. Lanjutkan?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="flex items-center justify-center bg-[#650000] hover:bg-red-900 cursor-pointer gap-2 px-4 h-10 rounded-lg transition">
                            <span class="text-lg font-bold text-[#FF2B2B]">Hapus</span>
                            <img src="{{ asset('images/trash-xmark-svgrepo-com.png') }}" alt="Hapus" width="24">
                        </button>
                    </form>
                </div>
            </div>

            <div class="flex flex-col w-full gap-6 mb-15">
                @forelse ($category->books as $book)
                    <a href="{{ route('staff.books.show', $book) }}">
                        <div class="flex items-center bg-[#00117E] hover:ring-2 hover:ring-[#213FFF] transition h-25 p-3 rounded-lg">
                            @if ($book->cover)
                                <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-20 h-22 object-cover rounded-lg mr-4">
                            @else
                                <div class="bg-red-500 w-20 h-22 rounded-lg mr-4 flex items-center justify-center text-xs text-center p-1">
                                    {{ $book->title }}
                                </div>
                            @endif
                            <div class="flex flex-col gap-2">
                                <h1 class="font-bold text-lg">{{ $book->title }}</h1>
                                <span class="text-sm text-gray-300">Penulis: {{ $book->author }}</span>
                            </div>
                            <div class="h-full ml-auto">
                                <h1>Dibuat {{ $book->created_at->format('d/m/Y') }}</h1>
                            </div>
                        </div>
                    </a>
                @empty
                    <div class="bg-[#00117E] p-8 rounded-lg text-center">Belum ada buku dalam kategori ini.</div>
                @endforelse
            </div>
        </div>

        <div id="editCategoryModal" class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4">
            <div class="bg-[#00117E] border border-[#213FFF] w-full max-w-md p-6 rounded-lg">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-display text-2xl">Edit Kategori</h2>
                    <button type="button" onclick="document.getElementById('editCategoryModal').classList.add('hidden')" class="text-2xl font-bold cursor-pointer">&times;</button>
                </div>
                <form method="POST" action="{{ route('staff.categories.update', $category) }}" enctype="multipart/form-data" class="flex flex-col gap-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label class="block mb-1 font-bold">Nama Kategori</label>
                        <input type="text" name="name" value="{{ $category->name }}" required class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                    </div>
                    <div>
                        <label class="block mb-1 font-bold">Ganti Gambar (Opsional)</label>
                        <input type="file" name="image" accept="image/*" class="w-full bg-[#D9D9D9] text-[#000315] p-1.5 rounded-lg">
                    </div>
                    <div class="flex justify-end gap-3 mt-4">
                        <button type="button" onclick="document.getElementById('editCategoryModal').classList.add('hidden')" class="px-4 py-2 rounded-lg bg-[#5B5B5B] cursor-pointer">Batal</button>
                        <button type="submit" class="px-6 py-2 rounded-lg bg-[#213FFF] font-bold cursor-pointer">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection