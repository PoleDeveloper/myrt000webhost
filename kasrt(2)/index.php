<?php
//coonection and database config
include "../config/config_all.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kas Rt</title>
    <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css">
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
    <script src="../script/mobile/jquery.touchSwipe.min.js"></script>
    <script src="../script/qrcode/jquery-qrcode-0.17.0.min.js"></script>
<style>
body{
    font-family: arial;
}
.divbody{
    width: 100%;
    margin: auto;
}
.output-table{
    width: 800px;
    margin: auto;
}
.table{
    width: 95%;
    margin: auto;
    overflow: auto;
}
.divbodyinner{
    position: fixed;
    top: 0px;
    bottom: 0px;
    left: 0px;
    right: 0px;
    width: 100%;
    height: 100%;
    background-color: rgba(38, 38, 38, 0.9);
}
.form-buat{
    width: 430px;
    margin: auto;
    margin-top: 100px;
    background-color: rgb(38, 38, 38);
    padding: 20px 10px;
    border-radius: 20px;
}
.btn{
    margin: 1px;
}
#divinneroutput{
    width: 100%;
    margin: auto;
    color: white;
}
.divinnerjquery{
    width: 440px;
    margin: auto;
    margin-top: 100px;
    background-color: rgb(38, 38, 38);
    color: white;
    padding: 20px 10px;
    border-radius: 10px;
}
.form-control{
    margin-bottom: 10px;
}
.divinnerdiv{
    width: 430px;
    margin: auto;
    margin-top: 100px;
}
.div-input{
    width: 650px;
    background-color: rgb(38, 38, 38);
    padding: 10px 1 5px;
    border-radius: 20px;
}
.divtd1{
    width: 100%;
    float: left;
    text-align: right;
}
.divtd2{
    width: 100%;
    float: left;
}
.divtd3{
    width: 34%;
    float: left;
}
.divtd4{
    width: 6%;
    float: left;
    text-align: center;
}
.divtd5{
    width: 60%;
    float: left;
}
/*width*/
::-webkit-scrollbar {
  width: 14px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1;
  cursor: pointer;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #0099ff;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #007acc;
}
#divinneroutput{
    font-size: 18px;
    transition: 1s;
}
.vadtxt{
    font-size: 20px;
    transition: 1s;
}
@media screen and (max-width: 800px){
    .divbody{
        width: 100%;
    }
    .output-table{
        width: 97%;
    }
}
@media screen and (max-width: 700px){
    .div-input{
        width: 97%;
    }
    .divinnerdiv{
        width: 98%;
    }
    #divinneroutput{
        font-size: 16px;
    }
    .vadtxt{
        font-size: 16px;
    }
}
@media screen and (max-width: 500px){
    .form-buat{
        width: 97%;
    }
    .divinnerjquery{
        width: 97%;
    }
    ::-webkit-scrollbar {
        width: 6px;
    }
}
</style>
<script>
jQuery(document).ready(function($) {

if (window.history && window.history.pushState) {

  $(window).on('popstate', function() {
    var hashLocation = location.hash;
    var hashSplit = hashLocation.split("#!/");
    var hashName = hashSplit[1];

    if (hashName !== '') {
      var hash = window.location.hash;
      if (hash === '') {
          var attrcond = $(".divbodyinner").attr("attrcond");
          if(attrcond == "1"){
                closeform();
          }else if(attrcond == "eki"){
                editinnerkascancel();
          }else if(attrcond == "buk"){
                submitkascancel();
          }else{
            
          }
          /* make window back not avaliable */
          (function (global) { 

          if(typeof (global) === "undefined") {
              throw new Error("window is undefined");
          }

          var _hash = "!";
          var noBackPlease = function () {
              global.location.href += "#";

              // making sure we have the fruit available for juice (^__^)
              global.setTimeout(function () {
                  global.location.href += "!";
              }, 50);
          };

          global.onhashchange = function () {
              if (global.location.hash !== _hash) {
                  global.location.hash = _hash;
              }
          };

          global.onload = function () {            
              noBackPlease();

              // disables backspace on page except on input fields and textarea..
              document.body.onkeydown = function (e) {
                  var elm = e.target.nodeName.toLowerCase();
                  if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                      e.preventDefault();
                  }
                  // stopping event bubbling up the DOM tree..
                  e.stopPropagation();
              };          
          }

          })(window);
      }
    }
  });

  window.history.pushState('forward', null, './#forward');
}

});
</script>
</head>
<body>
<div class="divbody">
    <h1 style="text-align: center;">Kas Rt</h1></div>
    <div class="output-table">
    <div id="accountgrupnotif">

    </div>

    <div id='kashead'>

    </div>
    <script>
        $(document).ready(function(){
            getallkascount();
        });
    </script>

    <br><br>
        <table class="table table-striped" id="output">

        </table>
    <br><br><br><br>
    <?php if($status_ac == "bendahara"){ ?>
        <div class="">
            <button style="position: fixed;right: 20px;bottom: 40px;box-shadow: 0px 0px 10px #333333;" type="button" class="btn btn-dark" id="btn-click" btnaction="form-buat" onclick="openform();">Buat Baru</button>
        </div>
    <?php } ?>
