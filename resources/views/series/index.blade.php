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

        <!-- Llista de targetes per a sèries -->
        <div class="row g-4">
            @forelse ($series as $serie)
                <div class="col-12 col-md-6 col-lg-4">
                    <x-card :title="$serie->title" icon="fas fa-film">
                        <p><strong>Descripció:</strong> {{ $serie->description }}</p>
                        <p><strong>Data:</strong> {{ $serie->getFormattedCreatedAtAttribute() }}</p>
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('series.show', $serie->id) }}" class="btn-primary-custom btn-sm">
                                🔍 Veure Vídeos
                            </a>
                        </div>
                    </x-card>
                </div>
            @empty
                <div class="text-center text-muted py-4">
                    <i class="fas fa-info-circle me-2"></i>No s'han trobat sèries.
                </div>
            @endforelse
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
