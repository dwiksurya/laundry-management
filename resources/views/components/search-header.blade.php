<div class="card card-body">
    <div class="row">
      <div class="col-md-4 col-xl-3">
        <form class="position-relative" method="GET">
          <input name="search" type="text" class="form-control product-search ps-5"
            id="input-search" value="{{ Request::get('search') }}" placeholder="{{ $placeholder }}">
          <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
        </form>
      </div>
      <div class="col-md-8 col-xl-9 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
        {{ $slot }}
      </div>
    </div>
</div>
