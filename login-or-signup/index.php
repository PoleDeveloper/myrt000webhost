<?php

include "../config/config.php";

if(!isset($_SESSION)){
    session_start();
}


if(!empty($_COOKIE['email']) && !empty($_COOKIE['brwco']) && !empty($_COOKIE['browser'])){
    $sesionemail = $_COOKIE['email'];
    $brwco = $_COOKIE['brwco'];
    $browser = $_COOKIE['browser'];
    $get = mysqli_query($conn, "SELECT * FROM used_browser WHERE email='$sesionemail' AND security_code='$brwco' AND browser='$browser' ")or die(mysqli_error($conn));
    $count_get = mysqli_num_rows($get);
    if($count_get == 1){
        $_SESSION['myrt4session'] = true;
        $_SESSION['email'] = $_COOKIE['email'];
        $_SESSION['setcookie'] = "yes";
        header("Location: ../group/");
    }else{
        $_SESSION = array("myrt4session");
        session_destroy();
        setcookie("email", "", time() - 3600, "/")or die("Gagal");
        setcookie("wc", "", time() - 3600, "/")or die("Gagal");
        setcookie("brwco", "", time() - 3600, "/")or die("Gagal");
        setcookie("browser", "", time() - 3600, "/")or die("Gagal");
        setcookie("version", "", time() - 3600, "/")or die("Gagal");
    }
}else if(empty($_COOKIE['email']) && isset($_SESSION['myrt4session']) && $_SESSION['myrt4session'] === true){
    $sesionemail = $_SESSION['email'];
    $_SESSION['myrt4session'] = true;
    header("Location: ../group/");
}

if(!isset($_GET['f'])){
    header("Location: ?f=l");
}
if(isset($_GET['f'])){
    $floc = $_GET['f'];
    if($floc == "l"){
        $logdis = "display: block;";
        $regdis = "display: none";
        $uptxt = "Masuk";
    }else if($floc = "r"){
        $logdis = "display: none;";
        $regdis = "display: block";
        $uptxt = "Buat Akun";
    }else{
        $logdis = "display: block;";
        $regdis = "display: none";
        $uptxt = "Masuk";
    }
}

$email = $password = "";
$emaillogerr = "";
if(isset($_GET['logmail'])){
    $email = $_GET['logmail'];
}
if(isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $search_query = mysqli_query($conn, "SELECT * FROM users_account WHERE email='$email' OR no_tlp='$email'")or die(mysqli_error($conn));
    $count_search = mysqli_num_rows($search_query);

    if($count_search == 0){
        $emaillogerr = "<div style='background-color: red;'>Email Atau Password Anda Salah</div>";
    }else{
        while($res = mysqli_fetch_array($search_query)){
            $hashed_password = $res['password'];
            $user_code = $res['user_code'];
            $email_get = $res['email'];
        }
            //verifikasi password
        if(password_verify($password, $hashed_password)){
            if(!isset($_SESSION)){
                session_start();
            }
            $keylenght = 30;
            $str = "1234567890avcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
            $randstr = substr(str_shuffle($str), 0, $keylenght);
            mysqli_query($conn, "UPDATE users_account SET web_code='$randstr' WHERE email='$email' ")or die(mysqli_error($conn));

            $_SESSION['myrt4session'] = true;
            $_SESSION['email'] = $email_get;
            $_SESSION['wc'] = $randstr;
            if(empty($_POST["remember"])){
                $_SESSION['setcookie'] = "no";
            }else{
                $_SESSION['setcookie'] = "yes";
            }
            header("Location: ../group/");
        }else{
            $emaillogerr = "<div style='background-color: red;'>Email Atau Password Anda Salah</div>";
        }
    }
}

mysqli_close($conn);
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
    <title>Masuk</title>
