<div>
    <x-innerpage-layout>
        @section('title', 'Users')
        <x-slot name="header">
            <x-slot name="title">
                {{ __('Users') }}
            </x-slot>

            <x-slot name="subtitle">
                {{ __('Manage All Users.') }}
            </x-slot>
            <x-slot name="action">
                {{-- modal action --}}
                <button wire:click="confirmCreate" wire:loading.attr="disabled" data-bs-toggle="modal" class="btn btn-primary d-none d-sm-inline-block">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                    Create new Role
                </button>
                <button wire:click="confirmCreate" wire:loading.attr="disabled" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal" data-bs-target="#modal-report" aria-label="Create new report">
                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                </button>
            </x-slot>
        </x-slot>
        @include('livewire.users.create')
        @include('livewire.users.delete')
        <div class="row row-cards">
            @if (session()->has('message'))

            <div class="alert alert-success bg-green alert-dismissible" role="alert">
                <div class="d-flex">
                    <div>
                        <h4 class="alert-title  text-white"> {{ session('message') }}</h4>
                    </div>
                </div>
                <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
            </div>
            @endif
            <div class="col-12">
                @php
                    $routesWeb= 'users.edit';
                @endphp
              
                <x-table  :columns="$columns" :page="$page" :perPage="$perPage" :items="$users" :sortColumn="$sortColumn" :sortDirection="$sortDirection" :routeWeb="$routesWeb">
                    <x-slot name="title">
                        {{ __('Users') }}
                    </x-slot>

                </x-table>
            </div>
        </div>
    </x-innerpage-layout>
</div>
