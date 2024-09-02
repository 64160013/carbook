@extends('layouts.app')

@section('content')
<div class="container">
    <h2>เพิ่มข้อมูล</h2>

    <form action="{{ route('req_documents.store') }}" method="POST">
        @csrf

        <!-- จังหวัด -->
<div class="row mb-3">
    <label for="provinces_id" class="col-md-4 col-form-label text-md-end">{{ __('จังหวัด') }}</label>
    <div class="col-md-6">
        <select id="provinces_id" class="form-control @error('provinces_id') is-invalid @enderror" name="provinces_id" required>
            <option value="" disabled selected>{{ __('เลือกจังหวัด') }}</option>
            @foreach($provinces as $province)
                <option value="{{ $province->provinces_id }}" {{ old('provinces_id') == $province->provinces_id ? 'selected' : '' }}>
                    {{ $province->name_th }}
                </option>
            @endforeach
        </select>
        @error('provinces_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<!-- อำเภอ -->
<div class="row mb-3">
    <label for="amphoe_id" class="col-md-4 col-form-label text-md-end">{{ __('อำเภอ') }}</label>
    <div class="col-md-6">
        <select id="amphoe_id" class="form-control @error('amphoe_id') is-invalid @enderror" name="amphoe_id" required>
            <option value="" disabled selected>{{ __('เลือกอำเภอ') }}</option>
            @if(old('provinces_id'))
                @foreach($amphoes as $amphoe)
                    <option value="{{ $amphoe->amphoe_id }}" {{ old('amphoe_id') == $amphoe->amphoe_id ? 'selected' : '' }}>
                        {{ $amphoe->name_th }}
                    </option>
                @endforeach
            @endif
        </select>
        @error('amphoe_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>



<div class="row mb-3">
    <label for="district_id" class="col-md-4 col-form-label text-md-end">{{ __('ตำบล') }}</label>
    <div class="col-md-6">
        <select id="district_id" class="form-control @error('district_id') is-invalid @enderror" name="district_id" required>
            <option value="" disabled selected>{{ __('เลือกตำบล') }}</option>
            @if(old('amphoe_id'))
                @foreach($districts as $district)
                    <option value="{{ $district->district_id }}" {{ old('district_id') == $district->district_id ? 'selected' : '' }}>
                        {{ $district->name_th }}
                    </option>
                @endforeach
            @endif
        </select>
        @error('district_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>




 <button type="submit" class="btn btn-primary">บันทึก</button>






<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#provinces_id').on('change', function() {
            var provinceId = $(this).val();
            if(provinceId) {
                $.ajax({
                    url: '/get-amphoes/' + provinceId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#amphoe_id').empty();
                        $('#amphoe_id').append('<option value="" disabled selected>{{ __('เลือกอำเภอ') }}</option>');
                        $.each(data, function(key, value) {
                            $('#amphoe_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    },
                    error: function(xhr) {
                        console.error('AJAX Error: ', xhr.responseText);
                    }
                });
            } else {
                $('#amphoe_id').empty();
                $('#amphoe_id').append('<option value="" disabled selected>{{ __('เลือกอำเภอ') }}</option>');
            }
        });

        $('#amphoe_id').on('change', function() {
            var amphoeId = $(this).val();
            if(amphoeId) {
                $.ajax({
                    url: '/get-districts/' + amphoeId,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#district_id').empty();
                        $('#district_id').append('<option value="" disabled selected>{{ __('เลือกตำบล') }}</option>');
                        $.each(data, function(key, value) {
                            $('#district_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    },
                    error: function(xhr) {
                        console.error('AJAX Error: ', xhr.responseText);
                    }
                });
            } else {
                $('#district_id').empty();
                $('#district_id').append('<option value="" disabled selected>{{ __('เลือกตำบล') }}</option>');
            }
        });
    });
</script>










@endsection
