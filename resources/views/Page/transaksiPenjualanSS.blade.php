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
                 
                <h4>Transaksi Penjualan Service & Sparepart</h4>
                <div class="col-sm-3">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Plat Motor Konsumen" name="cari_plat" id="cari_plat">
                    </div>
                </div>
                <div class="col-sm-8">
                    <button type="submit" value="Submit" class="btn btn-info" onclick="cari()">CARI</button>
                    </div>
                <table>
                    <div class="form-group">
                    <label class="control-label col-sm-4" for="plat_nomor">PLAT NOMOR MOTOR</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="plat_nomor" placeholder="Plat Nomor Motor" name="plat_nomor" readonly>
                    </div>
                   
                <!-- <h5>Service</h5> -->
                   <!-- service -->
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-4" for="id_montir">MONTIR</label>
                    <div class="col-sm-8">
                        <select class="form-control" id = "id_montir" name = "id_montir">
                            <option value="">---Pilih Montir---</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group" id="service">
                    <label class="control-label col-sm-4" for="jenis_service">JENIS SERVICE</label>
                    <div class="col-sm-7">
                        <select class="form-control" id = "jenis_service" name = "jenis_service" onclick = "harga()">
                            <option value="" >---Pilih Jenis Service---</option>
                        </select>
                    </div>
                    <button type="button" class="btn btn-info btn-circle" onclick = "return tambah()">+</button>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-4" for="hargaService">Harga</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="hargaService" placeholder="Harga" name="hargaService" readonly>
                    </div>
                    </div>

                    <table id= "tableDetailService" class="table table-bordered text-center">
                    <thead>
                        <tr>
                            
                            <th scope="col">Nama Service</th>
                            
                            <th scope="col">Harga</th>
                            
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                    

                <h4>Sparepart</h4>
                <!-- sparepart -->
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
                        <select class="form-control" id = "nama_sparepart" name = "nama_sparepart" onclick = "hargaSparepart()">
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
                        <input type="text" class="form-control" id="jumlah_beli" placeholder="Jumlah Beli" name="jumlah_beli" onkeypress="return hanyaAngka(event)" >
                    </div>
                    <button type="button" class="btn btn-info btn-circle" onclick = "return tambahSparepart()">+</button>
                    </div>
                    <table id= "tableDetailSparepart" class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th scope="col">Tipe Sparepart</th>
                            <th scope="col">Kode Sparepart</th>
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
        let detailService = [];
        let detailSparepart = [];
        let detail = [];
        let tampung;
        let nama_service, id_motor_fk,id_cabang_fk, id_montir;
        let nama_sparepart,tipe_sparepart, id_konsumen_fk, id_sparepartCabang_fk;
        let col1 = ['tipe_sparepart', 'nama_sparepart', 'jumlahBeli_sparepart', 'subTotal_sparepart'];
        let col2 = ['nama_service', 'subTotal_service'];
        let select1 = document.querySelector('#id_montir');
        let select2 = document.querySelector('#jenis_service');
        let select3 = document.querySelector('#tipe_sparepart');
        let select4 = document.querySelector('#nama_sparepart');
        let tableDetailService = document.querySelector('#tableDetailService tbody');
        let tableDetailSparepart = document.querySelector('#tableDetailSparepart tbody');
        

        function cekDetail() {
        if(document.querySelector('#jenis_service').value == '' 
        || document.querySelector('#hargaService').value == '' 
        || document.querySelector('#id_montir').value == '') {
            alert('Data Detail Pemesanan Tidak Boleh Kosong...');
            return false;
        }else
            return true;
        }
        //tambah jasa service
        function tambah(){
            let det = {};
            if(cekDetail() == false)
                return false;

            det.nama_service = nama_service;
            det.subTotal_service = document.querySelector('#hargaService').value;
            det.id_jasaService_fk = document.querySelector('#jenis_service').value;
            det.id_motorKonsumen_fk = id_motor_fk;
            total += parseFloat(det.subTotal_service);
            // det.jumlah_pemesanan = document.querySelector('#jumlah_pemesanan').value;
            // det.harga_beli = document.querySelector('#harga_beli').value;
            
            // let cek = detailService.some(dt => dt.nama_service === det.nama_service);
            // if(cek === true) {
            //     alert('Service Telah Terdaftar!');
            //     return false;
            // }

            detailService.push(det);
            // console.log(detailService.id_jasaService_fk);
            // console.log(detailService.id_motorKonsumen_fk);
            document.querySelector('#subtotal').value = total;
            let tr = tableDetailService.insertRow(-1);
            let td = document.createElement('td'); 
            for(j = 0; j <= 2; j++){
                td = tr.insertCell();  
                if(j == 2) {
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

            console.log(detailService);
            
            return false;
        }

        //tambah Sparepart
        function tambahSparepart(){
            let det = {};
            if(cekDetail() == false)
                return false;

            det.tipe_sparepart = document.querySelector('#tipe_sparepart').value;
            det.nama_sparepart = document.querySelector('#nama_sparepart').value;
            det.jumlahBeli_sparepart = document.querySelector('#jumlah_beli').value;
            det.subTotal_sparepart = document.querySelector('#hargaSatuan').value;
            det.id_konsumen_fk = id_konsumen_fk;
            det.id_sparepartCabang_fk = id_sparepartCabang_fk;
            total += parseFloat(det.subTotal_sparepart * det.jumlahBeli_sparepart);
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
            for(j = 0; j <= 4; j++){
                td = tr.insertCell();  
                if(j == 4) {
                    let buttonHapus = document.createElement('input');
                    buttonHapus.setAttribute('type', 'button');
                    buttonHapus.setAttribute('value', 'Hapus');
                    buttonHapus.setAttribute('class', 'btn');
                    buttonHapus.setAttribute('class', 'btn btn-danger');
                    buttonHapus.setAttribute('onclick', 'hapusDetail(this)');
                    td.appendChild(buttonHapus);
                }else {
                    td.innerHTML = det[col1[j]];
                }
            } 

            console.log(detailSparepart);
            
            return false;
        }

            //montir dropdown
            axios.get('http://192.168.19.140/P3L_L_1/api/pegawai')
            .then((result) => {
                pegawai = result.data.data;
                let cek = document.getElementById("id_montir").value;
                console.log(pegawai);
                for(let i=0; i<pegawai.length; i++){
                    // console.log("test3");
                    if(pegawai[i].id_role_fk == 4)
                    {
                        id_cabang_fk = pegawai[i].id_cabang_fk;
                        let option = document.createElement('option');
                        let txt = document.createTextNode(pegawai[i].nama_pegawai);
                        option.appendChild(txt);
                        option.setAttribute('value', pegawai[i].id_pegawai);
                        select1.insertBefore(option, select1.lastChild);
                    }
                    
                }
            }).catch((error) => {
                console.log(error);
            });

        
        
        
        //jenis service dropdown
        axios.get('http://192.168.19.140/P3L_L_1/api/jasaService')
        .then((result) => {
            service = result.data.data;
            
            for(let i=0; i<service.length; i++){
                // console.log("test3");
                let option = document.createElement('option');
                let txt = document.createTextNode(service[i].nama_jasaService);
                option.appendChild(txt);
                option.setAttribute('value', service[i].id_jasaService);
                nama_service = service[i].nama_jasaService;
               // option.setAttribute('value1', service[i].nama_jasaService);
                select2.insertBefore(option, select2.lastChild);
                
            }
        }).catch((error) => {
            console.log(error);
        });

        //tipe sparepart dropdown
        axios.get('http://192.168.19.140/P3L_L_1/api/sparepart')
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
                        
                        select3.insertBefore(option, select3.lastChild);
                    
                    
                }
                console.log(cek);
            }).catch((error) => {
                console.log(error);
            });

        
        
        
        //nama sparepart dropdown
        axios.get('http://192.168.19.140/P3L_L_1/api/sparepart')
        .then((result) => {
            sparepart = result.data.data;
            let cek = document.getElementById("tipe_sparepart").value;
            for(let i=0; i<sparepart.length; i++){
                console.log("test3");
                console.log(cek);
                
                    let option = document.createElement('option');
                    let txt = document.createTextNode(sparepart[i].nama_sparepart);
                    option.appendChild(txt);
                    //id_service = service[i].id_jasaService;
                    
                    option.setAttribute('value', sparepart[i].kode_sparepart);
                // option.setAttribute('value1', service[i].nama_jasaService);
                    select4.insertBefore(option, select4.lastChild);
                
            }
        }).catch((error) => {
            console.log(error);
        });

        function hargaSparepart(){
            axios.get('http://192.168.19.140/P3L_L_1/api/sparepartCabang')
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
                    if(sparepart[i].kode_sparepart_fk == cek )
                    {
                        id_sparepartCabang_fk = sparepart[i].id_sparepartCabang;
                        id_cabang_fk = sparepart[i].id_cabang_fk;
                        console.log(id_cabang_fk);
                        document.getElementById("hargaSatuan").value = sparepart[i].hargaJual_sparepart;
                    }
                }
            }).catch((error) => {
                console.log(error);
            });

        }
        function harga(){
            axios.get('http://192.168.19.140/P3L_L_1/api/jasaService')
            .then((result) => {
                service = result.data.data;
                let cek = document.getElementById("jenis_service").value;
                //console.log(cek);
                //sparepart.kode_sparepart_fk = cek;
                console.log(service.nama_jasaService);
                //document.getElementById("hargaBeli_sparepart").value = sparepart.hargaBeli_sparepart;
                //console.log(sparepart);
                for(let i=0; i<service.length; i++){
                    console.log("test3");
                    if(service[i].id_jasaService == cek )
                    {
                        //id_sparepartCabang = sparepart[i].id_sparepartCabang;
                        //console.log(id_sparepartCabang);
                        document.getElementById("hargaService").value = service[i].harga_jasaService;
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
       
       //hanya angka
       function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
        }
        //cari
        function cari(){
            axios.get('http://192.168.19.140/P3L_L_1/api/motorKonsumen')
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
                        id_konsumen_fk = motorK[i].id_konsumen_fk;
                    }else{
                        alert("Plat Motor Tidak ditemukan");
                    }
                    
                }
            }).catch((error) => {
                console.log(error);
            });
        }
        
        function tambahDetail(detailService, id_transaksi_fk) {
            //console.log(detail);
            detailService.map(dts => dts.id_transaksi_fk = id_transaksi_fk);
            let formDataDetail = new FormData(); 
            console.log(JSON.stringify(detailService));
            formDataDetail.append('data', JSON.stringify(detailService));
            // formDataDetail.append('kode_sparepart', kode_sparepart);
            // formDataDetail.append('jumlah_pemesanan', jumlah_pemesanan);
            // formDataDetail.append('harga_beli', harga_beli);
            // formDataDetail.append('satuan', satuan);
            axios.post('http://192.168.19.140/P3L_L_1/api/detilJasa', formDataDetail)
            .then((result) => {
                console.log(result);
            }).catch((err) => {
                console.log(err.response);
            });
        }

        function tambahDetailSparepart(detailSparepart , id_transaksi_fk) {
            console.log(detailSparepart);
            detailSparepart.map(dts => dts.id_transaksi_fk = id_transaksi_fk);
            let formDataDetail = new FormData(); 
            console.log(JSON.stringify(detailSparepart));
            formDataDetail.append('data', JSON.stringify(detailSparepart));
            // formDataDetail.append('kode_sparepart', kode_sparepart);
            // formDataDetail.append('jumlah_pemesanan', jumlah_pemesanan);
            // formDataDetail.append('harga_beli', harga_beli);
            // formDataDetail.append('satuan', satuan);
            axios.post('http://192.168.19.140/P3L_L_1/api/detilSparepart', formDataDetail)
            .then((result) => {
                console.log(result);
            }).catch((err) => {
                console.log(err.response);
            });
    }
        //simpan
        function simpan(){
        //let tampung = detailService;
        id_montir = document.getElementById("id_montir").value;
        let formData = new FormData();
        formData.append('id_cabang_fk', id_cabang_fk);
        // formData.append('kode_transaksi', kode_transaksi);
        formData.append('diskon', 0);
        formData.append('total_transaksi', total);
        //formData.append('id_pegawai_fk', id_montir);
        console.log(formData);
        axios.post('http://192.168.19.140/P3L_L_1/api/transaksiPenjualanSS', formData)
        .then((result) =>{
            console.log(result);
            //let tes = result.data.transaksiPenjualanSV;
            //console.log("tes = ",tes);
            for(let i = 0; i < detailService.length; i++)
                detailService[i].id_transaksi_fk = result.data.data.id_transaksi;
                console.log("tampung = ",detailService);
            for(let i = 0; i < detailSparepart.length; i++)
                detailSparepart[i].id_transaksi_fk = result.data.data.id_transaksi;
                console.log("tampung = ",detailSparepart);
                //console.log(tes[i]);
            
            tambahDetail(detailService, result.data.data.id_transaksi);
            tambahDetailSparepart(detailSparepart, result.data.data.id_transaksi);
            alert('Data Transaksi Service Berhasil di Tambahkan');
            location.href = "{{ url('/transaksiSS')}}";
        })
        .catch((error) =>{
            //console.log(error);
        });
        
        return false;
    }


    </script>
@endsection