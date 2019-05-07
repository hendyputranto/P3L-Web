@extends('master.layoutKonsumen')
@section('content')    
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
<nav class="navbar navbar-default" data-spy="affix" data-offset-top="128" padding-top="70px">
    <div class="container-fluid">
    <div class="navbar-header">
    </div>
               <!-- First Container -->
<div class="container-fluid bg-1 text-center">
  <h3 class="margin">SIMATO</h3>
  <img src="gambar/logosimato.png"  style="display:inline" alt="Bird" width="200" height="200">
  <h3>SELAMAT DATANG</h3>
</div>

<!-- Second Container -->


<!-- Third Container (Grid) -->
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

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p>CONTACT US FOR MORE INFORMATION : 085750177988</a></p> 
</footer>

<div class="container">
                @yield('content')
            </div>
        </div>
    </div>
@endsection