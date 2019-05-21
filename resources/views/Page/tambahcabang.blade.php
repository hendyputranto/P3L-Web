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
    <h2 align="center">Tambah Data Cabang</h2>
    <table>
        <form class="form-horizontal" onsubmit = "return simpan()">
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
        location.href = "{{ url('/cabang')}}";
    }
    function simpan(){
        let nama_cabang = document.querySelector('#nama_cabang').value;
        let alamat_cabang = document.querySelector('#alamat_cabang').value;
        let noTelp_cabang = document.querySelector('#noTelp_cabang').value;
        let formData = new FormData();
        formData.append('nama_cabang', nama_cabang);
        formData.append('alamat_cabang', alamat_cabang);
        formData.append('noTelp_cabang', noTelp_cabang);
        axios.post('http://127.0.0.1:8000/api/cabang', formData)
        .then((result) =>{
            console.log(result);
        })
        .catch((error) =>{
            console.log(error.response);
        });
        location.href = "{{ url('/cabang')}}";
        return false;
    }
</script>
@endsection