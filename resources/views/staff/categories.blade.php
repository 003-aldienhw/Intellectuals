@extends('main')
@section('title', 'Kategori')
@section('content')
    <x-staff_navbar />
    <main class="pt-30 pl-60 pr-5">
        @if (session('success'))
            <div class="bg-[#137000] text-[#46FF21] p-4 rounded-lg mb-6 font-bold">{{ session('success') }}</div>
        @endif
        @if ($errors->any())
            <div class="bg-[#650000] text-[#FF5D5D] p-4 rounded-lg mb-6 font-bold">{{ $errors->first() }}</div>
        @endif

        <button type="button" onclick="document.getElementById('addCategoryModal').classList.remove('hidden')"
            class="flex items-center justify-center bg-[#00117E] hover:bg-[#213FFF] transition cursor-pointer gap-2 px-4 py-2 mb-10 rounded-lg">
            <span class="text-lg font-bold">Tambah Kategori</span>
            <img src="{{ asset('images/plus-large-svgrepo-com.png') }}" alt="Tambah" width="26">
        </button>

        <div class="flex flex-col gap-6 mb-15">
            @forelse ($categories as $category)
                <a href="{{ route('staff.categories.show', $category) }}" class="searchable-item" data-search="{{ strtolower($category->name . ' ' . $category->category_code . ' ' . $category->status) }}">
                    <div class="flex items-center bg-[#00117E] hover:ring-2 hover:ring-[#213FFF] transition h-25 p-3 rounded-lg">
                        @if ($category->image)
                            <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-20 h-22 object-cover rounded-lg mr-4">
                        @else
                            <div class="bg-red-500 w-20 h-22 rounded-lg mr-4 flex items-center justify-center text-xs text-center p-1">
                                {{ $category->name }}
                            </div>
                        @endif
                        <div class="flex flex-col gap-3">
                            <h1 class="font-bold text-lg">{{ $category->name }}</h1>
                            <h1>{{ $category->books_count }} Buku</h1>
                        </div>
                        <div class="h-full ml-auto">
                            <h1>Dibuat {{ $category->created_at->format('d/m/Y') }}</h1>
                        </div>
                    </div>
                </a>
                <div id="emptySearchState" class="hidden bg-[#00117E] p-8 rounded-lg text-center mb-15">
                    <p class="text-lg">Data tidak ditemukan.</p>
                </div>
            @empty
                <div class="bg-[#00117E] p-8 rounded-lg text-center">Belum ada kategori.</div>
            @endforelse
        </div>

        <div id="addCategoryModal" class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4">
            <div class="bg-[#00117E] border border-[#213FFF] w-full max-w-md p-6 rounded-lg">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="font-display text-2xl">Tambah Kategori</h2>
                    <button type="button" onclick="document.getElementById('addCategoryModal').classList.add('hidden')" class="text-2xl font-bold cursor-pointer">&times;</button>
                </div>
                <form method="POST" action="{{ route('staff.categories.store') }}" enctype="multipart/form-data" class="flex flex-col gap-4">
                    @csrf
                    <div>
                        <label class="block mb-1 font-bold">Nama Kategori</label>
                        <input type="text" name="name" required class="w-full bg-[#D9D9D9] text-[#000315] h-10 px-3 rounded-lg">
                    </div>
                    <div>
                        <label class="block mb-1 font-bold">Gambar Kategori (Opsional)</label>
                        <input type="file" name="image" accept="image/*" class="w-full bg-[#D9D9D9] text-[#000315] p-1.5 rounded-lg">
                    </div>
                    <div class="flex justify-end gap-3 mt-4">
                        <button type="button" onclick="document.getElementById('addCategoryModal').classList.add('hidden')" class="px-4 py-2 rounded-lg bg-[#5B5B5B] cursor-pointer">Batal</button>
                        <button type="submit" class="px-6 py-2 rounded-lg bg-[#213FFF] font-bold cursor-pointer">Simpan</button>
                    </div>
                </form>
            </div>
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