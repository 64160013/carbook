@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-warning text-center">เพิ่มพาหนะ</div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('store.vehicle') }}">
                        @csrf
                        <div class="form-group">
    <label for="car_type">ประเภทพาหนะ:</label>
    <select name="car_type" id="car_type" class="form-control @error('car_type') is-invalid @enderror">
        <option value="">เลือกประเภทพาหนะ</option>
        <option value="รถยนต์">รถกระบะ</option>
        <option value="รถจักรยานยนต์">รถตู้</option>
        <!-- Add more options as needed -->
    </select>
    @error('car_type')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group mt-3">
    <label for="car_regnumber">เลขทะเบียน:</label>
    <input type="text" name="car_regnumber" id="car_regnumber" class="form-control @error('car_regnumber') is-invalid @enderror">
    @error('car_regnumber')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

                        <div class="form-group mt-4 text-center">
                            <a href="{{ route('admin.home') }}" class="btn btn-primary">ย้อนกลับ</a>
                            <button type="submit" class="btn btn-success">ยืนยัน</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
