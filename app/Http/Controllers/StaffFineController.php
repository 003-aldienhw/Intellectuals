<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\Fine;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffFineController extends Controller
{
    public function index(Request $request)
    {
        $query = Fine::with(['member', 'borrowing.details.book'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('member', fn ($q) => $q->where('name', 'like', "%{$search}%"));
        }

        $fines = $query->get();

        $members = User::where('role', 'anggota')->orderBy('name')->get();
        $borrowings = Borrowing::with(['member', 'details.book'])
            ->whereIn('status', ['approved', 'return_pending', 'returned'])
            ->latest()
            ->get();

        $preselectBorrowing = $request->filled('borrowing_id')
            ? Borrowing::with(['member', 'details.book'])->find($request->borrowing_id)
            : null;

        return view('staff.fines', compact('fines', 'members', 'borrowings', 'preselectBorrowing'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'borrowing_id' => ['nullable', 'exists:borrowings,id'],
            'violations' => ['required', 'array', 'min:1'],
            'violations.*' => ['required', 'string', 'max:255'],
            'total_amount' => ['required', 'integer', 'min:0'],
        ]);

        $cleanViolations = array_values(array_filter(array_map('trim', $validated['violations'])));

        Fine::create([
            'user_id' => $validated['user_id'],
            'borrowing_id' => $validated['borrowing_id'] ?: null,
            'staff_id' => Auth::id(),
            'violations' => $cleanViolations,
            'total_amount' => $validated['total_amount'],
            'status' => 'unpaid',
        ]);

        return redirect()->route('staff.fines.index')->with('success', 'Denda berhasil ditambahkan.');
    }

    public function show(Fine $fine)
    {
        $fine->load(['member', 'borrowing.details.book']);
        return view('staff.fine_management', compact('fine'));
    }

    public function update(Request $request, Fine $fine)
    {
        $validated = $request->validate([
            'violations' => ['required', 'array', 'min:1'],
            'violations.*' => ['required', 'string', 'max:255'],
            'total_amount' => ['required', 'integer', 'min:0'],
        ]);

        $cleanViolations = array_values(array_filter(array_map('trim', $validated['violations'])));

        $fine->update([
            'violations' => $cleanViolations,
            'total_amount' => $validated['total_amount'],
        ]);

        return redirect()->route('staff.fines.show', $fine)->with('success', 'Data denda berhasil diperbarui.');
    }

    public function markAsPaid(Fine $fine)
    {
        $fine->update(['status' => 'paid']);

        return redirect()->route('staff.fines.show', $fine)->with('success', 'Denda telah ditandai selesai (Lunas).');
    }

    public function destroy(Fine $fine)
    {
        $fine->delete();

        return redirect()->route('staff.fines.index')->with('success', 'Data denda berhasil dihapus.');
    }
}