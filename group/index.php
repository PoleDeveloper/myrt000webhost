<?php
include "../config/config_all.php";
include "../detect_used_browser.php";

if(isset($_SESSION['myrt4session']) && $_SESSION['myrt4session'] === true){

}else{
    header("Location: ../login-or-signup/");
}
if(!empty($status_ac) AND !empty($grup_code_ac)){
    header("Location: ../");
}else if(!empty($status_ac) AND empty($grup_code_ac)){

}

if(empty($status_ac) && empty($grup_code_ac)){
    $page1_dispay = "display: block;";
    $page2_display = "display: none";
    $page3_display = "display: none";
}else if(!empty($status_ac) && empty($grup_code_ac)){
    if($status_ac == "ketua"){
        $page1_display = "display: none;";
        $page2_display = "display: block;";
        $page3_display = "display: none";
    }else{
        $page1_display = "display: none;";
        $page2_display = "display: none;";
        $page3_display = "display: block;";
    }
}else if(!empty($status_ac) && !empty($grup_code_ac)){
    header("Location: ../");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- important script s -->
    <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css">
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../script/transition/transition.css"/>
    <link rel="stylesheet" type="text/css" href="../script/loading/loading.css"/>
    <!-- important script e -->
    <?php if($display_mode_ac == "light"){ ?>
        <link rel="stylesheet" type="text/css" href="light.css"/>
    <?php }else if($display_mode_ac == "dark"){ ?>
        <link rel="stylesheet" type="text/css" href="dark.css"/>
    <?php } ?>
    <?php if($display_mode_ac == "light"){ ?>
        <link rel="stylesheet" type="text/css" href="../script/our.css"/>
    <?php }else if($display_mode_ac == "dark"){ ?>
        <link rel="stylesheet" type="text/css" href="../script/darkour.css"/>
    <?php } ?>
    <title></title>
</head>
<body>
    <!-- loading full page -->
    <?php include "../script/full-page-load/loading1.html" ?>
    <?php include "../script/full-page-load/loading2.html" ?>
    <?php include "../script/form-full-page/form1.html" ?>
    <!-- error notif -->
    <?php include "../script/notif-page/notif1.html" ?>

    <script>
        $(document).ready(function(){
            $("#full-page-load-1").addClass("ld-zoom-out").delay(250).fadeOut();
        });
    </script>
    
    <div class="divbody">
        <div id="page1" class="ld" style="<?php echo $page1_display; ?>">
            <h3 style="text-align: center;">Selamat Datang<br>Pengguna Baru</h3>
            <br><br>
            <div style="text-align: center;">
                Anda Ingin Masuk Sebagai
            </div>
            <div style="width: 250px;margin: auto;">
                <button id="ketua" onclick="addpage1('ketua');" class="btnq btn btn-primary">Ketua Rt</button>
                <button id="sekretaris" onclick="addpage1('sekretaris');" class="btnq btn btn-primary">Sekretaris</button>
                <button id="bendahara" onclick="addpage1('bendahara');" class="btnq btn btn-primary">Bendahara</button>
                <button id="warga" onclick="addpage1('warga');" class="btnq btn btn-primary">Warga</button>
            </div>
            <br>
            <div style="text-align: right;cursor: pointer;margin: 0px 9px;"><button onclick="lewats();" class="btn btn-link">Lewati &rightarrow;</button></div>
        </div>
        <script>
            function addpage1(position){
                $("#full-page-load-2").fadeIn();
                $.ajax({
                    url:"position.php",
                    method:"post",
                    data:{position:position},
                    dataType:"text",
                    success:function(data){
                        $("#full-page-load-2").fadeOut();
                        if(data === "error"){
                            errordiv1s("ERROR",'Maaf Terjadi Kesalahan, Halaman Akan Di Reload dalam', "5", 'error');
                            setTimeout(function() {
                                location.reload();
                            }, 5000);
                        }else{
                            $("#page1").removeClass("ld-float-ltr-in").addClass("ld-float-ltr-out").fadeOut();
                            if(position === "ketua"){
                                $("#page2").delay(400).removeClass("ld-float-rtl-out").fadeIn().addClass("ld-float-rtl-in");
                                history.pushState({}, "", "?a=1");
                            }else{
                                $("#page3").delay(400).removeClass("ld-float-rtl-out").fadeIn().addClass("ld-float-rtl-in");
                                history.pushState({}, "", "?a=2");
                            }
                        }
                    }
                });
            }
        </script>

        <div id="page2" class="ld" style="<?php echo $page2_display; ?>">
            <h3 style="text-align: center;">Selamat Datang Ketua Rt</h3>
            <br><br>
            <div class="formdiv">
                <input onkeyup="limitut('nama', '100');" id="nama" type="text" class="forminput" placeholder="Nama Grup / Jalan">
                <div style="text-align: center;">
                    <input onkeyup="limitut('rt', '3');" id="rt" type="number" class="forminput" style="width: 43%;margin: 0px 2%;" placeholder="Rt">
                    <input onkeyup="limitut('rw', '3');" id="rw" type="number" class="forminput" style="width: 43%;margin: 0px 2%;" placeholder="Rw">
                </div>
                <input onkeyup="limitut('kelurahan', '40');" id="kelurahan" type="text" class="forminput" placeholder="Kelurahan">
                <input onkeyup="limitut('kecamatan', '40');" id="kecamatan" type="text" class="forminput" placeholder="Kecamatan">
                <input onkeyup="limitut('kota', '40');" id="kota" type="text" class="forminput" placeholder="Kota">
                <input onkeyup="limitut('kabupaten', '50');" id="kabupaten" type="text" class="forminput" placeholder="Kabupaten">
                <br><br>
                <div style="font-size: 15px;">
                    <div style="text-align: center;">Gunakan Password Atau Kode Akses?</div>
                    <div style="text-align: justify;">Kode Akses Berfungsi Agar Ketika Anggota Ingin Masuk Kedalam Grup Anda, maka mereka otomatis akan bergabung dalam grup, tanpa persetujuan terlebih dahulu dengan memasukan kode akses</div>
                </div>
                <div style="text-align: center;">
                    <input id="redeemcode" onkeyup="writekode();" type="text" class="forminput" placeholder="Kode Akses ( Optional )">
                    <button onclick="redemkode();" class="btn btn-primary" style="margin: none;">Redeem Kode</button>
                    <script>
                        function limitut(id, long){
                            var text = $("#"+id).val();
                            var textlen = text.length;
                            var disable = /[^a-z0-9@ _@#-]/gi;
                            var text = text.replace(disable, "");
                            if(textlen > long){
                                text = text.substring(0, long);
                                errordiv1s('Input terlalu Panjanga', 'Maksimal '+long+' Karakter', "0", 'error');
                            }
                            $("#"+id).val(text);
                        }
                        function redemkode(){
                            var a = Math.random().toString(36).substring(10);
                            var b = Math.random().toString(30).substring(10);
                            $("#redeemcode").val(a.toUpperCase() + b.toUpperCase());
                        }
                        function writekode(){
                            var a = $("#redeemcode").val();
                            var al = a.length;
                            var disable = /[^a-z0-9@]/gi;
                            var b = a.replace(disable, "");
                            if(al > 8){
                                b = b.substring(0, 8);
                            }
                            $("#redeemcode").val(b.toUpperCase());

                        }
                    </script>
                </div>
                <br>
                <div style="font-size: 15px;text-align: center;">
                    Kosongkan Saja Jika Anda Tidak Memakai Kode Akses
                </div>
                <br>
                <div style="text-align: right;">
                    <button id="btb" onclick="makegroup();" class="btn btn-success">Buat Grup</button>
                </div>
                <div onclick="postback();" style="text-align: left;cursor: pointer;margin: 0px 0px 0px 9px;"><button class="btn btn-link">&leftarrow; Kembali</button></div>
            </div>
            <script>
                var groupajax = null;
                function makegroup(){
                    if(groupajax){
                        groupajax.abort();
                    }
                    var a = 0;
                    var error = "";
                    var nama = $("#nama").val();
                    var rt = $("#rt").val();
                    var rw = $("#rw").val();
                    var kelurahan = $("#kelurahan").val();
                    var kecamatan = $("#kecamatan").val();
                    var kota = $("#kota").val();
                    var kabupaten = $("#kabupaten").val();
                    var kode = $("#redeemcode").val();
                    if(nama == ""){
                        a = a+1;
                        error = error+"Jalan / Nama Grup Kosong<br>";
                    }
                    if(rt == ""){
                        a = a+1;
                        error = error+"Rt Kosong<br>";
                    }
                    if(rw == ""){
                        a = a+1;
                        error = error+"Rw Kosong<br>";
                    }
                    if(kelurahan == ""){
                        a = a+1;
                        error = error+"Kelurahan Kosong<br>";
                    }
                    if(kecamatan == ""){
                        a = a+1;
                        error = error+"Kecamatan Kosong<br>";
                    }
                    if(kota == ""){
                        a = a+1;
                        error = error+"Kota Kosong<br>";
                    }
                    if(kabupaten == ""){
                        a = a+1;
                        error = error+"Kabupaten Kosong<br>";
                    }
                    if(a == 0){
                        $("#full-page-load-2").fadeIn();
                        $("#btb").prop("disabled", true);
                        groupajax = $.ajax({
                            method:"post",
                            url:"createg.php",
                            data:{
                                nama:nama,
                                rt:rt,
                                rw:rw,
                                kelurahan:kelurahan,
                                kota:kota,
                                kecamatan:kecamatan,
                                kabupaten:kabupaten,
                                kode:kode,
                                s:"s"
                            },
                            dataType:"text",
                            success:function(data){
                                $("#btb").prop("disabled", false);
                                if(data === "error"){
                                    location.href = "../error/index.php?errcod=conn";
                                }else{
                                    location.href = "../";
                                }
                            }
                        });
                    }else{
                        errordiv1s('Form Kosong',error, "0", 'error');
                    }
                }
            </script>
        </div>

        <div id="page3" class="ld" style="<?php echo $page3_display; ?>">
            <h3 style="text-align: center;">Silahkan Gabung Ke Grup</h3>
            <br>
            <div style="display: absolute;margin: center;width: 100%;text-align: center;">
                <div style="width: 60%;display: inline-block;">
                    <input onkeyup="carin();" attrtype="" id="ngaj" type="text" class="form-control" placeholder="Nama Grup / Jalan">
                </div>
                <div style="width: 35%;display: inline-block;padding-left: 8px;">
                    <button onclick="p3cari();" id="pg3b" style="width: 100%;" class="btn btn-info">Cari</button>
                </div>
                <br><br>
                <div attrkod="" id="page3_output" style="text-align: left;" attroffset="0">
                    <br>
                    <p style="text-align: justify;padding: 0px 10px;">
                        Gunakan Tanda # Untuk Masuk Menggunakan Id Grup<br><br>
                        Contoh:<br>
                        #IDGRUP
                    </p>
                    </br>
                    <!-- search output -->
                </div>
                <div id="script_out" style="display: none;"></div>
                <div id="loadmrdiv" style='text-align: center;display: none;'><button onclick="p3cari();" class='btn btn-dark'>Load More</button></div>
                <br><br>
                <div style="display: relative;">
                    <a style="text-align: left;cursor: pointer;margin: 0px 0px 0px 9px;float: left;"><button onclick="postback();" class="btn btn-link">&leftarrow; Kembali</button></a>
                    <a style="text-align: right;cursor: pointer;margin: 0px 9px;float: right;"><button class="btn btn-link">Lewati &rightarrow;</button><a>
                </div>
            </div>
        </div>
        <script>
            function gab(id){
                $("#full-page-load-2").fadeIn();
                $("#page3_output").attr("attrkod", id);
                $.ajax({
                    method:"post",
                    url:"gkod.php",
                    data:{id:id},
                    dataType:"text",
                    success:function(data){
                        $("#full-page-load-2").fadeOut();
                        if(data === "1"){
                            form1op("Kode Akses", "Masukan Kode Akses <input onkeyup='confirmcode();' id='concode' class='form-control' type='text'>", "<button onclick='jogrca();' class='btn btn-success'>Gabung</button>");
                        }else if(data === "0"){
                            window.location = "../";
                        }else if(data === "3"){
                            errordiv1s("Grup Telah Dihapus", "Tampaknya Grup Telah Dihapus Oleh Pemilik Grup", "0", "error");
                        }else{
                            errordiv1s("Error", "Kesalahan Pada Sistem, Harap Tunggu Sebentar, Halaman Akan Dimuat Ulang Dalam", "5", "error");
                            setTimeout(function(){
                                location.reload();
                            }, 5000)
                        }
                    }
                });
            }
            function confirmcode(){
                var text = $("#concode").val();
                var enable = /[^a-zA-z0-9]/gi;
                var text = text.replace(enable, "");
                $("#concode").val(text.toUpperCase());
            }
            var jogrcaa = null;
            function jogrca(){
                form1cl();
                $("#full-page-load-2").fadeIn();
                var attrkod = $("#page3_output").attr("attrkod");
                var text = $("#concode").val();
                jogrcaa = $.ajax({
                    method:"post",
                    url:"valgr.php",
                    data:{
                        text:text,
                        attrkod:attrkod
                    },
                    dataTye:"text",
                    success:function(data){
                        if(data === "0"){
                            window.location = "../";
                        }else if(data === "1"){
                            setTimeout(function(){
                                $("#full-page-load-2").fadeOut();
                                form1op("Kode Akses", "<div style='background-color: #c83349;color: white;font-size: 18px;text-align: center;padding: 4px 0px;'>Kode Akses Salah</div><br>Masukan Kode Akses <input onkeyup='confirmcode();' id='concode' class='form-control' type='text'>", "<button onclick='jogrca();' class='btn btn-success'>Gabung</button>");
                            }, 3000);
                        }
                    }
                });
            }
            function carin(){
                var text = $("#ngaj").val();
                var firsttext = text.substring(0, 1);
                var enable = /[^a-zA-Z0-9 _#-]/;
                var text = text.replace(enable, "");
                if(firsttext == "#"){
                    $("#pg3b").html("Gabung");
                    $("#ngaj").val(text.toUpperCase());
                    $("#ngaj").attr("attrtype", "kode");
                }else{
                    $("#ngaj").attr("attrtype", "");
                    $("#pg3b").html("Cari");
                }
            }
            var cariajax = null;
            var idajax = null;
            var searchbef = "";
            function p3cari(){
                if(cariajax){
                    cariajax.abort();
                }
                var attr = $("#ngaj").attr("attrtype");
                var attr2 = $("#page3_output").attr("attroffset");
                var text = $("#ngaj").val();
                var text_length = text.length;
                var text_front = text.substring(0, 1);
                var text2 = text.substring(1, text_length);
                if(text_front == "#"){
                    $("#full-page-load-2").fadeIn();
                    idajax = $.ajax({
                        method:"post",
                        url:"searchid.php",
                        data:{text:text2},
                        dataType:"text",
                        success:function(data){
                            $("#full-page-load-2").fadeOut();
                            $("#script_out").html(data);
                        }
                    });
                }else{
                    if((attr2 === "empty") && (text === searchbef)){

                    }else if((attr2 === "empty") && (text !== searchbef)){
                        $("#page3_output").attr("attroffset", "0");
                        searchz(attr,text,"0");
                    }else if((attr2 !== "empty") && (text !== searchbef)){
                        searchz(attr,text,"0");
                    }else if((attr2 !== "empty") && (text === searchbef)){
                        searchz(attr,text,attr2);
                    }
                }
            }
            function searchz(attr,text,attr2){
            if(attr == "kode"){

            }else{
                $("#full-page-load-2").fadeIn();
                searchbef = text;
                cariajax = $.ajax({
                    method:"post",
                    url:"search.php",
                    data:{
                        input:text,
                        offset:attr2
                    },
                    dataType:"text",
                    success:function(data){
                        $("#loadmrdiv").fadeIn();
                        $("#full-page-load-2").fadeOut();
                        if(attr2 == "0"){
                                $("#page3_output").html("<hr>"+data);
                        }else{
                            $("#page3_output").append(data);
                        }
                    }
                });
            }
        }
        </script>
        <script>
            function postback(){
                $("#full-page-load-2").fadeIn();
                $.ajax({
                    url:"position.php",
                    method:"post",
                    data:{back:"back"},
                    dataType:"text",
                    success:function(data){
                        $("#full-page-load-2").fadeOut();
                        if(data === "error"){
                            errordiv1s("ERROR",'Maaf Terjadi Kesalahan, Halaman Akan Di Reload dalam', "5", 'error');
                            setTimeout(function() {
                                location.reload();
                            }, 5000);
                        }else{
                            $("#page3").removeClass("ld-float-rtl-in").addClass("ld-float-rtl-out").fadeOut();
                            $("#page2").removeClass("ld-float-rtl-in").addClass("ld-float-rtl-out").fadeOut();
                            $("#page1").delay(400).removeClass("ld-float-ltr-out").fadeIn().addClass("ld-float-ltr-in");
                        }
                    }
                });
            }
            function lewats(){
                $("#full-page-load-1").fadeIn().removeClass("ld-zoom-out").addClass("ld-zoom-in");
                location.href = "../";
            }
        </script>

        <div id="page4" style="display: none;">

        </div>

    </div>

    <br><br><br><br>
</body>
</html>