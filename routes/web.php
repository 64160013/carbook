<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalenderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Middleware\IsAdmin;

// เส้นทางสำหรับ FullCalender
Route::controller(FullCalenderController::class)->group(function () {
    Route::get('fullcalender', 'index');
    Route::post('fullcalenderAjax', 'ajax');
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
