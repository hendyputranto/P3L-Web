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
                <h2>Riwayat Transaksi</h2>

                <form action="/action_page.php">
                    <div class="col-sm-offset-5 col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="     Cari Nomor Transaksi" name="cari_nomor" id="cari_nomor" onkeyup="myFunction()">
                    </div>
                    </div>
                </form>
                
                <table class="table table-bordered text-center" id="tableTransaksipenjualan">
                    <thead>
                    <tr>
                        <!-- <th scope="col">No. Transaksi</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Nomor Telpon</th>
                        <th scope="col">Subtotal Transaksi</th>
                        <th scope="col">Status Service</th>
                        <th scope="col">Keterangan Transaksi</th> -->
                        
                        <th scope="col">No. Transaksi</th>
                        <th scope="col">Tanggal Transaksi</th>
                        <th scope="col">Nomor Polisi</th>
                        <th scope="col">Status Service</th>
                        <th scope="col">Status Transaksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        let col = ['id_transaksi', 'tgl_transaksi', 'plat_motorKonsumen', 'status_service', 'status_transaksi' ];
        let tableTransaksipenjualan = document.querySelector('#tableTransaksipenjualan tbody');

        axios.get('http://192.168.19.140/P3L_L_1/api/penjualan/tampilriwayat')
        .then((result) => {
            console.log(result.data);
            let transaksipenjualan = result.data;
            for(let i=0; i<transaksipenjualan.length; i++){
                if(transaksipenjualan[i].status_transaksi == "Sudah Lunas")
                {
                    let tr = tableTransaksipenjualan.insertRow(-1);
                    let td = document.createElement('td');
                    for(j=0;j<col.length;j++){
                        td = tr.insertCell();
                        td.innerHTML = transaksipenjualan[i][col[j]];
                    }
                }
            }
        }).catch((arror) => {
            console.log(error);
        });

        //search data
        function myFunction() {
            var input, sfilter, table, tr, td, i, txtValue;
            input = document.getElementById("cari_nomor");
            filter = input.value.toUpperCase();
            table = document.getElementById("tableTransaksipenjualan");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[2];
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