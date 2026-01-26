@props([
    'label' => null,
    'name',
    'options' => [],
    'required' => false,
    'value' => null,
])

@php
    $value = old($name, $value);
@endphp

<div class="mb-3 w-100">


    @if($label)
        <label for="{{ $name }}" class="form-label fw-semibold">
            {{ $label }}
            @if($required)
                <span class="text-danger">*</span>
            @endif
        </label>
    @endif

   
    <select
        name="{{ $name }}"
        id="{{ $name }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes->merge(['class' => 'form-control']) }}
    >
        <option value="">Selecciona una opción</option>

        @foreach ($options as $key => $text)
            <option value="{{ $key }}" {{ $value == $key ? 'selected' : '' }}>
                {{ $text }}
            </option>
        @endforeach
    </select>

    
    @error($name)
        <div class="text-danger mt-1" style="font-size: 0.9rem;">
            {{ $message }}
        </div>
    @enderror

</div>
