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
                <h2>Kelola Data Sparepart</h2>
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
                        <input type="text" class="form-control" placeholder="Cari Nama Sparepart" name="cari_sparepart" id="cari_sparepart" onkeyup="myFunction()">
                    </div>
                    </div>
                </form>
                <table class="table table-bordered text-center" id="tableSparepart">
                    <thead>
                    <tr>
                        <th>KODE</th>
                        <th>NAMA</th>
                        <th>MERK</th>
                        <th>TIPE</th>
                        <th>GAMBAR</th>
                        <th>PILIHAN</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
    let Sparepart;
    let tableSparepart = document.querySelector('#tableSparepart');
    let col = ['kode_sparepart', 'nama_sparepart', 'merk_sparepart', 
    'tipe_sparepart', 'gambar_sparepart'];

    axios.get('http://127.0.0.1:8000/api/sparepart')
    .then((result) => {
        console.log(result.data);
        Sparepart = result.data.data;
        console.log(Sparepart);

        for(let i=0; i<Sparepart.length; i++){
            let tr = tableSparepart.insertRow(-1);
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
                }else if(j==4){
                            let img = document.createElement('img');
                            img.src = '/images/'+Sparepart[i][col[j]];
                            img.width = 150;
                            img.height = 150;
                            td.appendChild(img);
                }else if(j==8){
                    td.innerHTML = '***';
                }
                else{
                    td.innerHTML = Sparepart[i][col[j]];
                }
            }
        }
    }).catch((error) => {
        console.log(error);
    });

    function tambah(obj){
            location.href = "{{ url('/tsparepart')}}";
    }

    function ubah(obj){
            localStorage.setItem("id_sparepart",obj.parentNode.parentNode.cells[0].innerHTML);
            location.href = "{{ url('/usparepart')}}";
    }

    function hapus(obj) {
        console.log(obj.parentNode.parentNode.cells[0].innerHMTL);
        axios.delete('http://127.0.0.1:8000/api/sparepart/'+obj.parentNode.parentNode.cells[0].innerHTML)
        .then((result) => {
            sparepart.splice(obj.parentNode.parentNode.rowIndex-1, 1);
            tableSparepart.deleteRow(obj.parentNode.parentNode.rowIndex);
        }).catch((error) => { 
            console.log(error);
        });
    }

     //search data
     function myFunction() {
        var input, sfilter, table, tr, td, i, txtValue;
        input = document.getElementById("cari_sparepart");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableSparepart");
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