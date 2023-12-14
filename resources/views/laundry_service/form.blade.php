<x-app-layout>

    <x-breadcrumb-header title="{{ __('Laundry Service') }}">
        <li class="breadcrumb-item">
            <a class="text-muted text-decoration-none" href="{{ route('laundry-service.index') }}">
                {{ __('Laundry Service') }}
            </a>
        </li>
        <li class="breadcrumb-item" aria-current="page">{{ __('Create') }}</li>
    </x-breadcrumb-header>

    <div class="card card-body">
        <form action="{{ isset($laundryService) ? route('laundry-service.update', $laundryService->id) : route('laundry-service.store') }}" method="POST">
            @isset($laundryService)
                @method('PUT')
            @endisset
            @csrf

            <div class="mb-3 row">
                <x-input-label for="name" :value="__('Laundry Service Name')" />
                <div class="col-md-10">
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                        id="name" value="{{ old('name', $laundryService->name ?? null) }}"
                        placeholder="{{ __('Enter') . ' ' . __('Laundry Service Name') }}" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </div>

            <div class="mb-3 row">
                <x-input-label for="price" :value="__('Price')" />
                <div class="col-md-10">
                    <input class="form-control @error('price') is-invalid @enderror" type="text"
                        name="price" id="price" placeholder="{{ __('Enter') . ' ' . __('Price') }}"
                        value="{{ old('price', $laundryService->price ?? null) }}" />
                    <x-input-error :messages="$errors->get('price')" class="mt-2" />
                </div>
            </div>

            <div class="mb-3 row">
                <x-input-label for="type" :value="__('Type')" />
                <div class="col-md-10">
                    <select name="type" class="form-select col-12 @error('type') is-invalid @enderror"
                        id="type">
                        <option disabled selected="">{{ __('Choose...') }}</option>
                        <option @selected(old('type', $laundryService->type ?? null) == 'kilos') value="kilos">
                            {{ __('Kilos') }}
                        </option>
                        <option @selected(old('type', $laundryService->type ?? null) == 'unit') value="unit">
                            {{ __('Unit') }}
                        </option>
                    </select>
                    <x-input-error :messages="$errors->get('type')" class="mt-2" />
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
