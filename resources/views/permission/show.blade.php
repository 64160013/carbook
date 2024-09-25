@extends('layouts.app')

@section('content')
<div class="container mt-5">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        <h2>รายละเอียดคำร้อง</h2>
        <p><strong>ชื่อผู้ใช้:</strong> {{ $reqDocumentUser->user->name }}</p>
        <p><strong>ชื่อผู้ใช้:</strong> {{ $reqDocumentUser->user->lname }}</p>
        <p><strong>วัตถุประสงค์:</strong> {{ $reqDocumentUser->reqDocument->objective }}</p>
        <p><strong>วันที่สร้าง:</strong> {{ $reqDocumentUser->created_at }}</p>
        <!-- เพิ่มข้อมูลอื่น ๆ ตามต้องการ -->

        <div class="card mb-3">
            <div class="card-header bg-light">
                <h6 class="mb-0">{{ __('ความคิดเห็น') }}</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    test
                    <form action="{{ route('permission.updateStatus', $reqDocumentUser->id) }}" method="POST">
    @csrf
    @method('PUT')
    
    <label for="allow_department">สถานะ:</label>
    <select name="allow_department" id="allow_department">
        <option value="pending" {{ $reqDocumentUser->allow_department == 'pending' ? 'selected' : '' }}>รอการอนุมัติ</option>
        <option value="approved" {{ $reqDocumentUser->allow_department == 'approved' ? 'selected' : '' }}>อนุมัติ</option>
        <option value="rejected" {{ $reqDocumentUser->allow_department == 'rejected' ? 'selected' : '' }}>ไม่อนุมัติ</option>
    </select>

    

    <button type="submit" class="btn btn-primary">บันทึกสถานะ</button>
</form>

                </div>
            </div>
        </div>
</div>
@endsection