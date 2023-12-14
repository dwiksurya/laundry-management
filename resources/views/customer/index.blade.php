<x-app-layout>

    <x-breadcrumb-header title="{{ __('Customer') }}">
        <li class="breadcrumb-item" aria-current="page">{{ __('Customer') }}</li>
    </x-breadcrumb-header>

    <x-search-header placeholder="{{ __('Search').' '.__('Customer') }}">
        <a href="{{ route('customer.create') }}" id="btn-add-contact" class="btn btn-info d-flex align-items-center">
            <i class="ti ti-plus text-white me-1 fs-5"></i> {{ __('Add') }}
        </a>
    </x-search-header>

    <div class="card card-body">
        <div class="table-responsive">
            <table class="table search-table align-middle text-nowrap" aria-describedby="Customer">
                <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Phone Number') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone_number ?? '-' }}</td>
                            <td>
                                <x-action editRoute="{{ route('customer.edit', $item->id) }}"
                                    deleteRoute="{{ route('customer.destroy', $item->id) }}"/>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="3">
                                {{ __('Data not found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {!! $data->links() !!}
        </div>
    </div>
</x-app-layout>
