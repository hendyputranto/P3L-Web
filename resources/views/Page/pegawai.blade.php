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
                <h2>Kelola Data Pegawai</h2>
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
                        <input type="text" class="form-control" placeholder="Cari Nama Pegawai" name="cari_pegawai" id="cari_pegawai" onkeyup="myFunction()">
                    </div>
                    </div>
                </form>
                <table class="table table-bordered text-center" id="tablePegawai">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NAMA CABANG</th>
                        <th>NAMA ROLE</th>
                        <th>NAMA PEGAWAI</th>
                        <th>ALAMAT</th>
                        <th>NO TELP</th>
                        <th>GAJI</th>
                        <th>USERNAME</th>
                        <th>PASSWORD</th>
                        <th>PILIHAN</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
    let Pegawai;
    let tablePegawai = document.querySelector('#tablePegawai');
    let col = ['id_pegawai', 'id_cabang_fk', 'id_role_fk', 'nama_pegawai', 'alamat_pegawai', 'noTelp_pegawai', 
    'gaji_pegawai', 'username_pegawai', 'password_pegawai'];

    axios.get('http://192.168.19.140/P3L_L_1/api/pegawai/')
    .then((result) => {
        console.log(result.data.data);
        Pegawai = result.data.data;
        console.log(Pegawai);

        for(let i=0; i<Pegawai.length; i++){
            let tr = tablePegawai.insertRow(-1);
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
                }else if(j==8){
                    td.innerHTML = '***';
                }
                else{
                    td.innerHTML = Pegawai[i][col[j]];
                }
            }
        }
    }).catch((arror) => {
        console.log(error);
    });

    function tambah(obj){
            location.href = "{{ url('/tpegawai')}}";
    }

    function ubah(obj){
            localStorage.setItem("id_pegawai",obj.parentNode.parentNode.cells[0].innerHTML);
            location.href = "{{ url('/upegawai')}}";
    }

    function hapus(obj) {
        console.log(obj.parentNode.parentNode.cells[0].innerHMTL);
        axios.delete('http://192.168.19.140/P3L_L_1/api/pegawai/'+obj.parentNode.parentNode.cells[0].innerHTML)
        .then((result) => {
            pegawai.splice(obj.parentNode.parentNode.rowIndex-1, 1);
            tablePegawai.deleteRow(obj.parentNode.parentNode.rowIndex);
        }).catch((error) => { 
            console.log(error);
        });
    }

     //search data
     function myFunction() {
        var input, sfilter, table, tr, td, i, txtValue;
        input = document.getElementById("cari_pegawai");
        filter = input.value.toUpperCase();
        table = document.getElementById("tablePegawai");
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