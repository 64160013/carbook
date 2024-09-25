<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReqDocumentUser;

class PermissionController extends Controller
{
    public function index()
{
    // ดึงข้อมูลจากตาราง req_document_user พร้อมกับข้อมูลผู้ใช้และเอกสารที่เกี่ยวข้อง
    $reqDocumentUsers = ReqDocumentUser::with(['user', 'reqDocument'])->get();

    return view('permission.index', compact('reqDocumentUsers'));
}

public function show($id)
{
    // ดึงข้อมูล req_document_user ตาม id
    $reqDocumentUser = ReqDocumentUser::with(['user', 'reqDocument'])->findOrFail($id);

    // ส่งข้อมูลไปยัง view ที่จะแสดงฟอร์มสถานะ
    return view('permission.show', compact('reqDocumentUser'));
}


public function updateStatus(Request $request, $id)
{
    // ตรวจสอบข้อมูลที่รับเข้ามา
    $request->validate([
        'allow_department' => 'required|in:pending,approved,rejected',
    ]);

    // ดึงข้อมูล req_document_user ตาม id
    $reqDocumentUser = ReqDocumentUser::findOrFail($id);

    // อัปเดตสถานะ
    $reqDocumentUser->allow_department = $request->input('allow_department');
    $reqDocumentUser->save();

    return redirect()->route('permission.index')->with('success', 'สถานะถูกอัปเดตเรียบร้อยแล้ว');
}



}
