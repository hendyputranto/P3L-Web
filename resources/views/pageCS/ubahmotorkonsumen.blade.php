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
    <h2 align="center">Ubah Data Motor Konsumen</h2>
    <table>
        <form class="form-horizontal">
            <div class="form-group">
            <label class="control-label col-sm-2" for="id_motor_fk">Pilih Tipe Motor</label>
            <div class="col-sm-10">
                <select class="form-control" id="id_motor_fk" name="id_motor_fk">
                    <option>--Pilih Tipe Motor--</option>
                </select>
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="id_konsumen_fk">Pilih Konsumen</label>
            <div class="col-sm-10">
                <select class="form-control" id="id_konsumen_fk" name="id_konsumen_fk">
                    <option>--Pilih Konsumen--</option>
                </select>
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="plat_motorKonsumen">Plat Motor</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="plat_motorKonsumen" placeholder="plat motor konsumen" name="plat_motorKonsumen">
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

    let select = document.querySelector('#id_motor_fk');
    let select2 = document.querySelector('#id_konsumen_fk');
    let b = localStorage.getItem("id_motorKonsumen");
    let data;

    axios.get('http://192.168.19.140/P3L_L_1/api/motor/')
    .then((result) => {
        for(let i = 0; i<result.data.data.length; i++) {
            let option = document.createElement('option');
            let txt = document.createTextNode(result.data.data[i].id_motor+' ('+result.data.data[i].tipe_motor+')');
            option.appendChild(txt);
            option.setAttribute('value', result.data.data[i].id_motor);
            select.insertBefore(option, select.lastChild);
        }
    }).catch((err) => {
        console.log(err);
    });
    axios.get('http://192.168.19.140/P3L_L_1/api/konsumen/')
    .then((result) => {
        for(let i = 0; i<result.data.data.length; i++) {
            let option = document.createElement('option');
            let txt = document.createTextNode(result.data.data[i].id_konsumen+' '+result.data.data[i].nama_konsumen);
            option.appendChild(txt);
            option.setAttribute('value', result.data.data[i].id_konsumen);
            select2.insertBefore(option, select2.lastChild);
        }
    }).catch((err) => {
        console.log(err);
    });

    axios.get('http://192.168.19.140/P3L_L_1/api/motorKonsumen/'+b)
    .then(function (response) {
        // handle success
        data = response.data.data;
        let col = ['id_motorKonsumen', 'id_motor_fk', 'id_konsumen_fk' ,'plat_motorKonsumen'];
        document.getElementById("id_motor_fk").value = data[col[1]];
        document.getElementById("id_konsumen_fk").value = data[col[2]];
        document.getElementById("plat_motorKonsumen").value = data[col[3]];
        console.log(data[col[1]]);
        console.log(data);
    })
    .catch(function (error) {
        // handle error
        console.log(error);
    });

    function batal(obj){
            location.href = "{{ route('dmotorkonsumen') }}";
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
            let id_motor_fk = document.getElementById('id_motor_fk').value;
            let id_konsumen_fk = document.getElementById('id_konsumen_fk').value;
            let plat_motorKonsumen = document.getElementById('plat_motorKonsumen').value;
            formData.append('_method', 'PUT');
            formData.append('id_motor_fk', id_motor_fk);
            formData.append('id_konsumen_fk', id_konsumen_fk);
            formData.append('plat_motorKonsumen', plat_motorKonsumen);
            console.log(plat_motorKonsumen);
            axios.post('http://192.168.19.140/P3L_L_1/api/motorKonsumen/' + b, formData)
                    .then((result) => {
                        console.log(result);
                        edited = false;
                    }).catch((err) => {
                        console.log(err);
                        alert("Edit Data Gagal");
                    });
            alert("Edit Data Berhasil");
            location.href = "{{ route('dmotorkonsumen') }}";
            return false;
        // }
    }

</script>
@endsection