<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\TermController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaginationController;
use App\Models\Comment;
use App\Models\Menu;
use App\Models\Post;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');
Route::post('/post/loadmore/', [PostController::class, 'loadMore'])->name('post.loadmore');
Route::post('comment/store', [CommentController::class, 'store'])->name('comment.store');
Route::post('/comment/loadmore/{post}', [CommentController::class, 'loadmore'])->name('comment.loadmore');
Route::get('/term/archive/{term}', [TermController::class, 'archive'])->name('term.archive');

// admin dashboard
Route::middleware('auth')->prefix('admin')->group(function () {

    Route::view('/', 'admin.index')->name('admin');
    Route::resource('post', PostController::class)->except(['show']);
    Route::post('/upload', [ImageController::class, 'upload']);

    Route::middleware('role:admin')->group(function () {
        Route::resource('comment', CommentController::class)->only(['index', 'edit', 'update', 'destroy']);
        Route::resource('user', UserController::class)->except(['show']);
        Route::get('/change_password_form/{user}', [UserController::class, 'changePasswordForm'])->name('change-password.form');
        Route::post('/change_password', [UserController::class, 'changePassword'])->name('change-password');
        Route::prefix('term')->group(function () {
            Route::get('{tax_name}', [TermController::class, 'index'])->name('term.index');
            Route::post('store', [TermController::class, 'store'])->name('term.store');
            Route::get('edit/{term}', [TermController::class, 'edit'])->name('term.edit');
            Route::put('update/{term}', [TermController::class, 'update'])->name('term.update');
            Route::delete('destroy/{term}', [TermController::class, 'destroy'])->name('term.destroy');
        });
        Route::prefix('menu_config')->group(function () {
            Route::get('/', [MenuController::class, 'showConfig'])->name('menu.show-config');
            Route::post('/update_item/{menu}', [MenuController::class, 'updateItem'])->name('menu.update-item');
        });
    });
});


require __DIR__ . '/auth.php';
