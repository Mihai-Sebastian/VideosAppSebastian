<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center" style="color: #ff5733; font-weight: bold;">Gestió d'Usuaris</h1>

        <!-- Botó Afegir Usuari -->
        <div class="d-flex justify-content-center mb-4">
            <a href="{{ route('users.manage.create') }}" class="btn" style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white; padding: 12px 30px; border-radius: 25px; font-weight: bold; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-transform: uppercase; transition: all 0.3s ease-in-out;" data-qa="create-user-btn">
                Afegir Usuari
            </a>
        </div>

        <!-- Taula d'Usuaris -->
        <div class="table-responsive mt-4" style="overflow-x: auto;">
            <table class="table table-bordered table-striped" style="min-width: 600px; margin-top: 20px;">
                <thead style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white;">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Accions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr style="background-color: #282828; color: white; height: 60px;">
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <!-- Botó Editar -->
                            <a href="{{ route('users.manage.edit', $user->id) }}" class="btn btn-sm" style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white; border-radius: 20px; padding: 6px 12px; font-weight: bold; transition: 0.3s; margin: 2px;">
                                Editar
                            </a>
                            <!-- Botó Eliminar -->
                            <a href="{{ route('users.manage.delete', $user->id) }}" class="btn btn-sm" style="background: linear-gradient(45deg, #e74c3c, #c0392b); color: white; border-radius: 20px; padding: 6px 12px; font-weight: bold; transition: 0.3s; margin: 2px;">
                                Eliminar
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <!-- Missatge quan no hi ha usuaris -->
        @if($users->isEmpty())
            <p class="text-center text-muted">No hi ha usuaris disponibles.</p>
        @endif
    </div>
</x-videos-app-layout>
