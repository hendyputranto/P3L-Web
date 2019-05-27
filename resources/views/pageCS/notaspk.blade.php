<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	
    <title>Surat Perintah Kerja</title>
</head>
<body>
    <div id="fullcontainer">
        <div id="container">
		<img src="logosimato.jpg" height="170px" width="130" align="left"/>
            <div id="header">
                <p> A T M A - A U T O </p>
                <p>MOTORCYCLE SPAREPARTS AND SERVICES </p>
                <p>Jl. Babarsari No. 43 Yogyakarta 552181 </p>
                <p>Telp. (0274) 487711 </p>
                <p>http://atmaauto.com </p>
            </div>
			
			<hr>
            <p style="text-align: center"><strong>SURAT PERINTAH KERJA</strong></p>
			<hr>
			<p style="text-align: right" id="tanggal"></p>
			<p id="noTransaksi"></p>
			
			
			<div id="kiri">Cust&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:  <span id="cust"></span></div>
			<div id="kiri">CS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	: <span id="cs"></span></div>
			<div id="kiri">Telepon&nbsp;: <span id="telepon"></span></div>
			<div id="kiri">Montir&nbsp;: <span id="montir"></span></div>
			<p>Motor&nbsp;&nbsp;: <span id="motor"></span></p>
			
			<hr>
            <p style="text-align: center"><strong>SPAREPARTS</strong></p>
			<hr>
			<br>
			
			<table width="300" id="sparepart">
			<thead>
				<tr>
					<th class='center'>Kode</th>
					<th class='center'>Nama</th>
					<th class='center'>Merk</th>
					<th class='center'>Rak</th>
					<th class='center'>Jumlah</th>
				</tr>
			</thead>
			<tbody></tbody>

			</table>
			
			<br>
			<hr>
            <p style="text-align: center"><strong>SERVICES</strong></p>
			<hr>
			<br>
	
          	<table width="300" id="service">
			<thead>
				<tr>
					<th class='center'>Kode</th>
					<th class='center'>Nama</th>
					<th class='center'>Jumlah</th>
				</tr>
			</thead>
			<tbody></tbody>
			</table>
			
        </div>

    </div>
    
	<br>
</body>
</html>

<style>
table { 
	border-style:double t;
	border-collapse:transparen;
	font-family:Arial, sans-serif;
	font-size:16px;
	width:100%;
	caption-side: top;
}

hr{
	border:0.5px black solid;
}

caption, table th {
	font-weight:bold;
	padding:10px;
	border-top:1px black solid ;
	border-bottom:1px black solid;
}

caption, table td {
	padding:10px;
	border-top:1px black solid ;
	border-bottom:1px black solid;
	text-align:center; 
} 
  
caption {
	font-weight: bold;
	font-style: italic;
}

table .left {
	text-align: left ;
	padding: 7px;
}

#kiri{
	width:50%;
	height:30px;
	float:left;
}

#kanan{
	width:50%;
	height:100px;
	background-color:#0C0;
	float:right;
}


#container {
    margin: auto;
    width: 600px;
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

#fullcontainer{
    margin: auto;
}

#header {
    margin: auto;
    text-align: center;
}

img {
	margin-right: -70px;
}
</style>

<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script src="/html2canvas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

	const urlParams = new URLSearchParams(window.location.search);    
    let notrans, kendaraan;
    if(urlParams.get('notrans') !== null && urlParams.get('kendaraan') !== null) {
        notrans = urlParams.get('notrans');
		kendaraan = urlParams.get('kendaraan');
    }


    axios.get('api/getpenjualan/'+notrans)
    .then((result) => {
        let pegawai = [];
        let kasir, CS;

		
		// let tableSparepart = document.querySelector('#sparepart tbody');
		// let sparepart = 

        document.querySelector('#noTransaksi').innerHTML = result.data.id_transaksi;
        document.querySelector('#cust').innerHTML = result.data.nama_konsumen;
        document.querySelector('#telepon').innerHTML = result.data.noTelp_konsumen;
        document.querySelector('#cust').innerHTML = result.data.nama_konsumen;
        pegawai = result.data.pegawai;

        pegawai.forEach(function(rol) {
            if(rol.nama_role == "Kasir")
                kasir = rol.nama_pegawai;
            else
                CS = rol.nama_pegawai;
        });
        
        document.querySelector('#CS').innerHTML = CS;
        let tanggal = result.data.tanggal_transaksi;
        console.log(tanggal);
        let date = tanggal.substring(8, 10);
        console.log(date);
        let month = tanggal.substring(5, 7);
        let year = tanggal.substring(0, 4);
        let time = tanggal.substring(11, 16);
        document.querySelector('#tanggal').innerHTML = date + '-' + month + '-' + year + ' ' + time;
        

    }).catch((err) => {
        
    });  

    axios.get('/api/getsatukendaraan/'+kendaraan)
    .then((result) => {
        let merk = result.data[0].merk_motor;
        let tipe = result.data[0].tipe_motor;
        let noplat = result.data[0].plat_motor;
        document.querySelector('#motor').innerHTML = merk + ' ' + tipe + ' ' + noplat;
        document.querySelector('#montir').innerHTML = result.data[0].nama_pegawai;
    }).catch((err) => {
        
    });

    axios.get('/api/getdetailpenjualansparepart/'+notrans)
    .then((result) => {
		let tableSparepart = document.querySelector('#sparepart tbody');
        for(let i = 0; i < result.data.length; i++) {
            let tr = tableSparepart.insertRow(-1);
            let td = document.createElement('td'); 
            for(j = 0; j < 5; j++){
                td = tr.insertCell();  
                if(j == 0) {
					td.innerHTML = result.data[i].sparepart.kode_sparepart;
                }else if (j == 1) {
                    td.innerHTML = result.data[i].sparepart.nama_sparepart;
                } else if (j == 2) {
                    td.innerHTML = result.data[i].sparepart.merk_sparepart;
                } else if (j == 3) {
                    td.innerHTML = result.data[i].sparepart.letak_sparepart;
                } else if (j==4) {
					td.innerHTML = result.data[i].jumlahBeli_sparepart;
				}
            }
		} 
    
    }).catch((err) => {
        
    });

    axios.get('/api/getdetailpenjualanjasa/' + notrans + '/' + kendaraan)
    .then((result) => {
		
		let tableService = document.querySelector('#service tbody');
		
		for(let i = 0; i < result.data.length; i++) {
            let tr = tableService.insertRow(-1);
            let td = document.createElement('td'); 
			console.log(result.data[i])   ;  
            for(j = 0; j < 3; j++){
                td = tr.insertCell();  
                if(j == 0) {
					td.innerHTML = result.data[i].jasa_service.id_jasaService;
                }else if (j == 1) {
                    td.innerHTML = result.data[i].jasa_service.nama_jasaService;
                } else if (j == 2) {
                    td.innerHTML = result.data[i].harga_jasaService;
                } 
            }
		}

		printDong();
        
    }).catch((err) => {
        
    });

    function printDong(quality = 2) {
        window.print();
    } 

</script>