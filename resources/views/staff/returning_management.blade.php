@extends('main')
@section('title', 'Detail Pengembalian')
@section('content')
    <x-staff_navbar />
    <main class="pt-30 pl-60 pr-5">
        @if (session('error'))
            <div class="bg-[#650000] text-[#FF5D5D] p-4 rounded-lg mb-6 font-bold">{{ session('error') }}</div>
        @endif

        <div class="flex gap-10">
            <div class="bg-[#00117E] p-5 w-100 h-full rounded-lg mb-15 shrink-0">
                <div class="flex justify-center">
                    <img src="{{ asset('images/download-removebg-preview.png') }}" alt="ProfileIcon" width="180">
                </div>
                <div class="flex flex-col items-center gap-3 justify-center mt-5">
                    <h1 class="font-bold text-3xl">{{ $borrowing->member->name }}</h1>
                    <h1 class="font-bold text-xl">ID : {{ $borrowing->member->member_code }}</h1>
                </div>
                <div class="flex justify-center mt-8 mb-3">
                    <a href="{{ route('staff.members.show', $borrowing->member) }}" class="bg-[#213FFF] hover:bg-blue-600 px-5 py-2 flex justify-center items-center rounded-lg text-lg font-bold transition">
                        Lihat Profil
                    </a>
                </div>
            </div>

            <div class="bg-[#00117E] p-5 w-full h-full rounded-lg mb-15">
                <h1 class="font-display text-5xl">Pengembalian</h1>
                <div class="flex flex-col gap-6 mb-10 mt-6">
                    @foreach ($borrowing->details as $detail)
                        <div class="flex items-center bg-[#000315]/40 p-3 rounded-lg">
                            @if ($detail->book->cover)
                                <img src="{{ asset('storage/' . $detail->book->cover) }}" alt="{{ $detail->book->title }}" class="w-20 h-22 object-cover rounded-lg mr-4">
                            @else
                                <div class="bg-red-500 w-20 h-22 rounded-lg mr-4 flex items-center justify-center text-xs text-center p-1">
                                    {{ $detail->book->title }}
                                </div>
                            @endif
                            <div class="flex flex-col gap-2">
                                <h1 class="font-bold text-lg">{{ $detail->book->title }}</h1>
                                <h1>{{ $detail->book->category->name }}</h1>
                            </div>
                            <div class="ml-auto">
                                <a href="{{ route('staff.books.show', $detail->book) }}" class="bg-[#213FFF] hover:bg-blue-600 px-4 py-2 flex justify-center items-center rounded-lg text-base font-bold transition">
                                    Lihat Buku
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="flex w-full justify-center gap-16 items-center mt-8 mb-5">
                    <form method="POST" action="{{ route('staff.returnings.accept', $borrowing) }}">
                        @csrf
                        <button type="submit" class="flex items-center justify-center bg-[#137000] hover:bg-green-800 cursor-pointer gap-2 px-6 h-11 rounded-lg transition">
                            <span class="text-lg font-bold text-[#46FF21]">Terima</span>
                            <img src="{{ asset('images/correct-signal-svgrepo-com.png') }}" alt="Terima" width="24">
                        </button>
                    </form>

                    <a href="{{ route('staff.fines.index', ['borrowing_id' => $borrowing->id]) }}"
                        class="flex items-center justify-center bg-[#650000] hover:bg-red-900 gap-2 px-6 h-11 rounded-lg transition">
                        <span class="text-lg font-bold text-[#FF2B2B]">Beri Denda</span>
                    </a>
                </div>
            </div>
        </div>
    </main>
@endsection