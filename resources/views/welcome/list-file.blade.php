<div class="card">
    <div class="card-body">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Tahun</th>
                    <th>Nama</th>
                    <th>Dokumen</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($dokumenMutu->fileDokumen as $value)
                    <tr>
                        <td><strong>#</strong></td>
                        <td>{{ $value->created_at }}</td>
                        <td>{{ $dokumenMutu->tahun }}</td>
                        <td>{{ $value->nama_file }}</td>
                        <td>
                            <a href="{{ $value->file_url }}">Preview</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('dokumen-mutu.create-file')
