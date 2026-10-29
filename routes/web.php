<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Models\Book;
use App\Models\Category;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

// Dashboard untuk semua pengguna yang login
Route::get('/dashboard', function () {
    $totalBooks = Book::count();
    $totalStock = Book::sum('stock');
    $totalCategories = Category::count();
    $totalUsers = User::count();

    $activeLoans = Loan::where('status', 'dipinjam')->count();

    $latestLoans = Loan::with(['user', 'book'])
        ->latest()
        ->take(5)
        ->get();

    return view('dashboard', compact(
        'totalBooks',
        'totalStock',
        'totalCategories',
        'totalUsers',
        'activeLoans',
        'latestLoans'
    ));
})->middleware('auth')->name('dashboard');

// Semua fitur hanya dapat diakses setelah login
Route::middleware('auth')->group(function () {

    // CRUD buku
    Route::resource('books', BookController::class);

    // CRUD kategori
    Route::resource('categories', CategoryController::class);

    // Daftar peminjaman
    Route::get('/loans', [LoanController::class, 'index'])
        ->name('loans.index');

    // Form peminjaman
    Route::get('/loans/create', [LoanController::class, 'create'])
        ->name('loans.create');

    // Simpan peminjaman
    Route::post('/loans', [LoanController::class, 'store'])
        ->name('loans.store');

    // Detail peminjaman
    Route::get('/loans/{loan}', [LoanController::class, 'show'])
        ->whereNumber('loan')
        ->name('loans.show');

    // Edit transaksi
    Route::get('/loans/{loan}/edit', [LoanController::class, 'edit'])
        ->whereNumber('loan')
        ->name('loans.edit');

    // Update transaksi
    Route::put('/loans/{loan}', [LoanController::class, 'update'])
        ->whereNumber('loan')
        ->name('loans.update');

    // Update transaksi dengan PATCH
    Route::patch('/loans/{loan}', [LoanController::class, 'update'])
        ->whereNumber('loan')
        ->name('loans.patch');

    // Hapus transaksi
    Route::delete('/loans/{loan}', [LoanController::class, 'destroy'])
        ->whereNumber('loan')
        ->name('loans.destroy');

    // Pengembalian buku
    Route::post('/loans/{loan}/return', [
        LoanController::class,
        'returnBook',
    ])->whereNumber('loan')->name('loans.return');
});

// Autentikasi Laravel Breeze
require __DIR__ . '/auth.php';
