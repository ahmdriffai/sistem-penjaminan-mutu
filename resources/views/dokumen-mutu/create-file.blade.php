
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        {!! Form::open(['route' => 'file-dokumen.store', 'method' => 'POST', 'files' => true ,'class' => 'modal-content']) !!}
        {!! Form::hidden('dokumen_mutu_id', $dokumenMutu->id); !!}
        <div class="modal-header">
                <h5 class="modal-title" id="backDropModalTitle">File Upload</h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"
                ></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        {!! Form::label('nama_file', 'Nama File', ['class' => 'form-label']); !!}
                        {!! Form::text('nama_file', null ,['class' => 'form-control', 'placehoder' => 'Nama File Dokumen']); !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col mb-3">
                        {!! Form::label('file_url', 'File', ['class' => 'form-label']); !!}
                        {!! Form::file('file_url' ,['class' => 'form-control']); !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        {!! Form::close() !!}
    </div>
</div>
