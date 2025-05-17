<x-videos-app-layout>
    <div class="container py-5">

        <!-- Botó flotant per crear nova sèrie -->
        @auth
            <a href="{{ route('series.manage.create') }}" class="fab" title="Crear nova sèrie">
                +
            </a>
        @endauth

        <h1 class="mb-4 text-center">Llista de Sèries</h1>

        <!-- Formulari de cerca -->
        <form method="GET" action="{{ route('series.index') }}" class="mb-5 d-flex justify-content-center">
            <div class="input-group w-100 col-12 col-md-6" style="max-width: 600px;">
                <input type="text"
                       name="search"
                       class="form-control @error('search') is-invalid @enderror"
                       placeholder="Cerca per títol..."
                       value="{{ request()->get('search') }}"
                       data-qa="input-search"
                >
                <button type="submit" class="btn-primary-custom" data-qa="button-search">
                    🔍 Cercar
                </button>
            </div>
        </form>

        <!-- Taula de sèries -->
        <div class="custom-card p-4">
            <div class="table-responsive">
                <table class="table table-hover text-center w-100" style="min-width: 600px;">
                    <thead style="background: linear-gradient(45deg, var(--primary-color), var(--primary-hover)); color: white;">
                    <tr>
                        <th>Títol</th>
                        <th>Descripció</th>
                        <th>Data de Creació</th>
                        <th>Accions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($series as $serie)
                        <tr style="background-color: var(--card-bg); color: var(--text-primary); height: 70px;">
                            <td class="align-middle">{{ $serie->title }}</td>
                            <td class="align-middle">{{ $serie->description }}</td>
                            <td class="align-middle">{{ $serie->getFormattedCreatedAtAttribute() }}</td>
                            <td class="align-middle">
                                <a href="{{ route('series.show', $serie->id) }}"
                                   class="btn-primary-custom btn-sm"
                                   style="border-radius: 20px; font-size: 14px;"
                                   data-qa="button-view-details">
                                    🔍 Veure Vídeos
                                </a>
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

    <!-- Estils específics -->
    <style>
        .fab {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background-color: #28a745;
            color: white;
            font-size: 32px;
            font-weight: bold;
            border-radius: 50%;
            text-align: center;
            line-height: 60px;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s ease, transform 0.2s ease;
            z-index: 999;
        }

        .fab:hover {
            background-color: #218838;
            transform: scale(1.05);
        }
    </style>
</x-videos-app-layout>
