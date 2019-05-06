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
        .btn-circle {
            width: 30px;
            height: 30px;
            padding: 6px 0px;
            border-radius: 15px;
            text-align: center;
            font-size: 12px;
            line-height: 1.42857;
        }

        th {
            text-align:center;
        }

        h2 {
            font-size: 40px;
        }
    </style>    
    <div class="container">          
        <div class="table-responsive">
            <div class="kotak">
                <h2>Form Transaksi Penjualan</h2>
                <label>Pilih Transaksi : </label>
                <label class="radio-inline"><input type="radio" name="service" >Service</label>
                <label class="radio-inline"><input type="radio" name="serviceSparepart">Sparepart & Service</label>
                <label class="radio-inline"><input type="radio" name="sparepart">Sparepart</label>
                 
                <h4>Transaksi Penjualan Sparepart</h4>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Nama Konsumen" name="cari_nama" id="cari_nama">
                    </div>
                </div>
                <div class="col-sm-8">
                    <button type="submit" value="Submit" class="btn btn-info" onclick="cari()">CARI</button>
                    </div>
                <table>
                <form class="form-horizontal">
                    <div class="form-group">
                    <label class="control-label col-sm-4" for="nama_konsumen">NAMA KONSUMEN</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nama_konsumen" placeholder="Nama Konsumen" name="nama_konsumen" readonly>
                    </div>
                   
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-4" for="tipe_sparepart">TIPE SPAREPART</label>
                    <div class="col-sm-8">
                        <select class="form-control" id = "tipe_sparepart" name = "tipe_sparepart">
                            <option value="">---Pilih Tipe Sparepart---</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group" id="sparepart">
                    <label class="control-label col-sm-4" for="nama_sparepart">NAMA SPAREPART</label>
                    <div class="col-sm-8">
                        <select class="form-control" id = "nama_sparepart" name = "nama_sparepart" onclick = "harga()">
                            <option value="" >---Pilih Nama Sparepart---</option>
                        </select>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-sm-4" for="hargaSatuan">Harga Satuan</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="hargaSatuan" placeholder="Harga" name="hargaSatuan" readonly>
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="control-label col-sm-4" for="jumlah_beli">JUMLAH BELI</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="jumlah_beli" placeholder="Jumlah Beli" name="jumlah_beli" onkeypress="return hanyaAngka(event)" onkeyup="hitungTotal()">
                    </div>
                    <button type="button" class="btn btn-info btn-circle" onclick = "return tambah()">+</button>
                    </div>
                    <table id= "tableDetailSparepart" class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">Tipe Sparepart</th>
                            <th scope="col">Nama Sparepart</th>
                            <th scope="col">Jumlah Beli</th>
                            <!-- <th scope="col">Jumlah</th> -->
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                    <div class="form-group">
                    <label class="control-label col-sm-4" for="subtotal">SUBTOTAL</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="subtotal" placeholder="Subtotal" name="subtotal" readonly>
                    </div>
                    </div>

                    <!-- <div class="form-group">
                    <label class="control-label col-sm-4" for="total_harga">TOTAL HARGA</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control" id="total_harga" placeholder="Total Harga" name="total_harga">
                    </div>
                    </div> -->

                    <div class="form-group">
                    <div class="col-sm-offset-10 col-sm-20">
                        <button type="button" class="btn btn-danger" onclick="batal()">BATAL</button>
                        <button type="submit" value="Submit" class="btn btn-success" onclick="simpan()">BELI</button>
                    </div>
                    </div>
                </form>
            </table>
            </div>
        </div>
    </div>
    <div>
    </div>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>     
        let sparepartKurang;
        var total = 0;
        let detailSparepart = [];
        let det = [];
        let detail = [];
        let tampung;
        let id_service, id_motor_fk,id_cabang_fk;
        let col2 = ['tipe_sparepart', 'nama_sparepart', 'jumlah_beli', 'harga_satuan'];
        let select1 = document.querySelector('#tipe_sparepart');
        let select2 = document.querySelector('#nama_sparepart');
        let select3 = document.querySelector('#kode_sparepart');
        let select4 = document.querySelector('#hargaBeli_sparepart');
        let tableDetailSparepart = document.querySelector('#tableDetailSparepart tbody');
        

        function cekDetail() {
        if(document.querySelector('#jumlah_beli').value == '') {
            alert('Data Detail Pemesanan Tidak Boleh Kosong...');
            return false;
        }else
            return true;
        }
        //tambah Sparepart
        function tambah(){
            if(cekDetail() == false)
                return false;

            det.tipe_sparepart = document.querySelector('#tipe_sparepart').value;
            det.nama_sparepart = document.querySelector('#nama_sparepart').value;
            det.jumlah_beli = document.querySelector('#jumlah_beli').value;
            det.harga_satuan = document.querySelector('#hargaSatuan').value;
            total += parseFloat(det.harga_satuan * det.jumlah_beli);
            // det.jumlah_pemesanan = document.querySelector('#jumlah_pemesanan').value;
            // det.harga_beli = document.querySelector('#harga_beli').value;
            
            // let cek = detailService.some(dt => dt.nama_service === det.nama_service);
            // if(cek === true) {
            //     alert('Service Telah Terdaftar!');
            //     return false;
            // }

            detailSparepart.push(det);
            document.querySelector('#subtotal').value = total;
            let tr = tableDetailSparepart.insertRow(-1);
            let td = document.createElement('td'); 
            for(j = 0; j <= Object.keys(det).length; j++){
                td = tr.insertCell();  
                if(j == Object.keys(det).length) {
                    let buttonHapus = document.createElement('input');
                    buttonHapus.setAttribute('type', 'button');
                    buttonHapus.setAttribute('value', 'Hapus');
                    buttonHapus.setAttribute('class', 'btn');
                    buttonHapus.setAttribute('class', 'btn btn-danger');
                    buttonHapus.setAttribute('onclick', 'hapusDetail(this)');
                    td.appendChild(buttonHapus);
                }else {
                    td.innerHTML = det[col2[j]];
                }
            } 

            console.log(detailSparepart);
            
            return false;
        }


            //tipe sparepart dropdown
            axios.get('http://192.168.0.176:8000/api/sparepart')
            .then((result) => {
                sparepart = result.data.data;
                let cek = document.getElementById("tipe_sparepart").value;
                console.log(sparepart);
                for(let i=0; i<sparepart.length; i++){
                    // console.log("test3");
                   
                        //id_cabang_fk = pegawai[i].id_cabang_fk;
                        let option = document.createElement('option');
                        let txt = document.createTextNode(sparepart[i].tipe_sparepart);
                        option.appendChild(txt);
                        option.setAttribute('value', sparepart[i].tipe_sparepart);
                        select1.insertBefore(option, select1.lastChild);
                    
                    
                }
            }).catch((error) => {
                console.log(error);
            });

        
        
        
        //nama sparepart dropdown
        axios.get('http://192.168.0.176:8000/api/sparepart')
        .then((result) => {
            sparepart = result.data.data;
            
            for(let i=0; i<sparepart.length; i++){
                // console.log("test3");
                let option = document.createElement('option');
                let txt = document.createTextNode(sparepart[i].nama_sparepart);
                option.appendChild(txt);
                //id_service = service[i].id_jasaService;
                
                option.setAttribute('value', sparepart[i].nama_sparepart);
               // option.setAttribute('value1', service[i].nama_jasaService);
                select2.insertBefore(option, select2.lastChild);
                
            }
        }).catch((error) => {
            console.log(error);
        });

        function harga(){
            axios.get('http://192.168.0.176:8000/api/sparepartCabang')
            .then((result) => {
                sparepart = result.data.data;
                let cek = document.getElementById("nama_sparepart").value;
                //console.log(cek);
                //sparepart.kode_sparepart_fk = cek;
                //console.log(service.nama_jasaService);
                //document.getElementById("hargaBeli_sparepart").value = sparepart.hargaBeli_sparepart;
                //console.log(sparepart);
                for(let i=0; i<sparepart.length; i++){
                    console.log("test3");
                    if(sparepart[i].nama_sparepart == cek )
                    {
                        //id_sparepartCabang = sparepart[i].id_sparepartCabang;
                        //console.log(id_sparepartCabang);
                        document.getElementById("hargaSatuan").value = sparepart[i].hargaJual_sparepart;
                    }
                }
            }).catch((error) => {
                console.log(error);
            });

        }

        function hapusDetail(obj) {
            detailService.splice(obj.parentNode.parentNode.rowIndex-1, 1);
            tableDetailService.deleteRow(obj.parentNode.parentNode.rowIndex-1);
            // let cek = det[obj.parentNode.parentNode.rowIndex].nama_service;
            // console.log(cek);
        }
       
        //cari
        function cari(){
            axios.get('http://192.168.0.176:8000/api/motorKonsumen')
            .then((result) => {
                motorK = result.data.data;
                let cek = document.getElementById("cari_plat").value;
                console.log(motorK);
                for(let i=0; i<motorK.length; i++){
                    // console.log("test3");
                    if(motorK[i].plat_motorKonsumen == cek)
                    {
                        document.getElementById("plat_nomor").value = motorK[i].plat_motorKonsumen;
                        id_motor_fk = motorK[i].id_motorKonsumen;
                    }else{
                        alert("Plat Motor Tidak ditemukan");
                    }
                    
                }
            }).catch((error) => {
                console.log(error);
            });
        }
        
        //simpan
        function simpan(){
        let tampung = detailService;
        let formData = new FormData();
        formData.append('id_cabang_fk', id_cabang_fk);
        // formData.append('kode_transaksi', kode_transaksi);
        formData.append('diskon', 0);
        formData.append('total_transaksi', total);
        console.log(formData);
        axios.post('http://127.0.0.1:8000/api/transaksiPenjualanSP', formData)
        .then((result) =>{
            console.log(result);
            let tes = result.data.data;
            for(let i = 0; i < tampung.length; i++){
                tampung[i].id_transaksi_fk = tes[i].id_transaksi;
                //console.log(tes[i]);
                //console.log(tampung);
                tambahDetail(tampung);
            }
            alert('Data Transaksi Service Berhasil di Tambahkan');
           // location.href = "{{ url('/pengadaan')}}";
        })
        .catch((error) =>{
            console.log(error.response);
        });
        
        return false;
    }

    function tambahDetail(detail) {
        console.log(detail);
        let formDataDetail = new FormData(); 
        console.log(JSON.stringify(detail));
        formDataDetail.append('data', JSON.stringify(detail));
        // formDataDetail.append('kode_sparepart', kode_sparepart);
        // formDataDetail.append('jumlah_pemesanan', jumlah_pemesanan);
        // formDataDetail.append('harga_beli', harga_beli);
        // formDataDetail.append('satuan', satuan);
        axios.post('http://127.0.0.1:8000/api/detilJasa', formDataDetail)
        .then((result) => {
            console.log(result);
        }).catch((err) => {
            console.log(err.response);
        });
    }
    </script>
@endsection