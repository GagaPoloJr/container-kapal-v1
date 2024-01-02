<div class="form-group row ">
    <label class="control-label col-md-3 col-sm-3 ">Supplier</label>
    <div class="col-md-9 col-sm-9 ">
        <div>
            <select wire:model="value_id" class="form-control" name="value_id" required>
                <option></option>
                @foreach($options as $supplier)
                <option value="{{$supplier->id}}">{{$supplier->nama}} : {{$supplier->kode}}</option>
                @endforeach
            </select>
        </div>

        <div style="position:relative">
            <input wire:model.live.debounce.500ms="inputSearch" class="form-control relative" type="text" placeholder="search..." />
        </div>
        <div style="position:absolute; z-index:100;cursor: pointer;">
            @if(strlen($inputSearch)>0)
            @if(count($searchsuppliers)>0)
            <ul class="list-group">
                @foreach($searchsuppliers as $searchsupplier)
                <li class="list-group-item list-group-item-action"><span wire:click="selectOption({{$searchsupplier->id}})">{{$searchsupplier->kode}} : {{$searchsupplier->nama}}</span></li>
                @endforeach
            </ul>
            @else
            <li class="list-group-item">Found nothing...</li>
            @endif
            @endif
        </div>
    </div>
</div>
