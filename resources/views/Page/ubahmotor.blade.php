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
    <h2 align="center">Ubah Data Motor</h2> 
    <table>
    <form class="form-horizontal">
            <!-- <div class="form-group">
            <label class="control-label col-sm-2" for="kode_sparepart_fk">KODE SPAREPART</label>
            <div class="col-sm-10">
                <select class="form-control" id="kode_sparepart_fk" name="kode_sparepart_fk">
                    <option>--KODE SPAREPART--</option>
                </select>
            </div>
            </div> -->

            <div class="form-group">
            <label class="control-label col-sm-2" for="merk_motor">MERK MOTOR</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="merk_motor" placeholder="merk motor" name="merk_motor">
            </div>
            </div>

            <div class="form-group">
            <label class="control-label col-sm-2" for="tipe_motor">TIPE MOTOR</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="tipe_motor" placeholder="tipe motor" name="tipe_motor">
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
    // let select = document.querySelector('#kode_sparepart_fk');
    let b = localStorage.getItem("id_motor");
    let data;

    // axios.get('http://10.53.1.1:8000/api/sparepart/')
    // .then((result) => {
    //     for(let i = 0; i<result.data.data.length; i++) {
    //         let option = document.createElement('option');
    //         let txt = document.createTextNode(result.data.data[i].kode_sparepart+' ('+result.data.data[i].kode_sparepart+')');
    //         option.appendChild(txt);
    //         option.setAttribute('value', result.data.data[i].kode_sparepart);
    //         select.insertBefore(option, select.lastChild);
    //     }
    // }).catch((err) => {
    //     console.log(err);
    // });

    axios.get('http://192.168.19.140/P3L_L_1/api/motor/'+b)
    .then(function (response) {
        // handle success
        data = response.data.data;
        let col = ['id_motor','merk_motor','tipe_motor'];
        // document.getElementById("kode_sparepart_fk").value = data[col[1]];
        document.getElementById("merk_motor").value = data[col[1]];
        document.getElementById("tipe_motor").value = data[col[2]];
        console.log(data[col[1]]);
        console.log(data);
    })
    .catch(function (error) {
        // handle error
        console.log(error);
    });
    
    function batal(obj){
            location.href = "{{ route('dmotor') }}";
    }

    function simpan(){
        let formData = new FormData; 
        // let kode_sparepart= document.getElementById("kode_sparepart_fk").value;
        let merk_motor= document.getElementById("merk_motor").value;
        let tipe_motor= document.getElementById("tipe_motor").value;
        formData.append('_method', 'PUT');
        // formData.append('kode_sparepart_fk', kode_sparepart);
        formData.append('merk_motor', merk_motor);
        formData.append('tipe_motor', tipe_motor);
        axios.post('http://192.168.19.140/P3L_L_1/api/motor/' + b, formData)
                .then((result) => {
                    console.log(result);
                
                    edited = false;
                }).catch((err) => {
                    console.log(err);
                });
        location.href = "{{ route('dmotor') }}";
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

</script>
@endsection