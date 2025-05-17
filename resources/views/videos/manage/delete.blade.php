<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center text-danger">Eliminar Vídeo</h1>

        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="custom-card">
                    <div class="card-header-custom">
                        <h5 class="mb-0">
                            <i class="fas fa-trash-alt me-2"></i>Confirmació d'Eliminació
                        </h5>
                    </div>
                    <div class="card-body-custom">
                        <p class="mb-4 text-center">
                            Estàs segur que vols eliminar el vídeo <strong>{{ $video->title }}</strong>?
                        </p>

                        <form action="{{ route('videos.manage.destroy', $video->id) }}" method="POST" class="text-center">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn-danger-custom me-2"
                                    data-qa="confirm-delete-video-btn">
                                <i class="fas fa-trash me-1"></i> Sí, eliminar
                            </button>

                            <a href="{{ route('videos.manage.index') }}"
                               class="btn-secondary-custom"
                               data-qa="cancel-delete-video-btn">
                                Cancel·lar
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-videos-app-layout>
