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
                {!! Form::open(['route' => 'penelitian.store', 'method' => 'POST']) !!}
                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('judul', 'Judul', ['class' => 'form-label']); !!}
                        {!! Form::text('judul', null ,['class' => 'form-control']); !!}
                    </div>
                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('tanggal_mulai', 'Tanggal Mulai', ['class' => 'form-label']); !!}
                        {!! Form::date('tanggal_mulai', \Carbon\Carbon::now() ,['class' => 'form-control']); !!}
                    </div>
                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('tanggal_selesai', 'Tanggal Selesai', ['class' => 'form-label']); !!}
                        {!! Form::date('tanggal_selesai', \Carbon\Carbon::now() ,['class' => 'form-control']); !!}
                    </div>
                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('sumber_dana', 'Sumber Dana', ['class' => 'form-label']); !!}
                        {!! Form::text('sumber_dana', null ,['class' => 'form-control']); !!}
                    </div>
                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('jumlah', 'Jumlah', ['class' => 'form-label']); !!}
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">Rp. </span>
                            {!! Form::number('jumlah', null ,['class' => 'form-control']); !!}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('sebagai', 'Sebagai', ['class' => 'form-label']); !!}
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class="bx bx-user"></i>
                            </span>
                            {!! Form::text('sebagai', null ,['class' => 'form-control']); !!}
                        </div>
                        <div class="form-text">ex: Penulis 1, Penulis 2, dsb</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Kirim</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
    </div>
    <!-- / Content -->

@endsection
