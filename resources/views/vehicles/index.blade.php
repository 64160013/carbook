    @extends('layouts.app')

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header text-center bg-warning">{{ __('รายการรถทั้งหมด') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        <table class="table table-bordered">
                            <thead class="text-center">
                                <tr>
                                    <th style="width: 10%;">ประเภท</th>
                                    <th style="width: 65%;">หมายเลขทะเบียน</th>
                                    <th style="width: 15%;">สถานะ</th>
                                    <th style="width: 10%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($vehicles as $vehicle)
                                <tr>
                                    <!-- icon -->
                                    <td style="text-align: center;">
                                        @foreach ($car_icons as $car_icon)
                                            @if ($vehicle->icon_id == $car_icon->icon_id)
                                                <img src="{{ asset('images/' . $car_icon->icon_img) }}" alt="Icon Image" width="45" height="45">
                                            @endif
                                        @endforeach
                                    </td>

                                    <!-- เลขทะเบียนกับสีพื้นหลัง -->
                                    <td style="vertical-align: middle; background-color: 
                                        @foreach ($car_icons as $car_icon)
                                            @if ($vehicle->icon_id == $car_icon->icon_id)
                                                {{ $car_icon->icon_color }};
                                            @endif
                                        @endforeach">
                                        {{ $vehicle->car_category }} {{ $vehicle->car_regnumber }} {{ $vehicle->car_province }}
                                    </td>

                                    
                                    <!-- สถานะ -->
                                    <td style="text-align: center; vertical-align: middle;">
                                        <form action="{{ route('vehicles.updateStatus', $vehicle->car_id) }}" method="POST">
                                            @csrf
                                            <label style="color: {{ $vehicle->car_status == 'Y' ? 'green' : 'gray' }}">
                                                <input type="radio" name="car_status_{{ $vehicle->car_id }}" value="Y" onchange="this.form.submit()" {{ $vehicle->car_status == 'Y' ? 'checked' : '' }}> พร้อม
                                            </label>
                                            <label style="color: {{ $vehicle->car_status == 'N' ? 'red' : 'gray' }}">
                                                <input type="radio" name="car_status_{{ $vehicle->car_id }}" value="N" onchange="document.getElementById('reason_{{ $vehicle->car_id }}').style.display='block'; this.form.submit()" {{ $vehicle->car_status == 'N' ? 'checked' : '' }}> ไม่พร้อม
                                            </label>

                                            <div id="reason_{{ $vehicle->car_id }}" style="display: {{ $vehicle->car_status == 'N' ? 'block' : 'none' }};">
                                                <input type="text" name="car_reason_{{ $vehicle->car_id }}" placeholder="กรุณาระบุเหตุผล" value="{{ $vehicle->car_reason }}">
                                            </div>
                                        </form>
                                    </td>
                                    
                                    <!-- ลบข้อมูล -->
                                    <td style="text-align: center;">
                                        <form action="{{ route('vehicles.destroy', $vehicle->car_id) }}" method="POST" onsubmit="return confirm('คุณแน่ใจว่าต้องการลบข้อมูลนี้หรือไม่?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">ลบ</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <form action="{{ url('/add-vehicle') }}" method="get" class="text-center">
                        <button type="submit" class="btn btn-warning  mb-4">เพิ่มรถ</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
    // JavaScript เพื่อตั้งเวลาให้ข้อความแสดง 5 วินาที
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            var alert = document.getElementById('success-alert');
            if (alert) {
                alert.style.display = 'none';
            }
        }, 5000); // 5000 มิลลิวินาที = 5 วินาที
    });
    </script>   
@endsection

    
