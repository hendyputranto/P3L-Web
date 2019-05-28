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
                <h2>Ubah Transaksi Service</h2>
                
                <h4>Transaksi Penjualan Service</h4>
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
        
        let detail = [];
        let tampung;
        let nama_service, id_motor_fk,id_cabang_fk;
        let col2 = ['nama_service', 'subTotal_service'];
        let select1 = document.querySelector('#id_montir');
        let select2 = document.querySelector('#jenis_service');
        let select3 = document.querySelector('#kode_sparepart');
        let select4 = document.querySelector('#hargaBeli_sparepart');
        let tableDetailService = document.querySelector('#tableDetailService tbody');
        

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


            //montir dropdown
            axios.get('http://10.53.0.175:8000/api/pegawai')
            .then((result) => {
                pegawai = result.data.data;
                let cek = document.getElementById("id_montir").value;
                console.log(pegawai);
                for(let i=0; i<pegawai.length; i++){
                    // console.log("test3");
                    if(pegawai[i].id_role_fk == 2)
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
        axios.get('http://10.53.0.175:8000/api/jasaService')
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

        function harga(){
            axios.get('http://10.53.0.175:8000/api/jasaService')
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
       
        //cari
        function cari(){
            axios.get('http://10.53.0.175:8000/api/motorKonsumen')
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
            axios.post('http://10.53.0.175:8000/api/detilJasa', formDataDetail)
            .then((result) => {
                console.log(result);
            }).catch((err) => {
                console.log(err.response);
            });
        }
        //simpan
        function simpan(){
        //let tampung = detailService;
        let formData = new FormData();
        formData.append('id_cabang_fk', id_cabang_fk);
        // formData.append('kode_transaksi', kode_transaksi);
        formData.append('diskon', 0);
        formData.append('total_transaksi', total);
        console.log(formData);
        axios.post('http://10.53.0.175:8000/api/transaksiPenjualanSV', formData)
        .then((result) =>{
            console.log(result);
            //let tes = result.data.transaksiPenjualanSV;
            //console.log("tes = ",tes);
            for(let i = 0; i < detailService.length; i++)
                detailService[i].id_transaksi_fk = result.data.data.id_transaksi;
                console.log("tampung = ",detailService);
                //console.log(tes[i]);
            
            tambahDetail(detailService, result.data.data.id_transaksi);
            alert('Data Transaksi Service Berhasil di Tambahkan');
            location.href = "{{ url('/transaksiSV')}}";
        })
        .catch((error) =>{
            console.log(error);
        });
        
        return false;
    }


    </script>
@endsection