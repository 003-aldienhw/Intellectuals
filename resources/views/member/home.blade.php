@extends('main')
@section('title', 'Beranda')
@section('content')
    <x-member_navbar />
    <main class="pt-30 pl-60 pr-8">
        <div class="relative inline-block mb-10">
            <button type="button" onclick="document.getElementById('categoryDropdown').classList.toggle('hidden')"
                class="flex items-center justify-between bg-[#00117E] hover:bg-[#213FFF] transition gap-3 min-w-40 px-4 py-2 rounded-lg cursor-pointer">
                <span id="selectedCategoryLabel" class="text-lg font-bold">Kategori</span>
                <img src="{{ asset('images/down-arrow-backup-2-svgrepo-com.png') }}" alt="Dropdown" width="24">
            </button>

            <div id="categoryDropdown" class="hidden absolute left-0 mt-2 w-52 bg-[#00117E] border border-[#213FFF] rounded-lg shadow-xl z-20 overflow-hidden">
                <button type="button" onclick="selectCategory('', 'Kategori')"
                    class="w-full text-left block px-4 py-2.5 hover:bg-[#213FFF] cursor-pointer">
                    Semua Kategori
                </button>
                @foreach ($categories as $category)
                    <button type="button" onclick="selectCategory('{{ $category->id }}', '{{ e($category->name) }}')"
                        class="w-full text-left block px-4 py-2.5 hover:bg-[#213FFF] cursor-pointer">
                        {{ $category->name }}
                    </button>
                @endforeach
            </div>
        </div>

        <div id="booksContainer" class="flex flex-wrap gap-8 mb-15">
            @forelse ($books as $book)
                <a href="{{ route('member.borrowing.show', $book) }}"
                    class="group book-card"
                    data-category="{{ $book->category_id }}"
                    data-search="{{ strtolower($book->title . ' ' . $book->author . ' ' . $book->isbn . ' ' . $book->category->name) }}">
                    <div class="w-60 bg-[#00117E] rounded-lg overflow-hidden p-3 flex flex-col justify-between transition transform group-hover:-translate-y-1 group-hover:ring-2 group-hover:ring-[#213FFF]">
                        @if ($book->cover)
                            <img src="{{ asset('storage/' . $book->cover) }}" alt="{{ $book->title }}" class="w-full h-56 object-cover rounded-lg">
                        @else
                            <div class="bg-red-500 w-full h-56 rounded-lg flex items-center justify-center font-display text-xl">
                                {{ Str::limit($book->title, 15) }}
                            </div>
                        @endif
                        <div class="mt-3">
                            <h1 class="font-bold text-lg truncate">{{ $book->title }}</h1>
                            <div class="flex justify-between items-center text-sm text-gray-300 mt-1">
                                <span>{{ $book->category->name }}</span>
                                <span class="{{ $book->stock > 0 ? 'text-[#46FF21]' : 'text-[#FF5D5D]' }}">
                                    Stok: {{ $book->stock }}
                                </span>
                            </div>
                        </div>
                    </div>
                </a>
            @empty
                <div class="bg-[#00117E] p-8 rounded-lg text-center w-full">
                    <p class="text-lg">Belum ada buku tersedia.</p>
                </div>
            @endforelse
        </div>

        <div id="emptyFilterState" class="hidden bg-[#00117E] p-8 rounded-lg text-center mb-15">
            <p class="text-lg">Tidak ada buku yang cocok dengan filter atau pencarian.</p>
        </div>
    </main>
    <script>
        let activeCategoryId = '';

        function selectCategory(categoryId, label) {
            activeCategoryId = categoryId;
            document.getElementById('selectedCategoryLabel').textContent = label;
            document.getElementById('categoryDropdown').classList.add('hidden');
            filterBooks();
        }

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