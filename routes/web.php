<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\StaffBookController;
use App\Http\Controllers\StaffCategoryController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StaffFineController;
use App\Http\Controllers\StaffMemberController;
use Illuminate\Support\Facades\Route;

// Auth
Route::get('/', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', [AuthController::class, 'showLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Beranda dan Detail Buku (Bisa diakses pengunjung belum login dan anggota)
Route::get('/anggota/beranda', [MemberController::class, 'home'])->name('member.home');
Route::get('/anggota/peminjaman/{book}', [MemberController::class, 'showBorrowing'])->name('member.borrowing.show');
Route::post('/anggota/peminjaman/{book}', [MemberController::class, 'storeBorrowing'])->name('member.borrowing.store');

// Role: Anggota (Wajib Login Anggota)
Route::middleware(['auth', 'role:anggota'])->prefix('anggota')->name('member.')->group(function () {
    Route::get('/history', [MemberController::class, 'history'])->name('history');
    Route::get('/denda/{fine}', [MemberController::class, 'fineDetails'])->name('fine.details');

    Route::get('/pengembalian', [MemberController::class, 'returning'])->name('returning');
    Route::get('/pengembalian/{borrowing}', [MemberController::class, 'returningDetails'])->name('returning.details');
    Route::post('/pengembalian/{borrowing}/ajukan', [MemberController::class, 'requestReturn'])->name('returning.request');

    Route::get('/profil', [MemberController::class, 'profile'])->name('profile');
});

// Role: Petugas
Route::middleware(['auth', 'role:petugas'])->prefix('petugas')->name('staff.')->group(function () {
    Route::get('/beranda', [StaffController::class, 'home'])->name('home');

    Route::get('/peminjaman/{borrowing}', [StaffController::class, 'showBorrowing'])->name('borrowings.show');
    Route::post('/peminjaman/{borrowing}/setujui', [StaffController::class, 'approveBorrowing'])->name('borrowings.approve');
    Route::post('/peminjaman/{borrowing}/tolak', [StaffController::class, 'rejectBorrowing'])->name('borrowings.reject');

    Route::get('/pengembalian/{borrowing}', [StaffController::class, 'showReturning'])->name('returnings.show');
    Route::post('/pengembalian/{borrowing}/terima', [StaffController::class, 'acceptReturning'])->name('returnings.accept');

    Route::get('/anggota', [StaffMemberController::class, 'index'])->name('members.index');
    Route::post('/anggota', [StaffMemberController::class, 'store'])->name('members.store');
    Route::get('/anggota/{member}', [StaffMemberController::class, 'show'])->name('members.show');
    Route::put('/anggota/{member}', [StaffMemberController::class, 'update'])->name('members.update');
    Route::delete('/anggota/{member}', [StaffMemberController::class, 'destroy'])->name('members.destroy');

    Route::get('/buku', [StaffBookController::class, 'index'])->name('books.index');
    Route::post('/buku', [StaffBookController::class, 'store'])->name('books.store');
    Route::get('/buku/{book}', [StaffBookController::class, 'show'])->name('books.show');
    Route::put('/buku/{book}', [StaffBookController::class, 'update'])->name('books.update');
    Route::delete('/buku/{book}', [StaffBookController::class, 'destroy'])->name('books.destroy');

    Route::get('/kategori', [StaffCategoryController::class, 'index'])->name('categories.index');
    Route::post('/kategori', [StaffCategoryController::class, 'store'])->name('categories.store');
    Route::get('/kategori/{category}', [StaffCategoryController::class, 'show'])->name('categories.show');
    Route::put('/kategori/{category}', [StaffCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/kategori/{category}', [StaffCategoryController::class, 'destroy'])->name('categories.destroy');

    Route::get('/denda', [StaffFineController::class, 'index'])->name('fines.index');
    Route::post('/denda', [StaffFineController::class, 'store'])->name('fines.store');
    Route::get('/denda/{fine}', [StaffFineController::class, 'show'])->name('fines.show');
    Route::put('/denda/{fine}', [StaffFineController::class, 'update'])->name('fines.update');
    Route::patch('/denda/{fine}/selesai', [StaffFineController::class, 'markAsPaid'])->name('fines.paid');
    Route::delete('/denda/{fine}', [StaffFineController::class, 'destroy'])->name('fines.destroy');

    Route::get('/profil', [StaffController::class, 'profile'])->name('profile');
});