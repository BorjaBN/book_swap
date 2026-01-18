@props([
    'label' => null,
    'name',
    'type' => 'text',
    'value' => '',
    'required' => false,
])

<div class="mb-3 w-100">

    {{-- Label --}}
    @if($label)
        <label for="{{ $name }}" class="form-label fw-semibold">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

    {{-- Input --}}
    <input 
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-control']) }}
    >

    {{-- Error --}}
    @error($name)
        <div class="text-danger mt-1" style="font-size: 0.9rem;">
            {{ $message }}
        </div>
    @enderror

</div>
