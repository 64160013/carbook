<table>
    <thead>
        <tr>
            <th>User</th>
            <th>Document</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reqDocumentUsers as $reqDocumentUser)
            <tr>
                <td>{{ $reqDocumentUser->user->name }}</td>
                <td>{{ $reqDocumentUser->reqDocument->objective }}</td>
                <td>{{ $reqDocumentUser->created_at }}</td>
                <td>
                    <!-- ปุ่มเพื่อดูรายละเอียดคำร้อง -->
                    <a href="{{ route('permission.show', $reqDocumentUser->id) }}" class="btn btn-primary">
                        ดูคำร้อง
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
