<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center text-danger">Eliminar Sèrie: {{ $serie->title }}</h1>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="custom-card">
                    <div class="card-header-custom bg-danger text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-exclamation-triangle me-2"></i>Confirmació d'Eliminació
                        </h5>
                    </div>
                    <div class="card-body-custom text-center">
                        <form action="{{ route('series.manage.destroy', $serie->id) }}" method="POST" data-qa="delete-series-form">
                            @csrf
                            @method('DELETE')

                            <!-- Input ocult per defecte si el checkbox no es marca -->
                            <input type="hidden" name="remove_videos" value="0">

                            <p class="mb-4">
                                Estàs segur que vols eliminar aquesta sèrie? <br>
                                Aquesta acció pot eliminar també els vídeos associats,
                                a menys que decideixis només desassignar-los.
                            </p>

                            <!-- Checkbox per desassignar en comptes d'eliminar -->
                            <div class="form-check form-switch d-flex justify-content-center mb-4">
                                <input type="checkbox"
                                       name="remove_videos"
                                       id="remove-videos"
                                       value="1"
                                       class="form-check-input me-2"
                                       style="cursor: pointer;">
                                <label for="remove-videos" class="form-check-label">
                                    Desassignar els vídeos de la sèrie (no eliminar-los)
                                </label>
                            </div>

                            <!-- Botons d'acció -->
                            <div class="d-flex justify-content-center gap-3 mt-4">
                                <a href="{{ route('series.manage.index') }}" class="btn-secondary-custom">
                                    <i class="fas fa-arrow-left me-2"></i>Cancel·lar
                                </a>
                                <button type="submit" class="btn-danger-custom" data-qa="submit-delete-btn">
                                    <i class="fas fa-trash-alt me-2"></i>Eliminar Sèrie
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-videos-app-layout>
