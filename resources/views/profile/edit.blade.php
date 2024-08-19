@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

                <div class="container mt-2">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <!-- ชื่อ -->
                        <div class="mb-3">
                            <label for="name" class="form-label mt-2">ชื่อ</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}">
                        </div>

                        <!-- อีเมล -->
                        <div class="mb-3">
                            <label for="email" class="form-label">อีเมล</label>
                            <p id="email" class="form-control">{{ $user->email }}</p>
                        </div>

                        <!-- เบอร์ -->
                        <div class="mb-3">
                            <label for="phonenumber" class="form-label">เบอร์โทรศัพท์</label>
                            <input type="text" name="phonenumber" id="phonenumber" class="form-control" value="{{ $user->phonenumber }}">
                            @error('phonenumber')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- ลายเซ็น -->
                        <div class="mb-3">
                            <label for="signature_name" class="form-label">รูปภาพลายเซ็น (.png ขนาด 530x120 px)</label>
                            <input type="file" name="signature_name" id="signature_name" class="form-control">
                            @error('signature_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                            @if ($user->signature_name)
                                <img src="{{ asset('storage/' . $user->signature_name) }}" alt="Signature Image" class="img-fluid mt-2">
                            @endif
                        </div>

                        <!-- แผนก -->
                        <div class="mb-3">
                            <label for="division" class="form-label">แผนก</label>
                            <p id="division" class="form-control @error('division') is-invalid @enderror">
                                @foreach($divisions as $division)
                                    @if($user->division_id == $division->division_id)
                                        {{ $division->division_name }}
                                    @endif
                                @endforeach
                            </p>
                            @error('division')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary mb-5">บันทึกการเปลี่ยนแปลง</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
