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
                <h2>Form Pengadaan Sparepart</h2>
                
                <div class="form-group">
                    <label class="control-label col-sm-4" for="id_cabang">CABANG</label>
                    <div class="col-sm-5">
                        <select class="form-control" id = "id_cabang" name = "id_cabang" onchange = "tampilData()">
                            <option value=""  >---Pilih Cabang---</option>
                        </select>
                    </div>
                    <div class="col-sm-offset-9 ">
                        <button type="button" class="btn btn-info" onclick="tampil()">TAMPIL PENGADAAN</button>
                    </div>
                    </div>
                 
                
                <h5>Sparepart Dengan Stok Kurang</h5>
                <table class="table table-bordered text-center" id="tableSparepartKurang">
                    <thead>
                    <tr>
                        <th>KODE SPAREPART</th>
                        <th>STOK SISA</th>       
                    </tr>
                    </thead>
                </table>
                <h4>Pengadaan Sparepart</h4>
                <table>
                    <div class="form-group">
                    <label class="control-label col-sm-4" for="id_supplier">SUPPLIER</label>
                    <div class="col-sm-8">
                        <select class="form-control" id = "id_supplier" name = "id_supplier">
                            <option value="">---Pilih Supplier---</option>
                        </select>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-4" for="kode_sparepart">KODE SPAREPART</label>
                    <div class="col-sm-8">
                        <select class="form-control" id = "kode_sparepart" name = "kode_sparepart" onclick = "harga()">
                            <option value="" >---Pilih Kode Sparepart---</option>
                        </select>
                    </div>
                    </div>

                    <!-- <div class="form-group">
                    <label class="control-label col-sm-4" for="merk_sparepart">MERK SPAREPART</label>
                    <div class="col-sm-8">
                        <select class="form-control" id = "merk_sparepart" name = "merk_sparepart">
                            <option value="">---Pilih Merk Sparepart---</option>
                        </select>
                    </div>
                    </div> -->
                    <div class="form-group">
                    <label class="control-label col-sm-4" for="hargaBeli_sparepart">Harga</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="hargaBeli_sparepart" placeholder="Harga" name="hargaBeli_sparepart" readonly>
                    </div>
                    </div>
                    <div class="form-group">
                    <label class="control-label col-sm-4" for="satuan_pengadaan">SATUAN</label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" id="satuan_pengadaan" placeholder="Satuan Pengadaan" name="satuan_pengadaan" onkeypress="return hanyaAngka(event)">
                    </div>
                    <button type="button" class="btn btn-info btn-circle" onclick = "return tambah()">+</button>
                    </div>

                    <table id= "tableDetailPengadaan" class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <!-- <th scope="col">Tipe Sparepart</th> -->
                            <th scope="col">Kode Sparepart</th>
                            <th scope="col">Jumlah Beli</th>
                            <th scope="col">Harga Satuan</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>

                    <div class="form-group">
                    <label class="control-label col-sm-4" for="total_harga">TOTAL HARGA</label>
                    <div class="col-sm-8">
                        <input type="text" readonly class="form-control" id="total_harga" placeholder="Total Harga" name="total_harga">
                    </div>
                    </div>

                    <div class="form-group">
                    <div class="col-sm-offset-10 col-sm-20">
                        <button type="button" class="btn btn-danger" onclick="batal()">BATAL</button>
                        <button type="submit" value="Submit" class="btn btn-success" onclick="simpan()">SIMPAN</button>
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
        let total = 0;
        let id_sparepartCabang;
        let id_cabang;
        let detailPengadaan = [];
        let select1 = document.querySelector('#id_supplier');
        let select2 = document.querySelector('#id_cabang');
        let select3 = document.querySelector('#kode_sparepart');
        let select4 = document.querySelector('#hargaBeli_sparepart');
        let tableSparepartKurang = document.querySelector('#tableSparepartKurang');
        let tableDetailPengadaan = document.querySelector('#tableDetailPengadaan');
        let col = ['kode_sparepart_fk','stokSisa_sparepart'];
        let col2 = ['kode_sparepart_fk','satuan_pengadaan', 'sub_total_sparepart'];
        
        //tabel sparepart kurang
        function tampilData(){
            axios.get('http://192.168.19.140/P3L_L_1/api/sparepartCabang')
            .then((result) => {
                sparepartKurang = result.data.data;
                let cek = document.getElementById("id_cabang").value;
                console.log("Cek = ",sparepartKurang);
                console.log(cek);
                for(let i=0; i<sparepartKurang.length; i++){
                    // console.log("test3");
                    if(sparepartKurang[i].id_cabang_fk == cek && sparepartKurang[i].stokSisa_sparepart < sparepartKurang[i].stokMin_sparepart)
                    {
                        let tr = tableSparepartKurang.insertRow(-1);
                        let td = document.createElement('td');
                        for(j=0;j<=col.length;j++){
                            td = tr.insertCell();
                            if(j==col.length){
                                
                            }
                            else{
                                td.innerHTML = sparepartKurang[i][col[j]];
                            }
                        }
                    }
                    
                }
            }).catch((error) => {
                console.log(error);
            });

            
            //kode sprepart dropdown
            axios.get('http://192.168.19.140/P3L_L_1/api/sparepartCabang')
            .then((result) => {
                sparepart = result.data.data;
                let cek = document.getElementById("id_cabang").value;
                console.log(sparepart);
                for(let i=0; i<sparepart.length; i++){
                    // console.log("test3");
                    if(sparepart[i].id_cabang_fk == cek)
                    {
                        let option = document.createElement('option');
                        let txt = document.createTextNode(sparepart[i].kode_sparepart_fk);
                        option.appendChild(txt);
                        option.setAttribute('value', sparepart[i].kode_sparepart_fk);
                        select3.insertBefore(option, select3.lastChild);
                    }
                    
                }
            }).catch((error) => {
                console.log(error);
            });

        }
        
        function cekDetail() {
        if(document.querySelector('#id_supplier').value == '' 
        || document.querySelector('#satuan_pengadaan').value == '' 
        || document.querySelector('#kode_sparepart').value == '') {
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

            det.kode_sparepart_fk = document.querySelector('#kode_sparepart').value;
            det.sub_total_sparepart = document.querySelector('#hargaBeli_sparepart').value;
            det.satuan_pengadaan = document.querySelector('#satuan_pengadaan').value;
            det.id_sparepartCabang_fk = id_sparepartCabang;
            //det.id_motorKonsumen_fk = id_motor_fk;
            total += det.sub_total_sparepart * det.satuan_pengadaan;

            detailPengadaan.push(det);
            document.getElementById("total_harga").value = total;
            let tr = tableDetailPengadaan.insertRow(-1);
            let td = document.createElement('td'); 
            for(j = 0; j <= 3; j++){
                td = tr.insertCell();  
                if(j == 3) {
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

            console.log(detailPengadaan);
            
            return false;
        }

        function hapusDetail(obj) {
            detailPengadaan.splice(obj.parentNode.parentNode.rowIndex-1, 1);
            tableDetailPengadaan.deleteRow(obj.parentNode.parentNode.rowIndex);
            // let cek = det[obj.parentNode.parentNode.rowIndex].nama_service;
            // console.log(cek);
        }
        //supplier dropdown
        axios.get('http://192.168.19.140/P3L_L_1/api/supplier')
        .then((result) => {
            supplier = result.data.data;
            
            for(let i=0; i<supplier.length; i++){
                // console.log("test3");
                let option = document.createElement('option');
                let txt = document.createTextNode(supplier[i].nama_supplier);
                option.appendChild(txt);
                option.setAttribute('value', supplier[i].id_supplier);
                select1.insertBefore(option, select1.lastChild);
            }
        }).catch((error) => {
            console.log(error);
        });

        
        //harga sprepart dropdown
        function harga(){
            axios.get('http://192.168.19.140/P3L_L_1/api/sparepartCabang')
            .then((result) => {
                sparepart = result.data.data;
                let cek = document.getElementById("kode_sparepart").value;
                console.log(cek);
                //sparepart.kode_sparepart_fk = cek;
                console.log(sparepart.kode_sparepart_fk);
                //document.getElementById("hargaBeli_sparepart").value = sparepart.hargaBeli_sparepart;
                //console.log(sparepart);
                for(let i=0; i<sparepart.length; i++){
                    console.log("test3");
                    if(sparepart[i].kode_sparepart_fk == cek )
                    {
                        id_sparepartCabang = sparepart[i].id_sparepartCabang;
                        console.log(id_sparepartCabang);
                        document.getElementById("hargaBeli_sparepart").value = sparepart[i].hargaBeli_sparepart;
                    }
                }
            }).catch((error) => {
                console.log(error);
            });

        }
        

        //cabang dropdown
        axios.get('http://192.168.19.140/P3L_L_1/api/cabang')
        .then((result) => {
            cabang = result.data.data;
            console.log(cabang);
            for(let i=0; i<cabang.length; i++){
                // console.log("test3");
                let option = document.createElement('option');
                let txt = document.createTextNode(cabang[i].nama_cabang);
                option.appendChild(txt);
                option.setAttribute('value', cabang[i].id_cabang);
                select2.insertBefore(option, select2.lastChild);
                tampung = option.getAttribute('value', cabang[i].id_cabang);
                console.log(tampung);
            }
        }).catch((error) => {
            console.log(error);
        });

        
        //hanya angka
        function hanyaAngka(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))

            return false;
        return true;
        }
        //tampil
        function tampil(){
            location.href = "{{ url('/tPengadaan')}}";
        }


        function tambahDetail(detailPengadaan, id_pengadaan_fk) {
            //console.log(detail);
            detailPengadaan.map(dts => dts.id_pengadaan_fk = id_pengadaan_fk);
            let formDataDetail = new FormData(); 
            console.log(JSON.stringify(detailPengadaan));
            formDataDetail.append('data', JSON.stringify(detailPengadaan));
            
            axios.post('http://192.168.19.140/P3L_L_1/api/detilPengadaanSparepart/create', formDataDetail)
            .then((result) => {
                console.log(result);
            }).catch((err) => {
                //console.log(err.response);
            });
        }
        //simpan
        function simpan(){
        if(cekDetail() == false)
                return false;
        let id_supplier_fk = document.querySelector('#id_supplier').value;
        let totalHarga_pengadaan = document.querySelector('#total_harga').value;
        id_cabang = document.getElementById("id_cabang").value;
        let formData = new FormData();
        formData.append('id_supplier_fk', id_supplier_fk);
        formData.append('totalHarga_pengadaan', totalHarga_pengadaan);
        formData.append('id_cabang_fk', id_cabang);
        axios.post('http://192.168.19.140/P3L_L_1/api/pengadaanSparepart/create', formData)
        .then((result) =>{
            console.log(result);
            for(let i = 0; i < detailPengadaan.length; i++)
                detailPengadaan[i].id_pengadaan_fk = result.data.data.id_pengadaan;
                console.log("tampung = ",detailPengadaan);
                //console.log(tes[i]);
            
            tambahDetail(detailPengadaan, result.data.data.id_pengadaan);
            alert("Data Pengadaan Berhasil di Tambahkan");
            location.href = "{{ url('/pengadaan')}}";
        })
        .catch((error) =>{
            console.log(error.response);
        });
        
        return false;
    }
    </script>
@endsection