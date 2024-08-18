<?php

use App\Http\Controllers\ArsipController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Deposit;
use App\Http\Controllers\Deposite;
use App\Http\Controllers\DepositeController;
use App\Http\Controllers\Home;
use App\Http\Controllers\sidebarController;
use App\Http\Controllers\UserDepositController;
use App\Http\Controllers\buku;
use App\Http\Controllers\DatabukuController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [Home::class, 'home']);
Route::get('/dashboard', [Home::class, 'dashboard']);
/// list buku
Route::get('/list-buku', [DatabukuController::class, 'list_buku']);
Route::post('/list-buku', [DatabukuController::class, 'create_buku'])->name('createBuku');
Route::get('/list-buku/{id}', [DatabukuController::class, 'bukuId']);
Route::put('/list-buku/{id}', [DatabukuController::class, 'editBuku'])->name('editBuku');
Route::delete('/list-buku/{id}', [DatabukuController::class, 'deleteBuku'])->name('deleteBuku');
/// End list buku

// list peminjaman
Route::get('/list-peminjaman', [PeminjamanController::class, 'list_Peminjaman']);
Route::put('/list-peminjaman/{id}', [PeminjamanController::class, 'PeminjamanStatus'])->name('PeminjamanStatus');
// end list peminjaman




Route::get('/buku', [DatabukuController::class, 'buku']);
Route::post('/buku', [DatabukuController::class, 'createPeminjaman'])->name('createPeminjaman');

// buku peminjaman
Route::get('/buku/peminjaman', [PeminjamanController::class, 'peminjaman']);
Route::get('/buku/peminjaman/{id}', [PeminjamanController::class, 'pengembalianBuku'])->name('pengembalianBuku');
// Route::put('/buku/peminjaman/{id}', [PeminjamanController::class, 'pengembalianBuku'])->name('pengembalianBuku');
Route::delete('/buku/peminjaman/{id}', [PeminjamanController::class, 'pengembalianBuku'])->name('pengembalianBuku');
// end buku peminjaman

Route::get('/buku/pengembalian', [PeminjamanController::class, 'pengembalian']);

Route::get('/log-peminjaman', [PeminjamanController::class, 'logPeminjaman']);
Route::get('/log-pengembalian', [PeminjamanController::class, 'logPengembalian']);

// admin Kategori
Route::get('/kategori', [KategoriController::class, 'kategori']);
Route::post('/kategori', [KategoriController::class, 'createKategori'])->name('createKategori');
Route::get('/kategori/{id}', [KategoriController::class, 'kategoriId']);
Route::put('/kategori/{id}', [KategoriController::class, 'editKategori'])->name('editKategori');
Route::delete('/kategori/{id}', [KategoriController::class, 'deleteKategori'])->name('deleteKategori');
// END admin Kategori

// admin UserList
Route::get('/admin/userlist', [UserController::class, 'index']);
Route::get('/admin/userlist/{id}', [UserController::class, 'UserId']);
Route::put('/admin/userlist/{id}', [UserController::class, 'editUser'])->name('editUser');
Route::delete('/admin/userlist/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');


Route::get('/login', [AuthController::class, 'login']);
Route::post('/login', [AuthController::class, 'auth_login']);

Route::get('/register', [AuthController::class, 'register']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('verify/{token}', [AuthController::class, 'verifyEmail']);

Route::get('/reset-password', [AuthController::class, 'resetPassword']);

Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/sidebar', [sidebarController::class, 'index']);

Route::get('/profile', [UserController::class, 'userProfile']);
