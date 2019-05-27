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
        <div class="kotak">
            <div class="table-responsive">
                <h2>Kelola Data Sparepart Cabang</h2>
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
                        <input type="text" class="form-control" placeholder="Cari Kode Sparepart Cabang" name="cari_sparepartCabang" id="cari_sparepartCabang" onkeyup="myFunction()">
                    </div>
                    </div>
                </form>
                <table class="table table-bordered text-center" id="tableSparepartCabang">
                    <thead>
                    <tr>
                        <th>ID SPAREPART CABANG</th>
                        <th>ID CABANG</th>
                        <th>KODE SPAREPART</th>
                        <th>HARGA BELI</th>
                        <th>HARGA JUAL</th>
                        <th>LETAK SPAREPART</th>
                        <th>STOCK MINIMUM</th>
                        <th>STOCK SISA SPAREPART</th>
                        <th>PILIHAN</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
    let SparepartCabang;
    let tableSparepartCabang = document.querySelector('#tableSparepartCabang');
    let col = ['id_sparepartCabang', 'id_cabang_fk', 'kode_sparepart_fk', 'hargaBeli_sparepart', 'hargaJual_sparepart', 'letak_sparepart', 
    'stokMin_sparepart', 'stokSisa_sparepart'];

    axios.get('http://10.53.0.175:8000/api/sparepartCabang/')
    .then((result) => {
        console.log(result.data.data);
        SparepartCabang = result.data.data;
        console.log(SparepartCabang);

        for(let i=0; i<SparepartCabang.length; i++){
            let tr = tableSparepartCabang.insertRow(-1);
            let td = document.createElement('td');
            console.log(i);

            for(j=0;j<=col.length;j++){
                td = tr.insertCell();
                console.log(j);

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
                    td.innerHTML = SparepartCabang[i][col[j]];
                }
            }
        }
    }).catch((error) => {
        console.log(error);
    });

    function tambah(obj){
            location.href = "{{ url('/tsparepartcabang')}}";
    }

    function ubah(obj){
            localStorage.setItem("id_sparepartCabang",obj.parentNode.parentNode.cells[0].innerHTML);
            location.href = "{{ url('/usparepartcabang')}}";
    }

    function hapus(obj) {
        console.log(obj.parentNode.parentNode.cells[0].innerHMTL);
        axios.delete('http://10.53.0.175:8000/api/sparepartCabang/'+obj.parentNode.parentNode.cells[0].innerHTML)
        .then((result) => {
            sparepartCabang.splice(obj.parentNode.parentNode.rowIndex-1, 1);
            tableSparepartCabang.deleteRow(obj.parentNode.parentNode.rowIndex);
        }).catch((error) => { 
            console.log(error);
        });
    }

     //search data
     function myFunction() {
        var input, sfilter, table, tr, td, i, txtValue;
        input = document.getElementById("cari_sparepartCabang");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableSparepartCabang");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[3];
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