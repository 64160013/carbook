<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Division;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/login';

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phonenumber' => ['required', 'digits:10', 'regex:/^[0-9]+$/'],
            'department' => 'required|exists:departments,id',
            'division' => 'required|exists:divisions,id',
            // 'department' => ['required', 'string', 'max:255'],
            // 'division' => ['required', 'string', 'max:255'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // Find or create the department and division
        $department = Department::firstOrCreate(['department_name' => $data['department']]);
        $division = Division::firstOrCreate(['division_name' => $data['division']]);

        // Create the user with department and division IDs
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'phonenumber' => $data['phonenumber'],
            'department_id' => $department->department_name,
            'division_id' => $division->division_name,
        ]);
    }

    public function showRegistrationForm()
    {
        // ดึงข้อมูลจากฐานข้อมูล
        $divisions = Division::all();
        $departments = Department::all();
    
        // ส่งข้อมูลทั้งหมดไปยังวิว
        return view('auth.register', compact('divisions', 'departments'));
    }
    
}
