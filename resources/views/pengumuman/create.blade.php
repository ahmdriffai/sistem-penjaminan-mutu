@extends('layouts.template')

@section('content')
    <a class="btn btn-primary mb-3" href="{{ route('pengumuman.index') }}">
        <i class="bx bx-arrow-back me-1"></i> Kembali
    </a>
    <div class="row">
        <div class="col-xl-9">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tambah Pengumuman</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'pengumuman.store', 'method' => 'POST', 'files' => true]) !!}
                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('judul', 'Judul', ['class' => 'form-label']); !!}
                        {!! Form::text('judul', null ,['class' => 'form-control']); !!}
                    </div>

                    <div class="mb-3">
                        {!! Form::label('isi', 'Isi Pengumuman', ['class' => 'form-label']); !!}
                        <div class="input-group input-group-merge">
                            {!! Form::textarea('isi', null, array('class' => 'form-control', 'id' => 'body', 'width' => '100%')) !!}
                        </div>
                        <div class="form-text">* keterangan penjaminan mutu, misal : sop adalah ...</div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            {!! Form::label('file', 'File', ['class' => 'form-label']); !!}
                            {!! Form::file('file' ,['class' => 'form-control']); !!}
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->

@endsection


@section('script')
    <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>

    <script>
        var konten = document.getElementById("body");
        CKEDITOR.replace(konten,{
            language:'en-gb'
        });
        CKEDITOR.config.allowedContent = true;
        CKEDITOR.config.width = '100%';
    </script>
@endsection

