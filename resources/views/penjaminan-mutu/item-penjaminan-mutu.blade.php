<div class="card">
    <div class="d-flex align-items-center flex-row justify-content-around">
        <h5 class="card-header flex-grow-1">Daftar Item Penjaminan Mutu</h5>
    </div>
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
            <tr>
                <th>No</th>
                <th>Nama Penjaminan Mutu</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody class="table-border-bottom-0">
            @foreach($penjaminanMutu as $value)
                <tr>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>#</strong></td>
                    <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $value->nama }}</strong></td>
                    <td class="d-flex">
                        <button
                            type="button"
                            class="btn btn-sm btn-info"
                            data-bs-toggle="modal"
                            data-bs-target="#modalScrollable{{ $value->id }}"
                        >
                            <i class="bx bx-detail me-1"></i> Detail
                        </button>

                        <a class="btn btn-sm btn-primary mx-1" href="{{ route('penjaminan-mutu.edit', $value->id) }}">
                            <i class="bx bx-edit-alt me-1"></i> Edit
                        </a>
                        <div>
                            {!! Form::open(['route' => ['penjaminan-mutu.destroy', $value->id], 'method' => 'DELETE']) !!}
                            <button type="submit" class="btn btn-sm btn-danger delete-confirm">
                                <i class="bx bx-trash me-1"></i> Delete
                            </button>
                            {!! Form::close() !!}
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="mx-3 my-3">
        {{ $penjaminanMutu->links() }}
    </div>
</div>
<!--/ Hoverable Table rows -->

@include('penjaminan-mutu.show')
