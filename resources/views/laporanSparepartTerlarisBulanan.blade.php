<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Sparepart Terlaris</title>
</head>
<body>
    <div id="fullcontainer">
        <div id="container">
            <div id="header">
                <img src="{{asset('images/logo_atma_auto.png')}}" alt="Logo">
                <p>ATMA AUTO</p>
                <p>MOTORCYCLE SPAREPARTS AND SERVICES </p>
                <p>Jl. Babarsari No. 43 Yogyakarta 552181 </p>
                <p>Telp. (0274) 487711 </p>
                <p>http://atmaauto.com </p>
            </div>

            <hr>

            <p style="text-align: center"><strong>LAPORAN SPAREPART TERLARIS</strong></p>
        
            <table id="tableBulan">
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center">No</th>
                        <th style="width: 150px; text-align: center">Bulan</th>
                        <th style="width: 250px; text-align: center">Nama Barang</th>
                        <th style="width: 250px; text-align: center">Tipe Barang</th>
                        <th style="width: 200px; text-align: center">Jumlah Penjualan</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            
            <br>
            <p id="dicetak" style="text-align: right">dicetak tanggal <span id="datetime"></span></p>
            <script>
            var dt = new Date();
            var options = { year: 'numeric', month: 'long', day: 'numeric' };
            document.getElementById("datetime").innerHTML = dt.toLocaleDateString('en-GB', options);
            </script>

            <div align="center">
                <input id="cetak" type="button" value="Cetak" class="button" onClick="PrintDoc()"/>
            </div>
            
            <script type="text/javascript">
            function PrintDoc(){
            document.querySelector('#cetak').style.display = 'none';
            window.print();
            }
            </script>
        </div>
        <br>
        <br>
        <!-- <div id="container2">
            <canvas id="myChart"></canvas>
        </div> -->
    </div>

</body>
</html>

<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px;
}

img {
    float: left;
    width: 150px;
    height: 150px;
    margin-left: 0px;
    margin-right: -70px;
}

#container {
    margin: auto;
    width: 650px;
    border: 3px solid black;
    border-collapse: collapse;
    padding: 10px 40px;
}

#judultotal {
    text-align: right;
}

#container2 {
    margin: auto;
    width: 600px;
    border: 1px solid black;
    border-collapse: collapse;
    padding: 20px;

}

#header {
    margin: auto;
    text-align: center;
}
</style>

<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script src="/html2canvas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>


    let bul = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September"
                , "Oktober", "November", "Desember"];

    const urlParams = new URLSearchParams(window.location.search);   

    let table = document.querySelector('#tableBulan tbody');

    let total1 = 0;
    let bulan = [];
    let nama = [];
    let tipe = [];
    let jumlah = [];
    let datas = [];

    let ct = [];
    

    axios.get('/api/sparepartTerlaris')
    .then((result) => {
        let temp = result.data;
        console.log(temp);

        for(let i = 0 ; i < temp.length; i++) {
            //bul[i] = temp[i].bulan;
            nama[i] = temp[i].Nama;
            tipe[i] = temp[i].Tipe;
            jumlah[i] = temp[i].Total;
        }

        for(let j = 0; j < temp.length; j++) {
        
            let tr = table.insertRow(-1);
            let td = document.createElement('td');      
            for(let k = 0; k < 5; k++){
                td = tr.insertCell();  
                if (k == 0)
                    td.innerHTML = j+1;
                else if (k == 1) {
                    td.innerHTML = bul[j];
                } else if (k == 2) {
                    td.innerHTML = nama[j];
                } else if (k == 3) {
                    td.innerHTML = tipe[j];
                } else if (k == 4)
                    td.innerHTML = jumlah[j];
            } 
            
        }

        console.log(ct);

        // var ctx = document.getElementById("myChart").getContext('2d');

        // var myChart = new Chart(ctx, {
        //     type: 'bar',
        //     data: {
        //         labels: bul,
        //         datasets: [{
        //             label: "Service",
        //             backgroundColor: "blue",
        //             data: service
        //         }, {
        //             label: "Spareparts",
        //             backgroundColor: "red",
        //             data: sparepart,
        //         }, {
        //             label: "Total",
        //             backgroundColor: "grey",
        //             data: total
        //         }]
        //     },
        //     options: {
        //         legend: {
        //             position: 'right'
        //         },
        //         scales: {
        //             yAxes: [{
        //                 ticks: {
        //                 beginAtZero: true
        //                 }
        //             }]
        //         }
        //     }
        // });

        // datas.forEach(function(data){
        //     myChart.data.spareparts.push({
        //         label: data.Bulan,
        //         backgroundColor: '#' + (Math.random().toString(16) + "000000").substring(2,8),
        //         data: data.Spareparts
        //     });
        //     myChart.update();
        // })
    
        if(jenis === 'cetak')
            setTimeout(printDong, 500);
        
    }).catch((err) => {
        
    });   

    function printDong(quality = 2) {
        window.print();
    } 

</script>