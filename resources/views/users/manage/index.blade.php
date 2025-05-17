<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center">Gestió d'Usuaris</h1>

        <!-- Botó Afegir Usuari -->
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('users.manage.create') }}"
               class="btn-primary-custom"
               data-qa="create-user-btn">
                <i class="fas fa-user-plus me-2"></i>Afegir Usuari
            </a>
        </div>

        <!-- Taula d'Usuaris -->
        <div class="custom-card">
            <div class="card-header-custom">
                <h5 class="mb-0"><i class="fas fa-users me-2"></i>Llistat d'Usuaris</h5>
            </div>
            <div class="card-body-custom p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th class="text-center">Accions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td class="ps-4">{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Botó Editar -->
                                        <a href="{{ route('users.manage.edit', $user->id) }}"
                                           class="btn-warning-custom btn-sm"
                                           data-qa="edit-user-{{ $user->id }}">
                                            <i class="fas fa-edit me-1"></i>Editar
                                        </a>

                                        <!-- Botó Eliminar (redirigeix a vista de confirmació) -->
                                        <a href="{{ route('users.manage.delete', $user->id) }}"
                                           class="btn-danger-custom btn-sm"
                                           data-qa="delete-user-{{ $user->id }}">
                                            <i class="fas fa-trash-alt me-1"></i>Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <i class="fas fa-info-circle me-2 text-muted"></i>
                                    <span class="text-muted">No hi ha usuaris disponibles.</span>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Paginació -->
        @if(isset($users) && method_exists($users, 'links'))
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>

    <!-- Estils específics per a la taula -->
    <style>
        .table {
            color: var(--text-primary);
            margin-bottom: 0;
        }

        .table thead {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-hover));
        }

        .table thead th {
            color: white;
            font-weight: 600;
            border: none;
            padding: 15px;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .table tbody tr {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            transition: background-color var(--transition-speed) ease;
        }

        .table tbody tr:hover {
            background-color: rgba(255, 255, 255, 0.03);
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border: none;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 0.85rem;
        }
    </style>
</x-videos-app-layout>
