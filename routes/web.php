<?php

use App\Models\Message;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\AdminController;
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
    return view('homecontent');
});

Route::get('/speak',function(){
    return view('speak');
});

Route::get('/messages/findMessage/{id}', function($id) {
    return Message::findOrFail($id);
});

Route::resource('messages', MessageController::class);

// Route::resource('records', RecordController::class);
Route::post('records/upload', [RecordController::class, 'upload'])->name('upload');
Route::post('records/update', [RecordController::class, 'update']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('admin/home', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home');

Route::get('admin/recordandmessage', [App\Http\Controllers\AdminController::class, 'RecordAndMessage'])->name('admin.recordandmessage');
Route::get('admin/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');

