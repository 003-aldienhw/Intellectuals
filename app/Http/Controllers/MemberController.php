<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use App\Models\Category;
use App\Models\Fine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function home()
    {
        $categories = Category::orderBy('name')->get();
        $books = Book::with('category')->latest()->get();

        return view('member.home', compact('books', 'categories'));
    }

    public function showBorrowing(Book $book)
    {
        $book->load('category');
        $activeBorrowing = null;

        if (Auth::check() && Auth::user()->role === 'anggota') {
            $activeBorrowing = Borrowing::where('user_id', Auth::id())
                ->whereIn('status', ['pending', 'approved', 'return_pending'])
                ->whereHas('details', fn ($q) => $q->where('book_id', $book->id))
                ->first();
        }

        return view('member.borrowing', compact('book', 'activeBorrowing'));
    }

    public function storeBorrowing(Request $request, Book $book)
    {
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Meminjam harus login terlebih dahulu');
        }

        if (Auth::user()->role === 'petugas') {
            return redirect()->route('staff.home')
                ->with('error', 'Petugas tidak dapat meminjam buku');
        }

        if ($book->stock < 1) {
            return back()->with('error', 'Stok buku sedang habis.');
        }

        $user = Auth::user();

        $alreadyActive = Borrowing::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved', 'return_pending'])
            ->whereHas('details', fn ($q) => $q->where('book_id', $book->id))
            ->exists();

        if ($alreadyActive) {
            return back()->with('error', 'Kamu masih memiliki pengajuan atau pinjaman aktif untuk buku ini.');
        }

        DB::transaction(function () use ($user, $book) {
            $borrowing = Borrowing::create([
                'user_id' => $user->id,
                'borrow_date' => now()->toDateString(),
                'status' => 'pending',
            ]);

            BorrowingDetail::create([
                'borrowing_id' => $borrowing->id,
                'book_id' => $book->id,
                'quantity' => 1,
            ]);
        });

        return redirect()->route('member.history')
            ->with('success', 'Pengajuan peminjaman berhasil dikirim! Status: Menunggu Persetujuan petugas.');
    }

    public function history()
    {
        $user = Auth::user();

        $borrowings = Borrowing::with(['details.book.category'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $fines = Fine::with(['borrowing.details.book.category'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $unpaidFines = $fines->where('status', 'unpaid');

        return view('member.history', compact('borrowings', 'fines', 'unpaidFines'));
    }

    public function fineDetails(Fine $fine)
    {
        abort_if($fine->user_id !== Auth::id(), 403);
        $fine->load(['borrowing.details.book.category']);
        $book = $fine->borrowing?->details->first()?->book;

        return view('member.fine_details', compact('fine', 'book'));
    }

    public function returning()
    {
        $borrowings = Borrowing::with(['details.book.category'])
            ->where('user_id', Auth::id())
            ->whereIn('status', ['approved', 'return_pending'])
            ->latest()
            ->get();

        return view('member.returning', compact('borrowings'));
    }

    public function returningDetails(Borrowing $borrowing)
    {
        abort_if($borrowing->user_id !== Auth::id(), 403);
        $borrowing->load(['details.book.category']);

        return view('member.returning_details', compact('borrowing'));
    }

    public function requestReturn(Borrowing $borrowing)
    {
        abort_if($borrowing->user_id !== Auth::id(), 403);

        if ($borrowing->status !== 'approved') {
            return back()->with('error', 'Status peminjaman ini tidak dapat diajukan pengembalian.');
        }

        $borrowing->update([
            'status' => 'return_pending',
        ]);

        return redirect()->route('member.returning')
            ->with('success', 'Pengajuan pengembalian berhasil dikirim! Silakan serahkan buku fisik ke petugas.');
    }

    public function profile()
    {
        $user = Auth::user();

        $borrowedCount = BorrowingDetail::whereHas('borrowing', function ($q) use ($user) {
            $q->where('user_id', $user->id)->whereIn('status', ['approved', 'return_pending', 'returned']);
        })->sum('quantity');

        $returnedCount = BorrowingDetail::whereHas('borrowing', function ($q) use ($user) {
            $q->where('user_id', $user->id)->where('status', 'returned');
        })->sum('quantity');

        $totalFines = $user->fines()->where('status', 'unpaid')->sum('total_amount');

        return view('member.profile', compact('user', 'borrowedCount', 'returnedCount', 'totalFines'));
    }
}