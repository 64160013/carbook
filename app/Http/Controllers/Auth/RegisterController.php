<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\Department;
use App\Models\Position;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm() {
        $divisions = \App\Models\Division::all(); // ดึงข้อมูล division ทั้งหมด
        $departments = \App\Models\Department::all(); // ดึงข้อมูล department ทั้งหมด
        $positions = \App\Models\Position::all(); 
        $roles = \App\Models\Role::all(); 
        return view('auth.register', compact('divisions', 'departments','positions','roles'));
    }    
    //  

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phonenumber' => ['required', 'string', 'max:15'],
            'division' => ['required', 'exists:division,division_id'],
            'department_id' => ['required', 'exists:department,department_id'], // เพิ่มการตรวจสอบ department_id
            'position_id' => ['required', 'exists:position,position_id'],
            'role_id' => ['required', 'exists:role,role_id'],
        ]);
    }

    protected function create(array $data)
    {
        \Log::info('Register Data:', $data);

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'is_admin' => '0',
            'phonenumber' => $data['phonenumber'],
            'division_id' => $data['division'], // บันทึก division_id
            'department_id' => $data['department_id'],
            'position_id' => $data['position_id'],
            'role_id' => $data['role_id'],
        ]);
    }
}