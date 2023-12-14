@foreach ($orders as $key => $item)
<div class="card card-body">
    <div class="ms-auto mb-3">
        @if ($loop->first)
            <button wire:click="addLaundryService()" class="btn btn-sm btn-primary">
                <i class="ti ti-plus text-white me-1 fs-5"></i> {{ __('Add') }}
            </button>
        @else
            <button wire:click="removeLaundryService({{ $key }})" class="btn btn-sm btn-danger">
                <i class="ti ti-plus text-white me-1 fs-5"></i> {{ __('Remove') }}
            </button>
        @endif
    </div>

    <div class="mb-3 row">
        <x-input-label :for="'laundryServiceId.'.$key" :value="__('Laundry Service')" />
        <div class="col-md-10">
            <select wire:model="orders.{{ $key }}.laundryServiceId" class="form-select col-12 @error('item.'.$key.'.laundryServiceId') is-invalid @enderror"
                    id="laundryServiceId">
                <option disabled selected>{{ __('Choose...') }}</option>
                <option value="1">{{ __('Paid') }}</option>
                <option value="0">{{ __('Not Paid Yet') }}</option>
            </select>
            <x-input-error :messages="$errors->get('item.'.$key.'.laundryServiceId')" class="mt-2" />
        </div>
    </div>

    <div class="mb-3 row">
        <x-input-label for="weight" :value="__('Weight')" />
        <div class="col-md-10">
            <input class="form-control @error('weight') is-invalid @enderror" type="number"
                name="weight" id="weight" placeholder="{{ __('Enter') . ' ' . __('Weight') }}"
                value="{{ old('weight', $order->weight ?? date('Y-m-d', strtotime(now()))) }}" />
            <x-input-error :messages="$errors->get('weight')" class="mt-2" />
        </div>
    </div>
</div>
@endforeach
