@extends('layouts.template')

@section('content')
    <a class="btn btn-primary mb-3" href="{{ route('penelitian.index') }}">
        <i class="bx bx-arrow-back me-1"></i> Kembali
    </a>
    <div class="row">
        <div class="col-xl-9">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Tambah Penelitian</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => 'audit.store', 'method' => 'POST', 'files' => true]) !!}
                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('nama', 'Nama Audit', ['class' => 'form-label']); !!}
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
                        <label class="text-danger">*</label>
                        {!! Form::label('semester', 'Semester', ['class' => 'form-label']); !!}
                        {!! Form::select('semester', [ 1 => 'Semester 1', 2 => 'Semester 2'], null ,['class' => 'form-control', 'placeholder' => '-- Semester --']); !!}
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
