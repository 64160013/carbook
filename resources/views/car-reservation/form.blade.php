<!-- resources/views/car-reservation/form.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>ฟอร์มจองรถ</h1>
    <form method="POST" action="{{ route('car-reservation.submit') }}">
        @csrf

        <!-- ชื่อผู้ร่วมเดินทาง -->
        <div class="mb-3">
            <label for="companion_name" class="form-label">ชื่อผู้ร่วมเดินทาง</label>
            <input type="text" class="form-control" id="companion_name" name="companion_name" required>
        </div>

        <!-- วัตถุประสงค์ -->
        <div class="mb-3">
            <label for="objective" class="form-label">วัตถุประสงค์</label>
            <input type="text" class="form-control" id="objective" name="objective" required>
        </div>

        <!-- โครงการที่เกี่ยวข้อง -->
        <div class="mb-3">
            <label for="related_project" class="form-label">โครงการที่เกี่ยวข้อง</label>
            <input type="text" class="form-control" id="related_project" name="related_project" required>
        </div>

        <!-- สถานที่ -->
        <div class="mb-3">
            <label for="location" class="form-label">สถานที่</label>
            <input type="text" class="form-control" id="location" name="location" required>
        </div>

        <!-- จุดรับรถ -->
        <div class="mb-3">
            <label for="car_pickup" class="form-label">จุดรับรถ</label>
            <input type="text" class="form-control" id="car_pickup" name="car_pickup" required>
        </div>

        <!-- วันที่จอง -->
        <div class="mb-3">
            <label for="reservation_date" class="form-label">วันที่จอง</label>
            <input type="date" class="form-control" id="reservation_date" name="reservation_date" required>
        </div>

        <!-- วันที่เริ่มต้นและสิ้นสุด -->
        <div class="mb-3">
            <label for="start_date" class="form-label">วันที่เริ่มต้น</label>
            <input type="date" class="form-control" id="start_date" name="start_date" required>
        </div>

        <div class="mb-3">
            <label for="end_date" class="form-label">วันที่สิ้นสุด</label>
            <input type="date" class="form-control" id="end_date" name="end_date" required>
        </div>

        <!-- เวลาที่เริ่มต้นและสิ้นสุด -->
        <div class="mb-3">
            <label for="start_time" class="form-label">เวลาเริ่มต้น</label>
            <input type="time" class="form-control" id="start_time" name="start_time" required>
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">เวลาสิ้นสุด</label>
            <input type="time" class="form-control" id="end_time" name="end_time" required>
        </div>

        <!-- จำนวนผู้ร่วมเดินทาง -->
        <div class="mb-3">
            <label for="sum_companion" class="form-label">จำนวนผู้ร่วมเดินทาง</label>
            <input type="number" class="form-control" id="sum_companion" name="sum_companion" required>
        </div>

        <!-- ประเภทรถ -->
        <div class="mb-3">
            <label for="car_type" class="form-label">ประเภทรถ</label>
            <input type="text" class="form-control" id="car_type" name="car_type" required>
        </div>

        <button type="submit" class="btn btn-primary">จองรถ</button>
    </form>
</div>
@endsection
