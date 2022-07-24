@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="#">Pengumuman</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $pengumuman->judul }}</li>
    </ol>
</nav>
<div class="row mt-5">
    <div class="col-md-8">
        <div class="row">
            <h4 class="text-success">{{ $pengumuman->judul }}</h4>
            <small class="my-2 text-gray"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $pengumuman->created_at }}</small>
        </div>
        <p>
            {!! $pengumuman->isi !!}
        </p>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm border">
            <div class="card-body">
                <h5><i class="fa fa-bullhorn"></i> Pengumuman Lainya</h5>
                <ul class="list-group list-group-flush">
                    @foreach($listPengumuman as $value)
                        <li class="list-group-item">
                            <a href="" class="link-dark text-capitalize"><strong class="fw-light">{{ $value->judul }}</strong></a>
                            <br>
                            <small class="text-black-50 fw-light"><i class="fa fa-calendar me-3"></i>{{ date('d M, Y', strtotime($value->created_at)) }}</small>
                        </li>
                    @endforeach
                </ul>
                {{ $listPengumuman->links() }}
            </div>
        </div>
    </div>
</div>

@endsection
