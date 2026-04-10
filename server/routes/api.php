<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;


Route::post('/signup', [AuthController::class, 'signup']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/dashboard', [AuthController::class, 'dashboard']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return response()->json([
            'success' => true,
            'user' => $request->user()
        ]);
    });
    // ... other routes
});

// Public routes
Route::get('/books', [BookController::class, 'index']);
Route::get('/books/{id}', [BookController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);

// Protected routes (need login token)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/borrow/{bookId}', [BorrowController::class, 'borrow']);
    Route::get('/my-borrows', [BorrowController::class, 'myBorrows']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/borrow/{bookId}', [BorrowController::class, 'borrow']);
    Route::get('/my-borrows', [BorrowController::class, 'myBorrows']);
    Route::post('/return/{borrowId}', [BorrowController::class, 'returnBook']);
});

Route::middleware('auth:sanctum')->group(function () {
    // existing routes...
    Route::get('/admin/stats',   [AdminController::class, 'stats']);
    Route::get('/admin/borrows', [AdminController::class, 'allBorrows']);
    Route::post('/books',        [BookController::class,  'store']);
    Route::delete('/books/{id}', [BookController::class,  'destroy']);
});

// Public event routes
Route::get('/events',          [EventController::class, 'index']);
Route::get('/events/{id}',     [EventController::class, 'show']);

// Protected event registration
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/events/{id}/register', [EventController::class, 'register']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/pay-fine/{borrowId}', [BorrowController::class, 'payFine']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/admin/confirm-fine/{borrowId}', [AdminController::class, 'confirmFine']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::put('/books/{id}', [BookController::class, 'update']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/admin/audit-logs', [AdminController::class, 'auditLogs']);
});