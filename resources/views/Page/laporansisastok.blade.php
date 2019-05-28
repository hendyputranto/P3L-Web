<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Sisa Stock</title>
</head>
<body>
    <div id="fullcontainer">
        <div id="container">
		<img src="gambar/logosimato.png" height="170px" width="100" align="left"/>
            <div id="header">
                <p> A T M A - A U T O </p>
                <p>MOTORCYCLE SPAREPARTS AND SERVICES </p>
                <p>Jl. Babarsari No. 43 Yogyakarta 552181 </p>
                <p>Telp. (0274) 487711 </p>
                <p>http://atmaauto.com </p>
				<hr>
            </div>

            <p style="text-align: center"><strong>LAPORAN SISA STOCK</strong></p>
            <p>Tahun: <span id="tahun"></span></p>
			<p>Tipe Barang: <span id="sparepart"></span></p>
        
            <table id="tableBulan">
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center">No</th>
                        <th style="width: 120px; text-align: left">Bulan</th>
                        <th style="width: 180px; text-align: center">Sisa Stock</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <p id = "judultotal"><strong>TOTAL <span id="total"><span></strong></p>
        </div>
		
        <br>
        <div id="container2">
            <canvas id="myChart"></canvas>
        </div>
    </div>
    
	<br>
    <button onclick = "printDong()">Print</button>

    
    
    
</body>
</html>

<style>
table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
  padding: 5px;
}

table tr td:nth-child(1) {
    text-align: center;
}

table tr td:nth-child(3) {
    text-align: right;
}

#container {
    width: 430px;
    border: 3px solid black;
    border-collapse: collapse;
    padding: 10px 40px;
}

#judultotal {
    text-align: right;
}

#container2 {
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

    const urlParams = new URLSearchParams(window.location.search);    
    let tahun = null;
    let jenis = null;
    let sparepart = null;
    if(urlParams.get('tahun') !== null && urlParams.get('jenis') !== null && urlParams.get('sparepart') !== null) {
        tahun = urlParams.get('tahun');
        console.log(tahun);
        jenis = urlParams.get('jenis');
        sparepart = urlParams.get('sparepart');
    }

    console.log(sparepart);

    document.querySelector('#tahun').innerHTML = tahun;
    document.querySelector('#sparepart').innerHTML = sparepart;

    let bul = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September"
                , "Oktober", "November", "Desember"];

    let Kode = [0,0,0,0,0,0,0,0,0,0,0,0];
    let Tipe = [0,0,0,0,0,0,0,0,0,0,0,0];
    let sisa_stok = [0,0,0,0,0,0,0,0,0,0,0,0];

    let table = document.querySelector('#tableBulan tbody');
   
    let total = 0;

    axios.get('http://192.168.19.140/P3L_L_1/api/sisastok/' + sparepart + '/' + tahun)
    .then((result) => {
        let temp = result.data;
        for(let i = 0 ; i < temp.length; i++) {
            Kode[temp[i].bulan-1] = temp[i].kode_sparepart
            Tipe[temp[i].bulan-1] = temp[i].tipe_sparepart
            sisa_stok[temp[i].bulan-1] = temp[i].stokSisa_sparepart
        }

        console.log(temp);
			
        for(let j = 0; j < 12; j++) {
            total += sisa_stok[j];
        
            let tr = table.insertRow(-1);
            let td = document.createElement('td');      
            for(let k = 0; k < 3; k++){
                td = tr.insertCell();  
                if (k == 0)
                    td.innerHTML = j+1;
                else if (k == 1) 
                    td.innerHTML = bul[j];
                else if (k == 2)
                    td.innerHTML = sisa_stok[j];
            }   
        }

        document.querySelector('#total').innerHTML = total;

var canvas = document.getElementById('myChart');
var data = {
    labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September"
                , "Oktober", "November", "Desember"],
    datasets: [
        {
            label: "My First dataset",
            fill: false,
            lineTension: 0.1,
            backgroundColor: "rgba(75,192,192,0.4)",
            borderColor: "rgba(75,192,192,1)",
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0.0,
            borderJoinStyle: 'miter',
            pointBorderColor: "rgba(75,192,192,1)",
            pointBackgroundColor: "#fff",
            pointBorderWidth: 1,
            pointHoverRadius: 5,
            pointHoverBackgroundColor: "rgba(75,192,192,1)",
            pointHoverBorderColor: "rgba(220,220,220,1)",
            pointHoverBorderWidth: 2,
            pointRadius: 5,
            pointHitRadius: 10,
            data: sisa_stok,
        }
    ]
};


var option = {
	showLines: true
};
var myLineChart = Chart.Line(canvas,{
	data:data,
  options:option
});

        
    }).catch((err) => {
        
    });   

    function printDong(quality = 2) {
        window.print();
    } 

</script>