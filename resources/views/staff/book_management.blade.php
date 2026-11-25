@extends('main')
@section('title', 'Detail Buku')
@section('content')
    <x-staff_navbar />
    <main class="pt-30 pl-60 pr-5">
        @if (session('success'))
            <div class="bg-[#137000] text-[#46FF21] p-4 rounded-lg mb-6 font-bold">{{ session('success') }}</div>
        @endif

        <div class="flex gap-10">
            <div class="bg-[#00117E] p-5 w-100 h-full rounded-lg mb-15 shrink-0">
                @if ($book->cover)
                    <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-70 object-cover rounded-lg">
                @else
                    <div class="bg-red-500 h-70 rounded-lg flex items-center justify-center font-display text-2xl">
                        {{ $book->title }}
                    </div>
                @endif
                <div class="flex flex-col gap-2 mt-5">
                    <div class="flex"><h1 class="font-bold">Tahun :</h1><h1 class="ml-auto">{{ $book->publication_year }}</h1></div>
                    <div class="flex"><h1 class="font-bold">Halaman :</h1><h1 class="ml-auto">{{ $book->pages }}</h1></div>
                    <div class="flex"><h1 class="font-bold">Penulis :</h1><h1 class="ml-auto">{{ $book->author }}</h1></div>
                    <div class="flex"><h1 class="font-bold">Kategori :</h1><h1 class="ml-auto">{{ $book->category->name }}</h1></div>
                    <div class="flex"><h1 class="font-bold">ISBN :</h1><h1 class="ml-auto">{{ $book->isbn }}</h1></div>
                    <div class="flex"><h1 class="font-bold">Stok :</h1><h1 class="ml-auto">{{ $book->stock }}</h1></div>
                </div>
            </div>

            <div class="bg-[#00117E] p-5 w-full h-full rounded-lg mb-15">
                <h1 class="font-display text-5xl">{{ $book->title }}</h1>
                <p class="mt-5 leading-relaxed text-gray-200">{{ $book->description ?? 'Tidak ada deskripsi.' }}</p>

                <div class="flex w-full justify-center gap-16 items-center mt-10 mb-5">
                    <button type="button" onclick="document.getElementById('editBookModal').classList.remove('hidden')"
                        class="flex items-center justify-center bg-[#3E008B] hover:bg-purple-800 cursor-pointer gap-2 px-5 h-10 rounded-lg transition">
                        <span class="text-lg font-bold text-[#7C3AED]">Edit</span>
                        <img src="{{ asset('images/edit-svgrepo-com.png') }}" alt="Edit" width="24">
                    </button>

                    <form method="POST" action="{{ route('staff.books.destroy', $book) }}" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
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

        <div id="editBookModal" class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4 overflow-y-auto">
            <div class="bg-[#00117E] border border-[#213FFF] w-full max-w-2xl p-6 rounded-lg my-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-display text-2xl">Edit Buku</h2>
                    <button type="button" onclick="document.getElementById('editBookModal').classList.add('hidden')" class="text-2xl font-bold cursor-pointer">&times;</button>
                </div>
                <form method="POST" action="{{ route('staff.books.update', $book) }}" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
                    @csrf
                    @method('PUT')
                    <div class="col-span-2">
                        <label class="block mb-1 font-bold">Judul Buku</label>
                        <input type="text" name="title" value="{{ $book->title }}" required class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                    </div>
                    <div>
                        <label class="block mb-1 font-bold">Kategori</label>
                        <select name="category_id" required class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ $book->category_id === $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block mb-1 font-bold">Penulis</label>
                        <input type="text" name="author" value="{{ $book->author }}" required class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                    </div>
                    <div>
                        <label class="block mb-1 font-bold">Tahun Terbit</label>
                        <input type="number" name="publication_year" value="{{ $book->publication_year }}" required class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                    </div>
                    <div>
                        <label class="block mb-1 font-bold">Jumlah Halaman</label>
                        <input type="number" name="pages" value="{{ $book->pages }}" required class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                    </div>
                    <div>
                        <label class="block mb-1 font-bold">ISBN</label>
                        <input type="text" name="isbn" value="{{ $book->isbn }}" required class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                    </div>
                    <div>
                        <label class="block mb-1 font-bold">Stok Buku</label>
                        <input type="number" name="stock" value="{{ $book->stock }}" min="0" required class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-1 font-bold">Ganti Cover Buku (Opsional)</label>
                        <input type="file" name="cover" accept="image/*" class="w-full bg-[#D9D9D9] text-[#000315] p-1.5 rounded-lg">
                    </div>
                    <div class="col-span-2">
                        <label class="block mb-1 font-bold">Sinopsis / Deskripsi</label>
                        <textarea name="description" rows="3" class="w-full bg-[#D9D9D9] text-[#000315] p-3 rounded-lg">{{ $book->description }}</textarea>
                    </div>
                    <div class="col-span-2 flex justify-end gap-3 mt-2">
                        <button type="button" onclick="document.getElementById('editBookModal').classList.add('hidden')" class="px-4 py-2 rounded-lg bg-[#5B5B5B] cursor-pointer">Batal</button>
                        <button type="submit" class="px-6 py-2 rounded-lg bg-[#213FFF] font-bold cursor-pointer">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection