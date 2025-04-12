<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center" style="color: #ff5733; font-weight: bold;">Eliminar Sèrie: {{ $serie->title }}</h1>

        <form action="{{ route('series.manage.destroy', $serie->id) }}" method="POST" data-qa="delete-series-form">
            @csrf
            @method('DELETE')

            <!-- Input ocult per enviar un valor per defecte si el checkbox no està marcat -->
            <input type="hidden" name="remove_videos" value="0">

            <div class="mt-3 d-flex justify-content-center gap-2">
                <div class="card-body p-4">
                    <p class="mb-4">Estàs segur que vols eliminar aquesta sèrie? Aquesta acció eliminarà també els vídeos associats a la sèrie, a menys que decideixis desassignar-los.</p>

                    <div class="mb-4">
                        <label for="remove-videos" class="inline-flex items-center">
                            <input type="checkbox" name="remove_videos" id="remove-videos" class="form-checkbox" value="1">
                            <span class="ml-2">Desassignar els vídeos de la sèrie (No eliminar-los)</span>
                        </label>
                    </div>

                    <button type="submit" class="btn" style="background: linear-gradient(45deg, #ff5733, #ff8c00); color: white; font-weight: bold; border-radius: 5px; padding: 10px 20px;" data-qa="submit-delete-btn">Eliminar Sèrie</button>
                    <a href="{{ route('series.manage.index') }}" class="btn btn-secondary" style="background: linear-gradient(45deg, #6c757d, #5a6268); color: white; padding: 10px 20px; border-radius: 25px; font-weight: bold; transition: all 0.3s ease-in-out;">Cancelar</a>
                </div>
            </div>
        </form>




    </div>
</x-videos-app-layout>
