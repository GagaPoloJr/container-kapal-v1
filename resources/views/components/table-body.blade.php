@props(['items', 'columns', 'page', 'perPage', 'isModalEdit' => false, 'isCustomButton' => false])

<tbody>
    @if ($items->isEmpty())
        <tr class="text-center">
            <td class="p-5 border text-sm" :colspan="{{ count($columns) + 1 }}">No Data Displayed</td>
        </tr>
    @endif
    @foreach($items as $key => $item)
    <x-table-row :isCustomButton="$isCustomButton" :isModalEdit="$isModalEdit" :item="$item" :columns="$columns" :key="$key" :page="$page" :perPage="$perPage" />
    @endforeach

</tbody>
