<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center">Gestió de Sèries</h1>

        <div class="mb-4">
            <x-button color="primary" href="{{ route('series.manage.create') }}" class="text-uppercase" data-qa="create-series-btn">
                <i class="fas fa-plus me-2"></i>Nova Sèrie
            </x-button>
        </div>

        <!-- TAULA per a escriptori -->
        <div class="custom-card p-4 d-none d-md-block">
            <div class="table-responsive">
                <table class="table table-hover text-center w-100" style="min-width: 600px;">
                    <thead style="background: linear-gradient(45deg, var(--primary-color), var(--primary-hover)); color: white;">
                    <tr>
                        <th>Títol</th>
                        <th>Descripció</th>
                        <th>Data de Publicació</th>
                        <th>Accions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($series as $serie)
                        <tr style="background-color: var(--card-bg); color: var(--text-primary); height: 70px;">
                            <td class="align-middle">{{ $serie->title }}</td>
                            <td class="align-middle">{{ $serie->description }}</td>
                            <td class="align-middle">{{ $serie->formatted_created_at }}</td>
                            <td class="align-middle">
                                <div class="d-flex justify-content-center gap-2">
                                    <x-button color="warning" href="{{ route('series.manage.edit', $serie->id) }}" class="btn-sm" data-qa="edit-series-btn">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </x-button>
                                    <x-button color="danger" href="{{ route('series.manage.delete', $serie->id) }}" class="btn-sm" data-qa="delete-series-btn">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </x-button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">
                                <i class="fas fa-info-circle me-2"></i>No s'han trobat sèries.
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- LLISTA per a mòbil -->
        <div class="d-block d-md-none">
            @forelse($series as $serie)
                <div class="custom-card mb-3">
                    <div class="card-body-custom">
                        <h5 class="mb-2"><i class="fas fa-video me-2"></i>{{ $serie->title }}</h5>
                        <p class="mb-1"><strong>Descripció:</strong> {{ $serie->description }}</p>
                        <p class="mb-2"><strong>Data:</strong> {{ $serie->formatted_created_at }}</p>
                        <div class="d-flex justify-content-end gap-2">
                            <x-button color="warning" href="{{ route('series.manage.edit', $serie->id) }}" class="btn-sm" data-qa="edit-series-mobile-{{ $serie->id }}">
                                <i class="fas fa-edit me-1"></i>Editar
                            </x-button>
                            <x-button color="danger" href="{{ route('series.manage.delete', $serie->id) }}" class="btn-sm" data-qa="delete-series-mobile-{{ $serie->id }}">
                                <i class="fas fa-trash-alt me-1"></i>Eliminar
                            </x-button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted my-4">
                    <i class="fas fa-info-circle me-2"></i>No s'han trobat sèries.
                </div>
            @endforelse
        </div>

        <!-- Paginació -->
        <div class="d-flex justify-content-center mt-4">
            {{ $series->links() }}
        </div>
    </div>
</x-videos-app-layout>
