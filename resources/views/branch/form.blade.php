<x-app-layout>

    <x-breadcrumb-header title="{{ __('Branch') }}">
        <li class="breadcrumb-item">
            <a class="text-muted text-decoration-none" href="{{ route('branch.index') }}">
                {{ __('Branch') }}
            </a>
        </li>
        <li class="breadcrumb-item" aria-current="page">{{ __('Create') }}</li>
    </x-breadcrumb-header>

    <div class="card card-body">
        <form action="{{ isset($branch) ? route('branch.update', $branch->id) : route('branch.store') }}" method="POST">
            @isset($branch)
                @method('PUT')
            @endisset
            @csrf

            <div class="mb-3 row">
                <x-input-label for="name" :value="__('Branch Name')" />
                <div class="col-md-10">
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                        id="name" value="{{ old('name', $branch->name ?? null) }}"
                        placeholder="{{ __('Enter') . ' ' . __('Branch Name') }}" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </div>

            <div class="mb-3 row">
                <x-input-label for="phone_number" :value="__('Phone Number')" />
                <div class="col-md-10">
                    <input class="form-control @error('phone_number') is-invalid @enderror" type="text"
                        name="phone_number" id="phone_number" placeholder="{{ __('Enter') . ' ' . __('Phone Number') }}"
                        value="{{ old('phone_number', $branch->phone_number ?? null) }}" />
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>
            </div>

            <div class="mb-3 row">
                <x-input-label for="address" :value="__('Address')" />
                <div class="col-md-10">
                    <input class="form-control @error('address') is-invalid @enderror" type="text" name="address"
                        id="address" placeholder="{{ __('Enter') . ' ' . __('Address') }}"
                        value="{{ old('address', $branch->address ?? null) }}" />
                    <x-input-error :messages="$errors->get('address')" class="mt-2" />
                </div>
            </div>

            <div class="mb-3 row">
                <x-input-label for="email" :value="__('Email')" />
                <div class="col-md-10">
                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                        id="email" placeholder="{{ __('Enter') . ' ' . __('Email') }}"
                        value="{{ old('email', $branch->user?->email ?? null) }}" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
            </div>

            <div class="mb-3 row">
                <x-input-label for="password" :value="__('Password')" />
                <div class="col-md-10">
                    <input class="form-control @error('password') is-invalid @enderror" type="password" name="password"
                        id="password" placeholder="{{ __('Enter') . ' ' . __('Password') }}" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
            </div>

            <div class="mb-3 row">
                <x-input-label for="password_confirmation" :value="__('Password Confirmation')" />
                <div class="col-md-10">
                    <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password"
                        name="password_confirmation" id="password_confirmation"
                        placeholder="{{ __('Enter') . ' ' . __('Password Confirmation') }}" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="mb-3 row">
                <x-input-label for="description" :value="__('Description')" />
                <div class="col-md-10">
                    <textarea class="form-control @error('description') is-invalid @enderror"
                        placeholder="{{ __('Enter') . ' ' . __('Description') }}" name="description" id="description" cols="5"
                        rows="3">{{ old('description', $branch->description ?? null) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-2" />
                </div>
            </div>

            <div class="mb-3 row">
                <x-input-label for="status" :value="__('Status')" />
                <div class="col-md-10">
                    <select name="status" class="form-select col-12 @error('status') is-invalid @enderror"
                        id="status">
                        <option disabled selected="">{{ __('Choose...') }}</option>
                        <option @selected(old('status', $branch->status ?? null) == 1) value="1">
                            {{ __('Active') }}
                        </option>
                        <option @selected(old('status', $branch->status ?? null) == 0) value="0">
                            {{ __('Inactive') }}
                        </option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
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
