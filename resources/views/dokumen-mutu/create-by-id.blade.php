@extends('layouts.template')

@section('content')
    <a class="btn btn-primary mb-3" href="{{ route('paper-ilmiah.index') }}">
        <i class="bx bx-arrow-back me-1"></i> Kembali
    </a>
    <div class="row">
        <div class="col-xl-9">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tambah Penelitian</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'dokumen-mutu.store', 'method' => 'POST']) !!}

                    {!! Form::hidden('penjaminan_mutu_id', $penjaminanMutu->id) !!}

                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('kode_dokumen', 'Kode Dokumen', ['class' => 'form-label']); !!}
                        {!! Form::text('kode_dokumen', null ,['class' => 'form-control']); !!}
                    </div>

                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('nama', 'Nama Dokumen', ['class' => 'form-label']); !!}
                        {!! Form::text('nama', null ,['class' => 'form-control']); !!}
                    </div>

                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('tahun', 'Tahun', ['class' => 'form-label']); !!}
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class="bx bx-calendar-week"></i>
                            </span>
                            {!! Form::number('tahun', null ,['class' => 'form-control', 'min' => 2000]); !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        {!! Form::label('deskripsi', 'Deskripsi', ['class' => 'form-label']); !!}
                        <div class="input-group input-group-merge">
                            {!! Form::textarea('deskripsi', null, array('class' => 'form-control', 'id' => 'body', 'width' => '100%')) !!}
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
