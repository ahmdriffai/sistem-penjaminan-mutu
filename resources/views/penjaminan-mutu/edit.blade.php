@extends('layouts.template')

@section('content')
<a class="btn btn-primary mb-3" href="{{ route('penjaminan-mutu.index') }}">
    <i class="bx bx-arrow-back me-1"></i> Kembali
</a>
<div class="card mb-4">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Edit Item Penjaminan Mutu</h5>
    </div>
    <div class="card-body">
        <form action="/penjaminan-mutu/{{$penjaminanMutu->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        {{-- {!! Form::open(['route' => 'penjaminan-mutu.store', 'method' => 'POST']) !!} --}}
        <div class="mb-3">
            <label class="text-danger">*</label>
            {!! Form::label('nama', 'Nama', ['class' => 'form-label']); !!}
            {!! Form::text('nama', $penjaminanMutu->nama ,['class' => 'form-control']); !!}
        </div>
        <div class="mb-3">
            {!! Form::label('keterangan', 'Keterangan', ['class' => 'form-label']); !!}
            <div class="input-group input-group-merge">
                {!! Form::textarea('keterangan', $penjaminanMutu->keterangan, array('class' => 'form-control', 'id' => 'body', 'width' => '100%')) !!}
            </div>
            <div class="form-text">* keterangan penjaminan mutu, misal : sop adalah ...</div>
        </div>
        <div class="mb-3">
            <label for="icon" class="form-label @error('icon') is-invalid @enderror">Icon</label>
            <input type="hidden" name="oldImage" value="{{$penjaminanMutu->icon}}">
            @if ($penjaminanMutu->icon)
                <img src="{{asset('storage/'.$penjaminanMutu->icon)}}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
            @else
                <img class="img-preview img-fluid mb-3 col-sm-5">
            @endif
            <input class="form-control" type="file" id="icon" name="icon" onchange="previewImage()">
            @error('icon')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Kirim</button>
        </form>
    </div>
</div>
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

        function previewImage() {
            const icon = document.querySelector('#icon');
            const imgPreview = document.querySelector('.img-preview');
        
            imgPreview.style.display='block';
            const oFReader = new FileReader();
            oFReader.readAsDataURL(icon.files[0]);

            oFReader.onload = function(oFREvent){
                imgPreview.src=oFREvent.target.result;
            }
        }
    </script>
@endsection



