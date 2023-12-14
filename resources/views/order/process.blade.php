<x-app-layout>

    <x-breadcrumb-header title="{{ __('Order') }}">
        <li class="breadcrumb-item">
            <a class="text-muted text-decoration-none" href="{{ route('order.index') }}">
                {{ __('Order') }}
            </a>
        </li>
        <li class="breadcrumb-item" aria-current="page">{{ __('Update') }}</li>
    </x-breadcrumb-header>

    <form action="{{ route('order.update', $order->id ) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="card card-body">
            <div class="mb-3 row">
                <x-input-label for="customerId" :value="__('Customer')" />
                <div class="col-md-10">
                    <input class="form-control-plaintext" type="text" value="{{ $order->customer->name }}" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <x-input-label for="orderDate" :value="__('Order Date')" />
                <div class="col-md-10">
                    <input class="form-control-plaintext" type="text" value="{{ $order->order_date }}" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <x-input-label for="laundryService" :value="__('Laundry Service')" />
                <div class="col-md-10">
                    <input class="form-control-plaintext" type="text"
                        value="{{ $order->laundryService->name . ' - ' . Number::currency($order->laundryService->price, 'IDR', 'id') . '/' . ucwords($order->laundryService->type) }}"
                        readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <x-input-label for="amount" :value="__('Amount')" />
                <div class="col-md-10">
                    <input class="form-control-plaintext" type="text" value="{{ $order->amount }}" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <x-input-label for="total" :value="__('Total')" />
                <div class="col-md-10">
                    <input class="form-control-plaintext" type="text" value="{{ Number::currency($order->total,'IDR','id') }}" readonly>
                </div>
            </div>
            <div class="mb-3 row">
                <x-input-label for="payment_status" :value="__('Payment Status')" />
                <div class="col-md-10">
                    <select name="payment_status" class="form-select col-12 @error('payment_status') is-invalid @enderror"
                        id="payment_status">
                        <option @selected($order->payment_status == 1) value="1">{{ __('Paid') }}</option>
                        <option @selected($order->payment_status == 0) value="0">{{ __('Not Paid Yet') }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('payment_status')" class="mt-2" />
                </div>
            </div>
            <div class="mb-3 row">
                <x-input-label for="order_status" :value="__('Order Status')" />
                <div class="col-md-10">
                    <select name="order_status" class="form-select col-12 @error('order_status') is-invalid @enderror"
                        id="order_status">
                        <option @selected($order->order_status == 'process') value="process">{{ __('Process') }}</option>
                        <option @selected($order->order_status == 'ready') value="ready">{{ __('Ready to be taken') }}</option>
                        <option @selected($order->order_status == 'taken') value="taken">{{ __('Taken') }}</option>
                    </select>
                    <x-input-error :messages="$errors->get('order_status')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
        </div>
    </form>

</x-app-layout>
