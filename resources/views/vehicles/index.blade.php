@extends('layouts.app')

@section('content')
<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>ข้อมูลพาหนะ</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>ประเภทพาหนะ</th>
                <th>ทะเบียนรถ</th>
                <th>จังหวัด</th>
                <th>สถานะ</th>
                <th>การจัดการ</th>
            </tr>
        </thead>
        <tbody>
           
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>
                        <!-- Form for deleting vehicle -->
                        <form action="" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">ลบ</button>
                        </form>

                        <!-- Form for toggling vehicle status -->
                        <form action="" method="POST" style="display:inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">เปลี่ยนสถานะ</button>
                        </form>
                    </td>
                </tr>
        </tbody>
    </table>
</div>
@endsection