<style>
    body,
    html{
        font-family: ARIAL;
        /*
        background: url(../system/wall/d.png)no-repeat;
        background-size: cover;
        background-attachment: fixed;
        background-position: top;
        */
    }

    /* form-div s */
    .form-div{
        position: absolute;
        top: 100px;
        right: 0px;
        left: 0px;
        padding: 20px 10px;
        width: 350px;
        margin: auto;
        background-color: #034f84;
        box-shadow: 2px 2px 10px #034f84;
        color: white;
        margin-bottom: 100px;
    }
    .form-div-in{
        margin: auto;
        width: 90%;
    }
    .form-in{
        padding: 3px 0px;
    }
    .err{
        position: relative;
        width: 100%;
        overflow: hidden;
        text-align: center;
        display: none;
    }
    .errtxt{
        text-align: center;
        margin-top: 3px;
    }
    .ltlload{
        font-size: 15px;
    }
    .form-control{
        cursor: pointer;
        outline: none;
        background-color: transparent;
        color: white;
        transition: 0.5s;
    }
    .forminput{
        outline: none;
        width: 100%;
        padding: 4px 7px;
        margin: 5px 0px;
        border-top: none;
        border-left: none;
        border-right: none;
        border-bottom: 2px solid white;
        color: white;
        background-color: transparent;
        border-radius: 0px;
        transition: 0.4s;
        
    }
    .forminput:hover{
        background-color: white;
        color: black;
    }
    .forminput:hover::placeholder{
        color: black;
    }
    .forminput:focus{
        background-color: white;
        color: black;
        border-bottom: none;
    }
    .forminput:focus::placeholder{
        color: black;
    }
    .forminput::placeholder{
        color: white;
        border: none;
        opacity: 0.7;
    }
    .forminput:-moz-placeholder{
        background-color: transparent;
        border: none;
    }
    /* form-div e */
