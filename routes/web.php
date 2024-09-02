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
use App\Http\Middleware\IsUsers;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\ReqDocumentController;

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
// Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/home', [HomeController::class, 'index'])
    ->name('home')
    ->middleware(IsUsers::class); // ใช้ middleware ที่คุณสร้าง


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
    ->middleware(IsAdmin::class);
Route::post('/add-vehicle', [HomeController::class, 'storeVehicle'])->name('store.vehicle');


//แสดงข้อมูลรถ เปลี่ยนสถานะ ลบค่า
Route::get('/vehicles', [HomeController::class, 'showVehicles'])->name('show.vehicles')
    ->middleware(IsAdmin::class);;
Route::post('/vehicles/update-status/{id}', [HomeController::class, 'updateStatus'])->name('vehicles.updateStatus');
Route::delete('/vehicles/{id}', [HomeController::class, 'destroy'])->name('vehicles.destroy');


Route::get('/req-documents/create', [ReqDocumentController::class, 'create'])->name('req_documents.create');
Route::post('/req-documents/store', [ReqDocumentController::class, 'store'])->name('req_documents.store');
Route::get('/get-amphoes/{provinceId}', [ReqDocumentController::class, 'getAmphoes']);
Route::get('/get-districts/{amphoeId}', [ReqDocumentController::class, 'getDistricts']);



// Route::get('/amphoes/{province}', [ReqDocumentController::class, 'getAmphoes']);
// Route::get('/districts/{amphoe}', [ReqDocumentController::class, 'getDistricts']);
