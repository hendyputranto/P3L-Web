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
    <h2 align="center">Ubah Data Pegawai</h2>
    <table>
        <form class="form-horizontal">
            <div class="form-group">
            <label class="control-label col-sm-2" for="kode_cabang">Pilih Cabang</label>
            <div class="col-sm-10">
                <select class="form-control" id="kode_cabang" name="kode_cabang">
                    <option>--Pilih Cabang--</option>
                </select>
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="jabatan_pegawai">Jabatan</label>
            <div class="col-sm-10">
                <select class="form-control" id="jabatan_pegawai" name="jabatan_pegawai">
                    <option value="">--Pilih Jabatan--</option>
                    <option value="Montir">Montir</option>
                    <option value="Customer Service">Customer Service</option>
                    <option value="Kasir">Kasir</option>
                </select>
            </div>
            </div>
            
            <div class="form-group">
            <label class="control-label col-sm-2" for="nama_pegawai">Nama</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_pegawai" placeholder="nama pegawai" name="nama_pegawai">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="alamat_pegawai">Alamat</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat_pegawai" placeholder="alamat pegawai" name="alamat_pegawai">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="notelp_pegawai">Nomor Telpon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="notelp_pegawai" placeholder="nomor telpon pegawai" name="notelp_pegawai">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="gaji_per_minggu">Gaji Per Minggu</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="gaji_per_minggu" placeholder="gaji pegawai" name="gaji_per_minggu">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="username">Nama Pengguna</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="username" placeholder="nama pengguna pegawai" name="username">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="password">Password</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="password" placeholder="password pegawai" name="password">
            </div>
            </div>

            <div class="form-group">
            <div class="col-sm-offset-10 col-sm-20">
                <button type="button" class="btn btn-danger" onclick="batal()">BATAL</button>
                <button type="submit" value="Submit" class="btn btn-success" onclick="return simpan()">SIMPAN</button>
            </div>
            </div>
            
        </form>
    </table>
  </div>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    let select = document.querySelector('#kode_cabang');
    let b = localStorage.getItem("kode_pegawai");
    let data;

    axios.get('http://127.0.0.1:8000/api/cabang/')
    .then((result) => {
        for(let i = 0; i<result.data.length; i++) {
            let option = document.createElement('option');
            let txt = document.createTextNode(result.data[i].kode_cabang);
            option.appendChild(txt);
            option.setAttribute('value', result.data[i].kode_cabang);
            select.insertBefore(option, select.lastChild);
        }
    }).catch((err) => {
        console.log(err);
    });

    axios.get('http://127.0.0.1:8000/api/pegawai/'+b)
    .then(function (response) {
        // handle success
        data = response.data;
        let col = ['kode_cabang','nama_pegawai','alamat_pegawai','notelp_pegawai', 'gaji_per_minggu',
        'jabatan_pegawai', 'username', 'password'];
        document.getElementById("kode_cabang").value = data[col[0]];
        document.getElementById("nama_pegawai").value = data[col[1]];
        document.getElementById("alamat_pegawai").value = data[col[2]];
        document.getElementById("notelp_pegawai").value = data[col[3]];
        document.getElementById("gaji_per_minggu").value = data[col[4]];
        document.getElementById("jabatan_pegawai").value = data[col[5]];
        document.getElementById("username").value = data[col[6]];
        document.getElementById("password").value = data[col[7]];
        console.log(data[col[1]]);
        console.log(data);
    })
    .catch(function (error) {
        // handle error
        console.log(error);
    });

    function batal(obj){
            location.href = "{{ route('dpegawai') }}";
    }

    function simpan(){
        let formData = new FormData; 
        let kode_cabang = document.getElementById('kode_cabang').value;
        let nama_pegawai = document.getElementById('nama_pegawai').value;
        let alamat_pegawai = document.getElementById('alamat_pegawai').value;
        let notelp_pegawai = document.getElementById('notelp_pegawai').value;
        let gaji_per_minggu = document.getElementById('gaji_per_minggu').value;
        let jabatan_pegawai = document.getElementById('jabatan_pegawai').value;
        let username = document.getElementById('username').value;
        let password = document.getElementById('password').value;
        formData.append('_method', 'PUT');
        formData.append('kode_cabang', kode_cabang);
        formData.append('nama_pegawai', nama_pegawai);
        formData.append('alamat_pegawai', alamat_pegawai);
        formData.append('notelp_pegawai', notelp_pegawai);
        formData.append('gaji_per_minggu', gaji_per_minggu);
        formData.append('jabatan_pegawai', jabatan_pegawai);
        formData.append('username', username);
        formData.append('password', password);
        console.log(nama_pegawai);
        axios.post('http://127.0.0.1:8001/api/pegawai/'+b, formData)
                .then((result) => {
                    console.log(result);

                    edited = false;
                }).catch((err) => {
                    console.log(err);
                });
        location.href = "{{ route('dpegawai') }}";
        return false;
    }

</script>
@endsection