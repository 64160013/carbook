@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- ชื่อ -->
                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- อีเมล -->
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- รหัสผ่าน -->
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- ยืนยันรหัสผ่าน -->
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- หมายเลขโทรศัพท์ -->
                        <div class="row mb-3">
                            <label for="phonenumber" class="col-md-4 col-form-label text-md-end">{{ __('Phone number') }}</label>

                            <div class="col-md-6">
                                <input id="phonenumber" type="text" class="form-control @error('phonenumber') is-invalid @enderror" name="phonenumber" value="{{ old('phonenumber') }}" required autocomplete="phonenumber" autofocus>

                                @error('phonenumber')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Division -->
                        <div class="row mb-3">
                            <label for="division" class="col-md-4 col-form-label text-md-end">{{ __('Division') }}</label>
                            <div class="col-md-6">
                                <select id="division" class="form-control @error('division') is-invalid @enderror" name="division" required>
                                    <option value="" disabled selected>{{ __('Select Division') }}</option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->division_id }}" {{ old('division') == $division->division_id ? 'selected' : '' }}>
                                            {{ $division->division_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('division')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Department -->
                        <div class="row mb-3" id="department-group" style="display: none;"> <!--department-group ใช้กับscript-->
                            <label for="department" class="col-md-4 col-form-label text-md-end">{{ __('Department') }}</label>
                            <div class="col-md-6">
                                <select id="department" class="form-control @error('department_id') is-invalid @enderror" name="department_id">
                                    <option value="" disabled selected>{{ __('Select Department') }}</option>
                                    @foreach($departments as $department)
                                        @if($department->division_id == 2)
                                            <option value="{{ $department->department_id }}" {{ old('department_id') == $department->department_id ? 'selected' : '' }}>
                                                {{ $department->department_name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                         <!-- Position -->
                         <div class="row mb-3">
                            <label for="position_id" class="col-md-4 col-form-label text-md-end">{{ __('Position') }}</label>
                            <div class="col-md-6">
                                <select id="position_id" class="form-control @error('position_id') is-invalid @enderror" name="position_id" required>
                                    <option value="" disabled selected>{{ __('Select Position') }}</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->position_id }}" {{ old('position_id') == $position->position_id ? 'selected' : '' }}>
                                            {{ $position->position_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('position_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                       
                        <!-- role -->
                        <div class="row mb-3">
                            <label for="role_id" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
                            <div class="col-md-6">
                                <select id="role_id" class="form-control @error('role_id') is-invalid @enderror" name="role_id" required>
                                    <option value="" disabled selected>{{ __('Select Role') }}</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->role_id }}" {{ old('role_id') == $role->role_id ? 'selected' : '' }}>
                                            {{ $role->role_name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('role_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>




<script>
    document.addEventListener('DOMContentLoaded', function () {
        const divisionSelect = document.getElementById('division');
        const departmentGroup = document.getElementById('department-group');

        // ฟังก์ชันตรวจสอบค่า division
        function toggleDepartmentField() {
            if (divisionSelect.value == '2') {
                departmentGroup.style.display = 'block'; // แสดง
            } else {
                departmentGroup.style.display = 'none'; // ซ่อน
            }
        }

        toggleDepartmentField();// เรียกฟังก์ชันเมื่อหน้าโหลดขึ้นมา (เพื่อตรวจสอบค่าเก่า)

        // เรียกฟังก์ชันเมื่อเปลี่ยนค่าใน dropdown
        divisionSelect.addEventListener('change', toggleDepartmentField);
    });
</script>


                        <!-- ปุ่มลงทะเบียน -->
                        <div class="row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
        </button>
    </div>
</div>

<!-- แสดงข้อความ error ถ้ามี -->
@if ($errors->any())
    <div class="row mt-3">
        <div class="col-md-6 offset-md-4">
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif


                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection