<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center">Crear Nou Usuari</h1>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="custom-card">
                    <div class="card-header-custom">
                        <h5 class="mb-0"><i class="fas fa-user-plus me-2"></i>Formulari de Creació</h5>
                    </div>
                    <div class="card-body-custom">
                        <form action="{{ route('users.manage.store') }}" method="POST">
                            @csrf

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
                                        value="{{ old('name') }}"
                                        required
                                        placeholder="Introdueix el nom de l'usuari"
                                        data-qa="input-name"
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
                                        value="{{ old('email') }}"
                                        required
                                        placeholder="exemple@correu.com"
                                        data-qa="input-email"
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
                                <label for="password" class="form-label">Contrasenya:</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="fas fa-lock text-muted"></i>
                                    </span>
                                    <input
                                        type="password"
                                        name="password"
                                        id="password"
                                        class="form-control border-start-0 @error('password') is-invalid @enderror"
                                        required
                                        placeholder="Introdueix la contrasenya"
                                        data-qa="input-password"
                                    >
                                </div>
                                @error('password')
                                <div class="invalid-feedback d-block mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                                @enderror
                            </div>

                            <!-- Confirmació Contrasenya -->
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
                                        required
                                        placeholder="Confirma la contrasenya"
                                        data-qa="input-password-confirmation"
                                    >
                                </div>
                            </div>

                            <!-- Rol -->
                            <div class="mb-4">
                                <label for="role" class="form-label">Selecciona un rol:</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0">
                                        <i class="fas fa-user-tag text-muted"></i>
                                    </span>
                                    <select
                                        name="role"
                                        id="role"
                                        class="form-select border-start-0 @error('role') is-invalid @enderror"
                                        required
                                        data-qa="select-role"
                                    >
                                        <option value="" disabled {{ old('role') ? '' : 'selected' }}>
                                            Selecciona un rol
                                        </option>
                                        @foreach ($roles as $role)
                                            <option
                                                value="{{ $role->name }}"
                                                {{ old('role') === $role->name ? 'selected' : '' }}
                                                data-qa="option-role-{{ $role->name }}"
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

                            <!-- Botó Crear -->
                            <div class="text-center mt-5">
                                <button
                                    type="submit"
                                    class="btn-primary-custom"
                                    data-qa="button-submit"
                                >
                                    <i class="fas fa-user-plus me-2"></i>Crear Usuari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-videos-app-layout>
