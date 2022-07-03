{{--@if($message = Session::get('success'))--}}
{{--<div class="bs-toast toast show toast-placement-ex m-2 bg-success top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">--}}
{{--    <div class="toast-header">--}}
{{--        <i class='bx bx-bell me-2'></i>--}}
{{--        <div class="me-auto fw-semibold">Success</div>--}}
{{--        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>--}}
{{--    </div>--}}
{{--    <div class="toast-body">--}}
{{--        {{ $message }}--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endif--}}

{{--@if($message = Session::get('error'))--}}
{{--    <div class="bs-toast toast show toast-placement-ex m-2 bg-danger top-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">--}}
{{--        <div class="toast-header">--}}
{{--            <i class='bx bx-bell me-2'></i>--}}
{{--            <div class="me-auto fw-semibold">Error</div>--}}
{{--            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>--}}
{{--        </div>--}}
{{--        <div class="toast-body">--}}
{{--            {{ $message }}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--@endif--}}

<script>
    @if(Session::has('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ Session::get("success") }}'
    })
    @endif

    @if(Session::has('error'))
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '{{ Session::get("error") }}'
    })
    @endif

    @if(Session::has('warning'))
    Swal.fire({
        icon: 'warning',
        title: 'Oops...',
        text: '{{ Session::get("warning") }}'
    })
    @endif

    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        var form = event.target.form; // storing the form
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
        })

        swalWithBootstrapButtons.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No, cancel!',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelled',
                    'Your imaginary file is safe :)',
                    'error'
                )
            }
        })
    });
</script>
