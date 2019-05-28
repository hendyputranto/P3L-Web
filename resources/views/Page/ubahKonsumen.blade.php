@extends('master.layoutCS')
@section('content')
<style>
    .kotak {
        width: 100%;
        padding: 10px;
        border: 5px solid gray;
        margin: 0;
        background-color:lightgrey;
    }

    h2 {
        font-size: 40px;
    }
</style>    
<div class="container">
  <div class="kotak">
    <h2 align="center">Ubah Data Konsumen</h2>
    <table>
        <form class="form-horizontal" action="/action_page.php">
            
            <div class="form-group">
            <label class="control-label col-sm-2" for="nama_konsumen">NAMA</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_konsumen" placeholder="nama konsumen" name="nama_konsumen">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="alamat_konsumen">ALAMAT</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat_konsumen" placeholder="alamat konsumen" name="alamat_konsumen">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="noTelp_konsumen">NO TELP</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="noTelp_konsumen" placeholder="nomor telpon konsumen" name="notTelp_konsumen">
            </div>
            </div>

            <div class="form-group">
            <div class="col-sm-offset-10 col-sm-20">
                <button type="button" class="btn btn-danger" onclick="batal()">BATAL</button>
                <button type="button" class="btn btn-success" onclick="simpan()">SIMPAN</button>
            </div>
            </div>

            
        </form>
    </table>
  </div>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    let b = localStorage.getItem("id_konsumen");
    let data;

    axios.get('http://192.168.19.140/P3L_L_1/api/konsumen/'+b)
    .then(function (response) {
        // handle success
        data = response.data.data;
        let col = ['id_konsumen','nama_konsumen','alamat_konsumen','noTelp_konsumen'];
        document.getElementById("nama_konsumen").value = data[col[1]];
        document.getElementById("alamat_konsumen").value = data[col[2]];
        document.getElementById("noTelp_konsumen").value = data[col[3]];
        console.log(data[col[1]]);
        console.log(data);
    })
    .catch(function (error) {
        // handle error
        console.log(error);
    });
    function batal(obj){
        location.href = "{{ url('/konsumen')}}";
    }

    function simpan(){
        let formData = new FormData; 
        let nama= document.getElementById("nama_konsumen").value;
        let alamat= document.getElementById("alamat_konsumen").value;
        let notelp= document.getElementById("noTelp_konsumen").value;
        formData.append('_method', 'PUT');
        formData.append('nama_konsumen', nama);
        formData.append('alamat_konsumen', alamat);
        formData.append('noTelp_konsumen', notelp);
        axios.post('http://192.168.19.140/P3L_L_1/api/konsumen/' + b, formData)
                .then((result) => {
                    console.log(result);
                    location.href = "{{ url('/konsumen')}}";
                    edited = false;
                }).catch((err) => {
                    console.log(err);
                });
        // 
    }
</script>
@endsection