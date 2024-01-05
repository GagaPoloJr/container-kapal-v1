@props(['disabled' => false])
@php
    $errorClass = $errors->has($attributes->get('wire:model')) ? 'is-invalid' : '';
@endphp

<input {{ $disabled ? 'disabled' : '' }}  {!! $attributes->merge(['class' => 'form-control']) !!}>