</div>

</div>

<div class="divbodyinner" attrcond="0" style="display: none;overflow: auto;">
    <div id="close-divbodyinner" style="position: fixed;top: 5px;right: 17px;font-size: 30px;color: white;"><button onclick="closeform();" style="box-shadow: 3px 3px 5px black;" class="btn btn-danger">X</button></div>
    <div class="form-buat div-input" style="display: none;">
        <div style="width: 100%;text-align: right;"><a style="color: white;" id="txtinput-count"></a></div>
        <form method="post" id="form_buat">
            <input onkeyup="limitertxt();" id="kasrt-input" class="form-control" type="text" name="nama" placeholder="Nama Kas" required>
        </form>
        <div style="text-align: right;"><button id="btn-buat" class="btn btn-success">Buat</button></div>
    </div>
    <script>
        var maxinputtxt = 40;
        function limitertxt(){
            var inputtxtget = $("#kasrt-input").val();
            var countinputtxt = inputtxtget.length;
            if(countinputtxt > maxinputtxt){
                inputtxtget = inputtxtget.substring(0, maxinputtxt);
                $("#kasrt-input").val(inputtxtget);
                return false;
            }
            if(countinputtxt == maxinputtxt){
                $("#txtinput-count").html("Maksimal "+maxinputtxt+" Karakter");
            }else{
                $("#txtinput-count").html(countinputtxt+" - "+maxinputtxt);
            }
        }
        function limitertxt2(){
            var inputtxtget = $("#inputtitlekas").val();
            var countinputtxt = inputtxtget.length;
            if(countinputtxt > maxinputtxt){
                inputtxtget = inputtxtget.substring(0, maxinputtxt);
                $("#inputtitlekas").val(inputtxtget);
                $("#inputtitlekas").css({"border-color":"red"});
                alert("Maksimal 40 Karakter");
            }
        }
    </script>
    <div class="divinnerdiv" style="display: none;">
        <?php if($status_ac == "bendahara"){ ?>
            <button style="position: fixed;right: 20px;bottom: 40px;" id="btn-buat-kas" kascode="" class="btn btn-success">Tambah</button>
        <?php } ?>
        <table style="margin-bottom: 100px;" class="table table-dark" id="divinneroutput">

        </table>
    </div>
    <div class="divinnerkas divinnerjquery" kascode="" style="display: none;">
        <div><button onclick="submitkascancel();" class="btn btn-default">Kembali</button></div><br><br>
        <input onkeyup="limitertxt3();" id="inputkas_keperluan" type="text" class="form-control" placeholder="Keperluan / Kegiatan">
        Isi Salah Satu
        <input onkeyup="limitertxt4();" id="inputkas_pemasukan" type="text" class="form-control" placeholder="Pemasukan (Optional)">
        <input onkeyup="limitertxt5();" id="inputkas_pengeluaran" type="text" class="form-control" placeholder="Pengeluaran (Optional)">
        <label>Tanggal :</label> <input id="inputkas_tanggal" type="date" style="width: 150px;">
        <div style="text-align: right;"><button onclick="submitkascancel();" class="btn btn-danger">Batal</button> <button id="submit-kas" kascode="" class="btn btn-success">Simpan</button></div>
    </div>
    <div class="editinnerkas divinnerjquery" style="display: none;">
        <input onkeyup="limitertxt3();" id="editkas_keperluan" type="text" class="form-control" placeholder="Keperluan / Kegiatan"><br>
        Isi Salah Satu<br><br>
        Pemasukan :
        <input onkeyup="limitertxt4();" id="editkas_pemasukan" type="text" class="form-control" placeholder="Pemasukan (Optional)">
        Pengeluaran :
        <input onkeyup="limitertxt5();" id="editkas_pengeluaran" type="text" class="form-control" placeholder="Pengeluaran (Optional)"><br>
        <label>Tanggal :</label> <input id="editkas_tanggal" type="date" style="width: 150px;">
        <div style="text-align: right;"><button onclick="editinnerkascancel();" class="btn btn-danger">Batal</button> 
                                        </button><button id="edit-inner-kas" kasinner_code="" kascode="" class="btn btn-success">Simpan</button></div>
    </div>
    <script>
        function limitertxt3(){
            var inputtxtget = $("#inputkas_keperluan").val();
            var whac = "0";
            if(inputtxtget == ""){
                var inputtxtget = $("#editkas_keperluan").val();
                var whac = "1";
            }
            var countinputtxt = inputtxtget.length;
            if(countinputtxt > 30){
                inputtxtget = inputtxtget.substring(0, 30);
                if(whac == "1"){
                    $("#editkas_keperluan").val(inputtxtget);
                }else if(whac == "0"){
                    $("#inputkas_keperluan").val(inputtxtget);
                }
                alert("Maksimal 30 Karakter");
                return false;
            }
        }
        function limitertxt4(){
            var inputtxtget = $("#inputkas_pemasukan").val();
            var whac = "0";
            if(inputtxtget == ""){
                var inputtxtget = $("#editkas_pemasukan").val();
                var whac = "1";
            }
            var countinputtxt = inputtxtget.length;
            if(countinputtxt > 10){
                inputtxtget = inputtxtget.substring(0, 10);
                if(whac == "0"){
                    $("#inputkas_pemasukan").val(inputtxtget);
                }else if(whac == "1"){
                    $("#editkas_pemasukan").val(inputtxtget);
                }
                alert("Maksimal 10 Karakter");
                return false;
            }
        }
        function limitertxt5(){
            var inputtxtget = $("#inputkas_pengeluaran").val();
            var whac = "0";
            if(inputtxtget == ""){
                var inputtxtget = $("#editkas_pengeluaran").val();
                var whac = "1";
            }
            var countinputtxt = inputtxtget.length;
            if(countinputtxt > 10){
                inputtxtget = inputtxtget.substring(0, 10);
                if(whac == "0"){
                    $("#inputkas_pengeluaran").val(inputtxtget);
                }else if(whac == "1"){
                    $("#editkas_pengeluaran").val(inputtxtget);
                }
                alert("Maksimal 10 Karakter");
                return false;
            }
        }
    </script>
    <div class="divdownload divinnerjquery" style="display: none;">
            <div class="divdownloadas">

            </div>
    </div>
    <!-- use this for default -->
    <div class="divshare divinnerjquery" style="display: none;">
        
    </div>
