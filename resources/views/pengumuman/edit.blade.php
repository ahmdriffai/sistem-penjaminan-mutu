@extends('layouts.template')

@section('content')
    <a class="btn btn-primary mb-3" href="{{ route('berita.index') }}">
        <i class="bx bx-arrow-back me-1"></i> Kembali
    </a>
    <div class="row">
        <div class="col-xl-9">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tambah Berita</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['pengumuman.update', $pengumuman->id], 'method' => 'PUT', 'files' => true]) !!}
                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('judul', 'Judul', ['class' => 'form-label']); !!}
                        {!! Form::text('judul', $pengumuman->judul ,['class' => 'form-control']); !!}
                    </div>

                    <div class="mb-3">
                        {!! Form::label('isi', 'Isi Berita', ['class' => 'form-label']); !!}
                        <div class="input-group input-group-merge">
                            {!! Form::textarea('isi', $pengumuman->isi, array('class' => 'form-control', 'id' => 'body', 'width' => '100%')) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-3">
                            {!! Form::label('file_url', 'File ', ['class' => 'form-label']); !!}
                            <div class="d-flex align-items-center">
                                {{-- <iframe src="{{ $pengumuman->file_url }}" class="img-fluid" width="400px"> --}}
                                {!! Form::file('file' ,['class' => ['form-control']]); !!}
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Ubah</button>
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

