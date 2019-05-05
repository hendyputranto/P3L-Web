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
                
                <!-- <span style="float: left">
                    <div class="form-group">
                    <div class="col-sm-offset-0 col-sm-20">
                        <button type="button" class="btn btn-success" onclick="tambah()">TAMBAH</button>
                    </div>
                    </div>
                </span> -->
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
                        <!-- <th>NAMA</th>
                        <th>MERK</th>
                        <th>TIPE</th> -->
                        <th>STOK SISA</th>
                        <!-- <th>Satuan Pengadaan</th>
                        <th>Total Harga</th>
                        <th>Total Barang Datang</th>
                        <th>Tanggal Pengadaan</th>
                        <th>Tanggal Barang datang</th>
                        <th>Status Cetak</th> -->
                        <!-- <th>PILIHAN</th> -->
                    </tr>
                    </thead>
                </table>
                <h4>Pengadaan Sparepart</h4>
                <table>
                <form class="form-horizontal">
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
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="satuan_pengadaan" placeholder="Satuan Pengadaan" name="satuan_pengadaan" onkeypress="return hanyaAngka(event)" onkeyup="hitungTotal()">
                    </div>
                    </div>

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
        let total;
        let id_sparepartCabang;
        let select1 = document.querySelector('#id_supplier');
        let select2 = document.querySelector('#id_cabang');
        let select3 = document.querySelector('#kode_sparepart');
        let select4 = document.querySelector('#hargaBeli_sparepart');
        let tableSparepartKurang = document.querySelector('#tableSparepartKurang');
        let col = ['kode_sparepart_fk','stokSisa_sparepart'];
        
        //tabel sparepart kurang
        function tampilData(){
            axios.get('http://192.168.0.176:8000/api/sparepartCabang')
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
            axios.get('http://192.168.0.176:8000/api/sparepartCabang')
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
        
        
        //supplier dropdown
        axios.get('http://192.168.0.176:8000/api/supplier')
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
            axios.get('http://192.168.0.176:8000/api/sparepartCabang')
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
        axios.get('http://192.168.0.176:8000/api/cabang')
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

        //hitung total harga
        function hitungTotal() {
            var input, harga;
            input = document.getElementById("satuan_pengadaan").value;
            //x= parseFloat(input);
            harga = document.getElementById("hargaBeli_sparepart").value;
            //y= parseFloat(harga);
            total = parseFloat(input * harga);
            document.getElementById("total_harga").value = total;
            //return total;
            
        }
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
        //simpan
        function simpan(){
        let id_supplier_fk = document.querySelector('#id_supplier').value;
        let id_sparepartCabang_fk = id_sparepartCabang;
        let satuan_pengadaan = document.querySelector('#satuan_pengadaan').value;
        let totalHarga_pengadaan = document.querySelector('#total_harga').value;
        let formData = new FormData();
        formData.append('id_supplier_fk', id_supplier_fk);
        formData.append('id_sparepartCabang_fk', id_sparepartCabang_fk);
        formData.append('satuan_pengadaan', satuan_pengadaan);
        formData.append('totalHarga_pengadaan', totalHarga_pengadaan);
        axios.post('http://192.168.0.176:8000/api/pengadaanSparepart', formData)
        .then((result) =>{
            console.log(result);
            alert("Data Pengadaan Berhasil di Tambahkan");
           // location.href = "{{ url('/pengadaan')}}";
        })
        .catch((error) =>{
            console.log(error.response);
        });
        
        return false;
    }
    </script>
@endsection