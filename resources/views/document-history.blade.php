@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>ประวัติการยื่นขอ</h2>
        @if($documents->isEmpty())
            <div class="alert alert-info">
                {{ __('ไม่มีฟอร์มสำหรับการตรวจสอบ') }}
            </div>
        @else
            @foreach($documents->groupBy(function($date) {
                return \Carbon\Carbon::parse($date->created_at)->format('F Y');
            }) as $month => $groupedDocuments)
                <div class="card mb-3">
                    <div class="card-header">{{ $month }}</div>
                    <div class="card-body">
                        @foreach($groupedDocuments as $document)
                        
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="d-flex justify-content-between align-items-center" style="background-color: #FFC107; padding: 10px;">
                                        <div>
                                            <strong>วัตถุประสงค์: {{ $document->objective }}</strong><br>
                                            สถานที่: {{ $document->location }}<br>
                                            วันที่ไป: {{ \Carbon\Carbon::parse($document->start_date)->translatedFormat('d F Y') }}<br>
                                            วันที่กลับ: {{ \Carbon\Carbon::parse($document->end_date)->translatedFormat('d F Y') }}<br>
                                            เวลาไป: {{ \Carbon\Carbon::parse($document->start_time)->format('H:i') }} น.<br>
                                            เวลากลับ: {{ \Carbon\Carbon::parse($document->end_time)->format('H:i') }} น.<br>
                                        </div>
                                        <div>
                                            <!-- ส่ง document id ไปยัง route -->
                                            <!-- <a href="{{ route('documents.review', ['id' => $document->id]) }}">Review</a> -->
                                            <a href="{{ route('documents.review') }}?id={{ $document->document_id }}" class="btn btn-primary">ดูรายละเอียด</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection