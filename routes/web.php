<?php

use App\Models\Message;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\MessageController;
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