<?php

namespace App\Http\Controllers;

use App\Models\BorrowingDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffMemberController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'anggota')->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('member_code', 'like', "%{$search}%");
            });
        }

        $members = $query->get();

        return view('staff.members', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users,name'],
            'phone' => ['nullable', 'string', 'max:25'],
            'status' => ['required', 'in:Aktif,Nonaktif'],
            'password' => ['required', 'string', 'min:4'],
        ]);

        $nextId = (User::max('id') ?? 0) + 1;
        $memberCode = 'A' . str_pad((string) $nextId, 2, '0', STR_PAD_LEFT) . now()->format('dmY');

        User::create([
            'member_code' => $memberCode,
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
            'role' => 'anggota',
            'status' => $validated['status'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('staff.members.index')->with('success', "Anggota '{$validated['name']}' berhasil didaftarkan (ID: {$memberCode}).");
    }

    public function show(User $member)
    {
        abort_if($member->role !== 'anggota', 404);

        $borrowedCount = BorrowingDetail::whereHas('borrowing', function ($q) use ($member) {
            $q->where('user_id', $member->id)->whereIn('status', ['approved', 'return_pending', 'returned']);
        })->sum('quantity');

        $returnedCount = BorrowingDetail::whereHas('borrowing', function ($q) use ($member) {
            $q->where('user_id', $member->id)->where('status', 'returned');
        })->sum('quantity');

        $totalFines = $member->fines()->where('status', 'unpaid')->sum('total_amount');

        return view('staff.member_management', compact('member', 'borrowedCount', 'returnedCount', 'totalFines'));
    }

    public function update(Request $request, User $member)
    {
        abort_if($member->role !== 'anggota', 404);

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:users,name,'.$member->id],
            'phone' => ['nullable', 'string', 'max:25'],
            'status' => ['required', 'in:Aktif,Nonaktif'],
            'password' => ['nullable', 'string', 'min:4'],
        ]);

        $data = [
            'name' => $validated['name'],
            'phone' => $validated['phone'] ?? null,
            'status' => $validated['status'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $member->update($data);

        return redirect()->route('staff.members.show', $member)->with('success', 'Data anggota berhasil diperbarui.');
    }

    public function destroy(User $member)
    {
        abort_if($member->role !== 'anggota', 404);
        $member->delete();

        return redirect()->route('staff.members.index')->with('success', 'Akun anggota berhasil dihapus.');
    }
}