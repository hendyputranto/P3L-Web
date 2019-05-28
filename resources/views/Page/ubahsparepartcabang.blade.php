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
    <h2 align="center">Ubah Data Sparepart Cabang</h2>
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
            <label class="control-label col-sm-2" for="kode_sparepart_fk">Pilih Sparepart</label>
            <div class="col-sm-10">
                <select class="form-control" id="kode_sparepart_fk" name="kode_sparepart_fk">
                    <option value="">--Pilih Sparepart--</option>
                     
                </select>
            </div>
            </div>
            
            <div class="form-group">
            <label class="control-label col-sm-2" for="hargaBeli_sparepart">HARGA BELI</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="hargaBeli_sparepart" placeholder="hargaBeli sparepart" name="hargaBeli_sparepart">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="hargaJual_sparepart">HARGA JUAL</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="hargaJual_sparepart" placeholder="hargaJual sparepart" name="hargaJual_sparepart">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="letak_sparepart">LETAK SPAREPART</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="letak_sparepart" placeholder="letak sparepart" name="letak_sparepart">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="stokMin_sparepart">STOCK MINIMUM</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="stokMin_sparepart" placeholder="stokMin sparepart" name="stokMin_sparepart">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="stokSisa_sparepart">STOCK SISA SPAREPART</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="stokSisa_sparepart" placeholder="stokSisa sparepart" name="stokSisa_sparepart">
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
    let select2 = document.querySelector('#kode_sparepart_fk');
    let b = localStorage.getItem("id_sparepartCabang");
    let data;

    axios.get('http://10.53.0.175:8000/api/cabang/')
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
    axios.get('http://10.53.0.175:8000/api/sparepart/')
    .then((result) => {
        for(let i = 0; i<result.data.data.length; i++) {
            let option = document.createElement('option');
            let txt = document.createTextNode(result.data.data[i].kode_sparepart+' '+result.data.data[i].nama_sparepart);
            option.appendChild(txt);
            option.setAttribute('value', result.data.data[i].kode_sparepart);
            select2.insertBefore(option, select2.lastChild);
        }
    }).catch((err) => {
        console.log(err);
    });

    axios.get('http://10.53.0.175:8000/api/sparepartCabang/'+b)
    .then(function (response) {
        // handle success
        data = response.data.data
        let col = ['id_sparepartCabang', 'id_cabang_fk', 'kode_sparepart_fk', 'hargaBeli_sparepart',
        'hargaJual_sparepart','letak_sparepart', 'stokMin_sparepart', 'stokSisa_sparepart'];
        document.getElementById("id_cabang_fk").value = data[col[1]];
        document.getElementById("kode_sparepart_fk").value = data[col[2]];
        document.getElementById("hargaBeli_sparepart").value = data[col[3]];
        document.getElementById("hargaJual_sparepart").value = data[col[4]];
        document.getElementById("letak_sparepart").value = data[col[5]];
        document.getElementById("stokMin_sparepart").value = data[col[6]];
        document.getElementById("stokSisa_sparepart").value = data[col[7]];
        console.log(data[col[1]]);
        console.log(data);
    })
    .catch(function (error) {
        // handle error
        console.log(error);
    });

    function batal(obj){
            location.href = "{{ route('dsparepartCabang') }}";
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
            let kode_sparepart = document.getElementById('kode_sparepart_fk').value;
            let id_cabang = document.getElementById('id_cabang_fk').value;
            let hargaBeli_sparepart = document.getElementById('hargaBeli_sparepart').value;
            let hargaJual_sparepart = document.getElementById('hargaJual_sparepart').value;
            let letak_sparepart = document.getElementById('letak_sparepart').value;
            let stokMin_sparepart = document.getElementById('stokMin_sparepart').value;
            let stokSisa_sparepart = document.getElementById('stokSisa_sparepart').value;
            formData.append('_method', 'PUT');
            formData.append('id_cabang_fk', id_cabang);
            formData.append('kode_sparepart_fk', kode_sparepart);
            formData.append('hargaBeli_sparepart', hargaBeli_sparepart);
            formData.append('hargaJual_sparepart', hargaJual_sparepart);
            formData.append('letak_sparepart', letak_sparepart);
            formData.append('stokMin_sparepart', stokMin_sparepart);
            formData.append('stokSisa_sparepart', stokSisa_sparepart);
            console.log(hargaBeli_sparepart);
            axios.post('http://10.53.0.175:8000/api/sparepartCabang/' + b, formData)
                    .then((result) => {
                        console.log(result);
                        edited = false;
                    }).catch((err) => {
                        console.log(err);
                        alert("Edit Data Gagal");
                    });
            alert("Edit Data Berhasil");
            location.href = "{{ route('dsparepartCabang') }}";
            return false;
        // }
    }

</script>
@endsection