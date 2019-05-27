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
		<img src="/logoAA.ico" height="170px" width="100" align="left"/>
            <div id="header">
                <p> A T M A - A U T O </p>
                <p>MOTORCYCLE SPAREPARTS AND SERVICES </p>
                <p>Jl. Babarsari No. 43 Yogyakarta 552181 </p>
                <p>Telp. (0274) 487711 </p>
                <p>http://atmaauto.com </p>
            </div>
			
			<hr>
            <p style="text-align: center"><strong>NOTA LUNAS</strong></p>
			<hr>
			<p style="text-align: right" class="tanggal"> </p>
			<p class="noTransaksi"></p>
			
			
			<div id="kiri" >Cust&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <span id="cust"></span></div>
			<div id="kiri" >CS&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;	: <span id="kanan" class="cs"></span></div>
			<div id="kiri" >Telepon&nbsp;: <span id="telepon"></span></div>
			<div id="kiri" class="montir">Montir&nbsp;:</div>
			<br>
			<br>
            <br>
            <br>
            <br>
			<br>
			<hr>
            <p style="text-align: center"><strong>SPAREPARTS</strong></p>
			<hr>
			<br>
			
			<table width="300" id="sparepart"><thead>
				<tr>
					<th class='center'>Kode</th>
					<th class='center'>Nama</th>
					<th class='center'>Merk</th>
					<th class='center'>Harga</th>
					<th class='center'>Jumlah</th>
                    <th class='center'>Subtotal</th>
				</tr></thead>
				<tbody></tbody>

			</table>
			
			<br>
			<hr>
            <p style="text-align: center"><strong>SERVICES</strong></p>
			<hr>
			
			<table id="tableMotor">
                <tbody>
                </tbody>
            </table>
          <table width="300" id="service"><thead>
				<tr>
					<th class='center'>Kode</th>
					<th class='center'>Nama</th>
					<th class='center'>Harga</th>
                    <th class='center'>Jumlah</th>
                    <th class='center'>Subtotal</th>
				</tr></thead>
				<tbody></tbody>

			</table>
			
			<div id="Cust">
			<h3 id="Cust">Cust </h3><br><br><br><br><br><br>
			<h3 id="Cust" class="cust2"></h3>
			</div>
			
			<div id="Kasir">
			<h3 id="Kasir" >Kasir</h3><br><br><br><br><br><br>
			<h3 id="Kasir" class="kasir"></h3>
			</div>
			
			<div id="Total">
			<h3 id="Total">Sub Total <span id="subtotal"></span></h3><br>
			<h3 id="Total">Diskon <span id="diskon"></span></h3><br>
			<h3 id="Total">TOTAL <span id="total"></span></h3>
			</div>
        </div>

    </div>
    
	

    
    
    
</body>
</html>

<style>
table:not(#tableMotor) { 
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

caption, table:not(#tableMotor) th {
	font-weight:bold;
	padding:10px;
	border-top:1px black solid ;
	border-bottom:1px black solid;
}

caption, table:not(#tableMotor) td {
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
	float:right;
}


#container {
    width: 800px;
    border: 3px solid black;
    border-collapse: collapse;
    padding: 10px 40px;
	height: 1200px;
}

#judultotal {
    text-align: right;
}

#container2 {
    width: 800px;
    border: 1px solid black;
    border-collapse: collapse;
    padding: 20px;

}

#header {
    margin: auto;
    text-align: center;
}

#Cust {
	float: left;
}

#Kasir {
	margin-left: 150px;
	float: left;
}

#Total {
	float: right;
}
</style>

