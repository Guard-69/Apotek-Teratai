@props([
    'name',
    'label',
    'type' => 'text',
    'placeholder' => '',
    'hint' => null,
    'full' => false,
    'value' => null,
])

<div class="field {{ $full ? 'field-full' : '' }}">
    <label for="{{ $name }}">{{ $label }} <span class="req">*</span></label>
    <input
        id="{{ $name }}"
        name="{{ $name }}"
        type="{{ $type }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        class="@error($name) is-invalid @enderror"
        @error($name) aria-invalid="true" @enderror
        {{ $attributes }}
    >
    @if ($errors->has($name))
        <p class="error-text">{{ $errors->first($name) }}</p>
    @elseif ($hint)
        <p class="hint">{{ $hint }}</p>
    @endif
</div>
