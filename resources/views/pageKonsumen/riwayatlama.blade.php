@extends('master.layoutKonsumen')
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
                <h2>Tampil Riwayat Transaksi Penjualan Jasa Service</h2>
                
                <!-- <span style="float: left">
                    <div class="form-group">
                    <div class="col-sm-offset-0 col-sm-20">
                        <button type="button" class="btn btn-success" onclick="tambah()">TAMBAH</button>
                    </div>
                    </div>
                </span> -->
                
                <!-- <h5>Sparepart Dengan Stok Kurang</h5> -->
                
                    <label class="control-label col-sm-3" for="status">STATUS</label>
                    
                <div class="col-sm-offset-9 col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari ID detil Transaksi" name="cari_transaksi" id="cari_transaksi" onkeyup="myFunction()">
                    </div>
                </div>
                   
                <table class="table table-bordered text-center" id="tableService">
                    <thead>
                    <tr>
                        <th>ID DETIL TRANSAKSI</th>
                        <th>ID TRANSAKSI</th>
                        <!-- <th>KODE TRANSAKSI</th> -->
                        <th>TANGGAL TRANSAKSI</th>
                        <th>PLAT MOTOR</th>
                        <th>STATUS SERVICE</th>
                        <th>STATUS TRANSAKSI</th>
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
        let tableService = document.querySelector('#tableTransaksi');
        let col = ['id_detilTransaksiService','id_transaksi_fk','tgl_transaksi','plat_motorKonsumen','status_service','status_transaksi'];
        
        //tabel transaksi
        
           
        
                        
        
        function ubah(obj){
                 localStorage.setItem("id_transaksi",obj.parentNode.parentNode.cells[0].innerHTML);
                //  location.href = "{{ url('/ePengadaan')}}";
        }

        function hapus(obj) {
            console.log(obj.parentNode.parentNode.cells[0].innerHMTL);
            axios.delete('http://127.0.0.1:8000/api/transaksiPenjualan/'+obj.parentNode.parentNode.cells[0].innerHTML)
            .then((result) => {
                transaksi.splice(obj.parentNode.parentNode.rowIndex-1, 1);
                tableTransaksi.deleteRow(obj.parentNode.parentNode.rowIndex);
            }).catch((error) => { 
                console.log(error);
            });
        }

        function selesai(obj) {
            let data = obj.parentNode.parentNode;
            let formData = new FormData();
            formData.append('_method', 'PUT');
            // axios.post('http://127.0.0.1:8000/api/detilJasa' + data.cells[0].innerHTML, formData)
            // .then((result) => {
                obj.setAttribute('disabled', true);
                data.cells[2].innerHTML = 'Selesai';
                obj.parentNode.childNodes[0].setAttribute('disabled', true);
            // }).catch((err) => {
            //     console.log(err.response);
                
            // });
        }
        //search data
        function myFunction() {
            var input, sfilter, table, tr, td, i, txtValue;
            input = document.getElementById("cari_transaksi");
            filter = input.value.toUpperCase();
            table = document.getElementById("tableService");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
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