@props(['typeBtn' => 'submit', 'href' => null, 'btnColor'])


@php
    $id = $id ?? md5($attributes->wire('model'));

    $btnColor = [
        'primary' => 'btn-primary',
        'secondary' => 'btn-secondary',
        'warning' => 'btn-warning',
        'success' => 'btn-success',
        'dark' => 'btn-dark',
        'danger' => 'btn-danger',
        'info' => 'btn-info',
        'light' => 'btn-light',
    ][$btnColor ?? 'primary'];
@endphp


@if ($typeBtn === 'link')
    <a href="{{ $href }}"
        {{ $attributes->merge(['class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </a>
@else
    <button class="btn {{ $btnColor }}" {{ $attributes->merge(['type' => 'submit', 'class' => 'btn']) }}>
        {{ $slot }}
    </button>
@endif
