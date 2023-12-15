<div>
    <div class="card card-body mb-3">
        @if ($isNewCustomer)
            <div class="mb-3 row">
                <x-input-label for="name" :value="__('Customer Name')" />
                <div class="col-md-10">
                    <input class="form-control @error('name') is-invalid @enderror" type="text" wire:model.live="name"
                        id="name" value="{{ $name }}"
                        placeholder="{{ __('Enter') . ' ' . __('Customer Name') }}" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
            </div>

            <div class="mb-3 row">
                <x-input-label for="phoneNumber" :value="__('Phone Number')" />
                <div class="col-md-10">
                    <input class="form-control @error('phoneNumber') is-invalid @enderror" type="text"
                        wire:model.live="phoneNumber" id="phoneNumber"
                        placeholder="{{ __('Enter') . ' ' . __('Phone Number') }}" value="{{ $phoneNumber }}" />
                    <x-input-error :messages="$errors->get('phoneNumber')" class="mt-2" />
                </div>
                <div class="mt-1">
                    <div class="btn btn-sm btn-primary" wire:click="setNewCustomer()">
                        {{ __('Select Existing customer') }}</div>
                </div>
            </div>
        @else
            <div class="mb-3 row">
                <x-input-label for="customerId" :value="__('Customer')" />
                <div class="col-md-10">
                    <select wire:model.live="customerId"
                        class="form-select col-12 @error('customerId') is-invalid @enderror" id="customerId">
                        <option selected="">{{ __('Choose...') }}</option>
                        @foreach ($customers as $key => $item)
                            <option value="{{ $key }}">{{ $item }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('customerId')" class="mt-2" />
                </div>
                <div class="mt-1">
                    <div class="btn btn-sm btn-primary" wire:click="setNewCustomer()">{{ __('New customer') }}</div>
                </div>
            </div>
        @endif

        <div class="mb-3 row">
            <x-input-label for="orderDate" :value="__('Order Date')" />
            <div class="col-md-10">
                <input class="form-control @error('orderDate') is-invalid @enderror" type="date"
                    wire:model.live="orderDate" id="orderDate" placeholder="{{ __('Enter') . ' ' . __('Order Date') }}"
                    value="{{ $orderDate ?? date('Y-m-d', strtotime(now())) }}" />
                <x-input-error :messages="$errors->get('orderDate')" class="mt-2" />
            </div>
        </div>

        <div class="mb-3 row">
            <x-input-label for="paymentStatus" :value="__('Payment Status')" />
            <div class="col-md-10">
                <select wire:model.live="paymentStatus"
                    class="form-select col-12 @error('paymentStatus') is-invalid @enderror" id="paymentStatus">
                    <option selected="">{{ __('Choose...') }}</option>
                    <option value="1">{{ __('Paid') }}</option>
                    <option value="0">{{ __('Not Paid Yet') }}</option>
                </select>
                <x-input-error :messages="$errors->get('paymentStatus')" class="mt-2" />
            </div>
        </div>

        <div class="mb-3 row">
            <x-input-label for="laundryServiceId" :value="__('Laundry Service')" />
            <div class="col-md-10">
                <select wire:model.live="laundryServiceId"
                    class="form-select col-12
                    @error('laundryServiceId') is-invalid @enderror"
                    id="laundryServiceId">
                    <option selected>{{ __('Choose...') }}</option>
                    @foreach ($laundryServices as $key => $item)
                        <option value="{{ $key }}">{{ $item }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('laundryServiceId')" class="mt-2" />
            </div>
        </div>

        <div class="mb-3 row">
            <x-input-label for="amount" :value="__('Amount')" />
            <div class="col-md-10">
                <input class="form-control @error('amount') is-invalid @enderror" type="number"
                    wire:model.live="amount" id="amount" placeholder="{{ __('Enter') . ' ' . __('Amount') }}"
                    value="{{ $amount }}" />
                <x-input-error :messages="$errors->get('amount')" class="mt-2" />
            </div>
        </div>

        @if ($laundryService && $amount)
        <div class="mb-3 row">
            <x-input-label for="Total" :value="__('Total')" />
            <div class="col-md-10">
                <input readonly class="form-control-plaintext" type="text"
                    value="{{ Number::currency($amount*$laundryService->price,'IDR','id') }}" />
            </div>
        </div>
        @endif
    </div>

    <div class="text-end">
        <button class="btn btn-primary" wire:click="saveForm()">{{ __('Save') }}</button>
    </div>
</div>
