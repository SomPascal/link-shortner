@php
    $name = $attributes->get('name');
    $id = $attributes->get('id', $name);
    $value = old($name);
    $label = $attributes->get('label');
@endphp

<label for="{{ $name }}" class="flex flex-col">
    <span>{{ $label }}</span>

    <input {{ $attributes->merge([
        'name' => $name,
        'id' => $id,
        'value' => $value,
        'class' => 'p-2 text-base rounded bg-zinc-500/10'
    ])->except('label') }} />

    @error($name)
        <span class="text-red-500">
            {{ $message }}
        </span>
    @enderror
</label>