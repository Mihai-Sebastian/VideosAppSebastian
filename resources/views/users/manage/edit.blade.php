<x-videos-app-layout>
    <div class="container py-4">
        <h1 class="mb-4 text-center" style="color: #ff5733; font-weight: bold;">Editar Usuari</h1>

        <form action="{{ route('users.manage.update', $user->id) }}" method="POST" class="mx-auto" style="max-width: 600px;">
            @csrf
            @method('PUT')

            <!-- Camp Nom -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Nom:</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Camp Email -->
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Camp Contrasenya -->
            <div class="form-group mb-3">
                <label for="password" class="form-label">Contrasenya (deixa buit per mantenir la mateixa):</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Camp Confirmar Contrasenya -->
            <div class="form-group mb-3">
                <label for="password_confirmation" class="form-label">Confirma la Contrasenya:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
            </div>

            <!-- Camp Rol -->
            <div class="form-group mb-4">
                <label for="role" class="form-label">Rol:</label>
                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ old('role', $user->roles->first()->name) == $role->name ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Botó de Submit -->
            <div class="form-group text-center">
                <button type="submit" class="btn btn-warning" style="background: linear-gradient(45deg, #ffc107, #e0a800); color: white; padding: 10px 20px; border-radius: 25px; font-weight: bold; transition: all 0.3s ease-in-out;">
                    Desar Canvis
                </button>
            </div>
        </form>
    </div>
</x-videos-app-layout>
