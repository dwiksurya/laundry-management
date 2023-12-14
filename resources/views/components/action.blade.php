<div class="dropdown dropstart">
    <a href="#" class="text-muted"
        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="ti ti-dots fs-5"></i>
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
        @isset($printRoute)
        <li>
            <a class="dropdown-item d-flex align-items-center gap-3"
                href="{{ $printRoute }}" target="_blank">
                <i class="fs-4 ti ti-printer"></i>Print
            </a>
        </li>
        @endisset
        @isset($editRoute)
        <li>
            <a class="dropdown-item d-flex align-items-center gap-3"
                href="{{ $editRoute }}">
                <i class="fs-4 ti ti-edit"></i>Edit
            </a>
        </li>
        @endisset
        @isset($deleteRoute)
        <li>
            <form method="POST" action="{{ $deleteRoute }}">
                @csrf
                <input name="_method" type="hidden" value="DELETE">
                <button type="submit" class="dropdown-item d-flex align-items-center gap-3 show_confirm">
                    <i class="fs-4 ti ti-trash"></i>Delete
                </button>
            </form>
        </li>
        @endisset
    </ul>
</div>