</div>


<div id="notification" class="bg-success" style="position: fixed;margin: auto;width: 250px;height: 100px;top: 0px;left: 0px;right: 0px;bottom: 0px;padding: 35px 0px;text-align: center;font-size: 20px;border-radius: 20px;z-index: 3;display: none;color: white;">

</div>

<script>
$(document).ready(function(){
    $("#notification").empty().html("Loading").fadeIn();
    grup_code = "<?php echo $grup_code_ac; ?>";
    $.ajax({
        url:"getdata.php",
        type:"POST",
        data:{
            grup_code:grup_code,
        },
        dataType:"text",
        success:function(data){
            $("#notification").empty().fadeOut();
            $("#output").append(data);
        }
    });

    function getdata(){
        grup_code = "<?php echo $grup_code_ac; ?>";
        $("#notification").empty().html("Loading").fadeIn();
        $.ajax({
            url:"getdata.php",
            type:"POST",
            data:{
                grup_code:grup_code,
            },
            dataType:"text",
            success:function(data){
                $("#output").empty().append(data);
                $("#notification").empty().html("Loading Complete").fadeOut();
            }
        });
    }

    $(document).on("click", "#btn-click", function(){
        var action = $(this).attr("btnaction");
        if(action == "form-buat"){
            $(".form-buat").fadeIn("slow");
        }else{
            $(".form-buat").fadeOut();
            $(".divinnerdiv").fadeOut();
            $(".divinnerkas").fadeOut();
            $(".editinnerkas").fadeOut();
            $(".divdownload").fadeOut();
            $(".divshare").fadeOut();
        }
    });

    /* buat kas header (judul) */
    $(document).on("click", "#btn-buat", function(){
        var data = $("#form_buat").serializeArray();
        $.each(data, function(i, field){
            if(field.value == ""){

            }else{
                $("#btn-buat").html("Loading..");
                $.ajax({
                    type:"post",
                    url:"action.php",
                    data:data,
                    dataType:"text",
                    success:function(data){
                    $("#btn-buat").html("Buat");
                    $("#notification").empty().append(data).fadeIn("1000").delay("1500").fadeOut("slow");
                    closeform();
                    $(".form-buat").fadeOut();
                    $("#form_buat")[0].reset();
                    $(document).ready(function() {
                        getdata();
                        qupdate();
                    });
                }
                });
            }
        });
    });

    /* data delete*/
    $(document).on("click", "#headerdelete", function(){
        var headerdelete = $(this).attr("headerdeletedata");
        $(this).html("loading");
        $.ajax({
            type:"post",
            url:"action.php",
            data:{headerdelete:headerdelete},
            dataType:"text",
            success:function(data){
                $("#notification").empty();
                $("#notification").append(data);
                $("#notification").fadeIn().delay("700").fadeOut("slow");
                $(document).ready(function(){
                    getdata();
                    qupdate();
                });
            }
        });
    });

    /* read kas inner*/
    $(document).on("click", "#readkas", function(){
        var kascode = $(this).attr("kascode");
        $("#btn-buat-kas").fadeIn();
        $("#notification").html("Loading").fadeIn("1000");
        $.ajax({
            method:"post",
            url:"getdata2.php",
            data:{kascode:kascode},
            dataType:"text",
            success:function(data){
                $("#notification").html("Loading Complete").delay("700").fadeOut();
                $("#divinneroutput").empty().append(data).fadeIn();
                openform();
                $(".divinnerdiv").delay("700").fadeIn();
                $("#btn-buat-kas").attr("kascode", kascode);
            }
        });
    });

    $(document).on("click", "#btn-buat-kas", function(){
        $(".divbodyinner").attr("attrcond", "buk");
        var kascode = $(this).attr("kascode");
        $("#divinneroutput").fadeOut();
        $("#btn-buat-kas").fadeOut();
        $(".divinnerkas").delay("700").fadeIn();
        $("#submit-kas").attr("kascode", kascode);
        $(".divinnerkas").attr("kascode", kascode);
    });

    //download pdf
    $(document).on("click", "#download", function(){
        var kascode = $(this).attr("kascode");
        $(".divdownload").delay("700").fadeIn();
        openform();
        $.ajax({
            method:"post",
            url:"save.php",
            data:{
                kascode:kascode,
            },
            dataType:"text",
            success:function(data){
                $(".divdownload").empty().append(data);
            }
        });
    });

    /* simpan kas inner */
    $(document).on("click", "#submit-kas", function(){
        var keperluan = $("#inputkas_keperluan").val();
        var pengeluaran = $("#inputkas_pengeluaran").val();
        var pemasukan = $("#inputkas_pemasukan").val();
        var tanggal = $("#inputkas_tanggal").val();
        var kascode = $(this).attr("kascode");
        $("#notification").empty().html("loading").fadeIn();
        if(keperluan == ""){
            $("#notification").fadeIn().html("keperluan Kosong").delay("1000").fadeOut();
        }else{
            $.ajax({
                type:"post",
                url:"action.php",
                data:{
                    keperluan:keperluan,
                    pengeluaran:pengeluaran,
                    pemasukan:pemasukan,
                    tanggal:tanggal,
                    kascode:kascode,
                    inputkasinner:"ya",
                },
                dataType:"text",
                success:function(data){
                    $("#notification").fadeIn().html(data).delay("700").fadeOut();
                    emptyval();
                }
            });
        }
    });
    /* hapus kas inner */
    $(document).on("click", "#hapus-kas-inner", function(){
        var kasinnercode = $(this).attr("kasinnercode");
        var kascode = $(this).attr("kascode");
        $("#notification").empty().html("loading").fadeIn();
        $.ajax({
            type:"post",
            url:"action.php",
            data:{
                kasinnercode:kasinnercode,
                kasinnerdelete:"ya",
            },
            dataType:"text",
            success:function(){
                $.ajax({
                    method:"post",
                    url:"getdata2.php",
                    data:{kascode:kascode},
                    dataType:"text",
                    success:function(data){
                        $("#notification").empty().html("Berhasil").delay("700").fadeOut();
                        $("#divinneroutput").empty().append(data);
                    }
                });
            }
        });
    });

    /* edit kas inner */
    $(document).on("click", "#btn-titlekas-edit", function(){
        $("#tdtitlekas").fadeOut("1000").empty();
        var kascode = $(this).attr("kascode");
        var titlekas = $(this).attr("titlekas");
        $("#btn-simpantitlekas").attr("kascode", kascode);
        $("#inputtitlekas").val(titlekas);
        $("#tdformtitlekas").fadeIn("1000");
    });
    $(document).on("click", "#btn-simpantitlekas", function(){
        var kascode = $(this).attr("kascode");
        var titlekas = $("#inputtitlekas").val();
        $.ajax({
            method:'post',
            url:'action.php',
            data:{
                titlekas:titlekas,
                kascode:kascode
            },
            dataType:"text",
            success:function(data){
                $("#notification").empty().html("Berhasil").fadeIn().delay("700").fadeOut();
                emptyval();
                $.ajax({
                    method:"post",
                    url:"getdata2.php",
                    data:{kascode:kascode},
                    dataType:"text",
                    success:function(data){
                        $("#divinneroutput").delay("700").fadeIn().empty().append(data);
                    }
                });
            }
        });
    });
    $(document).on("click", "#btn-edit-kas-inner", function(){
        $(".divbodyinner").attr("attrcond", "eki");
        var editkas_keperluan = $(this).attr("editkas_keperluan");
        var editkas_pemasukan = $(this).attr("editkas_pemasukan");
        var editkas_pengeluaran = $(this).attr("editkas_pengeluaran");
        var editkas_tanggal = $(this).attr("editkas_tanggal");
        var kasinner_code = $(this).attr("kasinner_code");
        var kascode = $(this).attr("kascode");
        $("#edit-inner-kas").attr("kasinner_code", kasinner_code).attr("kascode", kascode);
        $("#editkas_keperluan").val(editkas_keperluan);
        $("#editkas_pemasukan").val(editkas_pemasukan);
        $("#editkas_pengeluaran").val(editkas_pengeluaran);
        $("#editkas_tanggal").val(editkas_tanggal);
        $("#divinneroutput").fadeOut();
        $("#btn-buat-kas").fadeOut();
        $(".editinnerkas").delay("700").fadeIn();
    });
    $(document).on("click", "#edit-inner-kas", function(){
        var keperluan = $("#editkas_keperluan").val();
        var pemasukan = $("#editkas_pemasukan").val();
        var pengeluaran = $("#editkas_pengeluaran").val();
        var tanggal = $("#editkas_tanggal").val();
        var kasinner_code = $("#edit-inner-kas").attr("kasinner_code");
        var kascode = $(this).attr("kascode");
        $("#notification").empty().html("Loading").fadeIn();
        $.ajax({
            method:"post",
            url:"action.php",
            data:{
                keperluan:keperluan,
                pemasukan:pemasukan,
                pengeluaran:pengeluaran,
                tanggal:tanggal,
                kasinner_code:kasinner_code,
                editkasinner:"ya",
            },
            dataType:"text",
            success:function(data){
                $("#btn-buat-kas").fadeIn();
                $(".editinnerkas").fadeOut();
                $("#notification").empty().html("Berhasil").fadeIn().delay("700").fadeOut();
                emptyval();
                $.ajax({
                    method:"post",
                    url:"getdata2.php",
                    data:{kascode:kascode},
                    dataType:"text",
                    success:function(data){
                        $("#divinneroutput").delay("700").fadeIn().empty().append(data);
                    }
                });
            }
        });
    });
    $(document).on("click", "#kasvalidation", function(){
        var action = $(this).attr("dataaction");
        var kascode = $(this).attr("kascode");
        $(this).html("Loading");
        $.ajax({
            method:"post",
            url:"action.php",
            data:{
                kasvalidation:action,
                kascode:kascode
            },
            dataType:"text",
            success:function(){
                $("#notification").empty().html("Berhasil").fadeIn().delay("700").fadeOut();
                closeform();
                $("#divinneroutput").empty();
                getdata();
            }
        });
    });

});
$(document).on("click", "#sharekas", function(){
    var kascode = $(this).attr("kascode");
    $("#notification").empty().html("loading").fadeIn();
    $.ajax({
        method:"post",
        url:"share.php",
        data:{kascode:kascode},
        dataType:"text",
        success:function(data){
            $("#notification").html("Loading Complete").delay("700").fadeOut();
            openform();
            $(".divshare").html(data).fadeIn();
        }
    });
});
// auto update data
$(document).ready(function(){
    qupdate();
});
function qupdate(){
    $.ajax({
        url:"update.php",
        dataType:"text",
        success:function(data){
            $("#accountgrupnotif").empty().html(data);
        }
    });
}
function openform(){
    $(".divbodyinner").attr("attrcond", "1");
    $(".divbodyinner").fadeIn();
}
function closeform(){
    var action = $(this).attr("btnaction");
    if(action == "form-buat"){
        $(".form-buat").fadeIn("slow");
    }else{
        $(".form-buat").fadeOut();
        $(".divinnerdiv").fadeOut();
        $(".divinnerkas").fadeOut();
        $(".editinnerkas").fadeOut();
        $(".divdownload").fadeOut();
        $(".divshare").fadeOut();
    }
    $(".divbodyinner").delay("500").fadeOut();
    $(".divshare").delay("500").fadeOut().html("");
    $(".divbodyinner").attr("attrcond", "0");
    getallkascount();
}
function emptyval(){
    $("#inputkas_keperluan").val("");
    $("#inputkas_pengeluaran").val("");
    $("#inputkas_pemasukan").val("");
    $("#inputkas_tanggal").val("");
    $("#editkas_keperluan").val("");
    $("#editkas_pemasukan").val("");
    $("#editkas_pengeluaran").val("");
    $("#editkas_tanggal").val("");
}
function submitkascancel(){
    $(".divbodyinner").attr("attrcond", "1");
    var kascode = $(".divinnerkas").attr("kascode");
    $(".divinnerkas").fadeOut();
    $.ajax({
        method:"post",
        url:"getdata2.php",
        data:{
            kascode:kascode,
        },
        dataType:"text",
        success:function(data){
            $("#divinneroutput").empty().append(data).delay("700").fadeIn();
            $("#btn-buat-kas").delay().fadeIn();
        }
    });
}
function editinnerkascancel(){
    $(".divbodyinner").attr("attrcond", "1");
    $("#btn-buat-kas").fadeIn();
    $(".editinnerkas").fadeOut();
    $("#divinneroutput").delay("700").fadeIn();
    $(document).ready(function(){
        emptyval();
    });
}
function getallkascount(){
    $.ajax({
        method:"post",
        url:"getallkas.php",
        dataType:"text",
        success:function(data){
            $("#kashead").html(data);
        }
    });
}
</script>
</body>
</html>