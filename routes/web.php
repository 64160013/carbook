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
use App\Models\User;
use App\Http\Controllers\UserController;
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


// // loginแล้วเข้าถึงได้
// use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Facades\Response;

// Route::get('/signatures/{filename}', function ($filename) {
//     $path = 'signatures/' . $filename;

//     if (!Storage::exists($path)) {
//         abort(404);
//     }

//     return Response::file(storage_path('app/' . $path));
// })->middleware('auth'); // คุณสามารถเพิ่ม middleware อื่นๆ ตามต้องการ


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;

Route::get('/signatures/{filename}', function ($filename) {
    $path = 'signatures/' . $filename;

    // ตรวจสอบว่ามีไฟล์อยู่ในระบบหรือไม่
    if (!Storage::exists($path)) {
        abort(404);
    }

    $userId = Auth::id();    // ดึง ID ของผู้ใช้ที่เข้าสู่ระบบ
    
    // ตรวจสอบว่า ID ของผู้ใช้ตรงกับ ID ที่อยู่ในชื่อไฟล์หรือไม่
    if (strpos($filename, $userId . '_signature') !== 0) {
        abort(403); // ห้ามเข้าถึงหาก ID ไม่ตรงกัน
    }

    // ส่งไฟล์กลับไปยังผู้ใช้
    return Response::file(storage_path('app/' . $path));
})->middleware('auth');
