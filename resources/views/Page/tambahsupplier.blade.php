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
    <h2 align="center">Tambah Data Supplier</h2>
    <table>
        <form class="form-horizontal" onsubmit = "return simpan()">
            <div class="form-group">
            <label class="control-label col-sm-2" for="nama_supplier">NAMA SUPPLIER</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_supplier" placeholder="nama supplier" name="nama_supplier">
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="noTelp_supplier">NO TELP SUPPLIER</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="noTelp_supplier" placeholder="no telp supplier" name="noTelp_supplier">
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="alamat_supplier">ALAMAT SUPPLIER</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat_supplier" placeholder="alamat supplier" name="alamat_supplier">
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="nama_sales">NAMA SALES</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_sales" placeholder="nama sales" name="nama_sales">
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="noTelp_sales">NO TELP SALES</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="noTelp_sales" placeholder="no telp sales" name="noTelp_sales">
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
            location.href = "{{ route('dsupplier') }}";
    }
    function simpan(){
        let nama_supplier = document.querySelector('#nama_supplier').value;
        let noTelp_supplier = document.querySelector('#noTelp_supplier').value;
        let alamat_supplier = document.querySelector('#alamat_supplier').value;
        let nama_sales = document.querySelector('#nama_sales').value;
        let noTelp_sales = document.querySelector('#noTelp_sales').value;
        let formData = new FormData();
        formData.append('nama_supplier', nama_supplier);
        formData.append('noTelp_supplier', noTelp_supplier);
        formData.append('alamat_supplier', alamat_supplier);
        formData.append('nama_sales', nama_sales);
        formData.append('noTelp_sales', noTelp_sales);
        axios.post('http://127.0.0.1:8000/api/supplier', formData)
        .then((result) =>{
            console.log(result);
        })
        .catch((error) =>{
            console.log(error.response);
        });
        location.href = "{{ route('dsupplier') }}";
        return false;
    }
</script>
@endsection