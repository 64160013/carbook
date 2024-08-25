<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsNotAdmin;
use App\Http\Controllers\UserController;
use App\Models\User;

// เส้นทางสำหรับ FullCalendar
Route::controller(FullCalendarController::class)->group(function () {
    Route::get('fullcalendar', 'index');
    Route::post('fullcalendarAjax', 'ajax');
});

// เส้นทางหลักของแอปพลิเคชัน
Route::get('/', function () {
    return view('welcome');
});

// เส้นทางสำหรับการยืนยันตัวตน
Auth::routes();

// เส้นทางสำหรับหน้าแรก
Route::get('/home', [HomeController::class, 'index'])->name('home');

// เส้นทางสำหรับหน้าแรกของผู้ดูแลระบบ
Route::get('/admin/home', [HomeController::class, 'adminHome'])
    ->name('admin.home')
    ->middleware(IsAdmin::class);

// แก้ไขโปนไฟล์
Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [UserController::class, 'update'])->name('profile.update');


// // Route เพื่อแสดงฟอร์ม
// Route::get('/user-form', [UserController::class, 'showForm'])->name('user.form');
// // Route เพื่อจัดการการส่งข้อมูลฟอร์ม
// Route::post('/user-form', [UserController::class, 'submitForm'])->name('user.submitForm');


// // Route::get('/form', function () {
// //     return view('form');
// // });

// Route::get('/form', [UserController::class, 'test'])->name('form');




// Route::get('/car-reservation/form', [CarReservationController::class, 'showForm'])
//     ->name('car-reservation.form')
//     ->middleware(['auth', 'isNotAdmin']); 

// Route::post('/car-reservation', [CarReservationController::class, 'submitForm'])
//     ->name('car-reservation.submit')
//     ->middleware(['auth', 'isNotAdmin']); 

