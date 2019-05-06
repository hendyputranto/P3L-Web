@extends('master.layout')
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
    <h2 align="center">Tambah Data Konsumen</h2>
    <table>
        <form class="form-horizontal" onsubmit = "return simpan()">
            <div class="form-group">
            <label class="control-label col-sm-2" for="nama_konsumen">NAMA</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_konsumen" placeholder="Nama Konsumen" name="nama_konsumen">
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="alamat_konsumen">ALAMAT</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat_konsumen" placeholder="Alamat Konsumen" name="alamat_konsumen">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="noTelp_konsumen">NO TELP</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="noTelp_konsumen" placeholder="Nomor Telepon Konsumen" name="noTelp_konsumen">
            </div>
            </div>

            <div class="form-group">
            <div class="col-sm-offset-10 col-sm-20">
                <button type="button" class="btn btn-danger" onclick="batal()">BATAL</button>
                <button type="submit" value="Submit" class="btn btn-success">SIMPAN</button>
            </div>
            </div>
        </form>
    </table>
  </div>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    function batal(obj){
        location.href = "{{ url('/konsumen')}}";
    }

    function simpan(){
        let nama_konsumen = document.querySelector('#nama_konsumen').value;
        let alamat_konsumen = document.querySelector('#alamat_konsumen').value;
        let noTelp_konsumen = document.querySelector('#noTelp_konsumen').value;
        let formData = new FormData();
        formData.append('nama_konsumen', nama_konsumen);
        formData.append('alamat_konsumen', alamat_konsumen);
        formData.append('noTelp_konsumen', noTelp_konsumen);
        axios.post('http://192.168.0.176:8000/api/konsumen', formData)
        .then((result) =>{
            console.log(result);
            location.href = "{{ url('/konsumen')}}";
            
        })
        .catch((error) =>{
            console.log(error.response);
        });
        
        return false;
    }


</script>
@endsection