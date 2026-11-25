<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\BorrowingDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    public function home(Request $request)
    {
        $query = Borrowing::with(['member', 'details.book'])
            ->whereIn('status', ['pending', 'return_pending'])
            ->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('member', fn ($m) => $m->where('name', 'like', "%{$search}%"))
                  ->orWhereHas('details.book', fn ($b) => $b->where('title', 'like', "%{$search}%"));
            });
        }

        $activities = $query->get();

        return view('staff.home', compact('activities'));
    }

    public function showBorrowing(Borrowing $borrowing)
    {
        $borrowing->load(['member', 'details.book.category']);
        return view('staff.borrowing_management', compact('borrowing'));
    }

    public function approveBorrowing(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'pending') {
            return back()->with('error', 'Transaksi ini sudah diproses.');
        }

        $borrowing->load('details.book');

        foreach ($borrowing->details as $detail) {
            if ($detail->book->stock < $detail->quantity) {
                return back()->with('error', "Stok buku '{$detail->book->title}' tidak mencukupi.");
            }
        }

        DB::transaction(function () use ($borrowing) {
            foreach ($borrowing->details as $detail) {
                $detail->book->decrement('stock', $detail->quantity);
            }

            $borrowing->update([
                'staff_id' => Auth::id(),
                'borrow_date' => now()->toDateString(),
                'due_date' => now()->addDays(7)->toDateString(),
                'status' => 'approved',
            ]);
        });

        return redirect()->route('staff.home')->with('success', 'Peminjaman berhasil disetujui.');
    }

    public function rejectBorrowing(Borrowing $borrowing)
    {
        if ($borrowing->status !== 'pending') {
            return back()->with('error', 'Transaksi ini sudah diproses.');
        }

        $borrowing->update([
            'staff_id' => Auth::id(),
            'status' => 'rejected',
        ]);

        return redirect()->route('staff.home')->with('success', 'Pengajuan peminjaman ditolak.');
    }

    public function showReturning(Borrowing $borrowing)
    {
        $borrowing->load(['member', 'details.book.category']);
        return view('staff.returning_management', compact('borrowing'));
    }

    public function acceptReturning(Borrowing $borrowing)
    {
        if (!in_array($borrowing->status, ['approved', 'return_pending'])) {
            return back()->with('error', 'Transaksi pengembalian ini sudah selesai.');
        }

        $borrowing->load('details.book');

        DB::transaction(function () use ($borrowing) {
            foreach ($borrowing->details as $detail) {
                $detail->book->increment('stock', $detail->quantity);
            }

            $borrowing->update([
                'staff_id' => Auth::id(),
                'return_date' => now()->toDateString(),
                'status' => 'returned',
            ]);
        });

        return redirect()->route('staff.home')->with('success', 'Pengembalian buku berhasil diterima & stok dikembalikan.');
    }

    public function profile()
    {
        $staff = Auth::user();

        $approvedBooks = BorrowingDetail::whereHas('borrowing', function ($q) use ($staff) {
            $q->where('staff_id', $staff->id)->whereIn('status', ['approved', 'return_pending', 'returned']);
        })->sum('quantity');

        $receivedBooks = BorrowingDetail::whereHas('borrowing', function ($q) use ($staff) {
            $q->where('staff_id', $staff->id)->where('status', 'returned');
        })->sum('quantity');

        $issuedFinesTotal = $staff->issuedFines()->sum('total_amount');

        return view('staff.profile', compact('staff', 'approvedBooks', 'receivedBooks', 'issuedFinesTotal'));
    }
}