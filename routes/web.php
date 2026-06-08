<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GeminiChatController;

route::get('/', [AdminController::class, 'home']);

route::get('/myhome', [AdminController::class, 'index'])->name('myhome');

route::get('/create_room', [AdminController::class, 'create_room'])->middleware(['auth', 'admin']);

route::Post('/add_room', [AdminController::class, 'add_room'])->middleware(['auth', 'admin']);

route::get('/view_room', [AdminController::class, 'view_room'])->middleware(['auth', 'admin']);

route::get('/room_delete/{id}', [AdminController::class, 'room_delete'])->middleware(['auth', 'admin']);

route::get('/room_update/{id}', [AdminController::class, 'room_update'])->middleware(['auth', 'admin']);

route::Post('/edit_room/{id}', [AdminController::class, 'edit_room'])->middleware(['auth', 'admin']);

route::get('/room_details/{id}', [HomeController::class, 'room_details']);

route::Post('/add_booking/{id}', [HomeController::class, 'add_booking']);

route::get('/bookings', [AdminController::class, 'bookings'])->middleware(['auth', 'admin']);

route::get('/delete_booking/{id}', [AdminController::class, 'delete_booking'])->middleware(['auth', 'admin']);

route::get('/approved_book/{id}', [AdminController::class, 'approved_book'])->middleware(['auth', 'admin']);

route::get('/rejected_booking/{id}', [AdminController::class, 'rejected_booking'])->middleware(['auth', 'admin']);

route::get('/view_gallery', [AdminController::class, 'view_gallery'])->middleware(['auth', 'admin']);

route::Post('/upload_gallery', [AdminController::class, 'upload_gallery'])->middleware(['auth', 'admin']);

route::get('/delete_gallery/{id}', [AdminController::class, 'delete_gallery'])->middleware(['auth', 'admin']);

route::Post('/contact', [HomeController::class, 'contact']);

route::get('/all_message', [AdminController::class, 'all_message'])->middleware(['auth', 'admin']);

route::get('/send_mail/{id}', [AdminController::class, 'send_mail'])->middleware(['auth', 'admin']);

route::post('/mail/{id}', [AdminController::class, 'mail'])->middleware(['auth', 'admin']);

route::get('/our_room', [HomeController::class, 'our_room']);

route::get('/our_gallery', [HomeController::class, 'our_gallery']);

route::get('/contact_us', [HomeController::class, 'contact_us']);

Route::get('/about', function() {
    return view('home.about');
});

route::get('/body', [AdminController::class, 'monthly_report'])->middleware(['auth', 'admin']);


Route::get('/chat', function () {
    return view('chat');
});

Route::post('/chat/send', [GeminiChatController::class, 'sendMessage'])->name('chat.send');
