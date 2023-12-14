<x-app-layout>

    <x-breadcrumb-header title="{{ __('Staff') }}">
        <li class="breadcrumb-item" aria-current="page">{{ __('Staff') }}</li>
    </x-breadcrumb-header>

    <x-search-header placeholder="{{ __('Search').' '.__('Staff') }}">
        <a href="{{ route('staff.create') }}" id="btn-add-contact" class="btn btn-info d-flex align-items-center">
            <i class="ti ti-plus text-white me-1 fs-5"></i> {{ __('Add') }}
        </a>
    </x-search-header>

    <div class="card card-body">
        <div class="table-responsive">
            <table class="table search-table align-middle text-nowrap" aria-describedby="Staff">
                <thead>
                    <tr>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Phone Number') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone_number ?? '-' }}</td>
                            <td>{{ $item->user->email ?? '-' }}</td>
                            <td>
                                <div class="dropdown dropstart">
                                    <a href="#" class="text-muted"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                      <i class="ti ti-dots fs-5"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                        <li>
                                            <a class="dropdown-item d-flex align-items-center gap-3"
                                                href="{{ route('staff.edit', $item->id) }}">
                                                <i class="fs-4 ti ti-edit"></i>Edit
                                            </a>
                                        </li>
                                        <li>
                                            <form method="POST" action="{{ route('staff.destroy', $item->id) }}">
                                                @csrf
                                                <input name="_method" type="hidden" value="DELETE">
                                                <button type="submit" class="dropdown-item d-flex align-items-center gap-3 show_confirm">
                                                    <i class="fs-4 ti ti-trash"></i>Delete
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="4">
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
