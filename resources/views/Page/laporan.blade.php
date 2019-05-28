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
    <h2 align="center">Laporan</h2>
    <table>
        <form class="form-horizontal" onsubmit = "return simpan()">
            <div class="form-group">
            <label class="control-label col-sm-2" for="laporan">Pilih Laporan</label>
            <div class="col-sm-10">
                <select name="laporan" id="laporan" placeholder="Pilih Laporan" 
                    class="form-control input" onchange = "onChange(this)">
                    <option value="">--Pilih Laporan--</option>
                    <option value="stok">Laporan Sisa Stok</option>
                    <option value="pendapatan-tahunan">Laporan Pendapatan Tahunan</option>
                    <option value="pendapatan-bulanan">Laporan Pendapatan Perbulan</option>
                    <option value="pengeluaran-bulanan">Laporan Pengeluaran Perbulan</option>
                    <option value="sisaStok-sparepart">Laporan Sisa Stok Sparepart</option>
                    <option value="jasa-terlaris">Laporan Penjualan Jasa Terlaris</option>
                </select>
            </div>
            </div>

            <div id="sisa-stok" style="display: none;">
                <div class="form-group">
                <label class="control-label col-sm-2" for="tahun-stok">Tahun</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="tahun-stok" placeholder="Masukkan Tahun" name="tahun-stok">
                </div>
                </div>

                <div class="form-group">
                <label class="control-label col-sm-2" for="sparepart">Tipe Sparepart</label>
                <div class="col-sm-10">
                    <select name="sparepart" id="sparepart" placeholder="Pilih Tipe Sparepart" 
                        class="form-control input">
                        <option value="">--Pilih Tipe--</option>
                    </select>
                </div>
                </div>
            </div>

            <div class="form-group">
            <div class="col-sm-offset-10 col-sm-20">
                <button class="btn btn-info" onclick="return tampil()">TAMPIL</button>
                <button class="btn btn-success" onclick="return cetak()">CETAK</button>
            </div>
            </div>
            
        </form>
    </table>
  </div>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    
    let selected = null;
    let sparepart = document.querySelector('#sparepart');

    axios.get('http://10.53.0.175:8000/api/spareparts/gettipe')
    .then((result) => {
        for(let i = 0; i < result.data.length; i++) {
            let option = document.createElement('option');
            let txt = document.createTextNode(result.data[i].tipe_sparepart);
            option.appendChild(txt);
            option.setAttribute('value', result.data[i].tipe_sparepart);
            sparepart.insertBefore(option, sparepart.lastChild);
        }
    }).catch((err) => {
        
    });

    function onChange(obj) {
        selected = obj.options[obj.selectedIndex].value;
        console.log(selected);
       
        if (selected == 'stok') {
            document.querySelector('#sisa-stok').style.display = 'block';
         }
         else if (selected === 'pendapatan-tahunan') {
            document.querySelector('#sisa-stok').style.display = 'none';
        }
    }

    function tampil() {
        console.log(selected);    
        if (selected === 'stok') {

            if(document.querySelector('#tahun-stok').value =='') {
                alert('Inputan tahun salah!!');
                return false;
            } else if(document.querySelector('#sparepart').value =='') {
                alert('Inputan sparepart salah!!');
                return false;
            }

            console.log('es');
            let tahun = document.querySelector('#tahun-stok').value;
            let sparepart = document.querySelector('#sparepart').value;
            let url = '/nlaporansisastok?tahun=' + tahun + '&sparepart=' + sparepart + '&jenis=tampil';
            window.open(url);
        }
        else if (selected === 'pendapatan-tahunan') {
            let url = '/npendapatanpertahun?jenis=tampil';
            window.open(url);
        }
        return false;
    }

    function cetak() {
        if (selected === 'stok') {
            if(document.querySelector('#tahun-stok').value =='') {
                alert('Inputan tahun salah!!');
                return false;
            } else if(document.querySelector('#sparepart').value =='') {
                alert('Inputan sparepart salah!!');
                return false;
            }
            
            console.log('es');
            let tahun = document.querySelector('#tahun-stok').value;
            let sparepart = document.querySelector('#sparepart').value;
            let url = '/nlaporansisastok?tahun=' + tahun + '&sparepart=' + sparepart + '&jenis=cetak';
            window.open(url);
        }
        else if (selected === 'pendapatan-tahunan') {
            let url = '/npendapatanpertahun?jenis=cetak';
            window.open(url);
        }
        return false;

    }

    function cek() {
        // if(selected === 'terlaris') {
        //     if(document.querySelector('#tahun-terlaris').value =='')
        //         return false;
        // } else if (selected === 'pendapatan-bulanan') {
        //     if(document.querySelector('#tahun-pendapatan').value =='')
        //         return false;
        // } else if (selected === 'pendapatan-tahunan') {
            
        // } else if (selected === 'pengeluaran-bulanan') {
        //     console.log("fsdaf");
        //     if(document.querySelector('#tahun-pengeluaran').value =='')
        //         return false;
        // } else if (selected === 'jasa') {
        //     let tahun = document.querySelector('#tahun-jasa').value;
        //     let bulan = document.querySelector('#bulan').value;
        //     let url = '/penjualan_jasa?tahun=' + tahun + '&bulan=' + bulan + '&jenis=cetak';
        //     window.open(url);
        // } 
        if (selected === 'stok') {
            console.log('es');
            let tahun = document.querySelector('#tahun-stok').value;
            let sparepart = document.querySelector('#sparepart').value;
            let url = '/nlaporansisastok?tahun=' + tahun + '&sparepart=' + sparepart + '&jenis=cetak';
            window.open(url);
        }
        else if (selected === 'pendapatan-tahunan') {
            
        } 
        // else if (selected === 'merkmotor') {
        //     let tahun = document.querySelector('#tahun-motor').value;
        //     let bulan = document.querySelector('#bulan-motor').value;
        //     let url = '/motor_seringservice?tahun=' + tahun + '&bulan=' + bulan + '&jenis=cetak';
        //     window.open(url);
        // }

        return true;

    }

    // function setInputFilter(textbox, inputFilter) {
    //     ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    //         textbox.addEventListener(event, function() {
    //         if (inputFilter(this.value)) {
    //             this.oldValue = this.value;
    //             this.oldSelectionStart = this.selectionStart;
    //             this.oldSelectionEnd = this.selectionEnd;
    //         } else if (this.hasOwnProperty("oldValue")) {
    //             this.value = this.oldValue;
    //             this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
    //         }
    //         });
    //     });
    // }


    // Install input filters.
    // setInputFilter(document.getElementById("tahun-terlaris"), function(value) {
    // return /^-?\d*$/.test(value); });

    // setInputFilter(document.getElementById("gaji_per_minggu"), function(value) {
    // return /^-?\d*$/.test(value); });
</script>
@endsection