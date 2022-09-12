@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Beranda</a></li>
        <li class="breadcrumb-item"><a href="#">Berita</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $berita->judul }}</li>
    </ol>
</nav>
<div class="row">
    <div class="col-md-8">
        <div class="row">
            <h4 class="text-success">{{ $berita->judul }}</h4>
            <small class="my-2 text-gray"><i class="fa fa-calendar" aria-hidden="true"></i> {{ $berita->created_at }}</small>
        </div>
        <img src="{{ $berita->gambar_url }}" class="img-fluid mb-5" width="100%">
        <p>
            {!! $berita->isi !!}
        </p>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow border">
            <div class="card-body">
                <h5><i class="fa fa-bullhorn"></i> Berita Terkini</h5>
                <ul class="list-group list-group-flush">
                    @foreach($listBerita as $value)
                        <li class="list-group-item">
                            <a href="" class="link-dark text-capitalize"><strong class="fw-light">{{ $value->judul }}</strong></a>
                            <br>
                            <small class="text-black-50 fw-light"><i class="fa fa-calendar me-3"></i>{{ date('d M, Y', strtotime($value->created_at)) }}</small>
                        </li>
                    @endforeach
                </ul>
                {{ $listBerita->links() }}
            </div>
        </div>
    </div>
</div>
<div class="row mt-5 gx-5 gy-3">
    <div class="col-md-12">
        <h3 class="text-success mb-5"><i class="fas fa-newspaper"></i> Berita Lainya</h3>
        <div class="row g-5">
            @foreach($listBerita as $value)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ $value->gambar_url }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><a href="{{ route('detail-berita', $value->id) }}" class="link-success">{{ $value->judul }}</a></h5>
                            <small><i class="fa fa-calendar" aria-hidden="true"></i> {{ $value->created_at }}</small>
                            <div class="mt-2 fw-light text-gray">
                                @php($start=strpos($value->isi, '<p>'))
                                @php($end=strpos($value->isi, '</p>'))
                                @php($isi= substr($value->isi, $start, $end))
                                {!! substr($isi, 0, 200) !!} ..
                            </div>
                            <a href="{{ route('detail-berita', $value->id) }}" class="link-success">selengkapnya ></a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
       
    </div>
</div>

@endsection
