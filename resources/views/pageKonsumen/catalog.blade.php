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
                        <th onclick="sortTable(2)">HARGA</th>
                        <th onclick="sortTable(3)">STOK</th>
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
    let col = ['kode_sparepart_fk', 'nama_sparepart', 'merk_sparepart', 'tipe_sparepart','hargaJual_sparepart','stokSisa_sparepart','gambar_sparepart'];
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
                    if(j==6){
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

    //sorting berdasarkan harga untuk konsumen
    function sortTable(n) {
        var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
        table = document.getElementById("tableSparepart");
        switching = true;
        // Set the sorting direction to ascending:
        dir = "asc"; 
        /* Make a loop that will continue until
        no switching has been done: */
        while (switching) {
                    // Start by saying: no switching is done:
                    switching = false;
                    rows = table.rows;
                    /* Loop through all table rows (except the
                    first, which contains table headers): */
                    for (i = 1; i < (rows.length - 1); i++) {
                    // Start by saying there should be no switching:
                    shouldSwitch = false;
                    /* Get the two elements you want to compare,
                    one from current row and one from the next: */
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    /* Check if the two rows should switch place,
                    based on the direction, asc or desc: */
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        // If so, mark as a switch and break the loop:
                        shouldSwitch = true;
                        break;
                }
            } else if (dir == "desc") {
                    if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch
                and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
                // Each time a switch is done, increase this count by 1:
                switchcount ++; 
                } else {
                /* If no switching has been done AND the direction is "asc",
                set the direction to "desc" and run the while loop again. */
                if (switchcount == 0 && dir == "asc") {
                    dir = "desc";
                    switching = true;
            }
            }
        }
    }
    </script>
@endsection