<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AtasanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RapatController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin
Route::middleware('auth', 'role:admin')->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/permissionsadmin', [PermissionController::class, 'indexAdmin'])->name('admin.permissions.index');
    Route::get('/permissions/{id}', [PermissionController::class, 'showAdmin'])->name('admin.permissions.show');
    Route::delete('/permissions/{id}', [PermissionController::class, 'destroyAdmin'])->name('admin.permissions.destroy');
    Route::get('/permissions/{permission}/export', [PermissionController::class, 'exportPdfAdmin'])->name('admin.permissions.export');
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
});

});

// Pegawai
Route::middleware('auth', 'role:pegawai')->group(function () {
    Route::resource('/pegawai', PegawaiController::class);
    Route::get('/permissionpegawai', [PermissionController::class, 'index'])->name('pegawai.permissions.index');
    Route::post('/pegawaipermissionsstore', [PermissionController::class, 'store'])->name('pegawai.permissions.store');
    Route::get('/exportpermissions-pdf/{permission}', [PermissionController::class, 'exportPdf'])->name('permissions.export');
    Route::get('pegawai/permissions/{permission}/download', [PermissionController::class, 'download'])->name('pegawai.permissions.download');

});

// Atasan
Route::middleware('auth', 'role:atasan')->group(function () {
    Route::resource('/atasan', AtasanController::class);
    Route::get('/permissionsatasan', [PermissionController::class, 'indexAtasan'])->name('atasan.permissions.index');
    Route::patch('/permissions/{permission}/approve', [PermissionController::class, 'approve'])->name('atasan.permissions.approve');
    Route::patch('/permissions/{permission}/reject', [PermissionController::class, 'reject'])->name('atasan.permissions.reject');
});
