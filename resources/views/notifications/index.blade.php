<x-videos-app-layout>
    <div class="container py-5">
        <h1 class="mb-4 text-center">Notificacions <span class="badge-custom">{{ $notifications->count() }}</span></h1>

        <div class="custom-card">
            <div class="card-header-custom">
                <h5 class="mb-0">
                    <i class="fas fa-bell me-2"></i>Les teves notificacions
                </h5>
            </div>

            <div class="card-body-custom">
                @forelse ($notifications as $notification)
                    <div class="notification-box mb-3 p-3 rounded d-flex flex-column flex-md-row align-items-start gap-3 border border-light-subtle">
                        <div class="notification-icon">
                            <i class="fas fa-video"></i>
                        </div>
                        <div class="notification-details w-100">
                            <div class="d-flex justify-content-between flex-wrap">
                                <div class="notification-title mb-2">
                                    Nou vídeo creat: <strong>{{ $notification->data['title'] }}</strong>
                                </div>
                                <div class="notification-time text-secondary small">
                                    <i class="fas fa-clock me-1"></i>{{ $notification->created_at->format('d/m/Y H:i') }}
                                </div>
                            </div>
                            <div class="notification-actions">
                                <a href="{{ $notification->data['url'] }}"
                                   class="btn-primary-custom btn-sm"
                                   data-qa="notification-link-{{ $notification->id }}">
                                    <i class="fas fa-play-circle me-1"></i>Veure vídeo
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="fas fa-bell-slash fs-1 mb-3 text-muted"></i>
                        <p class="text-muted">No tens notificacions disponibles.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <style>
        .notification-box {
            background-color: var(--card-bg);
            border: 1px solid rgba(255, 255, 255, 0.05);
            transition: background-color 0.3s ease;
        }

        .notification-box:hover {
            background-color: rgba(255, 255, 255, 0.03);
        }

        .notification-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary-color), var(--primary-hover));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            flex-shrink: 0;
        }

        .notification-title {
            font-weight: 500;
            color: var(--text-primary);
        }

        .notification-title strong {
            color: var(--primary-color);
        }

        .notification-actions .btn-sm {
            padding: 6px 12px;
            font-size: 0.875rem;
            margin-top: 5px;
        }

        .badge-custom {
            background: linear-gradient(45deg, var(--primary-color), var(--primary-hover));
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 500;
            color: white;
        }
    </style>
</x-videos-app-layout>
