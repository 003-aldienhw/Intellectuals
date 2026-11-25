@extends('main')
@section('title', 'Login')
@section('content')
        <main class="flex w-screen h-screen items-center justify-center">
            <div class="flex flex-col justify-center bg-[#00117E] p-10 rounded-lg">
                <h1 class="font-display text-4xl text-center mb-15">Intellectuals</h1>
                <h1 class="text-lg mb-2">Nama</h1>
                <input type="text" class="bg-[#D9D9D9] w-70 h-10 p-1 rounded-lg text-[#666]">
                <h1 class="text-lg mb-2 mt-5">Password</h1>
                <input type="text" class="bg-[#D9D9D9] w-70 h-10 p-1 rounded-lg text-[#666]">
                <div class="flex justify-center mt-15">
                    <a href="" class="bg-[#213FFF] w-30 flex justify-center items-center rounded-lg text-lg font-bold">Login</a>
                </div>
            </div>
        </main>
@endsection