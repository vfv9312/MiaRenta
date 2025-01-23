<div>
    <table>
        <thead>
            <th>ID</th>
            <th>Nombre</th>
            <th>Rol</th>
            <th>Status</th>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->person->names }} {{ $user->person->surnames }}</td>
                <td>{{ $user->role->name }}</td>
                <td>{{ $user->status->name }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
