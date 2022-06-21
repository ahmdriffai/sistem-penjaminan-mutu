@extends('layouts.template')

@section('content')

    <div class="row">
        <div class="col-md-6">
            @include('penjaminan-mutu.item-penjaminan-mutu')
        </div>
        <div class="col-md-6">
            @include('penjaminan-mutu.create')
        </div>
    </div>

@endsection
