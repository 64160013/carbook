@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-center bg-warning">{{ __('จัดการข้อมูลผู้ใช้') }}</div>

                <div class="card-body">
                    <!-- ข้อความแจ้งเตือน -->
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- ช่องค้นหาชื่อ-นามสกุล -->
                    <div class="container-fluid mt-2">
                        <form class="d-flex">
                            <input type="search" id="searchName" class="form-control me-2"  placeholder="ค้นหารายชื่อบุคลากร" aria-label="Search">
                            <button class="btn btn-outline-primary me-2 bi bi-filter-square-fill" type="button" data-bs-toggle="collapse" data-bs-target="#filterCollapse" aria-expanded="false" aria-controls="filterCollapse"></button>
                            <a href="{{ route('register') }}" class="btn btn btn-primary">
                                <i class="bi bi-plus-circle"></i>
                            </a>
                        </form>

                        <!-- เนื้อหา collapse-->
                        <div class="collapse" id="filterCollapse">
                            <div class="card card-body mt-2">

                                <!-- กรองส่วนงาน -->
                                <label for="filterDivision">กรองตามส่วนงาน: </label>
                                <select id="filterDivision">
                                    <option value="">-- แสดงทั้งหมด --</option>
                                    @foreach($divisions as $division)
                                        <option value="{{ $division->division_name }}">{{ $division->division_name }}</option>
                                    @endforeach
                                </select><br>

                                <!-- กรองฝ่ายงาน -->
                                <label for="filterDepartment">กรองตามฝ่ายงาน: </label>
                                <select id="filterDepartment">
                                    <option value="">-- แสดงทั้งหมด --</option>
                                    @foreach($departments as $department)
                                        <option value="{{ $department->department_name }}">{{ $department->department_name }}</option>
                                    @endforeach
                                </select><br>

                                <!-- กรองตำแหน่ง -->
                                <label for="filterPosition">กรองตามตำแหน่งงาน: </label>
                                <select id="filterPosition">
                                    <option value="">-- แสดงทั้งหมด --</option>
                                    @foreach($positions as $position)
                                        <option value="{{ $position->position_name }}">{{ $position->position_name }}</option>
                                    @endforeach
                                </select><br>

                                <!-- กรอง Role -->
                                <label for="filterRole">กรองตาม Role: </label>
                                <select id="filterRole">
                                    <option value="">-- แสดงทั้งหมด --</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->role_name }}">{{ $role->role_name }}</option>
                                    @endforeach
                                </select><br>

                            </div>
                        </div>
                    </div>

                    <!-- ตารางข้อมูลผู้ใช้ -->
                    <div class="table-responsive mt-4" style="overflow-x: auto;">
                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th style="white-space: nowrap;">ชื่อ-นามสกุล</th>
                                    <th style="white-space: nowrap;">ส่วนงาน</th>
                                    <th style="white-space: nowrap;">ฝ่ายงาน</th>
                                    <th style="white-space: nowrap;">ตำแหน่ง</th>
                                    <th style="white-space: nowrap;">อีเมล</th>
                                    <th style="white-space: nowrap;">เบอร์ติดต่อ</th>
                                    <th style="white-space: nowrap;">Role</th>
                                    <th style="white-space: nowrap;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                <tr>
                                    <td style="white-space: nowrap;">{{ $user->name }} {{ $user->lname }}</td>
                                    <!-- ส่วนงาน -->
                                    <td style="white-space: nowrap;">
                                        @foreach($divisions as $division)
                                            @if($user->division_id == $division->division_id)
                                                {{ $division->division_name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <!-- ฝ่ายงาน -->
                                    <td style="white-space: nowrap;">
                                        @foreach($departments as $department)
                                            @if($user->department_id == $department->department_id)
                                                {{ $department->department_name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <!-- ตำแหน่ง -->
                                    <td style="white-space: nowrap;">
                                        @foreach($positions as $position)
                                            @if($user->position_id == $position->position_id)
                                                {{ $position->position_name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td style="white-space: nowrap;">{{ $user->email }}</td>
                                    <td style="white-space: nowrap;">{{ $user->phonenumber }}</td>
                                    <td style="white-space: nowrap; text-align: center;"    >
                                        @foreach($roles as $role)
                                            @if($user->role_id == $role->role_id)
                                                {{ $role->role_name }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td style="white-space: nowrap;">
                                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">
                                            <i class="fa fa-edit"></i> แก้ไข
                                        </a>
                                        <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash"></i> ลบ
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/search.js') }}"></script>

@endsection
