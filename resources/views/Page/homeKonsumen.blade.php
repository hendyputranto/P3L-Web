@extends('master.layoutKonsumen')
@section('content')
<div class="container">
  <h2 align="middle">SELAMAT DATANG</h2>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">

      <div class="item active">
        <img src="asset/gambar.jpg" alt="" style="width:1200px; height:450px;">
        <div class="carousel-caption">
        </div>
      </div>

      <div class="item">
        <img src="asset/gambar1.jpg" alt="" style="width:1200px; height:450px;">
        <div class="carousel-caption">
        </div>
      </div>
    
      <div class="item">
        <img src="asset/gambar2.jpg" alt="" style="width:1200px; height:450px;">
        <div class="carousel-caption">
        </div>
      </div>
  
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<div class="container" align="middle"> 
  <h3>Jadwal Buka</h3>
  <h5>Setiap Hari  :  08:00 - 18:00</h5>
  
</div>
<!---Footer--->
<div class="container">
    <div class="row">
      <div class="col-sm-4">
        <div class="column">
        <div class="home-image">
          <img class="image1" src="asset/facebook_48px.png" alt="">
        </div>
        <div class="home-introduction">
          <h4>SIMATO BENGKEL</h4>
            <!-- <p>Saat Anda memesan langsung dengan kami, Anda akan mendapatkan lebih dari sekadar inklusi dasar kami. Sarapan gratis, WiFi gratis, dan tambahan lainnya.</p> -->
        </div>
      </div>
      </div>
      <div class="col-sm-4">
      <div class="column">
        <div class="home-image">
          <img class="image1" src="asset/instagram_new_48px.png" alt="">
        </div>
        <div class="home-introduction">
          <h4>SIMATO BENGKEL</h4>
            <!-- <p>Kami menjamin keamanan dan privasi Anda. Dengan berbagai opsi pembayaran yang bisa Anda pilih. Dari kredit & kartu debit dengan logo Visa / Mastercard / JCB / AMEX, transfer bank melalui BCA Virtual Account, dan bayar di bengkel.</p> -->
        </div>
      </div>
      </div>
      <div class="col-sm-4">
        <div class="column">
        <div class="home-image">
          <img class="image1" src="asset/google_maps_48px.png" alt="">
        </div>
        <div class="home-introduction">
          <h4>SIMATO BENGKEL</h4>
            <!-- <p>Penasaran apa pendapat konsumen lain tentang bengkel kami? Baca ulasan dari tamu sungguhan untuk membuat keputusan Anda lebih mudah.</p> -->
        </div>
      </div>
      </div>
    </div>
</div>
@endsection