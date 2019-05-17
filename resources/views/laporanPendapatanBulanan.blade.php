<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Penjualan Jasa</title>
</head>
<body>
    <div id="fullcontainer">
        <div id="container">
            <div id="header">
                <img src="{{ asset('images/logo_atma_auto.png') }}" alt="Logo">
                <p>ATMA AUTO</p>
                <p>MOTORCYCLE SPAREPARTS AND SERVICES </p>
                <p>Jl. Babarsari No. 43 Yogyakarta 552181 </p>
                <p>Telp. (0274) 487711 </p>
                <p>http://atmaauto.com </p>
            </div>

            <hr>

            <p style="text-align: center"><strong>LAPORAN PENJUALAN JASA</strong></p>
            <p style="text-align: left">Tahun : 2019 </p>
            <p style="text-align: left">Bulan : Mei </p>
        
            <table id="tableBulan">
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center">No</th>
                        <th style="width: 150px; text-align: center">Merk</th>
                        <th style="width: 250px; text-align: center">Tipe Motor</th>
                        <th style="width: 250px; text-align: center">Nama Service</th>
                        <th style="width: 250px; text-align: center">Jumlah Penjualan</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($query as $q)
                <tr>
                    <td style="text-align: center"> {{ ++$no }} </td>
                    <td style="text-align: center"> {{ $q->MERK }} </td>
                    <td style="text-align: center"> {{ $q->TIPE }} </td>
                    <td style="text-align: center"> {{ $q->NAMAJASA }} </td>
                    <td style="text-align: center"> </td>
                    
                </tr>
                @endforeach
                </tbody>
            </table>
            <br>
            
            <p id="dicetak" style="text-align: right">dicetak tanggal <span id="datetime"></span></p>
            <script>
            var dt = new Date();
            document.getElementById("datetime").innerHTML = dt.toLocaleDateString('en-GB');
            </script>

            <div align="center">
                <input type="button" value="Cetak" class="button" onClick="PrintDoc()"/>
            </div>
            
            <script type="text/javascript">
            function PrintDoc(){
            window.print();
            }
            </script>
        </div>
        
        <br>
        <br>
        <div id="container2">
            <canvas id="myChart"></canvas>
        </div>
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
    let jenis = null;
    if(urlParams.get('jenis') !== null) {
        jenis = urlParams.get('jenis');
    }

    if(jenis === 'cetak') {
        document.querySelector('#dicetak').style.display = 'block';
        let date = new Date().getDate();
        let month = new Date().getMonth();
        let year = new Date().getFullYear();

        let bulan = bul[month];

        document.querySelector('#tanggal').innerHTML = date + ' ' + bulan + ' ' + year;
        
    } 

    let table = document.querySelector('#tableBulan tbody');

    let total1 = 0;
    let tahun = [];
    let cabang = [];

    let datas = [];
    let temp2;

    let ct = [];
    

    axios.get('/api/pendapatantahunan')
    .then((result) => {
        let temp = result.data;
        let temp2 = result.data;
        console.log(temp);

        for(let j = 0; j < temp.length; j++) {
            total1 += temp[j].total;

            if(!tahun.includes(temp[j].tahun))
                tahun.push(temp[j].tahun);
        
            let tr = table.insertRow(-1);
            let td = document.createElement('td');      
            for(let k = 0; k < 4; k++){
                td = tr.insertCell();  
                if (k == 0)
                    td.innerHTML = j+1;
                else if (k == 1) {
                    td.innerHTML = temp[j].tahun;
                } else if (k == 2) {
                    td.innerHTML = temp[j].cabang;
                } else if (k == 3)
                    td.innerHTML = temp[j].total;
            } 

            if(!cabang.includes(temp[j].cabang)) {
                let data = {};
                cabang.push(temp[j].cabang);
                data.cabang = temp[j].cabang;
                data.total = [];
                data.total.push(temp[j].total);
                datas.push(data);
            }
            
        }

        for(let i = 0; i < cabang.length; i++) {
            for(let b = 0; b < tahun.length; b++) {
                let data = {};
                data.cabang = cabang[i];
                data.tahun = tahun[b];
                ct.push(data);
            }
        }

        console.log(ct);

        for(let h = 0; h < ct.length; h++) {
            for(let a = 0; a < temp2.length; a++) {
                if(ct[h].cabang == temp2[a].cabang && ct[h].tahun == temp2[a].tahun) {
                    // console.log("ketemu"+temp2[a].total);
                    for(let z = 0; z < datas.length; z++) {
                        if(datas[z].cabang == temp2[a].cabang)
                        {
                            
                            console.log(temp2[a].total)
                            datas[z].total.push(temp2[a].total);
                            break;
                        }
                            // 
                    }
                }
                // } else if (ct[h].cabang == temp2[a].cabang && ct[h].tahun != temp2[a].tahun) {
                //     console.log("nggak ketemu");
                //     for(let z = 0; z < datas.length; z++) {
                //         if(datas[z].cabang == ct[h].cabang)
                //             datas[z].total.push(0);
                //     }
                // }
            }
                
        }
        
        console.log(cabang);
        console.log(datas);
        console.log(tahun);

        document.querySelector('#total').innerHTML = total1;

        var ctx = document.getElementById("myChart").getContext('2d');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: tahun,
                datasets: []
            },
            options: {
                legend: {
                    position: 'right'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                        beginAtZero: true
                        }
                    }]
                }
            }
        });

        datas.forEach(function(data){
            myChart.data.datasets.push({
                label: data.cabang,
                backgroundColor: '#' + (Math.random().toString(16) + "000000").substring(2,8),
                data: data.total
            });
            myChart.update();
        })
    
        if(jenis === 'cetak')
            setTimeout(printDong, 500);
        
    }).catch((err) => {
        
    });   

    function printDong(quality = 2) {
        window.print();
    } 

</script>