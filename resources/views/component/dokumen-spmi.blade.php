<div class="container my-5 pb-5">
    <div class="row mt-5 gx-5 gy-3">
        <div class="col-md-12">
            <h3 class="text-success text-center mb-5"><i class="fas fa-file-archive"></i> Dokumen SPMI</h3>
            <p class="text-justify mb-4">
                Agar SPMI ini bisa diimplemetasikan, disusun standar mutu akademik FKSP-UNSIQ yang merupakan standar pendidikan tinggi yang ditetapkan oleh FKSP-UNSIQ sebagai acuan dalam penyelenggaraan proses akademik. Evaluasi proses akademik ini akan dilakukan melalui asesmen prodi dan fakultas/sekolah.
            </p>
            <div class="row g-5">
                @foreach($penjaminanMutu as $value)
                <div class="col-md">
                    <div class="card" style="width: 18rem;">
                        <img src="{{ asset('pm-icon/' . $value->icon) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $value->nama }}</h5>
                            <p class="card-text">{{ $value->keterangan }}</p>
                            <a href="{{ route('welcome.dokumen-mutu', $value->id) }}" class="btn btn-primary">Detail</a>
                        </div>
                    </div>
                    <!-- <a href="{{ route('welcome.dokumen-mutu', $value->id) }}" class="nav-link">
                        <div class="card card-berita shadow text-center p-5">
                            <div class="bg-white">
                                <i class="far fa-file-archive text-primary" style="font-size: 50px"></i>
                            </div>
                            <h5 class="card-title m-3">{{ $value->nama }}</h5>
                        </div>
                    </a> -->
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
