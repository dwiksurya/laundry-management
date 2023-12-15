<x-app-layout>
    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100 bg-info-subtle overflow-hidden shadow-none">
                <div class="card-body position-relative">
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="d-flex align-items-center mb-7">
                                <div class="rounded-circle overflow-hidden me-6">
                                    <img src="{{ asset('theme/images/profile/user-1.jpg') }}" alt=""
                                        width="40" height="40">
                                </div>
                                <h5 class="fw-semibold mb-0 fs-5">
                                    {{ __('Welcome back') . ' ' . ucwords(auth()->user()->name) }}!</h5>
                            </div>
                            <div class="d-flex align-items-center">
                                <div class="border-end pe-4 border-muted border-opacity-10">
                                    <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">
                                        {{ $todayOrders }}
                                    </h3>
                                    <p class="mb-0 text-dark">{{ __('Today’s Sales') }}</p>
                                </div>
                                <div class="ps-4 border-end pe-4 border-muted border-opacity-10">
                                    <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">
                                        {{ Number::currency($todayIncomes, 'IDR', 'id') }}
                                    </h3>
                                    <p class="mb-0 text-dark">{{ __('Today’s Income') }}</p>
                                </div>
                                <div class="ps-4">
                                    <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">
                                        {{ $totalCustomers }}
                                    </h3>
                                    <p class="mb-0 text-dark">{{ __('Total Customers') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="welcome-bg-img mb-n7 text-end">
                                <img src="{{ asset('theme/images/welcome-bg.svg') }}" alt="" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
            <div class="card w-100">
                <div class="card-body">
                    <h5 class="card-title fw-semibold">{{ __('Top Laundry Services') }}</h5>
                    <p class="card-subtitle mb-0">{{ __('in 7 days') }}</p>

                    @foreach ($topLaundryServices as $item)
                    <div class="position-relative mt-3">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex">
                                <div
                                    class="p-6 bg-primary-subtle text-primary rounded-2 me-6 d-flex align-items-center justify-content-center">
                                    <i class="ti ti-grid-dots fs-6"></i>
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4 fw-semibold">{{ $item->name }}</h6>
                                    <p class="fs-3 mb-0">{{ $item->type }}</p>
                                </div>
                            </div>
                            <div class="bg-primary-subtle text-primary badge">
                                <p class="fs-3 fw-semibold mb-0">{{ $item->orders_count }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
