<?php

use App\Models\Message;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ListenController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminSuperadminMiddleware;
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


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('homecontent');


Route::get('/speak',function(){
    return view('speak');
});

Route::get('/listen',function(){
    return view('listen');
});

Route::get('/statistic', [App\Http\Controllers\HomeController::class, 'statistics'])->name('statistics');

Route::get('/statisticdata', [App\Http\Controllers\HomeController::class, 'getStatistics']);

Route::get('/messages/findMessage/{id}', function($id) {
    return Message::findOrFail($id);
});

Route::resource('messages', MessageController::class);

// Route::resource('records', RecordController::class);
Route::get('/listen/message', [ListenController::class, 'index'])->name('listen');

Route::post('records/upload', [RecordController::class, 'upload'])->name('upload');
Route::post('records/update', [RecordController::class, 'update']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['admin.superadmin'])->group(function () {
    Route::get('admin/export', [App\Http\Controllers\AdminController::class, 'export'])->name('export');

    Route::get('admin/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');
    Route::get('admin/downloadfiles', [App\Http\Controllers\AdminController::class, 'downloadFiles'])->name('downloadfiles');

    Route::get('admin/recordandmessage', [App\Http\Controllers\AdminController::class, 'RecordAndMessage'])->name('admin.recordandmessage');
    Route::get('admin/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::get('admin/sentences', [App\Http\Controllers\AdminController::class, 'sentences'])->name('admin.sentences');
    Route::post('admin/register', [RegisterController::class, 'create'])->name('admin.register');
    Route::get('admin/messagedit/{id}', [AdminController::class, 'messagedit'])->name('admin.messagedit');

    Route::post('admin/messagedit', [AdminController::class, 'updatesentence'])->name('admin.updatesentence');

});

