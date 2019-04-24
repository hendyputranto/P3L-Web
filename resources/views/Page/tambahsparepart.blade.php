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
    <h2 align="center">Tambah Data Sparepart</h2>
    <table>
        <form class="form-horizontal" onsubmit = "return simpan()">
            <div class="form-group">
            <label class="control-label col-sm-2" for="kode_sparepart">KODE</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="kode_sparepart" placeholder="kode sparepart" name="kode_sparepart">
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="nama_sparepart">NAMA</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_sparepart" placeholder="nama sparepart" name="nama_sparepart">
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="merk_sparepart">MERK SPAREPART</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="merk_sparepart" placeholder="merk sparepart" name="merk_sparepart">
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="tipe_sparepart">TIPE SPAREPART</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="tipe_sparepart" placeholder="tipe sparepart" name="tipe_sparepart">
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="gambar_sparepart">GAMBAR SPAREPART</label>
            <div class="col-sm-10">
                <input type="file" class="form-control" id="gambar_sparepart" placeholder="gambar sparepart" name="gambar_sparepart">
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
            location.href = "{{ route('dsparepart') }}";
    }
    function simpan(){
        let kode_sparepart = document.querySelector('#kode_sparepart').value;
        let nama_sparepart = document.querySelector('#nama_sparepart').value;
        let merk_sparepart = document.querySelector('#merk_sparepart').value;
        let tipe_sparepart = document.querySelector('#tipe_sparepart').value;
        let gambar_sparepart = document.querySelector('#gambar_sparepart').value;
        let formData = new FormData();
        formData.append('kode_sparepart', kode_sparepart);
        formData.append('nama_sparepart', nama_sparepart);
        formData.append('merk_sparepart', merk_sparepart);
        formData.append('tipe_sparepart', tipe_sparepart);
        formData.append('gambar_sparepart', gambar_sparepart);
        axios.post('http://127.0.0.1:8000/api/sparepart', formData)
        .then((result) =>{
            console.log(result);
        })
        .catch((error) =>{
            console.log(error.response);
        });
        location.href = "{{ route('dsparepart') }}";
        return false;
    }
</script>
@endsection