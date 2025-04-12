<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center" style="color: #ff5733; font-weight: bold;">Llista de Sèries</h1>

        <form method="GET" action="{{ route('series.index') }}" class="mb-5 d-flex justify-content-center">
            <div class="input-group shadow-sm rounded w-100 col-12 col-md-6" style="border: 2px solid #ff5733; padding: 8px; background: #f8f9fa; margin-bottom: 8px;">
                <input type="text" name="search" class="form-control border-0" placeholder="Cerca per títol..." value="{{ request()->get('search') }}" data-qa="input-search">
                <button type="submit" class="btn" style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white; font-weight: bold; border-radius: 5px;" data-qa="button-search">🔍 Cercar</button>
            </div>
        </form>

        <!-- Taula de sèries -->
        <div class="table-responsive mt-4" style="overflow-x: auto;">
            <div class="card-body p-4">
                <div style="overflow-x: auto;">
                    <table class="table table-hover text-center w-100" style="min-width: 600px;">
                        <thead style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white;">
                        <tr>
                            <th>Títol</th>
                            <th>Descripció</th>
                            <th>Data de Creació</th>
                            <th>Accions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($series as $serie)
                            <tr style="background: #282828; color: white; height: 70px;">
                                <td class="align-middle">{{ $serie->title }}</td>
                                <td class="align-middle">{{ $serie->description }}</td>
                                <td class="align-middle">{{ $serie->getFormattedCreatedAtAttribute() }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('series.show', $serie->id) }}" class="btn btn-sm" style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white; border-radius: 20px; padding: 6px 12px; font-weight: bold; transition: 0.3s; font-size: 14px;" data-qa="button-view-details">🔍 Veure Vídeos</a>
                                </td>
                            </tr>
                            <tr style="height: 6px;"></tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted">No s'han trobat sèries.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Paginació (si és necessari) -->
        <div class="d-flex justify-content-center mt-4">
            {{ $series->links() }}
        </div>
    </div>
</x-videos-app-layout>
