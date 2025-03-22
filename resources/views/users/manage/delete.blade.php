<x-videos-app-layout>
    <div class="container py-4">
        <h1 class="mb-4 text-center" style="color: #ff5733; font-weight: bold;">Eliminar Usuari</h1>

        <p class="text-center">Estàs segur que vols eliminar l'usuari <strong>{{ $user->name }}</strong>?</p>

        <form action="{{ route('users.manage.destroy', $user->id) }}" method="POST" class="text-center">
            @csrf
            @method('DELETE')

            <div class="mt-3 d-flex justify-content-center gap-2">
                <!-- Botó Eliminar -->
                <button type="submit" class="btn btn-danger" style="background: linear-gradient(45deg, #e74c3c, #c0392b); color: white; padding: 10px 20px; border-radius: 25px; font-weight: bold; transition: all 0.3s ease-in-out;">
                    Eliminar Usuari
                </button>
                <!-- Botó Cancel·lar -->
                <a href="{{ route('users.manage.index') }}" class="btn btn-secondary" style="background: linear-gradient(45deg, #6c757d, #5a6268); color: white; padding: 10px 20px; border-radius: 25px; font-weight: bold; transition: all 0.3s ease-in-out;">
                    Cancel·lar
                </a>
            </div>
        </form>
    </div>
</x-videos-app-layout>
