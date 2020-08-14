<?php
session_start();
if(isset($_SESSION['myrt4session']) && $_SESSION['myrt4session'] === true){
    $email = $_SESSION['email'];
}
//coonection and database config
include "../../config/config.php";

if(empty($email)){
    header("location: ../../logout/");
}
//get data
$get_query = mysqli_query($conn, "SELECT * FROM users_account WHERE email LIKE '%$email%' ");
while($res = mysqli_fetch_array($get_query)){
    $user_code = $res['user_code'];
    $status = $res['status'];
    $grup = $res['grup_code'];
}
if(empty($status)){
    header("location: ../../group-login/");
}
//dont copy this <start>
if(!empty($grup)){
    header("location: ../../");
}
//dont copy this <end>
//end account configuration

$jalan = $rt = $rw = $kelurahan = $kecamatan = $kota = "";
$jalan_err = $rt_err = $rw_err = $kelurahan_err = $kecamatan_err = $kota_err = "";
if(isset($_POST['submit'])){
    $jalan = $_POST['jalan'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $kelurahan = $_POST['kelurahan'];
    $kecamatan = $_POST['kecamatan'];
    $kota = $_POST['kota'];

    if(strlen($rt) > 2){
        $rt_err = "Maksimal 2 Karakter";
    }
    if(strlen($rw) > 2){
        $rw_err = "Maksimal 2 Karakter";
    }
    if(strlen($kelurahan) > 30){
        $kelurahan_err = "Maksimal 30 Karakter";
    }
    if(strlen($kecamatan) > 30){
        $kecamatan_err = "Maksimal 30 Karakter";
    }
    if(strlen($kota) > 30){
        $kota_err = "Maksimal 30 Karakter";
    }
    
    if(empty($rt_err) && empty($rw_err) && empty($kelurahan_err) && empty($kecamatan_err) && empty($kota_err)){
        //create Grup code
        $grup_code = "G".date("DHsmYdiBu")."C";
        //date format code ([D] 3 letter of a day)([H] 24 fromat hour)([s] seconds 00-59)([m] Numeric Month 01-12)([Y] Four Digit Year)([d] day 01-31)([i] minute)([B] swacth internet Time)
        $query = mysqli_query($conn, "INSERT INTO grup (jalan,rt,rw,kelurahan,kecamatan,kota,grup_code) VALUES ('$jalan','$rt','$rw','$kelurahan','$kecamatan','$kota','$grup_code')")or die(mysqli_error());
        $query2 = mysqli_query($conn, "UPDATE users_account SET grup_code='$grup_code' WHERE email LIKE '%$email%' ")or die(mysqli_error());
        if(!file_exists("../../gp/$grup_code")){
            mkdir("../../group_file/$grup_code")or die("GAGAL");
        }
        }
        header("location: ../../");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buat Group</title>
    <link rel="stylesheet" href="../../script/bootstrap/css/bootstrap.min.css">
    <script src="../../script/jquery/jquery.js"></script>
    <script src="../../script/bootstrap/js/bootstrap.min.js"></script>
<style>
body{
    font-family: arial;
}
.divbody{
    width: 500px;
    margin: auto;
    margin-top: 5%;
}
@media screen and (max-width: 500px){
    .divbody{
        width: 95%;
    }
}
.php-invalid-feedback{
    color: red;
    font-size: 15px;
    text-align: center;
}
</style>
</head>
<body onoffline="offlinefunction()" ononline="onlinefunction()">
<?php
include "../../config/config_loading.php";
?>
<div class="divbody">
    <h1>Selamat Datang Ketua RT</h1><br>
    <h4>Silahkan Membuat Group Baru Dengan Mengisi Form Dibawah</h4><br><br>
    <form action="" method="post" class="was-validated">
        <table class="table">
            <tr class="form-group">
                <td COLSPAN="2"><input id="f1" type="text" class="form-control" placeholder="Nama Jalan" name="jalan" value="<?php echo $jalan; ?>" required></td>
            </tr>
            <tr class="form-group">
                <td><input type="number" id="f2" class="form-control" placeholder="RT" name="rt" value="<?php echo $rt; ?>" required>
                <div class="php-invalid-feedback"><?php echo $rt_err; ?></div></td>
                <td><input type="number" id="f3" class="form-control" placeholder="RW" name="rw" value="<?php echo $rw; ?>" required>
                <div class="php-invalid-feedback"><?php echo $rw_err; ?></div></td>
            </tr>
            <tr class="form-group">
                <td COLSPAN="2"><input id="f4" type="text" class="form-control" placeholder="Kelurahan" name="kelurahan" value="<?php echo $kelurahan; ?>" required>
                <div class="php-invalid-feedback"><?php echo $kelurahan_err; ?></div></td>
            </tr>
            <tr class="form-group">
                <td COLSPAN="2"><input id="f5" type="text" class="form-control" placeholder="Kecamatan" name="kecamatan" value="<?php echo $kecamatan; ?>" required>
                <div class="php-invalid-feedback"><?php echo $kecamatan_err; ?></div></td>
            </tr>
            <tr class="form-group">
                <td COLSPAN="2"><input id="f6" type="text" class="form-control" placeholder="Kota" name="kota" value="<?php echo $kota; ?>" required>
                <div class="php-invalid-feedback"><?php echo $kota_err; ?></div></td>
            </tr>
            <tr>
                <td COLSPAN="2"><a href="">Bantuan</a><input style="float: right;" type="submit" class="btn btn-primary" name="submit" value="Buat Group"></td>
            </tr>
        </table>
    </form>
</div>

<!-- offline config -->
<?php include "../../config/config_offline.html"; ?>
<script>
$('.btn').click(function(){
    if($("#f1").val() == ""){
    }else if($("#f1").val() == ""){
    }else if($("#f2").val() == ""){
    }else if($("#f3").val() == ""){
    }else if($("#f5").val() == ""){
    }else if($("#f6").val() == ""){
    }else{
        $(".btn").val("Loading...");
    }
});
</script>
</body>
</html>