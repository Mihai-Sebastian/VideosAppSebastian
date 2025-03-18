<x-videos-app-layout>
    <div class="container">
        <h1 class="mb-4">Eliminar Usuari</h1>

        <p>Estàs segur que vols eliminar l'usuari <strong>{{ $user->name }}</strong>?</p>

        <form action="{{ route('users.manage.destroy', $user->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="mt-3">
                <button type="submit" class="btn btn-danger">Eliminar Usuari</button>
                <a href="{{ route('users.manage.index') }}" class="btn btn-secondary">Cancel·lar</a>
            </div>
        </form>
    </div>
</x-videos-app-layout>
