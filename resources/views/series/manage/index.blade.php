<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center">Gestió de Sèries</h1>

        <div class="mb-4">
            <a href="{{ route('series.manage.create') }}" class="btn-primary-custom text-uppercase" data-qa="create-series-btn">
                <i class="fas fa-plus me-2"></i>Nova Sèrie
            </a>
        </div>

        <div class="custom-card p-4">
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
                                    <a href="{{ route('series.manage.edit', $serie->id) }}"
                                       class="btn-warning-custom btn-sm"
                                       data-qa="edit-series-btn">
                                        <i class="fas fa-edit me-1"></i>Editar
                                    </a>

                                    <a href="{{ route('series.manage.delete', $serie->id) }}"
                                       class="btn-danger-custom btn-sm"
                                       data-qa="delete-series-btn">
                                        <i class="fas fa-trash-alt me-1"></i>Eliminar
                                    </a>
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

        <!-- Paginació -->
        <div class="d-flex justify-content-center mt-4">
            {{ $series->links() }}
        </div>
    </div>
</x-videos-app-layout>
