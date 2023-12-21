@props(['id', 'maxWidth'])

@php
    $id = $id ?? md5($attributes->wire('model'));

    $maxWidth = [
        'sm' => 'modal-sm',
        'md' => 'modal-md',
        'lg' => 'modal-lg',
        'xl' => 'modal-xl',
        '2xl' => 'modal-2xl',
    ][$maxWidth ?? '2xl'];
@endphp

<div x-data="{ show: @entangle($attributes->wire('model')) }" x-on:close.stop="show = false" x-on:keydown.escape.window="show = false" x-show="show"
    id="{{ $id }}" class="modal modal-blur fade" tabindex="-1" aria-labelledby="{{ $id }}Label"
    aria-hidden="true" role="dialog" x-bind:class="{ 'show': show, 'fade': show }"
    x-bind:style="{ display: show ? 'block' : 'none' }">

    <div x-show="show" x-trap.inert.noscroll="show" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class=" modal-dialog {{ $maxWidth }} modal-lg" role="document">
        <div class="modal-content">
            {{ $slot }}
        </div>
    </div>
</div>
