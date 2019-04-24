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
    <h2 align="center">Ubah Data Jasa Service</h2> 
    <table>
        <form class="form-horizontal" action="/action_page.php">
            
            <div class="form-group">
            <label class="control-label col-sm-2" for="nama_jasaService">NAMA</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nama_jasaService" placeholder="nama cabang" name="nama_jasaService">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="harga_jasaService">HARGA</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="harga_jasaService" placeholder="alamat cabang" name="harga_jasaService">
            </div>
            </div>

            <div class="form-group">
            <div class="col-sm-offset-10 col-sm-20">
                <button type="button" class="btn btn-danger" onclick="batal()">BATAL</button>
                <button type="button" class="btn btn-success" onclick="simpan()">SIMPAN</button>
            </div>
            </div>

            
        </form>
    </table>
  </div>
</div>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script>
    let b = localStorage.getItem("id_jasaService");
    let data;

    axios.get('http://127.0.0.1:8001/api/jasaService/'+b)
    .then(function (response) {
        // handle success
        data = response.data.data;
        let col = ['id_jasaService','nama_jasaService','harga_jasaService'];
        document.getElementById("nama_jasaService").value = data[col[1]];
        document.getElementById("harga_jasaService").value = data[col[2]];
        console.log(data[col[1]]);
        console.log(data);
    })
    .catch(function (error) {
        // handle error
        console.log(error);
    });
    
    function batal(obj){
            location.href = "{{ route('djasaService') }}";
    }

    function simpan(){
        let formData = new FormData; 
        let nama= document.getElementById("nama_jasaService").value;
        let harga= document.getElementById("harga_jasaService").value;
        formData.append('_method', 'PUT');
        formData.append('nama_jasaService', nama);
        formData.append('harga_jasaService', harga);
        axios.post('http://127.0.0.1:8001/api/jasaService/' + b, formData)
                .then((result) => {
                    console.log(result);
                
                    edited = false;
                }).catch((err) => {
                    console.log(err);
                });
        location.href = "{{ route('djasaService') }}";
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