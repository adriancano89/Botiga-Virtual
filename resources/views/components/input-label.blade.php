@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-md text-black dark:text-white']) }}>
    {{ $value ?? $slot }}
</label>
