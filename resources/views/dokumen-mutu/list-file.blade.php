<div class="card">
    <div class="card-body">
        <button
            type="button"
            class="btn btn-warning"
            data-bs-toggle="modal"
            data-bs-target="#backDropModal"
        >
            <i class="bx bx-plus-circle me-1"></i> Tambah Dokumen
        </button>

        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Tahun</th>
                    <th>Nama</th>
                    <th>Dokumen</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($dokumenMutu->fileDokumen as $value)
                    <tr>
                        <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>#</strong></td>
                        <td>{{ $value->created_at }}</td>
                        <td>{{ $dokumenMutu->tahun }}</td>
                        <td>{{ $value->nama_file }}</td>
                        <td>
                            <a href="{{ $value->file_url }}">Preview</a>
                        </td>
                        <td>
                            <div>
                                {!! Form::open(['route' => ['file-dokumen.destroy', $value->id], 'method' => 'DELETE']) !!}
                                <button type="submit" class="btn btn-sm btn-danger">
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
    </div>
</div>

@include('dokumen-mutu.create-file')
