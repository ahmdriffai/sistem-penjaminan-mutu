

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/style.css">
    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
        .img{
            background-size: cover;
            width: 100%;
        }

        .doc{
            width: 100px;
            height: 100px;
        }

        .flex{
            display: flex;
            justify-content: center;
            align-items: center;
            color: #f1f1f1;
        }


        .Card{
            background-color: rgba(39, 153, 39, 0.979);
            width: 200px;
            height: 220px;
            margin: 1rem auto;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .Icon{
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            height: 150px;
            width: 150px;
            color: #f1f1f1;
            background-color: rgb(249 115 22);
        }

        .CardTitle{
            margin: 1rem;
            color: #2b2a2a;
            font-weight: 400;
        }

        .IconTitle{
            margin: 2rem auto;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            height: 180px;
            width: 180px;
            color: #f1f1f1;
            background-color: rgba(39, 153, 39, 0.979);
        }
    </style>
    <title>E-SPMI</title>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top shadow py-3 px-3 navbar-light bg-light">
    <div class="container-fluid">
        <a class="sidebar-brand-icon d-flex justify-content-center align-items-center">
            <img src="../img/fksp.png" style="width: 50px;height: 50px;" alt="logo fakultas e-spmi fksp">
            <h3 class="sidebar-brand-text mx-3" style="color: black">E-SPMI</h3>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Manual Mutu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Sop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Instruksi Kerja</a>
                </li>
                <li class="nav-item mr-3">
                    <a class="nav-link" href="#">Lembar Formulir</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn green px-3  text-white" href="#">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="jumbotron-fluid">
    <img src="../img/bannerspmi.png" class="img" alt="">
</div>
<div class="container-fluid col-11 mt-4">
    <h3 class="text-center">Tentang SPMI</h3>
    <p class="text-justify text-md mt-3 mx-auto">Sistem Penjaminan Mutu Internal adalah sistem penjaminan mutu yang berjalan di dalam satuan pendidikan dan dijalankan oleh seluruh komponen dalam satuan pendidikan yang mencakup seluruh aspek penyelenggaraan pendidikan denganmemanfaatkan berbagai sumberdaya untuk mencapai SNP Sistem Penjaminan Mutu Internal adalah sistem penjaminan mutu yang berjalan di dalam satuan pendidikan dan dijalankan oleh seluruh komponen dalam satuan pendidikan yang mencakup
        seluruh aspek penyelenggaraan pendidikan dengan memanfaatkan berbagai sumberdaya untuk mencapai SNP Sistem Penjaminan Mutu Internal adalah sistem penjaminan mutu yang berjalan di dalam satuan pendidikan dan dijalankan oleh seluruh</p>
</div>
<div class="container-fluid col-12">
    <div class="row">
        <div class="IconTitle">
            <i class="fa fa-archive fa-6x" aria-hidden="true"></i>
        </div>
    </div>
    <div class="row justify-content-center mb-4">
        <h3 class="text-center">Dokumen SPMI</h3>
    </div>
    <div class="row mb-4">
        <div class="Card">
            <div class="Icon">
                <i class="fa fa-archive fa-6x" aria-hidden="true"></i>
            </div>
            <h5 class="CardTitle text-center text-white">Manual Mutu</h5>
        </div>
        <div class="Card">
            <div class="Icon">
                <i class="fa fa-archive fa-6x" aria-hidden="true"></i>
            </div>
            <h5 class="CardTitle text-center text-white">SOP</h5>
        </div>
        <div class="Card">
            <div class="Icon">
                <i class="fa fa-archive fa-6x" aria-hidden="true"></i>
            </div>
            <h5 class="CardTitle text-center text-white">Instruksi Kerja</h5>
        </div>
        <div class="Card">
            <div class="Icon">
                <i class="fa fa-archive fa-6x" aria-hidden="true"></i>
            </div>
            <h5 class="CardTitle text-center text-white">Lembar Formulir</h5>
        </div>
    </div>
</div>
<!-- Footer -->
<footer class="text-center text-lg-start bg-dark text-muted">

    <!-- Section: Links  -->
    <div class="container-fluid text-center text-md-start mt-5 text-white">
        <!-- Grid row -->
        <div class="row mt-3 py-3">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                <!-- Content -->
                <h6 class="text-uppercase fw-bold mb-4">
                    <i class="fas fa-gem me-3"></i>Company name
                </h6>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">
                    Products
                </h6>
                <p>
                    <a href="#!" class="text-reset">Angular</a>
                </p>
                <p>
                    <a href="#!" class="text-reset">React</a>
                </p>
                <p>
                    <a href="#!" class="text-reset">Vue</a>
                </p>
                <p>
                    <a href="#!" class="text-reset">Laravel</a>
                </p>
            </div>
            <!-- Grid column -->

            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                <!-- Links -->
                <h6 class="text-uppercase fw-bold mb-4">
                    Contact
                </h6>
                <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
                <p>
                    <i class="fas fa-envelope me-3"></i>
                    info@example.com
                </p>
                <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
            </div>
            <!-- Grid column -->
        </div>
        <!-- Grid row -->
    </div>

    <!-- Copyright -->
    <div class="text-center p-4 text-white">
        © 2022 Copyright:
        <a class="text-reset fw-bold" href="">FKSP</a>
    </div>
    <!-- Copyright -->
</footer>
<!-- Footer -->



<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

</body>
</html>
