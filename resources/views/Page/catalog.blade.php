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
                <h2>Sparepart Yang Dijual</h2>
                
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
                        <th>HARGA</th>
                        <th>GAMBAR</th>
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
    let col = ['kode_sparepart_fk', 'nama_sparepart', 'merk_sparepart', 'tipe_sparepart','hargaJual_sparepart','gambar_sparepart'];
    let col1 = ['hargaJual_sparepart'];
    axios.get('http://192.168.19.140/P3L_L_1/api/sparepartCabang')
    .then((result) => {
        console.log(result.data);
            Sparepart = result.data.data;
            let kode;
            console.log(Sparepart);

            for(let i=0; i<Sparepart.length; i++){
                let tr = tableSparepart.insertRow(-1);
                let td = document.createElement('td');
                console.log(i);
                kode = Sparepart[i].kode_sparepart;
                for(j=0;j<col.length;j++){
                    td = tr.insertCell();
                    console.log(j);
                    if(j==5){
                        let img = document.createElement('img');
                        img.src = '/images/'+Sparepart[i][col[j]];
                        img.width = 150;
                        img.height = 150;
                        td.appendChild(img);
                    }
                    else{
                        td.innerHTML = Sparepart[i][col[j]];
                    }
                }
        }
    }).catch((error) => {
        console.log(error);
    });

    // axios.get('http://127.0.0.1:8000/api/sparepartCabang')
    // .then((result) => {
    //     console.log(result.data);
    //         Sparepart = result.data.data;
    //         console.log(Sparepart);

    //         for(let i=0; i<Sparepart.length; i++){
    //             let tr = tableSparepart.insertRow(-1);
    //             let td = document.createElement('td');
    //             console.log(i);

    //             for(j=0;j<col.length;j++){
    //                 td = tr.insertCell();
    //                 if(kode == Sparepart[i].kode_sparepart_fk){

    //                 }
    //                 else{
    //                     td.innerHTML = Sparepart[i][col1[j]];
    //                 }
    //             }
    //     }
    // }).catch((error) => {
    //     console.log(error);
    // });
    

     //search data
     function myFunction() {
        var input, sfilter, table, tr, td, i, txtValue;
        input = document.getElementById("cari_sparepart");
        filter = input.value.toUpperCase();
        table = document.getElementById("tableSparepart");
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