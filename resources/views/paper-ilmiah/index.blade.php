@extends('layouts.template')

@section('content')
    <!-- Hoverable Table rows -->
    <a class="btn btn-primary mb-3" href="{{ route('paper-ilmiah.create') }}">
        <i class="bx bx-plus-circle me-1"></i> Tambah Jurnal Ilmiah
    </a>
    <div class="card">
        <div class="d-flex align-items-center flex-row justify-content-around">
            <h5 class="card-header flex-grow-1">Daftar Jurnal Ilmiah</h5>
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
                    <th>Bulan</th>
                    <th>Tahun</th>
                    <th>Media</th>
                    <th>ISSN</th>
                    <th>Kriteria Jurnal</th>
                    <th>Indexs</th>
                    <th>Link</th>
                    <th>Publis</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($data as $value)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>#</strong></td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $value->judul }}</strong></td>
                        <td>{{ $value->bulan }}</td>
                        <td>{{ $value->tahun }}</td>
                        <td>{{ $value->media }}</td>
                        <td>{{ $value->issn }}</td>
                        <td>{{ $value->kriteria }}</td>
                        <td>{{ $value->indexs }}</td>
                        <td>
                            <a href="{{ $value->link }}" target="_blank">link</a>
                        </td>

                        <td><span class="badge bg-label-primary me-1">Active</span></td>
                        <td class="d-flex">
                            <a class="btn btn-sm btn-primary mx-1" href="{{ route('paper-ilmiah.edit', $value->id) }}">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <div>
                                {!! Form::open(['route' => ['paper-ilmiah.destroy', $value->id], 'method' => 'DELETE']) !!}
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
