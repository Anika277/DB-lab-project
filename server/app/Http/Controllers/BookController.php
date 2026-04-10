<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with('category');

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        return response()->json(['success' => true, 'books' => $query->get()]);
    }

    public function show($id)
    {
        $book = Book::with('category')->find($id);
        if (!$book) {
            return response()->json(['success' => false, 'message' => 'Book not found'], 404);
        }
        return response()->json(['success' => true, 'book' => $book]);
    }

    public function store(Request $request)
    {
        $book = Book::create([
            'title'            => $request->title,
            'author'           => $request->author,
            'cover_image'      => $request->cover_image,
            'category_id'      => $request->category_id ?? 1,
            'description'      => $request->description,
            'pdf_url'          => $request->pdf_url,
            'available_copies' => $request->available_copies ?? 3,
        ]);

        DB::table('audit_logs')->insert([
            'action'            => 'book_added',
            'entity_type'       => 'book',
            'entity_id'         => $book->id,
            'entity_name'       => $book->title,
            'changes'           => json_encode(['author' => $book->author]),
            'performed_by'      => $request->user()->id,
            'performed_by_name' => $request->user()->name,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        return response()->json(['success' => true, 'book' => $book]);
    }

    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['success' => false, 'message' => 'Book not found'], 404);
        }

        $changes = [];
        if ($request->title !== $book->title)
            $changes['title'] = ['from' => $book->title, 'to' => $request->title];
        if ($request->author !== $book->author)
            $changes['author'] = ['from' => $book->author, 'to' => $request->author];
        if ($request->available_copies != $book->available_copies)
            $changes['available_copies'] = ['from' => $book->available_copies, 'to' => $request->available_copies];

        $book->update([
            'title'            => $request->title,
            'author'           => $request->author,
            'available_copies' => $request->available_copies,
        ]);

        DB::table('audit_logs')->insert([
            'action'            => 'book_edited',
            'entity_type'       => 'book',
            'entity_id'         => $book->id,
            'entity_name'       => $book->title,
            'changes'           => json_encode($changes),
            'performed_by'      => $request->user()->id,
            'performed_by_name' => $request->user()->name,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        return response()->json(['success' => true, 'book' => $book]);
    }

    public function destroy(Request $request, $id)
    {
        $book = Book::find($id);
        if (!$book) {
            return response()->json(['success' => false, 'message' => 'Book not found'], 404);
        }

        DB::table('audit_logs')->insert([
            'action'            => 'book_deleted',
            'entity_type'       => 'book',
            'entity_id'         => $book->id,
            'entity_name'       => $book->title,
            'changes'           => json_encode(['author' => $book->author, 'copies' => $book->available_copies]),
            'performed_by'      => $request->user()->id,
            'performed_by_name' => $request->user()->name,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        $book->delete();
        return response()->json(['success' => true, 'message' => 'Book deleted']);
    }
}