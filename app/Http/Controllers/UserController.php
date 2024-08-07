<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use Image;

class UserController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phonenumber' => 'nullable|digits:10|regex:/^[0-9]+$/',  //เบอร์ไม่เกิน 10 
            'signature_name' => 'nullable|image|mimes:png|max:1024|dimensions:width=530,height=120',  //png 
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

        $user->update($validatedData);
        return redirect()->route('profile.edit')->with('success', 'แก้ไขข้อมูลเรียบร้อยแล้ว');
    }
}
