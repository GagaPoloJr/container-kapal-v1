<div>
    <x-innerpage-layout>
        @section('title', 'Roles Access')
        <x-slot name="header">
            <x-slot name="title">
                {{ __('Roles') }}
            </x-slot>

            <x-slot name="subtitle">
                {{ __('Tambah Access Permission') }} {{ $role->name }}
            </x-slot>
        </x-slot>
        <div class="row row-cards">
            <x-form-custom csrf action="{{ route('roles.store-permissions',$role) }}" method="POST">
                <x-slot name="title">
                    {{ __('General Information') }}
                </x-slot>

                <x-slot name="description">
                    {{ __('Update your account\'s settings information.') }}

                </x-slot>

                <x-slot name="form">
                    <div class="form-group mb-5">
                        <label class="font-bold">Permissions:</label>
                        <label class="form-check">
                            <input id="check-all-checkbox" class="form-check-input" type="checkbox">
                            <span class="form-check-label">Check All</span>
                        </label>
                        @foreach($groupedPermissions as $group => $permissions)
                        <div class="border p-5 rounded-md mt-4">
                            <h4 class="font-semibold">{{ $group }}</h4>

                            <label class="form-check">
                                <input data-group="{{ $group }}" class="group-checkbox form-check-input" type="checkbox">
                                <span class="form-check-label">Check All</span>
                            </label>
                            <div class="checkbox-item-wrapper flex flex-wrap items-center mt-2">
                                @foreach($permissions as $permission)
                                <div class="mr-5">

                                    <label for="permission_{{ $permission->id }}" class="form-check">
                                        <input @if(in_array($permission->id, $checkedPermissions)) checked @endif id="permission_{{ $permission->id }}" name="permissions[]" value="{{ $permission->id }}" class="permission-checkbox group-{{ $group }} form-check-input" type="checkbox">
                                        <span class="form-check-label">{{ $permission->name }}</span>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>

                </x-slot>
                <x-slot name="actions">
                    <x-button-cst> {{ __('Grant Access') }}</x-button-cst>
                    <x-button-cst btnColor="secondary" typeBtn="link" href="{{ route('roles') }}" class="ml-5">Cancel</x-button-cst>
                </x-slot>

            </x-form-custom>

        </div>


    </x-innerpage-layout>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let groupCheckboxes = document.querySelectorAll('.group-checkbox');
        groupCheckboxes.forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                let groupName = this.getAttribute('data-group');
                let permissionCheckboxes = document.querySelectorAll('.permission-checkbox.group-' + groupName);

                permissionCheckboxes.forEach(function(permissionCheckbox) {
                    permissionCheckbox.checked = checkbox.checked;
                });

                updateCheckAllCheckbox();
            });
        });

        // Add event listeners to permission checkboxes
        let permissionCheckboxes = document.querySelectorAll('.permission-checkbox');
        permissionCheckboxes.forEach(function(permissionCheckbox) {
            permissionCheckbox.addEventListener('change', function() {
                updateCheckAllCheckbox();
            });
        });

        // Add event listener to "Check All" checkbox
        let checkAllCheckbox = document.getElementById('check-all-checkbox');
        if (checkAllCheckbox) {
            checkAllCheckbox.addEventListener('change', function() {
                let allPermissionCheckboxes = document.querySelectorAll('.permission-checkbox');
                allPermissionCheckboxes.forEach(function(permissionCheckbox) {
                    permissionCheckbox.checked = checkAllCheckbox.checked;
                });

                // Uncheck all group checkboxes when "Check All" is unchecked
                if (!checkAllCheckbox.checked) {
                    groupCheckboxes.forEach(function(groupCheckbox) {
                        groupCheckbox.checked = false;
                    });
                }
            });
        }

        // Function to update the state of the "Check All" checkbox
        function updateCheckAllCheckbox() {
            let allPermissionCheckboxes = document.querySelectorAll('.permission-checkbox');
            let checkAllCheckbox = document.getElementById('check-all-checkbox');

            let allChecked = true;

            allPermissionCheckboxes.forEach(function(permissionCheckbox) {
                if (!permissionCheckbox.checked) {
                    allChecked = false;
                }
            });

            checkAllCheckbox.checked = allChecked;
        }


    })

</script>
