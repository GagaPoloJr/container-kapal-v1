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
    <a class="btn {{ $btnColor }}"  href="{{ $href }}"
        {{ $attributes->merge(['class' => 'btn ml-5']) }}>
        {{ $slot }}
    </a>
@else
    <button class="btn {{ $btnColor }}" {{ $attributes->merge(['type' => 'submit', 'class' => 'btn']) }}>
        {{ $slot }}
    </button>
@endif
