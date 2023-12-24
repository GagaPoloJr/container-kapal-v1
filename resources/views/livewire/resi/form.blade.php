<div>
    <button wire:click="addFormField">Add Field</button>

    @foreach ($formFields as $field)
    <div>
        <!-- Your form fields go here -->
        <input type="text" wire:model="formFields.{{ $loop->index }}.value">

        <button wire:click="removeFormField('{{ $field['id'] }}')">Remove</button>
    </div>
    @endforeach

</div>
