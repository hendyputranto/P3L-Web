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
            <label class="control-label col-sm-2" for="id_cabang_fk">Pilih Cabang</label>
            <div class="col-sm-10">
                <select class="form-control" id="id_cabang_fk" name="id_cabang_fk">
                    <option>--Pilih Cabang--</option>
                </select>
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="id_role_fk">Role</label>
            <div class="col-sm-10">
                <select class="form-control" id="id_role_fk" name="id_role_fk">
                    <option value="">--Pilih Role--</option>
                     
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
            <label class="control-label col-sm-2" for="noTelp_pegawai">Nomor Telpon</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="noTelp_pegawai" placeholder="nomor telpon pegawai" name="noTelp_pegawai">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="gaji_pegawai">Gaji Per Minggu</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="gaji_pegawai" placeholder="gaji pegawai" name="gaji_pegawai">
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
    // function cekEmpty(){
    //     if(document.getElementById("id_cabang_fk").selectedIndex == "0"||
    //     document.getElementById("id_role_fk").selectedIndex == "0"||
    //     document.getElementById("nama_pegawai").value == ""||
    //     document.getElementById("alamat_pegawai").value == ""||
    //     document.getElementById("notelp_pegawai").value == ""||
    //     document.getElementById("gaji_pegawai").value == ""||
    //     document.getElementById("username_pegawai").value == ""||
    //     document.getElementById("password_pegawai").value == "")
    //     {
    //         return true;
    //     }
    //     else
    //         return false;
    // }

    let select = document.querySelector('#id_cabang_fk');
    let select2 = document.querySelector('#id_role_fk');
    let b = localStorage.getItem("id_pegawai");
    let data;

    axios.get('http://192.168.19.140/P3L_L_1/api/cabang/')
    .then((result) => {
        for(let i = 0; i<result.data.data.length; i++) {
            let option = document.createElement('option');
            let txt = document.createTextNode(result.data.data[i].id_cabang+' ('+result.data.data[i].nama_cabang+')');
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

    axios.get('http://192.168.19.140/P3L_L_1/api/pegawai/'+b)
    .then(function (response) {
        // handle success
        data = response.data.data;
        let col = ['id_pegawai', 'id_role_fk', 'id_cabang_fk' ,'nama_pegawai','alamat_pegawai','noTelp_pegawai', 'gaji_pegawai'];
        document.getElementById("id_role_fk").value = data[col[1]];
        document.getElementById("id_cabang_fk").value = data[col[2]];
        document.getElementById("nama_pegawai").value = data[col[3]];
        document.getElementById("alamat_pegawai").value = data[col[4]];
        document.getElementById("noTelp_pegawai").value = data[col[5]];
        document.getElementById("gaji_pegawai").value = data[col[6]];
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
        // if(cekEmpty())
        // {
        //     alert("Data Tidak Boleh Kosong");
        //     return false;
        // }
        // else
        // {
            let formData = new FormData; 
            let id_role = document.getElementById('id_role_fk').value;
            let id_cabang = document.getElementById('id_cabang_fk').value;
            let nama_pegawai = document.getElementById('nama_pegawai').value;
            let alamat_pegawai = document.getElementById('alamat_pegawai').value;
            let notelp_pegawai = document.getElementById('noTelp_pegawai').value;
            let gaji_pegawai = document.getElementById('gaji_pegawai').value;
            formData.append('_method', 'PUT');
            formData.append('id_role_fk', id_role);
            formData.append('id_cabang_fk', id_cabang);
            formData.append('nama_pegawai', nama_pegawai);
            formData.append('alamat_pegawai', alamat_pegawai);
            formData.append('noTelp_pegawai', notelp_pegawai);
            formData.append('gaji_pegawai', gaji_pegawai);
            console.log(nama_pegawai);
            axios.post('http://192.168.19.140/P3L_L_1/api/pegawai/' + b, formData)
                    .then((result) => {
                        console.log(result);
                        edited = false;
                    }).catch((err) => {
                        console.log(err);
                        alert("Edit Data Gagal");
                    });
            alert("Edit Data Berhasil");
            location.href = "{{ route('dpegawai') }}";
            return false;
        // }
    }

</script>
@endsection