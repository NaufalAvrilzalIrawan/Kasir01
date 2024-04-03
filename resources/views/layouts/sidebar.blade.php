<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Coba</title>
  <link rel="stylesheet" href="assets/css/bootstrap/bootstrap.min.css">
</head>

<body>
  <div class="container-fluid">
    <div class="row flex-nowrap">
      
      <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
            <a href="" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none mt-3 ">
                <span class="fs-3 d-none d-sm-inline"><i class="fa-solid fa-cart-shopping me-2"></i>Kasiran</span>
            </a>

            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start mt-3">
                <li class="nav-item">
                    <a class="nav-link align-middle px-0" href="/dashboard"><i class="fa-solid fa-house fs-6 "></i><span
                            class="ms-1 d-none d-sm-inline">Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link align-middle px-0" href="/petugas"><i class="fa-solid fa-users fs-6 "></i><span
                            class="ms-1 d-none d-sm-inline">Data Petugas</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link align-middle px-0" href="/barang"><i class="fa-solid fa-boxes-stacked fs-6 "></i><span
                            class="ms-1 d-none d-sm-inline">Data Barang</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link align-middle px-0" href="#"><i class="fa-solid fa-percent fs-6 "></i><span
                            class="ms-1 d-none d-sm-inline">Diskon</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link align-middle px-0" href="#"><i class="fa-solid fa-cart-shopping fs-6 "></i><span
                            class="ms-1 d-none d-sm-inline">Transaksi</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link align-middle px-0" href="#"><i class="fa-solid fa-receipt fs-6 "></i><span
                            class="ms-1 d-none d-sm-inline">Laporan</span></a>
                </li>
            </ul>
        </div>
      </div>

      <div class="col py-5">
        @yield('content')
      </div>

    </div>
  </div>
<script src="assets/js/bootstrap/bootstrap.min.js"></script>
</body>

