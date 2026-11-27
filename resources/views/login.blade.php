@extends('main')
@section('title', 'Login')
@section('content')
    <main class="flex w-screen h-screen items-center justify-center">
        <form method="POST" action="{{ route('login.post') }}" class="flex flex-col justify-center bg-[#00117E] p-10 rounded-lg shadow-xl">
            @csrf
            <h1 class="font-display text-4xl text-center mb-10">Intellectuals</h1>

            @if (session('error'))
                <div class="bg-[#650000] text-center text-[#FF5D5D] px-3 py-2 rounded-lg mb-4 text-sm w-70 font-bold">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-[#650000] text-center text-[#FF5D5D] px-3 py-2 rounded-lg mb-4 text-sm w-70">
                    {{ $errors->first() }}
                </div>
            @endif

            <label class="text-lg mb-2">Nama</label>
            <input type="text" name="name" value="{{ old('name') }}" required autofocus
                class="bg-[#D9D9D9] w-70 h-10 px-3 rounded-lg text-[#000315] font-medium focus:outline-none">

            <label class="text-lg mb-2 mt-5">Password</label>
            <input type="password" name="password" required
                class="bg-[#D9D9D9] w-70 h-10 px-3 rounded-lg text-[#000315] font-medium focus:outline-none">

            <div class="flex flex-col items-center gap-3 mt-10">
                <button type="submit" class="bg-[#213FFF] hover:bg-blue-600 cursor-pointer w-36 h-10 flex justify-center items-center rounded-lg text-lg font-bold transition">
                    Login
                </button>
                <a href="{{ route('member.home') }}" class="text-sm text-blue-200 hover:text-white underline transition">
                    Lihat daftar buku
                </a>
            </div>
        </form>
    </main>
@endsection