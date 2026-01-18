@if($href)
    <a href="{{ $href }}" class="btn {{ $variant }}">
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" class="btn {{ $variant }}">
        {{ $slot }}
    </button>
@endif
