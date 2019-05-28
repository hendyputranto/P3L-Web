<!DOCTYPE html>
<html lang="en">
<head>
  <title>SIMATO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style>
    .affix {
      top: 0;
      width: 100%;
      z-index: 9999 !important;
    }

    .affix + .container-fluid {
      padding-top: 70px;
    }

    h1 {
      text-transform: uppercase;
      color: #191970;
      text-shadow: 3px 2px red;
    }

    body {
      background-color: #C0C0C0;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-default" data-spy="affix" data-offset-top="128" padding-top="70px">
  <div class="container-fluid">
    <div class="navbar-header">
    </div>
    <img src="gambar/logosimato.png" alt="" width="50" height="50">
    <ul class="nav navbar-nav navbar-right" display="none" >
      <li class="dropdown {{Request::is('keloladataCS/*') ? 'active' : null }}"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Kelola Data <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li class="{{Request::is('keloladataCS/dkonsumen') ? 'active' : null}}"><a href="{{ route('dkonsumen') }}">Konsumen</a></li>
          <li class="divider"></li>
          <li class="{{Request::is('keloladataCS/dmotorkonsumen') ? 'active' : null}}"><a href="{{ route('dmotorkonsumen') }}">Motor Konsumen</a></li>
          <li class="divider"></li>
          <li class="{{Request::is('keloladataCS/dtransaksiPenjualan') ? 'active' : null}}"><a href="{{ route('dtransaksiPenjualan') }}">Transaksi Penjualan Service</a></li>
          <li class="divider"></li>
          <li class="{{Request::is('keloladataCS/dtransaksiPenjualanSparepart') ? 'active' : null}}"><a href="{{ route('dtransaksiPenjualanSparepart') }}">Transaksi Penjualan Sparepart</a></li>
          <li class="divider"></li>
          <li class="{{Request::is('keloladataCS/dtransaksiPenjualanSS') ? 'active' : null}}"><a href="{{ route('dtransaksiPenjualanSS') }}">Transaksi Penjualan Sparepart & Service</a></li>
          <li class="divider"></li>
          <li class="{{Request::is('keloladataCS/dtampilTransaksi') ? 'active' : null}}"><a href="{{ route('dtampilTransaksi') }}">Tampil Transaksi Penjualan</a></li>
          <li class="divider"></li>
          <li class="{{Request::is('keloladataCS/dtampilTransaksi1') ? 'active' : null}}"><a href="{{ route('dtampilTransaksi1') }}"> Tampil Transaksi Jasa Service</a></li>
          <li class="divider"></li>
        </ul>
      </li>
      <li><a href="{{ url('/login')}}"><span class="glyphicon glyphicon-log-in"></span> Keluar</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
     

      @yield('content')

</div>

</body>
</html>