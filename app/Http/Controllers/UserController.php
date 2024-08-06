<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    // ฟังก์ชันแสดงฟอร์มแก้ไขข้อมูล
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // ฟังก์ชันอัปเดตข้อมูลผู้ใช้
    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phonenumber' => 'nullable|string|max:20',
            'signature_name' => 'nullable|string|max:255',
        ]);

        $user->update($validatedData);

        return redirect()->route('profile.edit')->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
    }
}
