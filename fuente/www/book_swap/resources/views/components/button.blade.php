@if($href)
    <a href="{{ $href }}" class="btn {{ $variant }}" {{ $attributes }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" class="btn {{ $variant }}" {{ $attributes }}>
        {{ $slot }}
    </button>
@endif