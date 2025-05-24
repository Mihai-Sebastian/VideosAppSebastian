@props(['title', 'icon' => null, 'image' => null])

<div class="custom-card p-4 mb-4" style="box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); border-radius: 12px;">
    @if($image)
        <div style="margin: -16px -16px 16px -16px; overflow: hidden; border-top-left-radius: 12px; border-top-right-radius: 12px;">
            <img src="{{ $image }}" alt="Imatge per {{ $title }}" style="width: 100%; height: auto; object-fit: cover;">
        </div>
    @endif

    <h5 class="mb-3 d-flex align-items-center">
        @if($icon)
            <i class="{{ $icon }} me-2"></i>
        @endif
        {{ $title }}
    </h5>
    <div>
        {{ $slot }}
    </div>
</div>
