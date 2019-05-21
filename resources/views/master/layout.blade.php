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
   
      <li><a href="#">Laporan</a></li>
      
      <li><a href="{{ url('/login')}}"><span class="glyphicon glyphicon-log-in"></span> Keluar</a></li>
    </ul>
  </div>
</nav>
  
<div class="container">
     

      @yield('content')

</div>

</body>
</html>