<script src="https://unpkg.com/jspdf@latest/dist/jspdf.min.js"></script>
<script src="/html2canvas.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>

    const urlParams = new URLSearchParams(window.location.search); 

    let notrans;
    if(urlParams.get('notrans') !== null) {
        notrans = urlParams.get('notrans');
    }

    console.log(notrans);

    axios.get('/api/getpenjualan/' + notrans)
    .then((result) => {
        let pegawai = [];
        let kasir, CS;
        console.log(result.data);

		
		// let tableSparepart = document.querySelector('#sparepart tbody');
		// let sparepart = 

        document.querySelector('.noTransaksi').innerHTML = result.data.id_transaksi;
        document.querySelector('.cust2').innerHTML = '( ' + result.data.nama_konsumen + ' )';
        document.querySelector('#telepon').innerHTML = result.data.no_telp_konsumen;
        document.querySelector('#cust').innerHTML = result.data.nama_konsumen;
        pegawai = result.data.pegawai;

        pegawai.forEach(function(rol) {
            if(rol.nama_role == "Kasir")
                kasir = rol.nama_pegawai;
            else
                CS = rol.nama_pegawai;
        });
        
        document.querySelector('.CS').innerHTML = CS;
        document.querySelector('.kasir').innerHTML = '( ' + kasir + ')';
        let tanggal = result.data.tanggal_transaksi;
        console.log(tanggal);
        let date = tanggal.substring(8, 10);
        console.log(date);
        let month = tanggal.substring(5, 7);
        let year = tanggal.substring(0, 4);
        let time = tanggal.substring(11, 16);
        document.querySelector('.tanggal').innerHTML = date + '-' + month + '-' + year + ' ' + time;
        document.querySelector('#subtotal').innerHTML = 'Rp ' + result.data.subTotal_transaksi;
        document.querySelector('#diskon').innerHTML = 'Rp ' + result.data.diskon_transaksi;
        document.querySelector('#total').innerHTML = 'Rp ' + result.data.jumlahBeli_transaksi;
        

    }).catch((err) => {
        console.log(err.response);
    });  

    axios.get('/api/getdetailpenjualansparepart/' + notrans)
    .then((result) => {
        let total = 0;

		let tableSparepart = document.querySelector('#sparepart tbody');
        for(let i = 0; i < result.data.length+1; i++) {

            if (i < result.data.length)
                total += result.data[i].subTotal_sparepart;

            let tr = tableSparepart.insertRow(-1);
            let td = document.createElement('td'); 
            for(j = 0; j < 6; j++){
                td = tr.insertCell();  
                if(j == 0 && i < result.data.length) {
					td.innerHTML = result.data[i].sparepart.kode_sparepart;
                }else if (j == 1 && i < result.data.length) {
                    td.innerHTML = result.data[i].sparepart.nama_sparepart;
                } else if (j == 2 && i < result.data.length) {
                    td.innerHTML = result.data[i].sparepart.merk_sparepart;
                } else if (j == 3 && i < result.data.length) {
                    td.innerHTML = 'Rp ' + result.data[i].sparepart.hargaJual_sparepart;
                } else if (j==4 && i < result.data.length) {
					td.innerHTML = result.data[i].jumlah_penjualan_sparepart;
				} else if (j==5 && i < result.data.length) {
					td.innerHTML = 'Rp ' + result.data[i].subTotal_sparepart;
				} else if (j==5 && i == result.data.length)
                    td.innerHTML = 'Rp ' + total;
            }
		} 
    
    }).catch((err) => {
        
    });

    axios.get('/api/getjasapertrans/' + notrans)
    .then((result) => {
        let total = 0;
        
		let tableService = document.querySelector('#service tbody');
        for(let i = 0; i < result.data.length + 1; i++) {
            console.log(result.data.length + 1);
            if (i < result.data.length)
                total += result.data[i].subtotal;

            let tr = tableService.insertRow(-1);
            let td = document.createElement('td'); 
            for(j = 0; j < 5; j++){
                console.log(i);
                td = tr.insertCell();  
                if(j == 0 && i < result.data.length) {
					td.innerHTML = result.data[i].id;
                } else if (j == 1 && i < result.data.length) {
                    td.innerHTML = result.data[i].nama;
                } else if (j == 2 && i < result.data.length) {
                    td.innerHTML = 'Rp ' + result.data[i].harga;
                } else if (j == 3 && i < result.data.length) {
                    td.innerHTML = result.data[i].jumlah;
                } else if (j == 4 && i < result.data.length) {
					td.innerHTML = 'Rp ' + result.data[i].subtotal; 
                } else if (j == 4 && i == result.data.length) {
                    console.log("test1");
                    td.innerHTML = 'Rp ' + total; 
                }
            }
		} 
    
    }).catch((err) => {
        
    });

    axios.get('/api/penjualan/tampilmontir/' + notrans)
    .then((result) => {
        console.log(result.data);
        for(let i = 0; i < result.data.length; i++) {
            let montir = document.querySelector('.montir');
            let span = document.createElement('span');
            span.setAttribute('id', 'kanan');
            let textNode = document.createTextNode(result.data[i].nama_pegawai);
            span.style.position = 'inline-block';
            span.appendChild(textNode);
            console.log(span);
            montir.appendChild(span);
            let br = document.createElement('br');
            montir.appendChild(br);
        }
    }).catch((err) => {
        
    });

    axios.get('/api/getkendaraan/' + notrans)
    .then((result) => {
        let tableMotor = document.querySelector('#tableMotor tbody');
        for(let i=0; i<result.data.length; i++){
            console.log(tableMotor);
            let merk = result.data[i].merk_motor;
            let tipe = result.data[i].tipe_motor;
            let nopol = result.data[i].plat_motor; 
            let tr = tableMotor.insertRow(-1);
            let td = document.createElement('td'); 
            td = tr.insertCell();
            console.log(tr);
            td.innerHTML = merk + ' ' + tipe + ' ' + nopol;
        }
    }).catch((err) => {
        
    });
    

    function printDong(quality = 2) {
        window.print();
    } 

</script>