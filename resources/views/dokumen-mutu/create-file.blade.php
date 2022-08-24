
<div class="modal fade" id="backDropModal" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog">
        {{-- {!! Form::open(['route' => 'file-dokumen.store', 'method' => 'POST', 'files' => true ,'class' => 'modal-content']) !!} --}}
        <form action="/file-dokumen" method="POST" enctype="multipart/form-data" class="modal-content">
        @csrf
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
                    <div class="mb-3">
                        <label for="file" class="form-label @error('file') is-invalid @enderror">File</label>
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        <input class="form-control" type="file" id="file" name="file">
                        @error('file')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Close
                </button>
                <button type="submit" class="btn btn-primary">Tambah</button>
            </div>
        </form>
        {{-- {!! Form::close() !!} --}}
    </div>
</div>
