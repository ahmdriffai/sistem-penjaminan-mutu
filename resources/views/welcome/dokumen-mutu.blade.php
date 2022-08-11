@extends('layouts.app')
@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('welcome') }}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('welcome.dokumen-mutu', $penjaminanMutu->id) }}">{{ $penjaminanMutu->nama }}</a></li>
        </ol>
    </nav>
    @include('component.carousel')

    <div class="d-flex justify-content-between">
        <h3 class="text-success"> Dokumen {{ $penjaminanMutu->nama }}</h3>
        <div class="d-flex align-items-center flex-row justify-content-between">
            <form method="get" action="">
                <div class="input-group input-group-merge px-5">
                    <span class="input-group-text" id="basic-addon-search31"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="hidden" value="100" name="size">
                    <input
                        type="text"
                        name="key"
                        class="form-control"
                        placeholder="Search..."
                        aria-label="Search..."
                        aria-describedby="basic-addon-search31"
                        value="{{ $_GET['key'] ?? '' }}"
                    />
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <table class="table">
            <thead>
            <tr>
                <th>No</th>
                <th>Tahun</th>
                <th>Nama Dokumen</th>
                <th>Kode Dokumen</th>
                <th>Jumlah</th>
                <th>Detail</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr>
                    <td><strong>#</strong></td>
                    <td>{{ $value->tahun }}</td>
                    <td>{{ $value->nama }}</td>
                    <td>{{ $value->kode_dokumen }}</td>
                    <td>{{ $value->fileDokumen->count() }}</td>
                    <td class="d-flex">
                        <a class="btn btn-sm btn-info mx-1" href="{{ route('welcome.detail-dokumen-mutu', $value->id) }}">
                            <i class="bx bx-detail me-1"></i> Detail
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="mx-3 my-3">
            {{ $data->links() }}
        </div>
    </div>

@endsection
