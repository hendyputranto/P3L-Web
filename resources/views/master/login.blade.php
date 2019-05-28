<!DOCTYPE html>
<html>
<head>
    <title>Login SIMATO</title>
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<style>
body {font-family: Arial, Helvetica, sans-serif;}
body {
      background-color: lightgrey;
    }

form {
    border: 13px solid white;
    margin: auto;
    width: 40%;
}
h2{
    text-align: center;
}

input[type=text], input[type=password] {
  width: 45%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: grey;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border:white;
  cursor: pointer;
  width: 45%;
}

button:hover {
  opacity: 0.8;
}



/* .container {
  padding: 16px;
} */

/* span.psw {
  float: right;
  padding-top: 16px;
} */

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}

    /* Remove the navbar's default margin-bottom and rounded borders */ 
    /* .navbar {
      margin-bottom: 0;
      border-radius: 0;
    } */
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    /* .row.content {height: 1000px} */
    
    /* Set gray background color and 100% height */
    /* .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    } */
    
    /* Set black background color, white text and some padding */

    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
</style>
</head>

<body>
  <div class="container-fluid text-center"> 
  <h2>LOGIN</h2>
  <form onsubmit="return submit_login()" style="background:white">
      
      <br>
      <img src="gambar/logosimato.png" alt="logo simato" style="width:75px;height:75px;">
      <br>
      <input type="text" id="username" placeholder="Username" name="username">
      <br>
      <input type="password" id="password" placeholder="Password Anda" name="password">
      <br>
      <button type="submit" name="submit">Masuk</button>
     
  </form>
</div>


</body>

</html>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

  function cekEmpty(){
      if(document.getElementById("username").value == ""||
      document.getElementById("password").value == "")
      {
          return true;
      }
      else
          return false;
  }


  function submit_login()
    {
      if(cekEmpty())
      {
          alert("Data Tidak Boleh Kosong");
          return false;
      }
      else
      {
        let username, password;
        let col = ['id_pegawai', 'id_cabang_fk', 'id_role_fk','nama_role', 'nama_pegawai', 'alamat_pegawai', 'noTelp_pegawai', 
        'gaji_pegawai', 'username_pegawai', 'password_pegawai'];

          console.log(document.getElementById("username").value);
          console.log(document.getElementById("password").value);
          axios.post('http://127.0.0.1:8000/api/pegawai/login', {
            username_pegawai : document.getElementById("username").value,
            password_pegawai : document.getElementById("password").value
          })
          .then(function (response) {
            localStorage.setItem("aksescode",response.data.nama_pegawai);
            let cekId=response.data.id_role_fk;
            console.log(cekId);
            if(cekId=="1"){
              console.log("Owner");
              alert("Login Berhasil");
              location.href = "{{ url('/')}}";
            } else if(cekId=="2"){
              console.log("Customer Service");
            //   location.href = "{{ url('/dkonsumen')}}";
              location.href = "{{ route('dkonsumen') }}";
              alert("Login Berhasil");
            } else if(cekId=="3"){
              console.log("Kasir");
              // location.href = "{{ url('#')}}";
            } else {
              console.log("Montir");
            }
          })
          .catch(function (error) {
            alert("Login Gagal");
            console.log(error.response);
            // return false;
          });
          return false;  
      }
    }

  function batalbtn()
    {
      location.href="{{ url('/homekonsumen')}}";
    }

</script>
