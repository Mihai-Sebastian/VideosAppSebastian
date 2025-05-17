<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center">Editar Usuari</h1>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="custom-card">
                    <div class="card-header-custom">
                        <h5 class="mb-0">
                            <i class="fas fa-user-edit me-2"></i>Formulari d'Edició
                        </h5>
                    </div>
                    <div class="card-body-custom">
                        <form action="{{ route('users.manage.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Nom -->
                            <div class="mb-4">
                                <label for="name" class="form-label">Nom:</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="fas fa-user text-muted"></i>
                                    </span>
                                    <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        class="form-control border-start-0 @error('name') is-invalid @enderror"
                                        value="{{ old('name', $user->name) }}"
                                        required
                                    >
                                </div>
                                @error('name')
                                <div class="invalid-feedback d-block mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-4">
                                <label for="email" class="form-label">Email:</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="fas fa-envelope text-muted"></i>
                                    </span>
                                    <input
                                        type="email"
                                        name="email"
                                        id="email"
                                        class="form-control border-start-0 @error('email') is-invalid @enderror"
                                        value="{{ old('email', $user->email) }}"
                                        required
                                    >
                                </div>
                                @error('email')
                                <div class="invalid-feedback d-block mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Contrasenya -->
                            <div class="mb-4">
                                <label for="password" class="form-label">
                                    Contrasenya:
                                    <small class="text-muted">(deixa buit per mantenir la mateixa)</small>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control border-start-0 @error('password') is-invalid @enderror"
                                    >
                                </div>
                                @error('password')
                                <div class="invalid-feedback d-block mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Confirmar contrasenya -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirma la Contrasenya:</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input
                                        type="password"
                                        name="password_confirmation"
                                        id="password_confirmation"
                                        class="form-control border-start-0"
                                    >
                                </div>
                            </div>

                            <!-- Rol -->
                            <div class="mb-4">
                                <label for="role" class="form-label">Rol:</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="fas fa-user-tag text-muted"></i>
                                    </span>
                                    <select
                                        name="role"
                                        id="role"
                                        class="form-select border-start-0 @error('role') is-invalid @enderror"
                                        required
                                    >
                                        @foreach ($roles as $role)
                                            <option
                                                value="{{ $role->name }}"
                                                {{ old('role', $user->roles->first()->name ?? '') === $role->name ? 'selected' : '' }}
                                            >
                                                {{ ucfirst($role->name) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('role')
                                <div class="invalid-feedback d-block mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Accions -->
                            <div class="d-flex justify-content-between mt-5">
                                <a href="{{ route('users.manage.index') }}" class="btn-secondary-custom">
                                    <i class="fas fa-arrow-left me-2"></i>Tornar
                                </a>
                                <button type="submit" class="btn-warning-custom">
                                    <i class="fas fa-save me-2"></i>Desar Canvis
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-videos-app-layout>
