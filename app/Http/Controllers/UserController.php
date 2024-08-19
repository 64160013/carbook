<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Division;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $divisions = Division::all(); // ดึงข้อมูล division ทั้งหมด
        return view('profile.edit', compact('user', 'divisions'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phonenumber' => 'nullable|digits:10|regex:/^[0-9]+$/', // เบอร์ไม่เกิน 10
            'division_id' => 'nullable|exists:divisions,division_id', // ตรวจสอบ division_id
            'signature_name' => 'nullable|image|mimes:png|max:1024|dimensions:width=530,height=120', // png
        ]);

        if ($request->hasFile('signature_name')) {
            // ลบรูปภาพเก่าถ้ามี
            if ($user->signature_name) {
                Storage::delete('public/' . $user->signature_name);
            }

            // อัปโหลดรูปภาพใหม่
            $path = $request->file('signature_name')->store('signatures', 'public');
            $validatedData['signature_name'] = $path;
        }

        // อัพเดตข้อมูลผู้ใช้
        $user->update($validatedData);

        return redirect()->route('profile.edit')->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
    }
}
