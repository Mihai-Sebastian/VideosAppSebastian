<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="text-center text-danger mb-4">Eliminar Usuari</h1>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="custom-card">
                    <div class="card-header-custom bg-danger text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-exclamation-triangle me-2"></i>Confirmació d'Eliminació
                        </h5>
                    </div>
                    <div class="card-body-custom text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-user-times text-danger" style="font-size: 4rem;"></i>
                        </div>

                        <h4 class="mb-4">Estàs segur que vols eliminar l'usuari?</h4>

                        <div class="alert alert-warning mb-4 text-start">
                            <div class="d-flex align-items-start gap-3">
                                <i class="fas fa-info-circle fs-4 mt-1 text-warning"></i>
                                <div>
                                    <p class="mb-1"><strong>Nom:</strong> {{ $user->name }}</p>
                                    <p class="mb-1"><strong>Email:</strong> {{ $user->email }}</p>
                                    <p class="mb-0 text-danger fw-semibold">Aquesta acció no es pot desfer.</p>
                                </div>
                            </div>
                        </div>

                        <form action="{{ route('users.manage.destroy', $user->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="d-flex justify-content-center gap-3">
                                <a href="{{ route('users.manage.index') }}" class="btn-secondary-custom">
                                    <i class="fas fa-times me-2"></i>Cancel·lar
                                </a>
                                <button type="submit" class="btn-danger-custom">
                                    <i class="fas fa-trash-alt me-2"></i>Eliminar Usuari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card-header-custom.bg-danger {
            background: linear-gradient(45deg, #e74c3c, #c0392b) !important;
        }

        .alert-warning {
            background-color: rgba(255, 193, 7, 0.1);
            border: 1px solid rgba(255, 193, 7, 0.2);
            color: var(--text-primary);
            border-radius: var(--border-radius);
        }
    </style>
</x-videos-app-layout>
