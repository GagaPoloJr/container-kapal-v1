{{-- <tr>
    <td><span class="text-muted">001401</span></td>
    <td><a href="invoice.html" class="text-reset" tabindex="-1">Design Works</a></td>
    <td>
        <span class="flag flag-country-us"></span>
        Carlson Limited
    </td>
    <td>
        87956621
    </td>
    <td>
        15 Dec 2017
    </td>
    <td>
        <span class="badge bg-success me-1"></span> Paid
    </td>
    <td>$887</td>
    <td class="text-end">
        <span class="dropdown">
            <button class="btn dropdown-toggle align-text-top" data-bs-boundary="viewport"
                data-bs-toggle="dropdown">Actions</button>
            <div class="dropdown-menu dropdown-menu-end">
                <a class="dropdown-item" href="#">
                    Action
                </a>
                <a class="dropdown-item" href="#">
                    Another action
                </a>
            </div>
        </span>
    </td>
</tr> --}}
@props(['item', 'key', 'page', 'perPage', 'columns', 'isModalEdit' => false, 'isCustomButton' => false])

<tr wire:key="{{ $item->id . $page }}">
    <td class="">{{ ++$key + $perPage * ($page - 1) }}.</td>
    @foreach ($columns as $column)
        <td>

            @if ($column['isData'])
                {!! $this->customFormat($column['column'], $item->{$column['column']}) !!}
            @else
                @if ($column['column'] === 'action')
                    <div class="flex gap-1 items-center justify-center">
                        @if ($isCustomButton)
                            <a href="{{ route('roles.access', $item->id) }}"
                                class="flex btn px-1 py-1 rounded-md bg-blue-100">
                                <x-heroicon-s-key class="w-4 h-4 p-1 text-blue-500" />
                            </a>
                        @elseif($isModalEdit)
                            <button  wire:loading.attr="disabled" wire:click="edit({{ $item->id }})"
                                class="flex btn px-1 py-1 rounded-md  text-bg-yellow">
                                <x-heroicon-s-pencil class="w-4 h-4 p-1 text-bg-yellow" />

                            </button>
                        @else
                            <a href="{{ route('resi.edit', $item->id) }}"
                                class="">
                                <x-heroicon-s-pencil class="w-4 h-4 p-1 text-bg-yellow" />
                            </a>
                        @endif
                        <button  wire:loading.attr="disabled" wire:click="deleteConfirmation({{ $item->id }})"
                            class="flex btn px-1 py-1 text-bg-red">
                            <x-heroicon-s-trash class="w-4 h-4 p-1 text-bg-red" />
                        </button>
                    </div>
                @endif
            @endif
        </td>

    @endforeach
</tr>
