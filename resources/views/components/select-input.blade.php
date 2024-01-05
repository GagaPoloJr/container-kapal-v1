@props(['options', 'selectedItem'])


<div x-data="{ show: @entangle($attributes->wire('model')) }" x-on:close.stop="show = false" x-on:keydown.escape.window="show = false" x-show="show" @click.away="isDropdownVisible = false" class="card-wrapper">
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
