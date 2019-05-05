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
                <h2>Kelola Data Konsumen</h2>
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
                        <input type="text" class="form-control" placeholder="Cari Nama Konsumen" name="cari_konsumen" id="cari_konsumen" onkeyup="myFunction()">
                    </div>
                    </div>
                </form>
                <table class="table table-bordered text-center" id="tableKonsumen">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAMA</th>
                        <th>ALAMAT</th>
                        <th>NO TELP</th>
                        <th>PILIHAN</th>
                    </tr>
                    
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>     
        let konsumen;
        let tableKonsumen = document.querySelector('#tableKonsumen');
        let col = ['id_konsumen','nama_konsumen', 'alamat_konsumen', 'noTelp_konsumen'];

        axios.get('http://192.168.0.176:8000/api/konsumen')
        .then((result) => {
            console.log(result.data.data);
            konsumen = result.data.data;
            for(let i=0; i<konsumen.length; i++){
                let tr = tableKonsumen.insertRow(-1);
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
                        td.innerHTML = konsumen[i][col[j]];
                    }
                }
            }
        }).catch((error) => {
            console.log(error);
        });

        function tambah(obj){
                 location.href = "{{ url('/tkonsumen')}}";
        }

        function ubah(obj){
                 localStorage.setItem("id_konsumen",obj.parentNode.parentNode.cells[0].innerHTML);
                 location.href = "{{ url('/ukonsumen')}}";
        }

        function hapus(obj) {
            console.log(obj.parentNode.parentNode.cells[0].innerHMTL);
            axios.delete('http://192.168.0.176:8000/api/konsumen/'+obj.parentNode.parentNode.cells[0].innerHTML)
            .then((result) => {
                konsumen.splice(obj.parentNode.parentNode.rowIndex-1, 1);
                tableKonsumen.deleteRow(obj.parentNode.parentNode.rowIndex);
            }).catch((error) => { 
                console.log(error);
            });
        }

        //search data
        function myFunction() {
            var input, sfilter, table, tr, td, i, txtValue;
            input = document.getElementById("cari_konsumen");
            filter = input.value.toUpperCase();
            table = document.getElementById("tableKonsumen");
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