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
                <select class="form-control" id="id_cabang" name="id_cabang">
                    <option>--Pilih Cabang--</option>
                </select>
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="id_role">Pilih Role</label>
            <div class="col-sm-10">
                <select class="form-control" id="id_role" name="id_role">
                    <option>--Pilih Role--</option>
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
            <label class="control-label col-sm-2" for="username_pegawai">USERNAME</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username_pegawai" placeholder="nama pengguna pegawai" name="username_pegawai">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="password_pegawai">PASSWORD</label>
            <div class="col-sm-10">
                <input type="password" class="form-control" id="password_pegawai" placeholder="password pegawai" name="password_pegawai">
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
        let id_role = document.querySelector('#id_role').value;
        let nama_pegawai = document.querySelector('#nama_pegawai').value;
        let alamat_pegawai = document.querySelector('#alamat_pegawai').value;
        let noTelp_pegawai = document.querySelector('#noTelp_pegawai').value;
        let gaji_pegawai = document.querySelector('#gaji_pegawai').value;
        let username = document.querySelector('#username_pegawai').value;
        let password = document.querySelector('#password_pegawai').value;
        let formData = new FormData();
        formData.append('id_cabang_fk', id_cabang);
        formData.append('id_role_fk', id_role);
        formData.append('nama_pegawai', nama_pegawai);
        formData.append('alamat_pegawai', alamat_pegawai);
        formData.append('noTelp_pegawai', noTelp_pegawai);
        formData.append('gaji_pegawai', gaji_pegawai);
        formData.append('username_pegawai', username);
        formData.append('password_pegawai', password);
        axios.post('http://192.168.19.140/P3L_L_1/api/pegawai/', formData)
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
    let select2 = document.querySelector('#id_role');

    axios.get('http://192.168.19.140/P3L_L_1/api/cabang/')
    .then((result) => {
        for(let i = 0; i<result.data.data.length; i++) {
            let option = document.createElement('option');
            let txt = document.createTextNode(result.data.data[i].id_cabang+''+result.data.data[i].nama_cabang);
            option.appendChild(txt);
            option.setAttribute('value', result.data.data[i].id_cabang);
            select.insertBefore(option, select.lastChild);
        }
    }).catch((err) => {
        console.log(err);
    });

    axios.get('http://192.168.19.140/P3L_L_1/api/role/')
    .then((result) => {
        for(let i = 0; i<result.data.length; i++) {
            let option = document.createElement('option');
            let txt = document.createTextNode(result.data[i].id_role+' '+result.data[i].nama_role);
            option.appendChild(txt);
            option.setAttribute('value', result.data[i].id_role);
            select2.insertBefore(option, select2.lastChild);
        }
    }).catch((err) => {
        console.log(err);
    });
</script>
@endsection