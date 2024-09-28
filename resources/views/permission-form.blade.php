@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Permission Form</h1>

        @if($documents->isEmpty())
            <p>ไม่มีเอกสารให้ตรวจสอบ</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อเอกสาร</th>
                        <th>วันที่สร้าง</th>
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
                            <!-- <a href="{{ route('documents.action', ['id' => $document->document_id]) }}" class="btn btn-primary">ตรวจสอบ</a> -->
                            <a href="{{ route('documents.show') }}?id={{ $document->document_id }}">ดูรายละเอียด</a>                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
