@extends('layouts.template')

@section('content')
    <!-- Hoverable Table rows -->
    @role('admin')
    <a class="btn btn-primary mb-3" href="{{ route('dokumen-mutu.create') }}">
        <i class="bx bx-plus-circle me-1"></i> Tambah Dokumen Penjaminan Mutu
    </a>
    @endrole
    <div class="card">
        <div class="d-flex align-items-center flex-row justify-content-around">
            <h5 class="card-header flex-grow-1">Dokumen Penjaminan Mutu</h5>
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
                    <th>Penjaminan Mutu</th>
                    <th>Tahun</th>
                    <th>Nama Dokumen</th>
                    <th>Kode Dokumen</th>
                    <th>Jumlah</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($data as $value)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>#</strong></td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $value->penjaminanMutu->nama }}</strong></td>
                        <td>{{ $value->tahun }}</td>
                        <td>{{ $value->nama }}</td>
                        <td>{{ $value->kode_dokumen }}</td>
                        <td>{{ $value->fileDokumen->count() }}</td>
                        <td class="d-flex">
                            <a class="btn btn-sm btn-info mx-1" href="{{ route('dokumen-mutu.show', $value->id) }}">
                                <i class="bx bx-detail me-1"></i> Detail
                            </a>
                            @role('admin')
                            <a class="btn btn-sm btn-primary mx-1" href="{{ route('dokumen-mutu.edit', $value->id) }}">
                                <i class="bx bx-edit me-1"></i>
                            </a>
                            <a class="btn btn-sm btn-warning mx-1" href="{{ route('dokumen-mutu.show', $value->id) }}">
                                <i class="bx bx-plus-circle me-1"></i> Tambah File
                            </a>
                            <div>
                                {!! Form::open(['route' => ['dokumen-mutu.destroy', $value->id], 'method' => 'DELETE']) !!}
                                <button type="submit" class="btn btn-sm btn-danger delete-confirm">
                                    <i class="bx bx-trash me-1"></i>
                                </button>
                                {!! Form::close() !!}
                            </div>
                            @endrole
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
