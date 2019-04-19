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
                <h2>Pengadaan Sparepart</h2>
                <span style="float: left">
                    <div class="form-group">
                    <div class="col-sm-offset-0 col-sm-20">
                        <button type="button" class="btn btn-success" onclick="tambah()">TAMBAH</button>
                    </div>
                    </div>
                </span>
                <form action="/action_page.php">
                    <div class="col-sm-offset-0 col-sm-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Cari Nama Cabang" name="cari_cabang" id="cari_cabang" onkeyup="myFunction()">
                    </div>
                    </div>
                </form>
                <table class="table table-bordered text-center" id="tableSparepartKurang">
                    <thead>
                    <tr>
                        <th>KODE SPAREPART</th>
                        <th>NAMA</th>
                        <th>MERK</th>
                        <th>TIPE</th>
                        <th>GAMBAR</th>
                        <!-- <th>Satuan Pengadaan</th>
                        <th>Total Harga</th>
                        <th>Total Barang Datang</th>
                        <th>Tanggal Pengadaan</th>
                        <th>Tanggal Barang datang</th>
                        <th>Status Cetak</th> -->
                        <th>PILIHAN</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>     
        let sparepartKurang;
        let tableSparepartKurang = document.querySelector('#tableSparepartKurang');
        let col = ['kode_sparepart', 'nama_sparepart', 'merk_sparepart','tipe_sparepart', 'gambar_sparepart'];

        axios.get('http://127.0.0.1:8000/api/sparepart')
        .then((result) => {
            console.log("test");
            console.log(result.data);
            sparepartKurang = result.data;
            console.log("test2");
            for(let i=0; i<sparepartKurang.length; i++){
                console.log("test3");
                let tr = tableSparepartKurang.insertRow(-1);
                let td = document.createElement('td');
                for(j=0;j<=col.length;j++){
                    td = tr.insertCell();
                    if(j==col.length){
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
                        td.innerHTML = sparepartKurang[i][col[j]];
                    }
                }
            }
        }).catch((error) => {
            console.log(error);
        });

        function tambah(obj){
                location.href = "{{ url('/tcabang')}}";
        }

        function ubah(obj){
                localStorage.setItem("id_cabang",obj.parentNode.parentNode.cells[0].innerHTML);
                location.href = "{{ url('/ucabang')}}";
        }

        function hapus(obj) {
            console.log(obj.parentNode.parentNode.cells[0].innerHMTL);
            axios.delete('http://www.simato.jasonfw.com/api/cabang/'+obj.parentNode.parentNode.cells[0].innerHTML)
            .then((result) => {
                cabang.splice(obj.parentNode.parentNode.rowIndex-1, 1);
                tableCabang.deleteRow(obj.parentNode.parentNode.rowIndex);
            }).catch((error) => { 
                console.log(error);
            });
        }

        //search data
        function myFunction() {
            var input, sfilter, table, tr, td, i, txtValue;
            input = document.getElementById("cari_cabang");
            filter = input.value.toUpperCase();
            table = document.getElementById("tableCabang");
            tr = table.getElementsByTagName("tr");
            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[1];
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