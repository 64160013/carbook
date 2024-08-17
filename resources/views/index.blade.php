<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
</head>
<body>
    <h1>Users List</h1>
    <ul>
    @foreach ($users as $user)
    <li>
        ชื่อ: {{ $user->name }}<br>
        แผนก: {{ $user->division->division_name ?? 'ไม่มีฝ่าย' }}<br>
        ฝ่าย: {{ $user->department->department_name ?? 'ไม่มีแผนก' }}<br><br>
    </li>
@endforeach

    </ul>
</body>
</html>
