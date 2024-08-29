@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>รายการรถทั้งหมด</h1>
        <table class="table table-bordered ">
            <thead class="text-center">
                <tr>
                    <!-- //รูปรถ -->
                    <th>ประภทพาหนะ</th>  
                    <th>หมายเลขทะเบียน</th>
                    <th>สถานะ</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vehicles as $vehicle)
                    <tr>
                        <td>
                            @foreach ($car_icons as $car_icon)
                                @if ($vehicle->icon_id == $car_icon->icon_id)
                                    <img src="{{ asset('images/' . $car_icon->icon_img) }}" alt="Icon Image" width="50" height="50">
                                    <a> : {{$car_icon->type_name}}</a>
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $vehicle->car_category }} {{ $vehicle->car_regnumber }} {{ $vehicle->car_province }}</td>
                        
                        <td>{{ $vehicle->car_status }}</td>

                        <td>{{ $vehicle->car }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
    </div>
@endsection
