@extends('master.layout')
@section('content')
<style>
    .kotak {
        width: 100%;
        padding: 10px;
        border: 5px solid gray;
        margin: 0;
        background-color:#FFFFFF;
    }

    h2 {
        font-size: 40px;
    }
</style>    
<div class="container">
  <div class="kotak">
    <h2 align="center">Ubah Data Supplier</h2> 
    <table>
        <form class="form-horizontal" action="/action_page.php">
            
            <div class="form-group">
            <label class="control-label col-sm-2" for="nama_supplier">NAMA SUPPLIER</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_supplier" placeholder="nama supplier" name="nama_supplier">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="noTelp_supplier">NO TELP SUPPLIER</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="noTelp_supplier" placeholder="no telp supplier" name="noTelp_supplier">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="alamat_supplier">ALAMAT SUPPLIER</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="alamat_supplier" placeholder="alamat supplier" name="alamat_supplier">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="nama_sales">NAMA SALES</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_sales" placeholder="nama sales" name="nama_sales">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="noTelp_sales">NO TELP SALES</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="noTelp_sales" placeholder="no telp sales" name="noTelp_sales">
            </div>
            </div>


            <div class="form-group">
            <div class="col-sm-offset-10 col-sm-20">
                <button type="button" class="btn btn-danger" onclick="batal()">BATAL</button>
                <button id="btnSave" type="button" class="btn btn-success" onclick="simpan()">SIMPAN</button>
            </div>
            </div>

            
        </form>
    </table>
  </div>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    let b = localStorage.getItem("id_supplier");
    let data;

    axios.get('http://127.0.0.1:8000/api/supplier/'+b)
    .then(function (response) {
        // handle success
        data = response.data.data;
        let col = ['id_supplier','nama_supplier','noTelp_supplier','alamat_supplier','nama_sales','noTelp_sales'];
        document.getElementById("nama_supplier").value = data[col[1]];
        document.getElementById("noTelp_supplier").value = data[col[2]];
        document.getElementById("alamat_supplier").value = data[col[3]];
        document.getElementById("nama_sales").value = data[col[4]];
        document.getElementById("noTelp_sales").value = data[col[5]];
        console.log(data[col[1]]);
        console.log(data);
    })
    .catch(function (error) {
        // handle error
        console.log(error);
    });
    
    function batal(obj){
        location.href = "{{ url('/supplier')}}";
    }

    function simpan(){
        let formData = new FormData; 
        let nama_supplier= document.getElementById("nama_supplier").value;
        let noTelp_supplier= document.getElementById("noTelp_supplier").value;
        let alamat_supplier= document.getElementById("alamat_supplier").value;
        let nama_sales= document.getElementById("nama_sales").value;
        let noTelp_sales= document.getElementById("noTelp_sales").value;
        formData.append('_method', 'PUT');
        formData.append('nama_supplier', nama_supplier);
        formData.append('noTelp_supplier', noTelp_supplier);
        formData.append('alamat_supplier', alamat_supplier);
        formData.append('nama_sales', nama_sales);
        formData.append('noTelp_sales', noTelp_sales);
        axios.post('http://127.0.0.1:8000/api/supplier/' + b, formData)
                .then((result) => {
                    console.log(result);
                
                    edited = false;
                }).catch((err) => {
                    console.log(err);
                });
                location.href = "{{ url('/supplier')}}";
    }

    function setInputFilter(textbox, inputFilter) {
        ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
            textbox.addEventListener(event, function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            }
            });
        });
    }

    // Install input filters.
    setInputFilter(document.getElementById("noTelp_supplier"), function(value) {
    return /^-?\d*$/.test(value); });
    setInputFilter(document.getElementById("noTelp_sales"), function(value) {
    return /^-?\d*$/.test(value); });
</script>
@endsection