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
                <h2>Kelola Data Motor</h2>
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
                        <input type="text" class="form-control" placeholder="Cari Merk Motor" name="cari_motor" id="cari_motor" onkeyup="myFunction()">
                    </div>
                    </div>
                </form>
                <table class="table table-bordered text-center" id="tableMotor">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <!-- <th>KODE SPAREPART</th> -->
                        <th>MERK MOTOR</th>
                        <th>TIPE MOTOR</th>
                        <th>PILIHAN</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>     
        let Motor;
        let tableMotor = document.querySelector('#tableMotor');
        let col = ['id_motor' , 'merk_motor', 'tipe_motor'];
        
        console.log("masuk");
        axios.get('http://192.168.19.140/P3L_L_1/api/motor')
        .then((result) => {
            console.log(result.data.data);
            Motor = result.data.data;
            console.log(Motor);

            for(let i=0; i<Motor.length; i++){
                let tr = tableMotor.insertRow(-1);
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
                        td.innerHTML = Motor[i][col[j]];
                    }
                }
            }
        }).catch((arror) => {
            console.log(error);
        });

        function tambah(obj){
                location.href = "{{ url('/tmotor')}}";
        }

        function ubah(obj){
                localStorage.setItem("id_motor",obj.parentNode.parentNode.cells[0].innerHTML);
                location.href = "{{ url('/umotor')}}";
        }

        function hapus(obj) {
            console.log(obj.parentNode.parentNode.cells[0].innerHMTL);
            axios.delete('http://192.168.19.140/P3L_L_1/api/motor/'+obj.parentNode.parentNode.cells[0].innerHTML)
            .then((result) => {
                motor.splice(obj.parentNode.parentNode.rowIndex-1, 1);
                tableMotor.deleteRow(obj.parentNode.parentNode.rowIndex);
            }).catch((error) => { 
                console.log(error);
            });
        }

        //search data
        function myFunction() {
            var input, sfilter, table, tr, td, i, txtValue;
            input = document.getElementById("cari_motor");
            filter = input.value.toUpperCase();
            table = document.getElementById("tableMotor");
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