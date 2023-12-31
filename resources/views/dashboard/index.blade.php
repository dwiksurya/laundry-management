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
                                        {{ $totalActiveBranchs }}
                                    </h3>
                                    <p class="mb-0 text-dark">{{ __('Active Branchs') }}</p>
                                </div>
                                <div class="ps-4">
                                    <h3 class="mb-1 fw-semibold fs-8 d-flex align-content-center">
                                        {{ $totalInactiveBranchs }}
                                    </h3>
                                    <p class="mb-0 text-dark">{{ __('Inactive Branchs') }}</p>
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
                    <h5 class="card-title fw-semibold">{{ __('Top Branches') }}</h5>
                    <p class="card-subtitle mb-0">{{ __('Based number of transactions') }}</p>

                    @foreach ($topBranches as $item)
                    <div class="position-relative mt-3">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary-subtle text-primary badge me-6">
                                    <p class="fs-3 fw-semibold mb-0">{{ $loop->iteration }}</p>
                                </div>
                                <div>
                                    <h6 class="mb-1 fs-4 fw-semibold">{{ $item->name }}</h6>
                                </div>
                            </div>
                            <div class="bg-primary-subtle text-primary badge">
                                <p class="fs-3 fw-semibold mb-0">{{ $item->customers_count }} {{ __('Order') }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
