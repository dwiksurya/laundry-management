<x-app-layout>

    <x-breadcrumb-header title="{{ __('Customer') }}">
        <li class="breadcrumb-item">
            <a class="text-muted text-decoration-none" href="{{ route('customer.index') }}">
                {{ __('Customer') }}
            </a>
        </li>
        <li class="breadcrumb-item" aria-current="page">{{ __('Create') }}</li>
    </x-breadcrumb-header>

    <div class="card card-body">
        <form action="{{ isset($customer) ? route('customer.update', $customer->id) : route('customer.store') }}" method="POST">
            @isset($customer)
                @method('PUT')
            @endisset
            @csrf

            <div class="mb-3 row">
                <x-input-label for="name" :value="__('Customer Name')" />
                <div class="col-md-10">
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                        id="name" value="{{ old('name', $customer->name ?? null) }}"
                        placeholder="{{ __('Enter') . ' ' . __('Customer Name') }}" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </div>

            <div class="mb-3 row">
                <x-input-label for="phone_number" :value="__('Phone Number')" />
                <div class="col-md-10">
                    <input class="form-control @error('phone_number') is-invalid @enderror" type="text"
                        name="phone_number" id="phone_number" placeholder="{{ __('Enter') . ' ' . __('Phone Number') }}"
                        value="{{ old('phone_number', $customer->phone_number ?? null) }}" />
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>
            </div>

            <div class="ms-auto mt-3 mt-md-0">
                <button type="submit" class="btn btn-info font-medium px-4">
                    <div class="d-flex align-items-center">
                        {{ __('Save') }}
                    </div>
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
