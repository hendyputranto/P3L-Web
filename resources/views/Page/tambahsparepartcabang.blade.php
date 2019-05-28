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
    <h2 align="center">Tambah Data Sparepart Cabang</h2>
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
            <label class="control-label col-sm-2" for="kode_sparepart">Pilih Sparepart</label>
            <div class="col-sm-10">
                <select class="form-control" id="kode_sparepart" name="kode_sparepart">
                    <option>--Pilih Sparepart--</option>
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
            <label class="control-label col-sm-2" for="stokSisa_sparepart">STOCK SISA</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="stokSisa_sparepart" placeholder="stokSisa sparepart" name="stokSisa_sparepart">
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
            location.href = "{{ route('dsparepartCabang') }}";
    }

    function simpan(){
        let id_cabang = document.querySelector('#id_cabang').value;
        let kode_sparepart = document.querySelector('#kode_sparepart').value;
        let hargaBeli_sparepart = document.querySelector('#hargaBeli_sparepart').value;
        let hargaJual_sparepart = document.querySelector('#hargaJual_sparepart').value;
        let letak_sparepart = document.querySelector('#letak_sparepart').value;
        let stokMin_sparepart = document.querySelector('#stokMin_sparepart').value;
        let stokSisa_sparepart= document.querySelector('#stokSisa_sparepart').value;
        let formData = new FormData();
        formData.append('id_cabang_fk', id_cabang);
        formData.append('kode_sparepart_fk', kode_sparepart);
        formData.append('hargaBeli_sparepart', hargaBeli_sparepart);
        formData.append('hargaJual_sparepart', hargaJual_sparepart);
        formData.append('letak_sparepart', letak_sparepart);
        formData.append('stokMin_sparepart', stokMin_sparepart);
        formData.append('stokSisa_sparepart', stokSisa_sparepart);
        axios.post('http://192.168.19.140/P3L_L_1/api/sparepartCabang/', formData)
        .then((result) =>{
            console.log(result);
        })
        .catch((error) =>{
            console.log(error.response);
        });
        location.href = "{{ route('dsparepartCabang') }}";
        return false;
    }

    let select = document.querySelector('#id_cabang');
    let select2 = document.querySelector('#kode_sparepart');

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

    axios.get('http://192.168.19.140/P3L_L_1/sparepart/')
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
</script>
@endsection