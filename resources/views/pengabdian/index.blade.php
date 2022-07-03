@extends('layouts.template')

@section('content')
    <!-- Hoverable Table rows -->
    <a class="btn btn-primary mb-3" href="{{ route('pengabdian.create') }}">
        <i class="bx bx-plus-circle me-1"></i> Tambah Pengabdian
    </a>
    <div class="card">
        <div class="d-flex align-items-center flex-row justify-content-around">
            <h5 class="card-header flex-grow-1">List Pengabdian</h5>
            <form method="get" action="">
                <div class="input-group input-group-merge px-5">
                    <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
                    <input type="hidden" value="100" name="size">
                    <input
                        type="text"
                        name="key"
                        class="form-control"
                        placeholder="Search..."
                        aria-label="Search..."
                        aria-describedby="basic-addon-search31"
                        value="{{ $_GET['key'] ?? '' }}"
                    />
                </div>
            </form>
        </div>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Tgl Mulai</th>
                    <th>Tgl Selesai</th>
                    <th>Sumber Dana</th>
                    <th>Jumlah</th>
                    <th>Sebagai</th>
                    <th>Publis</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($data as $value)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>#</strong></td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $value->judul }}</strong></td>
                        <td>{{ $value->tanggal_mulai }}</td>
                        <td>{{ $value->tanggal_selesai }}</td>
                        <td>{{ $value->sumber_dana }}</td>
                        <td>Rp.{{ number_format($value->jumlah) }}</td>
                        <td>{{ $value->sebagai }}</td>
                        <td><span class="badge bg-label-primary me-1">Active</span></td>
                        <td class="d-flex">
                            <a class="btn btn-sm btn-primary mx-1" href="{{ route('pengabdian.edit', $value->id) }}">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <div>
                                {!! Form::open(['route' => ['pengabdian.destroy', $value->id], 'method' => 'DELETE']) !!}
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
            {{ $data->links() }}
        </div>
    </div>
    <!--/ Hoverable Table rows -->

@endsection
