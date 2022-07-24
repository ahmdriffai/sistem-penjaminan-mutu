@extends('layouts.template')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang {{ Auth::user()->name }} 🎉</h5>
                                <p class="mb-4">
                                    Anda login sebagai <strong>{{ Auth::user()->getRoleNames()->first() }}</strong>
                                </p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img
                                    src="../assets/img/illustrations/man-with-laptop-light.png"
                                    height="140"
                                    alt="View Badge User"
                                    data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded" />
                                    </div>
                                    <div class="dropdown">
                                        <button
                                            class="btn p-0"
                                            type="button"
                                            id="cardOpt4"
                                            data-bs-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="d-block mb-1">Total File Dokumen Penjaminan</span>
                                <h3 class="card-title text-nowrap mb-2">{{ $totalFileDokumen }} File</h3>
                                <small class="text-danger fw-semibold"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <img src="../assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded" />
                                    </div>
                                    <div class="dropdown">
                                        <button
                                            class="btn p-0"
                                            type="button"
                                            id="cardOpt1"
                                            data-bs-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false"
                                        >
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                            <a class="dropdown-item" href="javascript:void(0);">View More</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1">Total Dokumen Penjaminan Mutu</span>
                                <h3 class="card-title mb-2">{{ $totalPenjaminanMutu }} Dokumen</h3>
                                <small class="text-success fw-semibold"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Transactions -->
            <div class="col-md-6 col-lg-4 order-1 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Info Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            @foreach($pengumuman as $value)
                            <li class="d-flex mb-4 pb-1">
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h4 class="mb-0">
                                            <a href="{{ route('pengumuman.show', $value->id) }}" class="link-primary">{{ $value->judul }}</a>
                                        </h4>
                                        <small class="text-muted d-block mb-1">{{ date('d M, Y', strtotime($value->created_at)) }}</small>
                                    </div>
                                    <div class="user-progress d-flex align-items-center gap-1">
                                        <h6 class="mb-0">+82.6</h6>
                                        <span class="text-muted">USD</span>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="ms-3">
                        {{ $pengumuman->links() }}
                    </div>
                </div>
            </div>
            <!--/ Transactions -->

            <!-- Expense Overview -->
            <div class="col-md-6 col-lg-8 order-2 mb-4">
                <div class="card">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Grafik Jurnal Ilmiah</h5>
                    </div>
                    <div class="card-body px-0">
                        <div id="columnchart_material" class="p-5" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
            </div>
            <!--/ Expense Overview -->


        </div>
    </div>
    <!-- / Content -->
@endsection

@section('style')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['bar']});
        google.charts.setOnLoadCallback(drawChart);

        let data = [];
        let penelitian;
        let pengabdian;
        let paperIlmiah;
        @foreach($penelitian as $data)
            penelitian = {{ $data->data }} ?? 0;
        @endforeach
        @foreach($pengabdian as $data)
            pengabdian = {{ $data->data }} ?? 0;
        @endforeach
        @foreach($paperIlmiah as $data)
            paperIlmiah = {{ $data->data }} ?? 0;
        @endforeach

        @foreach($penelitian as $value)
            data.push('{{$value->year}}');
            data.push(penelitian);
            data.push(pengabdian);
            data.push(paperIlmiah);
        @endforeach

        console.log(data[0]);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Year', 'Penelitian', 'Pengabdian', 'Paper Ilmiah'],
                @foreach($penelitian as $value)
                    ['{{$value->name_month}} - {{$value->year}}', penelitian, pengabdian, paperIlmiah],
                @endforeach
            ]);

            var options = {
                chart: {
                    title: 'Grafiik Total Jurnal Ilimiah Per Tahun',
                    subtitle: 'Pengbdian, Penelitian, Paper Ilmiah',
                }
            };

            var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

            chart.draw(data, google.charts.Bar.convertOptions(options));
        }
    </script>
@endsection
