<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function stats()
{
    return response()->json([
        'success'        => true,
        'total_books'    => \App\Models\Book::count(),
        'total_users'    => \App\Models\User::count(),
        'active_borrows' => \App\Models\Borrow::whereNull('returned_at')->count(),
        'total_fines'    => \App\Models\Borrow::where('fine_paid', true)->sum('fine_amount'),
        'pending_fines'  => \App\Models\Borrow::whereNotNull('paid_at')->where('fine_paid', false)->count(),
    ]);
}

    public function allBorrows()
    {
        $borrows = Borrow::with('book', 'user')
            ->get()
            ->map(function ($borrow) {
                $dueDate = \Carbon\Carbon::parse($borrow->borrowed_at)->addDays(14);
                $status = 'borrowed';
                if ($borrow->returned_at) {
                    $status = 'returned';
                } elseif (now()->gt($dueDate)) {
                    $status = 'overdue';
                }
                $overdueDays = $status === 'overdue' ? $dueDate->diffInDays(now()) : 0;
return [
    'id'             => $borrow->id,
    'book'           => $borrow->book,
    'user'           => $borrow->user,
    'issue_date'     => $borrow->borrowed_at,
    'due_date'       => $dueDate,
    'status'         => $status,
    'fine_amount'    => $overdueDays * 100,
    'fine_paid'      => (bool)$borrow->fine_paid,
    'payment_method' => $borrow->payment_method,
    'paid_at'        => $borrow->paid_at,
];
            });

        return response()->json(['success' => true, 'borrows' => $borrows]);
    }

    public function confirmFine(Request $request, $borrowId)
{
    $borrow = Borrow::find($borrowId);

    if (!$borrow) {
        return response()->json(['success' => false, 'message' => 'Not found'], 404);
    }

    $borrow->update(['fine_paid' => true]);

    return response()->json(['success' => true, 'message' => 'Fine confirmed!']);
}

public function auditLogs()
{
    $logs = \Illuminate\Support\Facades\DB::table('audit_logs')
        ->orderBy('created_at', 'desc')
        ->limit(50)
        ->get();

    return response()->json(['success' => true, 'logs' => $logs]);
}
}