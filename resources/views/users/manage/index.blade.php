<x-videos-app-layout>
    <div class="container">
        <h1 class="mb-4">Gestió d'Usuaris</h1>

        <a href="{{ route('users.manage.create') }}" class="btn btn-primary mb-3" data-qa="create-user-btn">Afegir Usuari</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Accions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <a href="{{ route('users.manage.edit', $user->id) }}" class="btn btn-warning btn-sm" data-qa="edit-user-btn">Editar</a>
                        <a href="{{ route('users.manage.delete', $user->id) }}" class="btn btn-danger btn-sm" data-qa="delete-user-btn">Eliminar</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @if($users->isEmpty())
            <p class="text-center">No hi ha usuaris disponibles.</p>
        @endif
    </div>
</x-videos-app-layout>
