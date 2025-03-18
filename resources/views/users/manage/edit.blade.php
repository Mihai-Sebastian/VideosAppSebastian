<x-videos-app-layout>
    <div class="container">
        <h1 class="mb-4">Editar Usuari</h1>

        <form action="{{ route('users.manage.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="password">Contrasenya (deixa buit per mantenir la mateixa):</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>

            <div class="form-group">
                <label for="role">Rol:</label>
                <select name="role" id="role" class="form-control" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}"
                            {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mt-3">
                <button type="submit" class="btn btn-warning">Desar Canvis</button>
            </div>
        </form>
    </div>
</x-videos-app-layout>
