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

// แก้ไขโปรไฟล์
Route::get('/profile/edit', [UserController::class, 'edit'])->name('profile.edit');
Route::put('/profile', [UserController::class, 'update'])->name('profile.update');

// เพิ่มรถ
Route::get('/add-vehicle', [HomeController::class, 'AddVehicleForm'])
    ->name('add.vehicle')    
    ->middleware(IsAdmin::class);;
Route::post('/add-vehicle', [HomeController::class, 'storeVehicle'])->name('store.vehicle');



