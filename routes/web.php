<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Teller\TellerController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\Transaction\TransactionController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::prefix('user')->name('user.')->group(function(){

    Route::middleware(['guest:web', 'PreventBackHistory'])->group(function(){
        Route::view('/login', 'user.login')->name('userLogin');
        Route::post('/check', [UserController::class, 'checkLogin'])->name('userCheck');
    });

    Route::middleware(['auth:web', 'PreventBackHistory'])->group(function(){
        Route::get('/userHome', [TransactionController::class, 'home'])->name('userHome');
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
        Route::get('/product', [ProductController::class, 'index'])->name('product');
        Route::view('addProduct', 'user.addProduct')->name('addProduct');
        Route::post('/checkBarcode', [ProductController::class, 'storeProduct'])->name('checkBarcode');
        Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('editProduct');
        Route::post('/update', [ProductController::class, 'update'])->name('updateProduct');
        Route::get('/delete/{id}', [ProductController::class, 'delete'])->name('deleteProduct');
        Route::get('/users', [UserController::class, 'showUsers'])->name('users');
        Route::view('/addUser', 'user.addUser')->name('addUser');
        Route::post('/checkCustomer', [UserController::class, 'store'])->name('checkCustomer');
        Route::get('/editUser/{id}', [UserController::class, 'edit'])->name('editUser');
        Route::post('/updateUser', [UserController::class, 'update'])->name('updateUser');
        Route::get('/deleteUser/{id}', [UserController::class, 'delete'])->name('deleteUser');
        Route::get('/issue', [ProductController::class, 'show'])->name('issue');
        Route::post('/issueProduct', [TransactionController::class, 'store'])->name('issueProduct');
        Route::get('/return', [TransactionController::class, 'index'])->name('return');
        Route::post('/productReturn', [TransactionController::class, 'return'])->name('returnProduct');
        Route::get('/trial', [TransactionController::class, 'trialReturn'])->name('trial');
        Route::get('/reports', [TransactionController::class, 'report'])->name('reports');
        Route::get('/issueReports', [TransactionController::class, 'issueReports'])->name('issueReports');
        Route::get('/returnReports', [TransactionController::class, 'returnReports'])->name('returnReports');
    });

});