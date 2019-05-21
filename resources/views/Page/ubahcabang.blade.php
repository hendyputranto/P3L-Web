@extends('master.layout')
@section('content')
<style>
    .kotak {
        width: 100%;
        padding: 10px;
        border: 5px solid gray;
        margin: 0;
        background-color:#FFFFFF;
    }

    h2 {
        font-size: 40px;
    }
</style>    
<div class="container">
  <div class="kotak">
    <h2 align="center">Ubah Data Cabang</h2>
    <table>
        <form class="form-horizontal" action="/action_page.php">
            
            <div class="form-group">
            <label class="control-label col-sm-2" for="nama_cabang">NAMA</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_cabang" placeholder="nama cabang" name="nama_cabang">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="alamat_cabang">ALAMAT</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat_cabang" placeholder="alamat cabang" name="alamat_cabang">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="noTelp_cabang">NO TELP</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="noTelp_cabang" placeholder="nomor telpon cabang" name="noTelp_cabang">
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
    let b = localStorage.getItem("id_cabang");
    let data;

    axios.get('http://127.0.0.1:8000/api/cabang/'+b)
    .then(function (response) {
        // handle success
        data = response.data.data;
        let col = ['id_cabang','nama_cabang','alamat_cabang','noTelp_cabang'];
        document.getElementById("nama_cabang").value = data[col[1]];
        document.getElementById("alamat_cabang").value = data[col[2]];
        document.getElementById("noTelp_cabang").value = data[col[3]];
        console.log(data[col[1]]);
        console.log(data);
    })
    .catch(function (error) {
        // handle error
        console.log(error);
    });
    function batal(obj){
        location.href = "{{ url('/cabang')}}";
    }

    function simpan(){
        let formData = new FormData; 
        let nama= document.getElementById("nama_cabang").value;
        let alamat= document.getElementById("alamat_cabang").value;
        let notelp= document.getElementById("noTelp_cabang").value;
        formData.append('_method', 'PUT');
        formData.append('nama_cabang', nama);
        formData.append('alamat_cabang', alamat);
        formData.append('noTelp_cabang', notelp);
        axios.post('http://127.0.0.1:8000/api/cabang/' + b, formData)
                .then((result) => {
                    console.log(result);
                
                    edited = false;
                }).catch((err) => {
                    console.log(err);
                });
                location.href = "{{ url('/cabang')}}";
    }
</script>
@endsection