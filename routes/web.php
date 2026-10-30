
<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ActivityLogController;
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

    // Anggota hanya melihat peminjaman miliknya sendiri
    $latestLoans = Loan::with(['user', 'book'])
        ->when(
            auth()->user()->role !== 'admin',
            fn ($query) => $query->where('user_id', auth()->id())
        )
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

// Semua fitur membutuhkan login
Route::middleware('auth')->group(function () {

    // BUKU

    // Semua pengguna boleh melihat buku
    Route::get('/books', [BookController::class, 'index'])
        ->name('books.index');

    Route::get('/books/{book}', [BookController::class, 'show'])
        ->name('books.show');

    // Hanya SuperAdmin yang boleh mengelola buku
    Route::middleware('admin')->group(function () {

        Route::resource('books', BookController::class)
            ->except(['index', 'show']);

        // KATEGORI

        Route::resource('categories', CategoryController::class);

        // ACTIVITY LOG

        Route::get('/activity-logs', [ActivityLogController::class, 'index'])
            ->name('activity-logs.index');
    });

    // PEMINJAMAN

    // Anggota dan SuperAdmin boleh melihat halaman peminjaman
    Route::get('/loans', [LoanController::class, 'index'])
        ->name('loans.index');

    // Form pengajuan peminjaman
    Route::get('/loans/create', [LoanController::class, 'create'])
        ->name('loans.create');

    // Proses pengajuan peminjaman
    Route::post('/loans', [LoanController::class, 'store'])
        ->name('loans.store');

    // Detail peminjaman
    Route::get('/loans/{loan}', [LoanController::class, 'show'])
        ->whereNumber('loan')
        ->name('loans.show');

    // KHUSUS SUPERADMIN

    Route::middleware('admin')->group(function () {

        // Edit transaksi
        Route::get('/loans/{loan}/edit', [LoanController::class, 'edit'])
            ->whereNumber('loan')
            ->name('loans.edit');

        // Update transaksi
        Route::put('/loans/{loan}', [LoanController::class, 'update'])
            ->whereNumber('loan')
            ->name('loans.update');

        Route::patch('/loans/{loan}', [LoanController::class, 'update'])
            ->whereNumber('loan')
            ->name('loans.patch');

        // Hapus transaksi
        Route::delete('/loans/{loan}', [LoanController::class, 'destroy'])
            ->whereNumber('loan')
            ->name('loans.destroy');

        // Memproses pengembalian buku
        Route::post('/loans/{loan}/return', [
            LoanController::class,
            'returnBook',
        ])->whereNumber('loan')->name('loans.return');
    });
});

// Autentikasi Laravel Breeze
require __DIR__ . '/auth.php';
