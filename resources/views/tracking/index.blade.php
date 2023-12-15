<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laundry') }}</title>
    <link rel="shortcut icon" type="image/png" href="{{ asset('theme/images/logos/favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('theme/css/styles.min.css') }}" />
    <style>
        #tracking {
            background: #fff
        }

        .tracking-detail {
            padding: 3rem 0;
        }

        #tracking {
            margin-bottom: 1rem;
        }

        [class*="tracking-status-"] p {
            margin: 0;
            font-size: 1.1rem;
            color: #fff;
            text-transform: uppercase;
            text-align: center;
        }

        [class*="tracking-status-"] {
            padding: 1.6rem 0;
        }

        .tracking-list {
            border: 1px solid #e5e5e5;
        }

        .tracking-item {
            border-left: 4px solid #00ba0d;
            position: relative;
            padding: 2rem 1.5rem 0.5rem 2.5rem;
            font-size: 0.9rem;
            margin-left: 3rem;
            min-height: 5rem;
        }

        .tracking-item:last-child {
            padding-bottom: 4rem;
        }

        .tracking-item .tracking-date {
            margin-bottom: 0.5rem;
        }

        .tracking-item .tracking-date span {
            color: #888;
            font-size: 85%;
            padding-left: 0.4rem;
        }

        .tracking-item .tracking-content {
            padding: 0.5rem 0.8rem;
            background-color: #f4f4f4;
            border-radius: 0.5rem;
        }

        .tracking-item .tracking-content span {
            display: block;
            color: #767676;
            font-size: 13px;
        }

        .tracking-item .tracking-icon {
            position: absolute;
            left: -0.7rem;
            width: 1.1rem;
            height: 1.1rem;
            text-align: center;
            border-radius: 50%;
            font-size: 1.1rem;
            background-color: #fff;
            color: #fff;
        }

        .tracking-item-pending {
            border-left: 4px solid #d6d6d6;
            position: relative;
            padding: 2rem 1.5rem 0.5rem 2.5rem;
            font-size: 0.9rem;
            margin-left: 3rem;
            min-height: 5rem;
        }

        .tracking-item-pending:last-child {
            padding-bottom: 4rem;
        }

        .tracking-item-pending .tracking-date {
            margin-bottom: 0.5rem;
        }

        .tracking-item-pending .tracking-date span {
            color: #888;
            font-size: 85%;
            padding-left: 0.4rem;
        }

        .tracking-item-pending .tracking-content {
            padding: 0.5rem 0.8rem;
            background-color: #f4f4f4;
            border-radius: 0.5rem;
        }

        .tracking-item-pending .tracking-content span {
            display: block;
            color: #767676;
            font-size: 13px;
        }

        .tracking-item-pending .tracking-icon {
            line-height: 2.6rem;
            position: absolute;
            left: -0.7rem;
            width: 1.1rem;
            height: 1.1rem;
            text-align: center;
            border-radius: 50%;
            font-size: 1.1rem;
            color: #d6d6d6;
        }

        .tracking-item-pending .tracking-content {
            font-weight: 600;
            font-size: 17px;
        }

        .tracking-item .tracking-icon.status-current {
            width: 1.9rem;
            height: 1.9rem;
            left: -1.1rem;
        }

        .tracking-item .tracking-icon.status-intransit {
            color: #00ba0d;
            font-size: 0.6rem;
        }

        .tracking-item .tracking-icon.status-current {
            color: #00ba0d;
            font-size: 0.6rem;
        }

        @media (min-width: 992px) {
            .tracking-item {
                margin-left: 10rem;
            }

            .tracking-item .tracking-date {
                position: absolute;
                left: -10rem;
                width: 7.5rem;
                text-align: right;
            }

            .tracking-item .tracking-date span {
                display: block;
            }

            .tracking-item .tracking-content {
                padding: 0;
                background-color: transparent;
            }

            .tracking-item-pending {
                margin-left: 10rem;
            }

            .tracking-item-pending .tracking-date {
                position: absolute;
                left: -10rem;
                width: 7.5rem;
                text-align: right;
            }

            .tracking-item-pending .tracking-date span {
                display: block;
            }

            .tracking-item-pending .tracking-content {
                padding: 0;
                background-color: transparent;
            }
        }

        .tracking-item .tracking-content {
            font-weight: 600;
            font-size: 17px;
        }

        .blinker {
            border: 7px solid #e9f8ea;
            animation: blink 1s;
            animation-iteration-count: infinite;
        }

        @keyframes blink {
            50% {
                border-color: #fff;
            }
        }
    </style>
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-lg-6">
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{ asset('theme/images/logos/logo-laundry.png') }}" width="180"
                                        alt="">
                                </a>

                                @if (Request::get('order_code') && !$order)
                                    <div class="alert alert-danger" role="alert">
                                        {{ __('Order code not found!') }}
                                    </div>
                                @endif

                                <form action="{{ route('tracking') }}" method="GET">
                                    <div class="mb-3">
                                        <label for="order_code" class="form-label">{{ __('Order Code') }}</label>
                                        <input name="order_code" type="text"
                                            class="form-control @error('order_code') is-invalid @enderror"
                                            value="{{ old('order_code', Request::get('order_code')) }}" id="order_code"
                                            placeholder="{{ __('Enter') . ' ' . __('Order Code') }}" required>
                                        <x-input-error :messages="$errors->get('order_code')" class="mt-2" />
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Track</button>
                                </form>

                                @if ($order)
                                    <div class="row">
                                        <label class="col-md-3 col-form-label" for="name">
                                            {{ __('Order Code') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input class="form-control-plaintext" type="text"
                                                value="{{ $order->order_code }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3 col-form-label" for="name">
                                            {{ __('Laundry Service') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input class="form-control-plaintext" type="text"
                                                value="{{ $order->laundryService->name ?? '-' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3 col-form-label" for="name">
                                            {{ __('Customer') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input class="form-control-plaintext" type="text"
                                                value="{{ $order->customer->name ?? '-' }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label class="col-md-3 col-form-label" for="name">
                                            {{ __('Status') }}
                                        </label>
                                        <div class="col-md-9">
                                            <input class="form-control-plaintext" type="text"
                                                value="{{ strtoupper($order->order_status) }}" readonly>
                                        </div>
                                    </div>

                                    @if ($order->order_status != 'cancel')
                                        <div class="container py-5">
                                            <div class="row">

                                                <div class="col-md-12 col-lg-12">
                                                    <div id="tracking-pre"></div>
                                                    <div id="tracking">
                                                        <div class="tracking-list">
                                                            <div class="{{ $trackingProgress['process'] ? 'tracking-item' : 'tracking-item-pending' }}">
                                                                <div class="tracking-icon status-intransit">
                                                                    <svg class="svg-inline--fa fa-circle fa-w-16"
                                                                        aria-hidden="true" data-prefix="fas"
                                                                        data-icon="circle" role="img"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 512 512" data-fa-i2svg="">
                                                                        <path fill="currentColor"
                                                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                                <div class="tracking-content">{{ __('Process') }}</div>
                                                            </div>
                                                            <div class="{{ $trackingProgress['ready'] ? 'tracking-item' : 'tracking-item-pending' }}">
                                                                <div class="tracking-icon status-intransit">
                                                                    <svg class="svg-inline--fa fa-circle fa-w-16"
                                                                        aria-hidden="true" data-prefix="fas"
                                                                        data-icon="circle" role="img"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 512 512" data-fa-i2svg="">
                                                                        <path fill="currentColor"
                                                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                                <div class="tracking-content">{{ __('Ready to be taken') }}</div>
                                                            </div>
                                                            <div class="{{ $trackingProgress['taken'] ? 'tracking-item' : 'tracking-item-pending' }}">
                                                                <div class="tracking-icon status-intransit">
                                                                    <svg class="svg-inline--fa fa-circle fa-w-16"
                                                                        aria-hidden="true" data-prefix="fas"
                                                                        data-icon="circle" role="img"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 512 512" data-fa-i2svg="">
                                                                        <path fill="currentColor"
                                                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                                <div class="tracking-content">
                                                                    {{ __('Taken') }}
                                                                    @if ($trackingProgress['taken'])
                                                                        <span>{{ $order->taken_at }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="{{ $trackingProgress['taken'] ? 'tracking-item' : 'tracking-item-pending' }}">
                                                                <div class="tracking-icon status-intransit">
                                                                    <svg class="svg-inline--fa fa-circle fa-w-16"
                                                                        aria-hidden="true" data-prefix="fas"
                                                                        data-icon="circle" role="img"
                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                        viewBox="0 0 512 512" data-fa-i2svg="">
                                                                        <path fill="currentColor"
                                                                            d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8z">
                                                                        </path>
                                                                    </svg>
                                                                </div>
                                                                <div class="tracking-content">{{ __('Finished') }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('theme/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('theme/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
