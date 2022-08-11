@extends('layouts.app')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('welcome.dokumen-mutu', $dokumenMutu->penjaminanMutu->id) }}">{{ $dokumenMutu->penjaminanMutu->nama }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $dokumenMutu->nama }}</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="demo-inline-spacing mt-3">
                        <div class="list-group list-group-flush">
                            <a href="javascript:void(0);" class="list-group-item list-group-item-action"
                            >
                                Kode Dokumen : <br>
                                <strong>{{ $dokumenMutu->kode_dokumen }}</strong>
                            </a
                            >
                            <a href="javascript:void(0);" class="list-group-item list-group-item-action"
                            >
                                Nama Dokumen : <br>
                                <strong>{{ $dokumenMutu->nama }}</strong>
                            </a
                            >
                            <a href="javascript:void(0);" class="list-group-item list-group-item-action"
                            >
                                Tahun : <br>
                                <strong>{{ $dokumenMutu->tahun }}</strong>
                            </a
                            >
                            <a href="javascript:void(0);" class="list-group-item list-group-item-action"
                            >
                                Deskripsi : <br>
                                {!!  $dokumenMutu->deskripsi !!}
                            </a
                            >

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            @include('welcome.list-file')
        </div>
    </div>
@endsection
