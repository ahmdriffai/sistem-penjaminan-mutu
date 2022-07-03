@extends('layouts.template')

@section('content')
    <!-- Hoverable Table rows -->
    <a class="btn btn-primary mb-3" href="{{ route('dosen.create') }}">
        <i class="bx bx-plus-circle me-1"></i> Tambah Dosen
    </a>
    <div class="card">
        <div class="d-flex align-items-center flex-row justify-content-around">
            <h5 class="card-header flex-grow-1">List Dosen</h5>
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
                    <th>NIDN</th>
                    <th>Nama</th>
                    <th>NIK</th>
                    <th>Nomer HP</th>
                    <th>Alamat</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($data as $value)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>#</strong></td>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{ $value->nidn }}</strong></td>
                        <td>{{ $value->nama }}</td>
                        <td>{{ $value->nik }}</td>
                        <td>{{ $value->nomer_hp }}</td>
                        <td>{{ $value->alamat }}</td>
                        <td class="d-flex">
                            <a class="btn btn-sm btn-primary mx-1" href="{{ route('dosen.edit', $value->nidn) }}">
                                <i class="bx bx-edit-alt me-1"></i> Edit
                            </a>
                            <div>
                                {!! Form::open(['route' => ['dosen.destroy', $value->nidn], 'method' => 'DELETE']) !!}
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
