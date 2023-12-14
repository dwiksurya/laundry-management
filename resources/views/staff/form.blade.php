<x-app-layout>

    <x-breadcrumb-header title="{{ __('Staff') }}">
        <li class="breadcrumb-item">
            <a class="text-muted text-decoration-none" href="{{ route('staff.index') }}">
                {{ __('Staff') }}
            </a>
        </li>
        <li class="breadcrumb-item" aria-current="page">{{ __('Create') }}</li>
    </x-breadcrumb-header>

    <div class="card card-body">
        <form action="{{ isset($staff) ? route('staff.update', $staff->id) : route('staff.store') }}" method="POST">
            @isset($staff)
                @method('PUT')
            @endisset
            @csrf

            <div class="mb-3 row">
                <x-input-label for="name" :value="__('Staff Name')" />
                <div class="col-md-10">
                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name"
                        id="name" value="{{ old('name', $staff->name ?? null) }}"
                        placeholder="{{ __('Enter') . ' ' . __('Staff Name') }}" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </div>

            <div class="mb-3 row">
                <x-input-label for="phone_number" :value="__('Phone Number')" />
                <div class="col-md-10">
                    <input class="form-control @error('phone_number') is-invalid @enderror" type="text"
                        name="phone_number" id="phone_number" placeholder="{{ __('Enter') . ' ' . __('Phone Number') }}"
                        value="{{ old('phone_number', $staff->phone_number ?? null) }}" />
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>
            </div>

            <div class="mb-3 row">
                <x-input-label for="email" :value="__('Email')" />
                <div class="col-md-10">
                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email"
                        id="email" placeholder="{{ __('Enter') . ' ' . __('Email') }}"
                        value="{{ old('email', $staff->user?->email ?? null) }}" required />
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
