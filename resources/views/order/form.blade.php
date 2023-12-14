<x-app-layout>

    <x-breadcrumb-header title="{{ __('Order') }}">
        <li class="breadcrumb-item">
            <a class="text-muted text-decoration-none" href="{{ route('order.index') }}">
                {{ __('Order') }}
            </a>
        </li>
        <li class="breadcrumb-item" aria-current="page">{{ __('Create') }}</li>
    </x-breadcrumb-header>


    <livewire:order />

</x-app-layout>
