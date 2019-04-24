@extends('master.layout')
@section('content')
    <style>
        .kotak {
            width: 100%;
            padding: 10px;
            border: 5px solid gray;
            margin: 0;
            background-color:#FFFFFF;
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
                <h2>Kelola Data Jasa Service</h2>
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
                        <input type="text" class="form-control" placeholder="Cari Nama Jasa Service" name="cari_jasaService" id="cari_jasaService" onkeyup="myFunction()">
                    </div>
                    </div>
                </form>
                <table class="table table-bordered text-center" id="tableJasaService">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAMA</th>
                        <th>HARGA</th>
                        <th>PILIHAN</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>     
        let JasaService;
        let tableJasaService = document.querySelector('#tableJasaService');
        let col = ['id_jasaService', 'nama_jasaService', 'harga_jasaService'];
        
        console.log("masuk");
        axios.get('http://127.0.0.1:8000/api/jasaService')
        .then((result) => {
            console.log(result.data.data);
            JasaService = result.data.data;
            console.log(JasaService);

            for(let i=0; i<JasaService.length; i++){
                let tr = tableJasaService.insertRow(-1);
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
                        td.innerHTML = JasaService[i][col[j]];
                    }
                }
            }
        }).catch((arror) => {
            console.log(error);
        });

        function tambah(obj){
                location.href = "{{ url('/tjasaservice')}}";
        }

        function ubah(obj){
                localStorage.setItem("id_jasaService",obj.parentNode.parentNode.cells[0].innerHTML);
                location.href = "{{ url('/ujasaservice')}}";
        }

        function hapus(obj) {
            console.log(obj.parentNode.parentNode.cells[0].innerHMTL);
            axios.delete('http://127.0.0.1:8001/api/jasaService/'+obj.parentNode.parentNode.cells[0].innerHTML)
            .then((result) => {
                jasaService.splice(obj.parentNode.parentNode.rowIndex-1, 1);
                tableJasaService.deleteRow(obj.parentNode.parentNode.rowIndex);
            }).catch((error) => { 
                console.log(error);
            });
        }

        //search data
        function myFunction() {
            var input, sfilter, table, tr, td, i, txtValue;
            input = document.getElementById("cari_jasaService");
            filter = input.value.toUpperCase();
            table = document.getElementById("tableJasaService");
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