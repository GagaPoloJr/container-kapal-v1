@props(['item', 'key', 'page', 'perPage', 'columns', 'isModalEdit' => false, 'isCustomButton' => false])

<tr wire:key="{{ $item->id . $page }}">
    <td class="">{{ ++$key + $perPage * ($page - 1) }}.</td>
    @foreach ($columns as $column)
    <td>
        @if ($column['isData'])
        {!! $this->customFormat($column['column'], $item->{$column['column']}) !!}
        @elseif ($column['column'] === 'action')
        <div class="flex gap-1 items-center justify-center">
            @if(($isCustomButton))
            <a href="{{ route('roles.access', $item->id) }}" class="flex btn px-1 py-1 rounded-md  text-bg-blue">
                <x-heroicon-s-key class="w-4 h-4 p-1 text-bg-blue" />
            </a>
            @endif
            @if($isModalEdit)
            <button wire:loading.attr="disabled" wire:click="edit({{ $item->id }})" class="flex btn px-1 py-1 rounded-md  text-bg-yellow">
                <x-heroicon-s-pencil class="w-4 h-4 p-1 text-bg-yellow" />
            </button>
            @else
            <a href="{{ route('resi.edit', $item->id) }}" class="">
                <x-heroicon-s-pencil class="w-4 h-4 p-1 text-bg-yellow" />
            </a>
            @endif
            <button wire:loading.attr="disabled" wire:click="deleteConfirmation({{ $item->id }})" class="flex btn px-1 py-1 text-bg-red">
                <x-heroicon-s-trash class="w-4 h-4 p-1 text-bg-red" />
            </button>
        </div>
        @endif
    </td>
    @endforeach
</tr>

