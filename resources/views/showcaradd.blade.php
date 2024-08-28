@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">รายละเอียดรถ</h2>
    <table class="table-custom mt-4 w-100">
        <thead>
            <tr>
                <th>ประเภท</th>
                <th>ข้อมูล</th>
                <th class="status-column">สถานะ</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="type-column">
                    <div class="icon-bus">
                        🚌
                    </div>
                </td>
                <td style="background-color: #ffe5cc;">
                    เลขทะเบียน : คข 1234 ชลบุรี
                    <button class="btn btn-danger float-end">ลบ</button>
                </td>
                <td class="status-column">
                    <div class="ready-status">พร้อม</div>
                    <input type="checkbox" checked>
                    <div class="not-ready-status">ไม่พร้อม</div>
                    <input type="checkbox">
                </td>
            </tr>
            <tr>
                <td class="type-column">
                    <div class="icon-truck">
                        🚚
                    </div>
                </td>
                <td style="background-color: #ccd9ff;">
                    เลขทะเบียน : คข 6789 ชลบุรี
                    <button class="btn btn-danger float-end">ลบ</button>
                </td>
                <td class="status-column">
                    <div class="ready-status">พร้อม</div>
                    <input type="checkbox" checked>
                    <div class="not-ready-status">ไม่พร้อม</div>
                    <input type="checkbox">
                </td>
            </tr>
        </tbody>
    </table>

    <button type="button" class="add-btn">เพิ่มพาหนะ</button>
</div>

@endsection

@push('styles')
<style>
    .table-custom {
        width: 100%;
        border: 1px solid #ddd;
    }
    .table-custom th, .table-custom td {
        padding: 15px;
        text-align: left;
    }
    .type-column {
        width: 15%;
        text-align: center;
    }
    .status-column {
        width: 10%;
        text-align: center;
    }
    .icon-bus {
        background-color: orange;
        padding: 10px;
        border-radius: 50%;
    }
    .icon-truck {
        background-color: navy;
        padding: 10px;
        border-radius: 50%;
    }
    .btn-danger {
        background-color: red;
        border-color: red;
    }
    .ready-status {
        color: green;
    }
    .not-ready-status {
        color: red;
    }
    .add-btn {
        display: block;
        margin: 20px auto;
        background-color: orange;
        border: none;
        padding: 10px 20px;
        color: white;
        border-radius: 25px;
    }
</style>
@endpush
