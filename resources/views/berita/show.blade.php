@extends('layouts.template')

@section('content')
    <a class="btn btn-primary mb-3" href="{{ route('berita.index') }}">
        <i class="bx bx-arrow-back me-1"></i> Kembali
    </a>
    <div class="card">
        <div class="d-flex align-items-center flex-row justify-content-around p-5">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <h4 class="text-success">{{ $berita->judul }}</h4>
                        <small class="my-2 text-gray"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $berita->created_at }}</small>
                    </div>
                    <img src="{{ $berita->gambar_url }}" class="img-fluid mb-5" width="100%">
                    <p>
                        {!! $berita->isi !!}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
