<x-videos-app-layout>
    <div class="container py-4">
        <h1 class="mb-4 text-center" style="color: #ff5733; font-weight: bold;">Crear Nou Usuari</h1>

        <form action="{{ route('users.manage.store') }}" method="POST" class="mx-auto" style="max-width: 600px;">
            @csrf

            <!-- Camp Nom -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Nom:</label>
                <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required data-qa="input-name">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Camp Email -->
            <div class="form-group mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required data-qa="input-email">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Camp Contrasenya -->
            <div class="form-group mb-3">
                <label for="password" class="form-label">Contrasenya:</label>
                <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required data-qa="input-password">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <!-- Camp Confirmar Contrasenya -->
            <div class="form-group mb-3">
                <label for="password_confirmation" class="form-label">Confirma la Contrasenya:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required data-qa="input-password-confirmation">
            </div>

            <!-- Camp Rol -->
            <div class="form-group mb-4">
                <label for="role" class="form-label">Selecciona un rol:</label>
                <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required data-qa="select-role">
                    <option value="" disabled selected>Selecciona un rol</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }} data-qa="option-role-{{ $role->name }}">{{ ucfirst($role->name) }}</option>
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
                <button type="submit" class="btn btn-success" style="background: linear-gradient(45deg, #28a745, #218838); color: white; padding: 10px 20px; border-radius: 25px; font-weight: bold; transition: all 0.3s ease-in-out;" data-qa="button-submit">
                    Crear Usuari
                </button>
            </div>
        </form>
    </div>
</x-videos-app-layout>
