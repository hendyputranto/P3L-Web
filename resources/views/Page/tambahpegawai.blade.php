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
    <h2 align="center">Tambah Data Pegawai</h2>
    <table>
        <form class="form-horizontal" onsubmit = "return simpan()">
            <div class="form-group">
            <label class="control-label col-sm-2" for="id_cabang">Pilih Cabang</label>
            <div class="col-sm-10">
                <select class="form-control" id="kode_cabang" name="id_cabang">
                    <option>--Pilih Cabang--</option>
                </select>
            </div>
            </div>
            
            <div class="form-group">
            <label class="control-label col-sm-2" for="nama_pegawai">NAMA</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_pegawai" placeholder="nama pegawai" name="nama_pegawai">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="alamat_pegawai">ALAMAT</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat_pegawai" placeholder="alamat pegawai" name="alamat_pegawai">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="noTelp_pegawai">NO TELP</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="noTelp_pegawai" placeholder="nomor telpon pegawai" name="noTelp_pegawai">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="gaji_pegawai">GAJI</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="gaji_pegawai" placeholder="gaji pegawai" name="gaji_pegawai">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="username">USERNAME</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" placeholder="nama pengguna pegawai" name="username">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="password">PASSWORD</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="password" placeholder="password pegawai" name="password">
            </div>
            </div>

            <div class="form-group">
            <div class="col-sm-offset-10 col-sm-20">
                <button type="button" class="btn btn-danger" onclick="batal()">BATAL</button>
                <button type="submit" value="Submit" class="btn btn-success" >SIMPAN</button>
            </div>
            </div>
            
        </form>
    </table>
  </div>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    function batal(obj){
            location.href = "{{ route('dpegawai') }}";
    }

    function simpan(){
        let id_cabang = document.querySelector('#id_cabang').value;
        let nama_pegawai = document.querySelector('#nama_pegawai').value;
        let alamat_pegawai = document.querySelector('#alamat_pegawai').value;
        let noTelp_pegawai = document.querySelector('#noTelp_pegawai').value;
        let gaji_pegawai = document.querySelector('#gaji_pegawai').value;
        let username = document.querySelector('#username').value;
        let password = document.querySelector('#password').value;
        let formData = new FormData();
        formData.append('id_cabang', id_cabang);
        formData.append('nama_pegawai', nama_pegawai);
        formData.append('alamat_pegawai', alamat_pegawai);
        formData.append('noTelp_pegawai', noTelp_pegawai);
        formData.append('gaji_pegawai', gaji_pegawai);
        formData.append('username', username);
        formData.append('password', password);
        axios.post('http://127.0.0.1:8000/api/pegawai/', formData)
        .then((result) =>{
            console.log(result);
        })
        .catch((error) =>{
            console.log(error.response);
        });
        location.href = "{{ route('dpegawai') }}";
        return false;
    }

    let select = document.querySelector('#id_cabang');

    axios.get('http://127.0.0.1:8000/api/cabang/')
    .then((result) => {
        for(let i = 0; i<result.data.length; i++) {
            let option = document.createElement('option');
            let txt = document.createTextNode(result.data[i].id_cabang);
            option.appendChild(txt);
            option.setAttribute('value', result.data[i].id_cabang);
            select.insertBefore(option, select.lastChild);
        }
    }).catch((err) => {
        console.log(err);
    });
</script>
@endsection