<div class="card border-0 shadow">
    <div class="card-body">
        <h5><i class="fa fa-bullhorn"></i> Pengumuman SPMI</h5>
        <ul class="list-group list-group-flush">
            @foreach($pengumuman as $value)
                <li class="list-group-item">
                    <a href="{{ route('detail-pengumuman', $value->id) }}" class="link-dark text-capitalize"><strong class="fw-normal">{{ $value->judul }}</strong></a>
                    <br>
                    <small class="text-black-50 fw-light"><i class="fas fa-calendar me-3"></i>{{ date('d M, Y', strtotime($value->created_at)) }}</small>
                </li>
            @endforeach
        </ul>
        {{ $pengumuman->links() }}
    </div>
</div>
