<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Pendapatan Tahunan</title>
</head>
<body>
    <div id="fullcontainer">
        <div id="container">
            <div id="header">
                <img src="gambar/logosimato.png" alt="Logo">
                <p>ATMA AUTO</p>
                <p>MOTORCYCLE SPAREPARTS AND SERVICES </p>
                <p>Jl. Babarsari No. 43 Yogyakarta 552181 </p>
                <p>Telp. (0274) 487711 </p>
                <p>http://atmaauto.com </p>
            </div>

            <hr>

            <p style="text-align: center"><strong>LAPORAN PENDAPATAN TAHUNAN</strong></p>
        
            <table id="tableBulan">
                <thead>
                    <tr>
                        <th style="width: 50px; text-align: center">No</th>
                        <th style="width: 150px; text-align: center">Tahun</th>
                        <th style="width: 250px; text-align: center">Cabang</th>
                        <th style="width: 200px; text-align: center">Total</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            <p id = "judultotal"><strong>TOTAL <span id="total"><span></strong></p>
            <br>
            <p id="dicetak" align="right" style="display: none">dicetak tanggal <span id="tanggal"></span></p>
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
    let temp;

    let ct = [];
    

    axios.get('http://192.168.19.140/P3L_L_1/api/pendapatantahunan')
    .then((result) => {
        let temp = result.data;
        let temp2 = result.data;
        console.log(temp);

        for(let j = 0; j < temp.length; j++) {
            total1 += temp[j].Total;

            if(!tahun.includes(temp[j].Tahun))
                tahun.push(temp[j].Tahun);
        
            let tr = table.insertRow(-1);
            let td = document.createElement('td');      
            for(let k = 0; k < 4; k++){
                td = tr.insertCell();  
                if (k == 0)
                    td.innerHTML = j+1;
                else if (k == 1) {
                    td.innerHTML = temp[j].Tahun;
                } else if (k == 2) {
                    td.innerHTML = temp[j].Cabang;
                } else if (k == 3)
                    td.innerHTML = temp[j].Total;
            } 

            if(!cabang.includes(temp[j].Cabang)) {
                let data = {};
                cabang.push(temp[j].Cabang);
                data.Cabang = temp[j].Cabang;
                data.Total = [];
                data.Total.push(temp[j].Total);
                datas.push(data);
            }
            
        }

        for(let i = 0; i < cabang.length; i++) {
            for(let b = 0; b < tahun.length; b++) {
                let data = {};
                data.Cabang = cabang[i];
                data.Tahun = tahun[b];
                ct.push(data);
            }
        }

        console.log(ct);

        for(let h = 0; h < ct.length; h++) {
            for(let a = 0; a < temp2.length; a++) {
                if(ct[h].Cabang == temp2[a].Cabang && ct[h].Tahun == temp2[a].Tahun) {
                    // console.log("ketemu"+temp2[a].total);
                    for(let z = 0; z < datas.length; z++) {
                        if(datas[z].Cabang == temp2[a].Cabang)
                        {
                            
                            console.log(temp2[a].Total);
                            datas[z].Total.push(temp2[a].Total);
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
                label: data.Cabang,
                backgroundColor: '#' + (Math.random().toString(16) + "000000").substring(2,8),
                data: data.Total
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