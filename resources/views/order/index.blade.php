<x-app-layout>

    <x-breadcrumb-header title="{{ __('Order') }}">
        <li class="breadcrumb-item" aria-current="page">{{ __('Order') }}</li>
    </x-breadcrumb-header>

    <x-search-header placeholder="{{ __('Search').' '.__('Order') }}">
        @role('staff')
        <a href="{{ route('order.create') }}" id="btn-add-contact" class="btn btn-info d-flex align-items-center">
            <i class="ti ti-plus text-white me-1 fs-5"></i> {{ __('Add') }}
        </a>
        @endrole
    </x-search-header>

    <div class="card card-body">
        <div class="table-responsive">
            <table class="table search-table align-middle text-nowrap" aria-describedby="Order">
                <thead>
                    <tr>
                        <th>{{ __('Order Code') }}</th>
                        <th>{{ __('Customer') }}</th>
                        <th>{{ __('Laundry Service') }}</th>
                        <th>{{ __('Order Date') }}</th>
                        <th class="text-center">{{ __('Amount') }}</th>
                        <th>{{ __('Total') }}</th>
                        <th class="text-center">{{ __('Payment Status') }}</th>
                        <th>{{ __('Payment At') }}</th>
                        <th>{{ __('Order Status') }}</th>
                        <th>{{ __('Taken At') }}</th>
                        @role('staff')
                        <th></th>
                        @endrole
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $item->order_code }}</td>
                            <td>{{ $item->customer->name }}</td>
                            <td>{{ $item->laundryService->name }}</td>
                            <td>{{ $item->order_date }}</td>
                            <td class="text-center">
                                <x-info-badge>
                                    {{ $item->amount. ' '.$item->laundryService->type }}
                                </x-info-badge>
                            </td>
                            <td>{{ Number::currency($item->total,'IDR','id') }}</td>
                            <td class="text-center">
                                @if ($item->payment_status)
                                    <x-success-badge>{{ __('Paid') }}</x-success-badge>
                                @else
                                    <x-danger-badge>{{ __('Not Paid Yet') }}</x-danger-badge>
                                @endif
                            </td>
                            <td>{{ $item->payment_at ?? '-' }}</td>
                            <td>
                                @if ($item->order_status == 'taken')
                                    <x-success-badge>{{ __('Already Taken') }}</x-success-badge>
                                @elseif($item->order_status == 'ready')
                                    <x-warning-badge>{{ __('Ready to be taken') }}</x-warning-badge>
                                @elseif($item->order_status == 'cancel')
                                    <x-danger-badge>{{ __('Canceled') }}</x-danger-badge>
                                @else
                                    <x-info-badge>{{ __('Process') }}</x-info-badge>
                                @endif
                            </td>
                            <td>{{ $item->taken_at ?? '-' }}</td>
                            @role('staff')
                            <td>
                                @if ($item->order_status == 'cancel')
                                <x-action printRoute="{{ route('order.print', $item->id) }}"/>
                                @else
                                <x-action
                                    printRoute="{{ route('order.print', $item->id) }}"
                                    editRoute="{{ route('order.edit', $item->id) }}"
                                    cancelRoute="{{ route('order.cancel', $item->id) }}"/>
                                @endif
                            </td>
                            @endrole
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="@role('staff') 11 @else 10 @endrole">
                                {{ __('Data not found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {!! $data->links() !!}
        </div>
    </div>

    <div class="modal" id="modal-form" tabindex="-1">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="" method="post">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Cancel') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="form-group">
                          <textarea class="form-control @error('cancel_reason') is-invalid @enderror"
                              placeholder="{{ __('Enter') . ' ' . __('Cancel Reason') }}" name="cancel_reason" id="cancel_reason" cols="5"
                              rows="3" required></textarea>
                          <x-input-error :messages="$errors->get('cancel_reason')" class="mt-2" />
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{ __('Cancel Order') }}</button>
                  </div>
            </form>
          </div>
        </div>
    </div>

    <script type="text/javascript" charset="utf-8">
        function showModalForm(url, title = 'Tambah', modal = '#modal-form', func) {
            $(`${modal}`).modal('show');
            $(`${modal} .modal-title`).text(title);
            $(`${modal} form`).attr('action', url);
            $(`${modal} [name=_method]`).val('post');

            resetForm(`${modal} form`);


            if (func != undefined) {
                func();
            }
        };
    </script>
</x-app-layout>

