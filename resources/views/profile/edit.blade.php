@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>
                    <div class="container">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                        
                            <div class="mb-3">
                                <label for="name" class="form-label mt-2">ชื่อ</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">อีเมล</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}">
                            </div>

                            <div class="mb-3">
                                <label for="phonenumber" class="form-label">เบอร์โทรศัพท์</label>
                                <input type="text" name="phonenumber" id="phonenumber" class="form-control" value="{{ $user->phonenumber }}">
                            </div>

                            <div class="mb-3">
                                <label for="signature_name" class="form-label">ลายเซ็น</label>
                                <input type="text" name="signature_name" id="signature_name" class="form-control" value="{{ $user->signature_name }}">
                            </div>

                            <button type="submit" class="btn btn-primary mb -5">บันทึกการเปลี่ยนแปลง</button>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('content')

@endsection
