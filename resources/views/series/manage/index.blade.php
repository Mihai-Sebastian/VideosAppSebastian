<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center" style="color: #ff5733; font-weight: bold;">Gestió de Sèries</h1>

        <a href="{{ route('series.manage.create') }}" class="btn" style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white; font-weight: bold; border-radius: 5px; padding: 10px 20px;" data-qa="create-series-btn">Nova Sèrie</a>

        <div class="table-responsive mt-4" style="overflow-x: auto;">
            <div class="card-body p-4">
                <div style="overflow-x: auto;">
                    <table class="table table-hover text-center w-100" style="min-width: 600px;">
                        <thead style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white;">
                        <tr>
                            <th>Títol</th>
                            <th>Descripció</th>
                            <th>Data de Publicació</th>
                            <th>Accions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($series as $serie)
                            <tr style="background: #282828; color: white; height: 70px;">
                                <td class="align-middle">{{ $serie->title }}</td>
                                <td class="align-middle">{{ $serie->description }}</td>
                                <td class="align-middle">{{ $serie->formatted_created_at }}</td>
                                <td class="align-middle">
                                    <a href="{{ route('series.manage.edit', $serie->id) }}" class="btn btn-sm" style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white; border-radius: 20px; padding: 6px 12px; font-weight: bold; transition: 0.3s; font-size: 14px;" data-qa="edit-series-btn">Editar</a>
                                    <a href="{{ route('series.manage.delete', $serie->id) }}" class="btn btn-sm" style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white; border-radius: 20px; padding: 6px 12px; font-weight: bold; transition: 0.3s; font-size: 14px;" data-qa="delete-series-btn">Eliminar</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $series->links() }}
        </div>
    </div>
</x-videos-app-layout>
