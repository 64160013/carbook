@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Permission Form</h1>

        @if($documents->isEmpty())
            <div class="alert alert-info">
                {{ __('ไม่มีฟอร์มสำหรับการตรวจสอบ') }}
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อเอกสาร</th>
                        <th>วันที่สร้าง</th>
                        <th>สถานะ</th>
                        <th>การกระทำ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documents as $document)
                        <tr>
                            <td>{{ $document->document_id }}</td>
                            <td>{{ $document->objective }}</td>
                            <td>{{ $document->created_at }}</td>
                            <td>
                            @if (in_array(auth()->user()->role_id, [4, 5, 6, 7, 8, 9, 10])) 
                                
                                @if ($document->allow_division == 'approved')
                                    <span class="badge bg-success">อนุมัติ</span>
                                @elseif ($document->allow_division == 'pending')
                                    <span class="badge bg-warning">รอดำเนินการ</span>
                                @else
                                    <span class="badge bg-danger">ถูกปฏิเสธ</span>
                                @endif
                            @elseif (in_array(auth()->user()->role_id, [13, 14, 15, 16]))
                                
                                @if ($document->allow_department == 'approved')
                                    <span class="badge bg-success">อนุมัติ</span>
                                @elseif ($document->allow_department	 == 'pending')
                                    <span class="badge bg-warning">รอดำเนินการ</span>
                                @else
                                    <span class="badge bg-danger">ถูกปฏิเสธ</span>
                                @endif 
                            @endif  
                            </td>
                            <td>
                                <a href="{{ route('documents.show') }}?id={{ $document->document_id }}">ดูรายละเอียด</a>                        
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
