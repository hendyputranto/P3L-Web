<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <title>HOME</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
  body {
    font: 20px Montserrat, sans-serif;
    line-height: 1.8;
    color: #f5f6f7;
  }
  p {font-size: 16px;}
  .margin {margin-bottom: 45px;}
  .bg-1 { 
    background-color: #1abc9c; /* Green */
    color: #ffffff;
  }
  .bg-2 { 
    background-color: #474e5d; /* Dark Blue */
    color: #ffffff;
  }
  .bg-3 { 
    background-color: #ffffff; /* White */
    color: #555555;
  }
  .bg-4 { 
    background-color: #2f2f2f; /* Black Gray */
    color: #fff;
  }
  .container-fluid {
    padding-top: 70px;
    padding-bottom: 70px;
  }
  .navbar {
    padding-top: 15px;
    padding-bottom: 15px;
    border: 0;
    border-radius: 0;
    margin-bottom: 0;
    font-size: 12px;
    letter-spacing: 5px;
  }
  .navbar-nav  li a:hover {
    color: #1abc9c !important;
  }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="{{ url('/homeKonsumen')}}">HOME</a>
      <a class="navbar-brand" href="{{ url('/catalog')}}">CATALOG</a>
      <a class="navbar-brand" href="{{ url('/riwayatKonsumen')}}">RIWAYAT</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right"></ul>
    </div>
  </div>
</nav>

<!-- <div class="container-fluid bg-1 text-center">
  <h3 class="margin">SIMATO</h3>
  <img src="gambar/logosimato.png"  style="display:inline" alt="Bird" width="200" height="200">
  <h3>SELAMAT DATANG</h3>
</div>
<div class="container-fluid bg-3 text-center">    
  <h3 class="margin">LAYANAN APA YANG KAMI BERIKAN ?</h3><br>
  <div class="row">
    <div class="col-sm-4">
      <p>Kami melayani penjualan sparepart yang berkualitas dan tahan lama daripada bengkel yang lainnya :)</p>
    </div>
    <div class="col-sm-4"> 
      <p>Kami melayani jasa service yang sangat baik dan teliti sehingga anda tidak perlu khawatir akan motor anda :)</p>
    </div>
    <div class="col-sm-4"> 
      <p>Kami melayani penjualan sekaligus jasa service agar motor anda terasa seperti baru dan lebih bagus dari sebelumnya :)</p>
    </div>
  </div>
</div>


<footer class="container-fluid bg-4 text-center">
  <p>CONTACT US FOR MORE INFORMATION : 085750177988</a></p> 
</footer> -->

<div class="container">
     

      @yield('content')

</div>

</body>
</html>
