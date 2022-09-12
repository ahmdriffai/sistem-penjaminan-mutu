@extends('layouts.template')

@section('content')
    <a class="btn btn-primary mb-3" href="{{ route('paper-ilmiah.index') }}">
        <i class="bx bx-arrow-back me-1"></i> Kembali
    </a>
    <div class="row">
        <div class="col-xl-9">
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Edit Jurnal Ilmiah</h5>
                </div>
                <div class="card-body">
                    {!! Form::open(['route' => ['paper-ilmiah.update', $paperIlmiah->id], 'method' => 'PUT']) !!}
                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('judul', 'Judul', ['class' => 'form-label']); !!}
                        {!! Form::text('judul', $paperIlmiah->judul ,['class' => 'form-control']); !!}
                    </div>

                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('tahun', 'Tahun', ['class' => 'form-label']); !!}
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class="bx bx-calendar-week"></i>
                            </span>
                            {!! Form::number('tahun', $paperIlmiah->tahun ,['class' => 'form-control', 'min' => 2000]); !!}
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('bulan', 'Bulan', ['class' => 'form-label']); !!}
                        {!! Form::selectMonth('bulan', $paperIlmiah->bulan,['class' => 'form-control', 'placeholder' => 'Pilih bulan ...']); !!}
                    </div>

                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('media', 'Media', ['class' => 'form-label']); !!}
                        {!! Form::text('media', $paperIlmiah->media ,['class' => 'form-control']); !!}
                        <div class="form-text">*ex : syariati, ppkm, dsb.</div>
                    </div>

                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('issn', 'ISSN', ['class' => 'form-label']); !!}
                        {!! Form::text('issn', $paperIlmiah->issn ,['class' => 'form-control']); !!}
                    </div>

                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('sebagai', 'Sebagai', ['class' => 'form-label']); !!}
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class="bx bx-user"></i>
                            </span>
                            {!! Form::text('sebagai', $paperIlmiah->sebagai ,['class' => 'form-control']); !!}
                        </div>
                        <div class="form-text">*ex : Penulis 1, Penulis 2, dsb.</div>
                    </div>

                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('indexs', 'Indexs', ['class' => 'form-label']); !!}
                        {!! Form::text('indexs', $paperIlmiah->indexs ,['class' => 'form-control']); !!}
                    </div>

                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('kriteria', 'Kriteria Jurnal', ['class' => 'form-label']); !!}
                        {!! Form::select('kriteria', [
                            'Jurnal Internasional Bereputasi' => 'Jurnal Internasional Bereputasi',
                             'Jurnal Internasioal' => 'Jurnal Internasional',
                             'Jurnal Nasional Teragretasi' => 'Jurnal Nasional Teragretasi',
                             'Jurnal Nasional' => 'Jurnal Nasional',
                             'Jurnal Lokal' => 'Jurnal Lokal',
                             ], $paperIlmiah->kriteria ,['class' => 'form-control', 'placeholder' => '-- Ktiteria Jurnal --']); !!}
                    </div>

                    <div class="mb-3">
                        <label class="text-danger">*</label>
                        {!! Form::label('link', 'Link', ['class' => 'form-label']); !!}
                        <div class="input-group input-group-merge">
                            <span id="basic-icon-default-fullname2" class="input-group-text">
                                <i class="bx bx-link-alt"></i>
                            </span>
                            {!! Form::text('link', $paperIlmiah->link ,['class' => 'form-control', 'placeholder' => 'http:\\\...']); !!}
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
