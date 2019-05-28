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
    <h2 align="center">Tambah Data Jasa Service</h2>
    <table>
        <form class="form-horizontal" onsubmit = "return simpan()">
            <div class="form-group">
            <label class="control-label col-sm-2" for="nama_jasaService">NAMA</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_jasaService" placeholder="nama jasa service" name="nama_jasaService">
            </div>
            </div>
            <div class="form-group">
            <label class="control-label col-sm-2" for="harga_jasaService">HARGA</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="harga_jasaService" placeholder="harga jasa service" name="harga_jasaService">
            </div>
            </div>

            <div class="form-group">
            <div class="col-sm-offset-10 col-sm-20">
                <button type="button" class="btn btn-danger" onclick="batal()">BATAL</button>
                <button type="submit" value="Submit" class="btn btn-success">SIMPAN</button>
            </div>
            </div>
        </form>
    </table>
  </div>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    function batal(obj){
            location.href = "{{ route('djasaService') }}";
    }
    function simpan(){
        let nama_jasaService = document.querySelector('#nama_jasaService').value;
        let harga_jasaService = document.querySelector('#harga_jasaService').value;
        let formData = new FormData();
        formData.append('nama_jasaService', nama_jasaService);
        formData.append('harga_jasaService', harga_jasaService);
        axios.post('http://192.168.19.140/P3L_L_1/api/jasaService', formData)
        .then((result) =>{
            console.log(result);
        })
        .catch((error) =>{
            console.log(error.response);
        });
        location.href = "{{ route('djasaService') }}";
        return false;
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
    setInputFilter(document.getElementById("harga_jasaService"), function(value) {
    return /^-?\d*$/.test(value); });
</script>
@endsection