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
                
                <!-- <h5>Sparepart Dengan Stok Kurang</h5> -->
                <div class="col-sm-offset-9 col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Tanggal Pengadaan" name="cari_pengadaan" id="cari_pengadaan" onkeyup="myFunction()">
                    </div>
                </div>
                   
                <table class="table table-bordered text-center" id="tablePengadaan">
                    <thead>
                    <tr>
                        <th>ID PENGADAAN</th>
                        <th>ID SUPPLIER</th>
                        <th>ID SPAREPART CABANG</th>
                        <th>STATUS PENGADAAN</th>
                        <th>SATUAN PENGADAAN</th>
                        <th>TOTAL HARGA</th>
                        <th>Total Barang Datang</th>
                        <th>Tanggal Pengadaan</th>
                        <th>Tanggal Barang datang</th>
                        <th>Status Cetak</th>
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
        let select1 = document.querySelector('#id_supplier');
        let select2 = document.querySelector('#id_cabang');
        let select3 = document.querySelector('#kode_sparepart');
        let select4 = document.querySelector('#hargaBeli_sparepart');
        let tablePengadaan = document.querySelector('#tablePengadaan');
        let col = ['id_pengadaan','id_supplier_fk','id_sparepartCabang_fk','status_pengadaan','satuan_pengadaan','totalHarga_pengadaan','totalBarang_datang','tgl_pengadaan','tgl_barangDatang','statusCetak_pengadaan'];
        
        //tabel pengadaan
        
            axios.get('http://127.0.0.1:8000/api/pengadaanSparepart')
            .then((result) => {
                pengadaan = result.data.data;
                //let cek = document.getElementById("id_cabang").value;
                //console.log("Cek = ",sparepartKurang);
                //console.log(cek);
                for(let i=0; i<pengadaan.length; i++){
                    // console.log("test3");
                    
                        let tr = tablePengadaan.insertRow(-1);
                        let td = document.createElement('td');
                        for(j=0;j<=col.length;j++){
                            td = tr.insertCell();
                            if(j==col.length){
                                let buttonCetak = document.createElement('input');
                                buttonCetak.setAttribute('type','button');
                                buttonCetak.setAttribute('value','Cetak');
                                buttonCetak.setAttribute('class','btn btn-success');
                                buttonCetak.setAttribute('onclick','Cetak(this)');
                                td.appendChild(buttonCetak);
                                let buttonVerif = document.createElement('input');
                                buttonVerif.setAttribute('type','button');
                                buttonVerif.setAttribute('value','Verif');
                                buttonVerif.setAttribute('class','btn btn-success');
                                buttonVerif.setAttribute('onclick','Verif(this)');
                                td.appendChild(buttonVerif);
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
                            else{
                                td.innerHTML = pengadaan[i][col[j]];
                            }
                        }
                    
                    
                }
            }).catch((error) => {
                console.log(error);
            });
            
        
        
        function ubah(obj){
                 localStorage.setItem("id_pengadaan",obj.parentNode.parentNode.cells[0].innerHTML);
                 location.href = "{{ url('/ePengadaan')}}";
        }

        function hapus(obj) {
            console.log(obj.parentNode.parentNode.cells[0].innerHMTL);
            axios.delete('http://127.0.0.1:8000/api/pengadaanSparepart/'+obj.parentNode.parentNode.cells[0].innerHTML)
            .then((result) => {
                pengadaan.splice(obj.parentNode.parentNode.rowIndex-1, 1);
                tablePengadaan.deleteRow(obj.parentNode.parentNode.rowIndex);
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