@media screen and (max-width: 360px){
    .form-div{
        width: 95%;
    }
}
</style>
</head>
<body>
    <!-- loading full page s -->
    <?php include "../script/full-page-load/loading1.html" ?>
    <script>
        $(document).ready(function(){
            $("#full-page-load-1").addClass("ld-zoom-out").delay(250).fadeOut();
        });
    </script>
    <!-- loading full page e -->

    <div id="body-form" class="form-div" style="animation-duration: 0.5s;">
        <h2 id="form-title" class="ld" style="text-align: center;"><?php echo $uptxt; ?></h2>
        <div id="root"></div>
        <div id="divcoba"></div>
        <!-- confirm div s -->
        <div style='display: none;' class="ld" id="confirm-div">

        </div>
        <!--  confirm div e -->
        <div id="form-login" class="ld" style="<?php echo $logdis; ?>">
        <br>
            <form ation="" method="post" autocomplete="off">
                <div class="form-in" style="text-align: center;">
                    <?php echo $emaillogerr; ?>
                </div>
                <div class="form-in">
                    <input class="forminput" type="text" name="email" placeholder="Email / No Tlp" value="<?php echo $email; ?>" required>
                </div>
                <div class="form-in">
                    <input class="forminput" type="password" name="password" placeholder="Password" value="<?php echo $password; ?>" required>
                </div>
                <div class="form-in">
                    <input con="0" style="cursor: pointer;" type="checkbox" name="remember" onclick="rememalert();" id="remember"> <label for="remember" style="cursor:pointer;"> Ingat Saya Di Perangkat Ini</label>
                </div>
                <div class="form-in" style="text-align: right;">
                    <input onclick="masukbtn();" id="logbtn" class="btn" style="background-color: white;" name="login" type="submit" value="Masuk">
                </div>
                <script>
                    function masukbtn(){
                        $("#logbtn").html("Masuk <a class='ld ld-ring ld-cycle'><a>");
                        $("#full-page-load-1").removeClass("ld-zoom-out").fadeIn().addClass("ld-zoom-in");
                    }
                    function rememalert(){
                        var val = $("#remember").attr("con");
                        if(val == 0){
                            alert("Pastikan Ini Adalah Perangkat Milik Anda Sendiri \n\n Jika Ini Bukan Perangkat Anda Sendiri, Direkomendasikan Untuk Tidak Mencentang Pilihan ( Ingat Saya Diperangkat Ini )");
                            $("#remember").attr("con", "1");
                        }else{
                            $("#remember").attr("con", "0");
                        }
                    }
                </script>
            </form>
        </div>
        <div id="form-register" class="ld" style="<?php echo $regdis; ?>">
            <form autocomplete="off">
                <div class="form-in">
                    <input onkeyup="limiter('namareg');" id="namareg" class="forminput" type="text" name="namareg" placeholder="Nama" required>
                    <div class="err" id="namaregerr"></div>
                </div>
                <div class="form-in">
                    <input onkeyup="limiter('emailreg');" id="emailreg" class="forminput" type="text" name="emailreg" placeholder="Email" required>
                    <div class="err" id="emailregerr"></div>
                </div>
                <div class="form-in">
                    <input id="passreg1" class="forminput" type="password" name="passreg" placeholder="Password" required>
                    <div class="err" id="passreg1err"></div>
                </div>
                <div class="form-in">
                    <input onkeyup="passval();" id="passreg2" class="forminput" type="password" name="conpassreg" placeholder="Konfirmasi Password" required>
                    <div class="err" id="passreg2err"></div>
                </div>
                <div class="form-in">
                    Tanggal Lahir
                    <table style="width: 100%;">
                        <tr>
                            <td style="width: 33%;" id="datop" attrmax="31">
                                <select class="form-control" id="daytop">

                                </select>
                            </td>
                            <td style="width: 33%;">
                                <select class="form-control" id="montop">
                                    <option value="bulan">Bulan</option>
                                    <option value="01">Januari</option>
                                    <option value="02">Febuari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </td>
                            <td style="width: 33%;">
                                    <select class="form-control" id="yearregsel">

                                    </select>
                            </td>
                            <script>
                                $("#montop").on("change", function(){
                                    var montg = $("#montop").val();
                                    if(montg == "02"){
                                        var jd = 29;
                                    }else{
                                        if(montg%2 == 1){
                                            var jd = 32;
                                        }else if(montg%2 == 0){
                                            var jd = 31;
                                        }
                                    }
                                    $("#datop").attr("attrmax", jd);
                                    daytop();
                                });
                                $(document).ready(function(){
                                    yeatop();
                                    daytop();
                                    $("#daytop").val("tanggal").change();
                                });
                                function daytop(){
                                    var daytop = $("#datop").attr("attrmax");
                                    var seltop = $("#daytop").val();
                                    var x;
                                    var option = "";
                                    for(x = 1;x < daytop;x++){
                                        option += "<option value='"+x+"'>"+x+"</option>";
                                    }
                                    $("#daytop").html("<option value='tanggal' selected>Tanggal</option>"+option);
                                    if(seltop < daytop){
                                        $("#daytop").val(seltop).change();
                                    }else if(seltop > daytop){
                                        $("#daytop").val("tanggal").change();
                                    }
                                }
                                function yeatop(){
                                    var d = new Date();
                                    var year = d.getFullYear();
                                    var yearlast = year-90;
                                    var x;
                                    var option = "";
                                    for (i = yearlast; i < year; i++) {
                                        option += "<option value='"+i+"'>"+i+"</option>";
                                    }
                                    $("#yearregsel").html("<option value='tahun'>Tahun</option>"+option);
                                }
                            </script>
                            <script>

                                function limiter(dl){
                                    var spaceerr = 0;
                                    var namamax = 40;
                                    var emailmax = 100;
                                    if(dl == "namareg"){
                                        var nama = $("#"+dl).val();
                                        if(nama.length >= namamax){
                                            nama = nama.substring(0, namamax);
                                            $("#"+dl+"err").html("Maksimal "+namamax+" Karakter").show("slow");
                                        }else{
                                            $("#"+dl+"err").hide("slow").html("-");
                                        }
                                        $("#"+dl).val(nama);
                                    }else if(dl == "emailreg"){
                                        var email = $("#"+dl).val();
                                        var disable = /[^a-z0-9@_.-]/gi;
                                        var emails = email.replace(disable, "");
                                        if(email.length > emailmax){
                                            emails = emails.substring(0, emailmax);
                                            $("#"+dl+"err").slideDown("medium").html("Maksimal "+emailmax+" Karakter");
                                        }
                                        $("#"+dl).val(emails);

                                        /* validate @gmail.com */
                                        var emaillen = email.length;
                                        var gmaillen = emaillen-10;
                                        var yahoolen = emaillen-10;
                                        gmailvale = email.substring(gmaillen,emaillen);
                                        yahoovale = email.substring(yahoolen,emaillen);

                                        /* check spacing in text s */
                                        var emaillenfor = emaillen;
                                        for(var z = 0;z < emaillen; z++){
                                            if(email.substring(emaillenfor-1, emaillenfor) == " "){
                                                spaceerr = spaceerr-1;
                                            }else{
                                                spaceerr = spaceerr+1;
                                            }
                                            emaillenfor = emaillenfor-1;
                                        }
                                        /* check spacing in text e */

                                        if((spaceerr != emaillen)){
                                            $("#"+dl+"err").html("Tidak Boleh Ada Spasi").slideDown();
                                        }else if((email != "@gmail.com") && (email != "@yahoo.com")){
                                            if((gmailvale == "@gmail.com") || (yahoovale == "@yahoo.com")){
                                                $("#"+dl+"err").slideUp("medium");
                                            }else{
                                                $("#"+dl+"err").html("Email Tidak Valid").slideDown("medium");
                                            }
                                        }
                                    }
                                }

                                function passval(){
                                    var pass1 = $("#passreg1").val();
                                    var pass2 = $("#passreg2").val();
                                    if(pass1 == ""){
                                        $("#passreg1err").show("slow").html("Password Kosong");
                                        $("#passreg2err").hide("medium").html("-"); 
                                        $("#passreg2").val("");
                                    }else{
                                        $("#passreg1err").hide("medium").html("-");
                                        if(pass1 != pass2){
                                            $("#passreg2err").show("medium").html("Password Tidak Sama");
                                        }else{
                                            $("#passreg2err").hide("medium").html("-");
                                        }
                                    }
                                }
                            </script>
                        </tr>
                    </table>
                    <div class="err" id="tanggalerr">

                    </div>
                </div>
                <div class="form-in">
                    <input onkeyup="notlpf();" id="notlp" type="number" class="forminput" name="notlp" placeholder="Nomor Telepon" required>
                    <div class="err" id="notlperr"></div>
                </div>
                <script>
                    function notlpf(){
                        no = $("#notlp").val();
                        nosubs = no.substring(0, 1);
                        nolen = no.length;

                        if((nosubs != "0" ) || (nolen < 8)){
                            $("#notlperr").html("No Telepon Tidak Valid").slideDown("medium");
                        }else{
                            $("#notlperr").slideUp("medium");
                        }
                    }
                </script>
                <div class="form-in">
                    <select id="jkl" class="form-control">
                        <option value="jk">Jenis Kelamin</option>
                        <option value="laki">Laki - Laki</option>
                        <option value="perempuan">Perempuan</option>
                    </select>
                    <div class="err" id="jklerr"></div>
                </div>
            </form>
            <div class="form-in" style="text-align: right;">
                <button id="bk" emstat="1" tpstat="1" erstat="1" cs="0" valc="" onclick="getreadybak();" class="btn btn-success">Buat Akun</button>
            </div>
            <script>
            /* empty register form s */
            function resetregisterform() {
                $("#namareg").val("");
                $("#emailreg").val("");
                $("#passreg1").val("");
                $("#passreg2").val("");
                $("#daytop").val("tanggal");
                $("#montop").val("bulan");
                $("#yearregsel").val("tahun");
                $("#notlp").val("");
                $("#jkl").val("jk");
                $("#bk").attr("valc", "");
            }
            /* empty register form e */
            var tanggalerr = "";
            var emailajax = null;
            var noajax = null;
            var errall = 0;
            var emailbef = "";
            var ca = null;
                function getreadybak(){
                    $("#bk").prop("disabled", true);
                    errall = 0;
                    var nama = $("#namareg").val();
                    var email = $("#emailreg").val();
                    var password = $("#passreg1").val();
                    var daytop = $("#daytop").val();
                    var montop = $("#montop").val();
                    var yeartop = $("#yearregsel").val();
                    var notlp = $("#notlp").val();
                    var jkl = $("#jkl").val();

                    if(nama == ""){
                        $("#namaregerr").html("Nama Kosong").slideDown("medium");
                        errall = errall+1;
                    }
                    if(email == ""){
                        $("#emailregerr").html("Email Kosong").slideDown("medium");
                        errall = errall+1;
                    }else{
                        if(emailajax){
                            emailajax.abort();
                        }

                        if(email != emailbef){
                            $("#bk").html("Buat Akun <a class='ld ld-ring ld-cycle'>");
                            var dr = new Date();
                            var a = dr.getFullYear();
                            var b = dr.getMonth();
                            var c = dr.getDate();
                            var d = dr.getMilliseconds();
                            var e = dr.getHours();
                            var f = dr.getMinutes();
                            var g = dr.getSeconds();
                            let h = Math.random().toString(36).substring(7);
                            let i = Math.random().toString(36).substring(7);
                            let j = Math.random().toString(36).substring(7);
                            let k = Math.random().toString(36).substring(7);
                            let l = Math.random().toString(36).substring(7);
                            $("#bk").attr("valc", a+h+notlp+i+b+j+c+k+d+l+e+"y"+f+"k"+g);
                            $("#emailregerr").slideDown("medium").html("<div class='errtxt'>Mengecek Ketersedian Email <a class='ltlload ld ld-ring ld-cycle'></a></div>");
                            emailajax = $.ajax({
                                method:"post",
                                url:"emailvalidate.php",
                                data:{
                                    email:email,
                                    emailbef:emailbef,
                                    valc:a+h+notlp+i+b+j+c+k+d+l+e+"y"+f+"k"+g
                                },
                                dataType:"text",
                                success:function(data){
                                    if(data == 0){
                                        $("#emailregerr").slideUp("slow");
                                        emailbef = email;
                                        $("#bk").attr("emstat", "0");
                                    }else if(data == 1){
                                        $("#bk").prop("disabled", false);
                                        $("#emailregerr").slideDown("medium").html("Email Sudah Digunakan");
                                        $("#bk").attr("emstat", "1");
                                        $("#bk").prop("disabled", false);
                                    }
                                }
                            });
                        }else{
                            $("#bk").attr("emstat", "0");
                        }
                    }
                    if(password == ""){
                        $("#passreg1err").html("Password Kosong").slideDown("medium");
                        errall = errall+1;
                    }
                    if(daytop == "tanggal"){
                        tanggalerr += "Tanggal ";
                    }
                    if(montop == "bulan"){
                        tanggalerr += "& Bulan ";
                    }
                    if(yeartop == "tahun"){
                        tanggalerr += "& Tahun";
                    }
                    if(tanggalerr != ""){
                        $("#tanggalerr").empty().html(tanggalerr+" Kosong").slideDown();
                        tanggalerr = "";
                        errall = errall+1;
                    }else{
                        $("#tanggalerr").slideUp();
                    }
                    if($("#notlp").val() == ""){
                        $("#notlperr").html("No Telepon Kosong").slideDown();
                        errall = errall+1;
                    }else{
                        if(notlp.length > 8){
                            if(noajax){
                                noajax.abort();
                            }
                            noajax = $.ajax({
                                method:"post",
                                url:"notlpvalidate.php",
                                data:{notlp:notlp},
                                dataType:"text",
                                success:function(data){
                                    if(data == "0"){
                                        /* no action */
                                        $("#bk").attr("tpstat", "0");
                                        $("#notlperr").slideUp();
                                    }else if(data == "1"){
                                        $("#bk").prop("disabled", false)
                                        $("#notlperr").html("Nomor Telepon Sudah Digunakan");
                                        $("#bk").attr("tpstat", "1");
                                        $("#bk").prop("disabled", false);
                                    }
                                }
                            });
                        }else{
                            $("#notlperr").html("Nomor Telepon Tidak Valid").slideDown();
                            $("#bk").attr("tpstat", "1");
                        }
                    }
                    if(jkl == "jk"){
                        $("#jklerr").html("Jenis Kelamin Kosong").slideDown();
                        errall = errall+1;
                    }
                    if((errall == 0)){
                        $("#bk").attr("errstat","0");
                    }
                    if(ca){
                        ca.abort();
                    }
                    createaccount();
                    $("#bk").attr("cs", "0");
                }

                function createaccount(){
                    $("#bk").html("Buat Akun <a class='ld ld-ring ld-cycle'>");
                    var nama = $("#namareg").val();
                    var email = $("#emailreg").val();
                    var password = $("#passreg1").val();
                    var daytop = $("#daytop").val();
                    var montop = $("#montop").val();
                    var yeartop = $("#yearregsel").val();
                    var notlp = $("#notlp").val();
                    var jkl = $("#jkl").val();
                    var valc = $("#bk").attr("valc");
                    if(($("#bk").attr("errstat") == "0") && ($("#bk").attr("emstat") == "0") && ($("#bk").attr("tpstat") == "0") && (valc != "")){
                        if(ca == null){
                            ca = $.ajax({
                                method:"post",
                                url:"cac.php",
                                data:{
                                    nama:nama,
                                    email:email,
                                    password:password,
                                    tgl_lahir:yeartop+"-"+montop+"-"+daytop,
                                    no_tlp:notlp,
                                    jkl:jkl,
                                    valc:valc,
                                    cac:"yes"
                                },
                                dataType:"text",
                                success:function(data){
                                    ca = null;
                                    $("#bk").attr("cs","1");
                                    $("#bk").html("Buat Akun");
                                    if(data == "1"){
                                        $("#bk").prop("disabled", false);
                                    }else{
                                        $("#form-register").removeClass("ld-power-on").addClass("ld-power-off").fadeOut(400);
                                        $("#confirm-div").html("<h5 style='text-align: center'><br><br>AKUN<br>BERHASIL DIBUAT<br><br>Harap Tunggu Sebentar<br><br><a class='ld ld-ring ld-cycle'></a><br></h5>").delay(400).fadeIn().removeClass("ld-power-off").addClass("ld-power-on");
                                        setTimeout(function(){
                                            $("#bk").prop("disabled", false);
                                            resetregisterform();
                                            $("#confirm-div").removeClass("ld-power-on").removeClass("ld-power-off").fadeOut(400);
                                            setTimeout(function(){
                                                login();
                                            }, 400)
                                        }, 5000)
                                    }
                                    
                                }
                            });
                        }   
                    }
                    if(($("#bk").attr("cs") == "0") && (ca == null)){
                        setTimeout(function(){
                            createaccount();
                            $("#bk").html("Buat Akun");
                        }, 2000);
                    }
                }
            </script>
        </div>
        <br>
        <hr style="background-color: white;">
        <div id="div-login" class="ld" style="text-align: center;<?php echo $logdis; ?>">
            <h6>Belum Punya Akun?</h6>
            <button class="btn" style="text-align: center;background-color: #d64161;color: white;" onclick="register();">Buat Akun</button>
        </div>
        <div id="div-register" class="ld" style="text-align: center;<?php echo $regdis; ?>">
            <h6>Sudah Punya Akun?</h6>
            <button class="btn" style="text-align: center;background-color: #d64161;color: white;" onclick="login();">Masuk</button>
        </div>
        <div style="text-align: center;padding-top: 3px;">
            <h6>Atau</h6>
            <button class="btn btn-dark">Lupa Password</button>
        </div> 
        </div>
        <!-- change register or login div s -->
        <script>
            function register() {
                $("#form-login").removeClass("ld-power-on").addClass("ld-power-off").fadeOut();
                $("#form-register").delay(400).fadeIn().removeClass("ld-power-off").addClass("ld-power-on");
                $("#div-login").removeClass("ld-jump-alt-in").addClass("ld ld-jump-alt-out").fadeOut(400);
                $("#div-register").delay(400).fadeIn().removeClass("ld-jump-alt-out").addClass("ld-jump-alt-in");
                $("#form-title").html("Buat Akun");
                history.pushState({}, "", "?f=r");
            }
            function login(){
                $("#form-register").removeClass("ld-power-on").addClass("ld-power-off").fadeOut(400);
                $("#form-login").delay(400).fadeIn().removeClass("ld-power-off").addClass("ld-power-on");
                $("#div-register").removeClass("ld-jump-alt-in").addClass("ld ld-jump-alt-out").fadeOut(400);
                $("#div-login").delay(400).fadeIn().removeClass("ld-jump-alt-out").addClass("ld-jump-alt-in");
                $("#form-title").html("Masuk");
                history.pushState({}, "", "?f=l");
            }
        </script>
        <!-- change register or login div e -->
        <!-- div form transition s -->
        <script>
            $(document).ready(function(){
                $("#body-form").addClass('ld ld-power-on');
            });
        </script>
        <!-- div form transition e -->
    </div>


    <br><br><br><br>
</body>
</html>