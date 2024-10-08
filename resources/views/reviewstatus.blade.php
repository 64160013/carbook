@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header bg-warning ">
            <div class="row">
                <div class="col-6">
                    <strong>วันที่ไป : {{ \Carbon\Carbon::parse($document->start_date)->translatedFormat('d F Y') }} </strong>
</div>
                <div class="col-6 text-right">
                    <strong>วัตถุประสงค์ : {{ $document->objective }}</strong>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row text-center mb-4">
                @foreach($document->reqDocumentUsers as $docUser)
                    @if ($docUser->division_id == 2)
                    <div class="col-2 offset-1">
                        <i class="fas fa-user-circle fa-3x"></i>
                        <p>หัวหน้างาน</p>
                        <div class="badge badge-warning">
                            @if ($document->allow_department == 'approved')
                                <span class="badge bg-success">อนุมัติ</span>
                            @elseif ($document->allow_department == 'pending')
                                <span class="badge bg-warning">รอดำเนินการ</span>
                            @else
                                <span class="badge bg-danger">ถูกปฏิเสธ</span>
                            @endif
                        </div>
                    </div>
                    @endif
                @endforeach
                <div class="col-2 ">
                    <i class="fas fa-user-circle fa-3x"></i>
                    <p>หัวหน้าฝ่าย</p>
                    <div class="badge badge-warning">
                        @if ($document->allow_division == 'approved')
                            <span class="badge bg-success">อนุมัติ</span>
                        @elseif ($document->allow_division == 'pending')
                            <span class="badge bg-warning">รอดำเนินการ</span>
                        @else
                            <span class="badge bg-danger">ถูกปฏิเสธ</span>
                        @endif
                    </div>
                </div>
                
                <div class="col-2">
                    <i class="fas fa-user-circle fa-3x"></i>
                    <p>คนสั่งรถ</p>
                    <div class="badge badge-warning">
                        @if ($document->allow_opcar == 'approved')
                            <span class="badge bg-success">อนุมัติ</span>
                        @elseif ($document->allow_opcar == 'pending')
                            <span class="badge bg-warning">รอดำเนินการ</span>
                        @else
                            <span class="badge bg-danger">ถูกปฏิเสธ</span>
                        @endif 
                    </div>
                </div>
                <div class="col-2">
                    <i class="fas fa-user-circle fa-3x"></i>
                    <p>หัวหน้าสำนักงาน</p>
                    <div class="badge badge-secondary">
                        @if ($document->allow_officer == 'approved')
                            <span class="badge bg-success">อนุมัติ</span>
                        @elseif ($document->allow_officer == 'pending')
                            <span class="badge bg-warning">รอดำเนินการ</span>
                        @else
                            <span class="badge bg-danger">ถูกปฏิเสธ</span>
                        @endif
                    </div>
                </div>
                <div class="col-2">
                    <i class="fas fa-user-circle fa-3x"></i>
                    <p>ผู้อำนวยการ</p>
                    <div class="badge badge-secondary">
                        @if ($document->allow_director == 'approved')
                            <span class="badge bg-success">อนุมัติ</span>
                        @elseif ($document->allow_director == 'pending')
                            <span class="badge bg-warning">รอดำเนินการ</span>
                        @else
                            <span class="badge bg-danger">ถูกปฏิเสธ</span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="text-center mb-4">
                <h4>สถานะปัจจุบัน : 
                    <span >
                    @foreach($document->reqDocumentUsers as $docUser)
                        @if ($docUser->division_id == 2)
                            {{-- ตรวจสอบ allow_department เมื่อ division_id == 2 --}}
                            @if ($document->allow_department == 'pending')
                                <span class="badge bg-warning">รอหัวหน้างานพิจารณา</span>
                            @elseif ($document->allow_department == 'approved')
                                @include('partials.allow_status', ['document' => $document])
                            @else
                                <span class="badge bg-danger">หัวหน้างานไม่อนุมัติ</span>
                                @if ($document->notallowed_reason)
                                    <br><span>เหตุผล: {{ $document->notallowed_reason }}</span>
                                @endif
                            @endif
                        @else
                            {{-- ข้ามการตรวจสอบ allow_department --}}
                            @include('partials.allow_status', ['document' => $document])
                        @endif
                    @endforeach
                    </span>                    
                </h4>
                
            </div>

            <div class="text-center">
                <a href="#" class="btn btn-warning">แก้ไขแบบฟอร์มเพิ่มเติม</a>
                <a href="#" class="btn btn-danger">ต้องการยกเลิกคำขอ</a>
                <!-- <a href="{{ route('documents.history') }}" class="btn btn-secondary">ย้อนกลับ</a> -->
            </div>
        </div>
    </div>
</div>
@endsection
