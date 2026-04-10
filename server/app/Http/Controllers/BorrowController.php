<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use Illuminate\Http\Request;

class BorrowController extends Controller
{
    public function borrow(Request $request, $bookId)
    {
        $user = $request->user();
        $book = Book::find($bookId);

        if (!$book) {
            return response()->json([
                'success' => false,
                'message' => 'Book not found'
            ], 404);
        }

        if ($book->available_copies < 1) {
            return response()->json([
                'success' => false,
                'message' => 'No copies available'
            ], 400);
        }

        $existing = Borrow::where('user_id', $user->id)
            ->where('book_id', $bookId)
            ->whereNull('returned_at')
            ->first();

        if ($existing) {
            return response()->json([
                'success' => false,
                'message' => 'You already borrowed this book'
            ], 400);
        }

        $borrow = Borrow::create([
            'user_id' => $user->id,
            'book_id' => $bookId,
            'borrowed_at' => now(),
        ]);

        $book->decrement('available_copies');

        return response()->json([
            'success' => true,
            'message' => 'Book borrowed successfully',
            'borrow' => $borrow
        ]);
    }
public function myBorrows(Request $request)
{
    $borrows = Borrow::with('book.category')
        ->where('user_id', $request->user()->id)
        ->get()
        ->map(function ($borrow) {
            $dueDate = \Carbon\Carbon::parse($borrow->borrowed_at)->addDays(14);
            $status = 'borrowed';
            $fine = 0;

            if ($borrow->returned_at) {
                $status = 'returned';
                // Calculate fine if returned late
                $returnDate = \Carbon\Carbon::parse($borrow->returned_at);
                if ($returnDate->gt($dueDate)) {
                    $overdueDays = $dueDate->diffInDays($returnDate);
                    $fine = $overdueDays * 100;
                }
            } elseif (now()->gt($dueDate)) {
                $status = 'overdue';
                $overdueDays = $dueDate->diffInDays(now());
                $fine = $overdueDays * 100;
            }

            return [
                'id'             => $borrow->id,
                'book'           => $borrow->book,
                'issue_date'     => $borrow->borrowed_at,
                'due_date'       => $dueDate,
                'return_date'    => $borrow->returned_at,
                'status'         => $status,
                'fine_amount'    => $fine,
                'fine_paid'      => (bool)$borrow->fine_paid,
                'payment_method' => $borrow->payment_method,
            ];
        });

    return response()->json(['success' => true, 'borrows' => $borrows]);
}
    public function returnBook(Request $request, $borrowId)
{
    $borrow = Borrow::where('id', $borrowId)
        ->where('user_id', $request->user()->id)
        ->first();

    if (!$borrow) {
        return response()->json(['success' => false, 'message' => 'Borrow record not found'], 404);
    }

    if ($borrow->returned_at) {
        return response()->json(['success' => false, 'message' => 'Already returned'], 400);
    }

    $borrow->update(['returned_at' => now()]);
    $borrow->book->increment('available_copies');

    return response()->json(['success' => true, 'message' => 'Book returned successfully']);
}

public function payFine(Request $request, $borrowId)
{
    $borrow = Borrow::where('id', $borrowId)
        ->where('user_id', $request->user()->id)
        ->first();

    if (!$borrow) {
        return response()->json(['success' => false, 'message' => 'Borrow not found'], 404);
    }

    $dueDate     = \Carbon\Carbon::parse($borrow->borrowed_at)->addDays(14);
    $overdueDays = $dueDate->diffInDays(now());
    $fine        = $overdueDays * 100;

    $borrow->update([
        'fine_amount'    => $fine,
        'fine_paid'      => false,          // ← false until admin confirms
        'payment_method' => $request->payment_method ?? 'bKash',
        'paid_at'        => now(),
    ]);

    return response()->json([
        'success'        => true,
        'message'        => 'Payment submitted! Waiting for admin confirmation.',
        'fine_amount'    => $fine,
        'payment_method' => $request->payment_method,
    ]);
}
}