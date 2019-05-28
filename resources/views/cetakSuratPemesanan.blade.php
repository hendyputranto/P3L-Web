<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	
    <title>Struk Pengadaan Sparepart</title>
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
            <p style="text-align: center"><strong>SURAT PEMESANAN</strong></p>
			<div class="description-section">
			<div class="date-section">
				<table>
					<tbody>
						<tr>
							<th>No:</th>
							<td></td>
						</tr>
						<tr>
							<th>Tanggal:</th>
							<td><span id="datetime"></span></td>
							<script>
							var dt = new Date();
							var options = { year: 'numeric', month: 'long', day: 'numeric' };
							document.getElementById("datetime").innerHTML = dt.toLocaleDateString('en-GB', options);
							</script>
						</tr>
					</tbody>
				</table>
			</div>


      <div class="consignee-section">
				Kepada Yth:
				<p class="nama_supplier"></p>
				<p class="alamat_supplier"></p>
				<p class="noTelp_supplier"></p>
				
			</div>
    </div>

		<div class="table-section" id="tableData">
			<h4>Mohon disediakan barang - barang berikut:</h4>
			<table>
				<thead>
					<tr>
						<th>No</th>
						<th>Nama Barang</th>
						<th>Merk</th>
						<th>Tipe Barang</th>
						<th>Satuan</th>
						<th>Jumlah</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>

		<div class="signature-section">
			<div>
				Hormat Kami,
			</div>
			<div>
				(Philips Purnomo)
			</div>
		</div>

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

#header {
    margin: auto;
    text-align: center;
}

	.description-section h3 {
		text-align: center;
	}
	.description-section .date-section {
		float: right;
	}
	.description-section .date-section tbody tr {
		text-align: left;
	}
	.description-section .consignee-section {
		border: 1px dashed black;
		line-height: 20px;
		padding: 5px 0px 5px 10px;
		width: 250px;
	}
	.table-section table {
		width: 100%;
		text-align: left;
		border: 0.2px solid black;
		border-collapse: collapse;
	}
	.table-section table thead tr th {
		border: 0.2px solid black;
	}
	.table-section table tbody tr td {
		border: 0.2px solid black;
	}
	.signature-section {
		float: right;
		margin-top: 10px;
		line-height: 100px;
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
	let b = localStorage.getItem("id_pengadaan");
    let table = document.querySelector('#tableData tbody');

    let total1 = 0;
    let bulan = [];
    let nama = [];
    let merk = [];
    let tipe = [];
    let satuan = [];
    let total = [];
    let datas = [];

    let ct = [];
    

    axios.get('/api/cetakSuratPemesanan/' + b)
    .then((result) => {
        let temp = result.data;
        console.log(temp);
		document.querySelector('.nama_supplier').innerHTML = temp[0].Nama_Supplier;
		document.querySelector('.alamat_supplier').innerHTML = temp[0].Alamat;
		document.querySelector('.noTelp_supplier').innerHTML = temp[0].NoTelp;
        for(let i = 0 ; i < temp.length; i++) {
            //bul[i] = temp[i].bulan;
            nama[i] = temp[i].Nama_Barang;
            merk[i] = temp[i].Merk;
            tipe[i] = temp[i].Tipe;
            satuan[i] = temp[i].Satuan;
            total[i] = temp[i].Jumlah;
        }

        for(let j = 0; j < temp.length; j++) {
            total1 += temp[j].Jumlah;
        
            let tr = table.insertRow(-1);
            let td = document.createElement('td');      
            for(let k = 0; k < 6; k++){
                td = tr.insertCell();  
                if (k == 0)
                    td.innerHTML = j+1;
                else if (k == 1) {
                    td.innerHTML = nama[j];
                } else if (k == 2) {
                    td.innerHTML = merk[j];
                } else if (k == 3) {
                    td.innerHTML = tipe[j];
                } else if (k == 4){
                    td.innerHTML = satuan[j];
                } else if (k == 5){
                    td.innerHTML = total[j];
                }
            } 
            
        }

        console.log(ct);

        document.querySelector('#total').innerHTML = total1;
        
    }).catch((err) => {
        
    });   


</script>