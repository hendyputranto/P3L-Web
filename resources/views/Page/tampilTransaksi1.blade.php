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
                
                <!-- <h5>Sparepart Dengan Stok Kurang</h5> -->
                
                    <label class="control-label col-sm-3" for="status">STATUS</label>
                    <div class="col-sm-4">
                        <select class="form-control" id = "status" name = "status" onchange = "tampilData()">
                            <option value="">---Pilih Status---</option>
                            <option value="Belum Selesai">Belum Selesai</option>
                            <option value="Sudah Selesai">Sudah Selesai</option>
                        </select>
                    </div>
                    
                <div class="col-sm-offset-9 col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Tanggal Transaksi" name="cari_transaksi" id="cari_transaksi" onkeyup="myFunction()">
                    </div>
                </div>
                   
                <table class="table table-bordered text-center" id="tableService">
                    <thead>
                    <tr>
                        <th>ID DETIL TRANSAKSI</th>
                        <th>ID TRANSAKSI</th>
                        <!-- <th>KODE TRANSAKSI</th> -->
                        <!-- <th>TANGGAL TRANSAKSI</th>
                        <th>DISKON</th>
                        <th>TOTAL TRANSAKSI</th> -->
                        <!-- <th>Total Barang Datang</th>
                        <th>Tanggal Pengadaan</th>
                        <th>Tanggal Barang datang</th> -->
                        <th>STATUS SERVICE</th>
                        <th>PILIHAN</th>
                    </tr>
                    </thead>
                </table>
                
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
        let select1 = document.querySelector('#status');
        let tableService = document.querySelector('#tableService');
        let col = ['id_detilTransaksiService','id_transaksi_fk','status_service'];
        
        //tabel transaksi
        function tampilData(){
            axios.get('http://192.168.19.140/P3L_L_1/api/detilJasa')
            .then((result) => {
                detil = result.data.data;
                let cek = document.getElementById("status").value;
                //let cek = document.getElementById("id_cabang").value;
                //console.log("Cek = ",sparepartKurang);
                console.log(cek);
                for(let i=0; i<detil.length; i++){
                    // console.log("test3");
                    console.log(cek);
                        if(detil[i].status_service == cek)
                        {
                            //console.log(cek);
                            let tr = tableService.insertRow(-1);
                            let td = document.createElement('td');
                            for(j=0;j<=col.length;j++){
                                td = tr.insertCell();
                                if(j==col.length){
                                    if(detil[i].status_service == "Belum Selesai"){
                                        let buttonCetak = document.createElement('input');
                                        buttonCetak.setAttribute('type','button');
                                        buttonCetak.setAttribute('value','Cetak');
                                        buttonCetak.setAttribute('class','btn btn-success');
                                        buttonCetak.setAttribute('onclick','Cetak(this)');
                                        td.appendChild(buttonCetak);
                                        let buttonBayar = document.createElement('input');
                                        buttonBayar.setAttribute('type','button');
                                        buttonBayar.setAttribute('value','Bayar');
                                        buttonBayar.setAttribute('class','btn btn-success');
                                        buttonBayar.setAttribute('onclick','Bayar(this)');
                                        td.appendChild(buttonBayar);
                                        let buttonUbah = document.createElement('input');
                                        buttonUbah.setAttribute('type','button');
                                        buttonUbah.setAttribute('value','ubah');
                                        buttonUbah.setAttribute('class','btn btn-primary');
                                        buttonUbah.setAttribute('onclick','ubah(this)');
                                        td.appendChild(buttonUbah);
                                        td.appendChild(document.createTextNode(' '));
                                        let buttonHapus = document.createElement('input');
                                        buttonHapus.setAttribute('type','button');
                                        buttonHapus.setAttribute('value','hapus');
                                        buttonHapus.setAttribute('class','btn');
                                        buttonHapus.setAttribute('class','btn btn-danger');
                                        buttonHapus.setAttribute('onclick','hapus(this)');
                                        td.appendChild(buttonHapus);
                                    }
                                    
                                }
                                else{
                                    td.innerHTML = detil[i][col[j]];
                                }
                        }
                        
                    }
                }
            }).catch((error) => {
                console.log(error);
            });

        }
                        
        
        function ubah(obj){
                 localStorage.setItem("id_transaksi",obj.parentNode.parentNode.cells[0].innerHTML);
                //  location.href = "{{ url('/ePengadaan')}}";
        }

        function hapus(obj) {
            console.log(obj.parentNode.parentNode.cells[0].innerHMTL);
            axios.delete('http://192.168.19.140/P3L_L_1/api/transaksiPenjualan/'+obj.parentNode.parentNode.cells[0].innerHTML)
            .then((result) => {
                transaksi.splice(obj.parentNode.parentNode.rowIndex-1, 1);
                tableTransaksi.deleteRow(obj.parentNode.parentNode.rowIndex);
            }).catch((error) => { 
                console.log(error);
            });
        }
        //search data
        function myFunction() {
            var input, sfilter, table, tr, td, i, txtValue;
            input = document.getElementById("cari_pengadaan");
            filter = input.value.toUpperCase();
            table = document.getElementById("tablePengadaan");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[7];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } 
                    else {
                        tr[i].style.display = "none";
                    }
                }       
            }
        }
    </script>
@endsection