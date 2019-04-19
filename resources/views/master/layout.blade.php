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

    .jumbotron1 {
    padding-top: 10px; 
    padding-bottom: 10px;
    padding-top: 10px;
    padding-bottom: 10px;
    color: inherit;
    background-color: #66CDAA;
    }

    .jumbotron1>img {
      float: right;
    }

    h1 {
      text-transform: uppercase;
      color: #191970;
      text-shadow: 3px 2px red;
    }

    body {
      background-color: lightblue;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-default" data-spy="affix" data-offset-top="128" padding-top="70px">
  <div class="container-fluid">
    <div class="navbar-header">

    </div>
    <ul class="nav navbar-nav" display="none">
      <li class="{{Request::is('/') ? 'active' : null}}"><a href="{{ url('/')}}">Pengadaan Sparepart</a></li>
      
      <li><a href="#">Laporan</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Keluar</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
     

      @yield('content')

</div>

</body>
</html>