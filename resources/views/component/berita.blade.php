<div class="container">
    <div class="row mt-5 gx-5 gy-3">
        <div class="col-md-12">
            <h3 class="text-success text-center mb-5"><i class="fas fa-newspaper"></i> Berita</h3>
            <div class="row g-5">
                @foreach($berita as $value)
                    <div class="col-md-4">
                        <div class="card card-berita">
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
</div>
