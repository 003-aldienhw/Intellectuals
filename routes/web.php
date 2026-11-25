<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});

Route::get('/login', function () {
    return view('login');
});

// Members

Route::get('/anggota/beranda', function () {
    return view('member.home');
})->name('member.home');

Route::get('/anggota/history', function () {
    return view('member.history');
})->name('member.history');

Route::get('/anggota/pengembalian', function () {
    return view('member.returning');
})->name('member.returning');

Route::get('/anggota/profil', function () {
    return view('member.profile');
})->name('member.profile');

Route::get('/anggota/peminjaman', function () {
    return view('member.borrowing');
})->name('member.borrowing');

Route::get('/anggota/pengembalian/detail', function () {
    return view('member.returning_details');
})->name('member.returning_details');

// Staff

Route::get('/petugas/beranda', function () {
    return view('staff.home');
})->name('staff.home');

Route::get('/petugas/anggota', function () {
    return view('staff.members');
})->name('staff.members');

Route::get('/petugas/buku', function () {
    return view('staff.books');
})->name('staff.books');

Route::get('/petugas/kategori', function () {
    return view('staff.categories');
})->name('staff.categories');

Route::get('/petugas/denda', function () {
    return view('staff.fines');
})->name('staff.fines');

Route::get('/petugas/profil', function () {
    return view('staff.profile');
})->name('staff.profile');

Route::get('/petugas/anggota/detail', function () {
    return view('staff.member_management');
})->name('staff.member_management');

Route::get('/petugas/buku/detail', function () {
    return view('staff.book_management');
})->name('staff.book_management');

Route::get('/petugas/kategori/detail', function () {
    return view('staff.category_management');
})->name('staff.category_management');

Route::get('/petugas/denda/detail', function () {
    return view('staff.fine_management');
})->name('staff.fine_management');

Route::get('/petugas/peminjaman', function () {
    return view('staff.borrowing_management');
})->name('staff.borrowing_management');

Route::get('/petugas/pengembalian', function () {
    return view('staff.returning_management');
})->name('staff.returning_management');
