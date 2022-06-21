@if($message = Session::get('success'))
<div class="bs-toast toast show toast-placement-ex m-2 bg-success top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
    <div class="toast-header">
        <i class='bx bx-bell me-2'></i>
        <div class="me-auto fw-semibold">Success</div>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        {{ $message }}
    </div>
</div>
@endif

@if($message = Session::get('error'))
    <div class="bs-toast toast show toast-placement-ex m-2 bg-danger top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
            <i class='bx bx-bell me-2'></i>
            <div class="me-auto fw-semibold">Error</div>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ $message }}
        </div>
    </div>
@endif
