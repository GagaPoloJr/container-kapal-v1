@props(['selectedItem', 'value_id', 'modelValue', 'placeholder'])
@php
    $errorClass = $errors->has($attributes->get('wire:model')) ? 'is-invalid' : '';
   
@endphp

<div>
    <input hidden type="text" wire:model="{{ $modelValue }}" name="{{ $modelValue }}" value="{{ $value_id }}">
    <button wire:click="toggleDropdown" style="width:100%;text-align:left;z-index:51;padding-bottom:5px;padding-top:5px;" type="button" {!! $attributes->merge(['class' => 'btn btn-outline-secondary d-block position-relative btn-search']) !!}>
        <span class="d-flex justify-content-between  align-items-center">
            {{ $value_id ? collect($searchOptions)->firstWhere('id', $value_id)['nama'] : $placeholder }}

            @if($isDropdownVisible)
            <x-heroicon-s-chevron-down class="w-4 h-4 p-1  float-right" />
            @else
            <x-heroicon-s-chevron-up class="w-4 h-4 p-1  float-right" />
            @endif
        </span>
    </button>
    @if($isDropdownVisible)
    <div class="card-wrapper">
        <div>
            <input wire:model.live.debounce.500ms="inputSearch" class="form-control" type="text" placeholder="search..." />
        </div>
        <div class="dropdown-select">
            @if(count($searchOptions) > 0)
            <ul class="list-group">
                @foreach($searchOptions as $option)
                <li class="list-group-item list-group-item-action">
                    <span
                    @if($value_id == $option['id'])
        class="selected"
    @endif
                    wire:key="{{ $option['id'] }}" wire:click="selectOption({{$option['id']}}, '{{ $option['nama'] }}')">
                        {{$option['nama']}}
                    </span>
                </li>
                @endforeach
            </ul>
            @else
            <li class="list-group-item">Found nothing...</li>
            @endif
        </div>
        {{-- <div class="dropdown-select" x-data="{ selectedItem: '{{ $selectedItem->nama }}' }" x-init="selectItemOnInit">
        @if(count($searchsuppliers) > 0)
        <ul class="list-group">
            @foreach($searchsuppliers as $searchsupplier)
            <li class="list-group-item list-group-item-action">
                <span data-id="{{ $searchsupplier['id'] }}" wire:key="{{ $searchsupplier['id'] }}" x-on:click="selectedItem = '{{ $searchsupplier['nama'] }}'; $wire.selectOption({{$searchsupplier['id']}}, '{{ $searchsupplier['nama'] }}')" :class="{ 'selected': selectedItem === '{{ $searchsupplier['nama'] }}' }">
                    {{ $searchsupplier['nama'] }}
                </span>
            </li>
            @endforeach
        </ul>
        @else
        <li class="list-group-item">Found nothing...</li>
        @endif
    </div> --}}


</div>
@endif

</div>






{{--
 <div x-data="{ isDropdownVisible: false }">
    <button @click="isDropdownVisible = !isDropdownVisible" style="width:100%;text-align:left;z-index:51" type="button" class="btn btn-outline-secondary d-block position-relative btn-search">
        <span class="d-flex justify-content-between  align-items-center">
            {{ $value ?? 'Pilih Penerima' }}

@if($isDropdownVisible)
<x-heroicon-s-chevron-down class="w-4 h-4 p-1  float-right" />
@else
<x-heroicon-s-chevron-up class="w-4 h-4 p-1  float-right" />
@endif
</span>
</button>

<div x-show="isDropdownVisible" @dropdown-toggled.window="isDropdownVisible = $event.detail.isVisible" @click.away="isDropdownVisible = false" class="card-wrapper">

    <div>
        <input wire:model.live.debounce.500ms="inputSearch" class="form-control" type="text" placeholder="search..." />
    </div>
    <div class="dropdown-select">
        @if(count($searchsuppliers) > 0)
        <ul class="list-group">
            @foreach($searchsuppliers as $searchsupplier)
            <li class="list-group-item list-group-item-action">
                <span wire:key="{{ $searchsupplier['id'] }}" wire:click="selectOption({{$searchsupplier['id']}}, '{{ $searchsupplier['nama'] }}')">
                    {{$searchsupplier['nama']}}
                </span>
            </li>
            @endforeach
        </ul>
        @else
        <li class="list-group-item">Found nothing...</li>
        @endif
    </div>
</div>
</div> --}}
