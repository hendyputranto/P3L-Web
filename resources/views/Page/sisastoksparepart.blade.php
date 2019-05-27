@extends('master.layout')
@section('content')
<style>
    .kotak {
        width: 100%;
        padding: 10px;
        border: 5px solid gray;
        margin: 0;
        background-color:grey;
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
                <h2>Sisa Stok Sparepart</h2>
                
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
                        <th>NAMA SPAREPART</th>
                        <th>MERK SPAREPART</th>
                        <th>TIPE SPAREPART</th>
                        <th>GAMBAR</th>
                        <th>STOK MINIMAL</th>
                        <th>STOK SISA</th>
                        <th>HARGA BELI</th>
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
    let col = ['kode_sparepart','nama_sparepart','merk_sparepart','tipe_sparepart','gambar_sparepart', 'stokMin_sparepart', 'stokSisa_sparepart', 'hargaBeli_sparepart'];

    axios.get('http://127.0.0.1:8000/api/spareparts/tampilstokkurang')
    .then((result) => {
        console.log(result.data);
            Sparepart = result.data;
            console.log(Sparepart);

            for(let i=0; i<Sparepart.length; i++){
                // console.log(result.data[i].stokMin_sparepart);
                if(result.data[i].stokSisa_sparepart < result.data[i].stokMin_sparepart)
                {
                    // console.log(stokMin_sparepart);
                    let tr = tableSparepart.insertRow(-1);
                    let td = document.createElement('td');
                    console.log(i);

                    for(j=0;j<col.length;j++){
                        td = tr.insertCell();
                        if(j==4){
                            let img = document.createElement('img');
                            img.src = '/images/'+Sparepart[i][col[j]];
                            img.width = 150;
                            img.height = 150;
                            td.appendChild(img);
                        }else
                            td.innerHTML = Sparepart[i][col[j]];
                        console.log(j);                   
                    }
                }
        }
    }).catch((arror) => {
        console.log(error);
    });

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