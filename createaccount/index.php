<?php
//config
include "../config/config.php";
$gender = "";

$nama = $email = $password = $confirm_password = $no_tlp = $jenis_kelamin = $tempat_lahir = $tanggal_lahir = $alamat = $rt = $rw = "";
$nama_err = $email_err = $password_err = $confirm_password_err = $no_tlp_err = $jenis_kelamin_err = $tempat_lahir_err = $tanggal_lahir_err = $alamat_err = $rt_err = $rw_err = $no_kk_err = "";
if(isset($_POST['submit'])){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $no_tlp = $_POST['no_tlp'];
    $jenis_kelamin = $_POST['gender'];$gender = $jenis_kelamin;
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $alamat = $_POST['alamat'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $no_kk = $_POST['no_kk'];

    if(strlen($nama) > 40){
        $nama_err = "Nama Terlalu Panjang ( Maksimal 40 Karakter )";
    }
    if(strlen($email) > 100){
        $email_err = "Email Terlalu Panjang ( Maksimal 100 Karakter )";
    }
    if(strlen($password) > 35){
        $password_err = "Password Terlalu Panjang ( Maksimal 35 Karakter )";
        $confirm_password_err = "Password Terlalu Panjang ( Maksimal 35 Karakter )";
    }
    if(strlen($no_tlp) > 13){
        $no_tlp_err = "Nomor Telepon Terlalu Panjang ( Maksimal 13 Karakter )";
    }
    if(strlen($tempat_lahir) > 15){
        $tempat_lahir_err = "( Maksimal 15 Karakter )";
    }
    if(strlen($alamat) > 100){
        $alamat_err = "Alamat Terlalu Panjang ( Maksimal 100 Karakter )";
    }
    if(strlen($no_kk) > 50){
        $no_kk_err = "No KK Terlalu Panjang Atau Tidak Valid";
    }
    if(strlen($rt) > 2){
        $rt_err = "( Maksimal 2 Karakter )";
    }
    if(strlen($rw) > 2){
        $rw_err = "( Maksimal 2 Karakter )";
    }

//cek email
$email_query = mysqli_query($conn, "SELECT user_code FROM users_account WHERE email LIKE'%$email%' ");
$count_email = mysqli_num_rows($email_query);
if($count_email == 1){
    $email_err = "Email Sudah Digunakan";
}

//cek no telepon
$no_tlp_query = mysqli_query($conn, "SELECT user_code FROM users_account WHERE no_tlp = $no_tlp ");
$count_no_tlp = mysqli_num_rows($no_tlp_query);
if($count_no_tlp == 1){
    $no_tlp_err = "Nomor Telepon Sudah Digunakan";
}

//make hashed password
if($password != $confirm_password){
    $confirm_password_err = "Password Tidak Cocok";
}else{
    $param_password = password_hash($password, PASSWORD_BCRYPT);
}

//create user code
$user_code = date("DHsmYdiB")."c".date("u");
//date format code ([D] 3 letter of a day)([H] 24 fromat hour)([s] seconds 00-59)([m] Numeric Month 01-12)([Y] Four Digit Year)([d] day 01-31)([i] minute)([B] swacth internet Time)
if(empty($nama_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($no_tlp_err) && empty($jenis_kelamin_err) && empty($tempat_lahir_err) && empty($tanggal_lahir_err) && empty($alamat_err) && empty($rt_err) && empty($rw_err)){
    //insert into database
    $date_now = date("Y-m-d H:i:s");
    $insert_query = mysqli_query($conn ,"INSERT INTO users_account(nama,email,password,no_kk,jenis_kelamin,no_tlp,alamat,rt,rw,status,user_code,grup_code,persetujuan,tempat_lahir,tanggal_lahir) VALUES('$nama','$email','$param_password','$no_kk','$gender','$no_tlp','$alamat','$rt','$rw','','$user_code','','','$tempat_lahir','$tanggal_lahir') ")or die(mysqli_error($conn));
    if(!file_exists("../users/$user_code/")){
        mkdir("../users/$user_code", 0777, true)or die(mysqli_error());
    }
    header("Location: ../login/");
}



}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buat Akun</title>
    <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css">
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
<style>
<?php include "../script/css/lightour.css"; ?>

.divbody{
    padding: 0px;
    margin: 0px;
}
.divform{
    position: relative;
    width: 100%;
}
.table{
    margin: auto;
    width: 450px;
    table-layout: fixed;
    box-shadow: 0px 0px 10px #333333;
    border-radius: 5px;
}
.btn{
    background-color: #00ccff;
    color: white;
}
.alert{
    padding: 2px;
    text-align: center;
    margin-top: 10px;
    margin-bottom: 0px;
}
.php-invalid-feedback{
    color: red;
    font-size: 15px;
    text-align: center;
}
/*animation*/
.btn:hover{
    background-color: white;
    color: #00ccff;
    outline: 3px solid #00ccff;
}
@media screen and (max-width: 500px){
    .table{
        width: 95%;
    }
}

</style>
</head>
<body onoffline="offlinefunction()" ononline="onlinefunction()">

<div class="divbody">
    <h1 style="text-align: center;">Buat Akun</h1><br>

<div>
    <form method="post" class="was-validated">
        <table class="table table-hover" CELLSPACING="4">
            <tr class="form-group">
                <td COLSPAN="2"><input class="form-control" id="f1" type="text" placeholder="Nama" name="nama" value="<?php echo $nama; ?>" required>
                                <div class="php-invalid-feedback"><?php echo $nama_err; ?></div></td>
            </tr>
            <tr class="form-group">
                <td COLSPAN="2"><input class="form-control" id="f2" type="email" placeholder="Email" name="email" value="<?php echo $email; ?>" required>
                                <div class="php-invalid-feedback"><?php echo $email_err; ?></div></td>
            </tr>
            <tr class="form-group">
                <td COLSPAN="2"><input class="form-control" id="f3" type="password" name="password" placeholder="Masukan Password" value="<?php echo $password; ?>" required>
                                <div class="php-invalid-feedback"><?php echo $password_err; ?></div></td>
            </tr>
            <tr class="form-group">
                <td COLSPAN="2"><input class="form-control" id="f4" type="password" placeholder="Konfirmasi Password" name="confirm_password" value="<?php echo $confirm_password; ?>" required>
                                <div class="php-invalid-feedback"><?php echo $confirm_password_err; ?></div></td>
            </tr>
            <tr class="form-group">
                <td COLSPAN="2"><input class="form-control" id="f12" type="number" placeholder="NO KK (Kartu Keluarga)" name="no_kk" value="<?php echo $confirm_password; ?>" required>
                                <div class="php-invalid-feedback"><?php echo $no_kk_err; ?></div></td>
            </tr>
            <tr class="form-group">
                <td COLSPAN="2"><input class="form-control" id="f5" type="number" PlaceHolder="No Telepon" name="no_tlp" value="<?php echo $no_tlp; ?>" required>
                                <div class="php-invalid-feedback"><?php echo $no_tlp_err; ?></div></tr>
            </tr>
            <tr class="form-group">
                <td><label><input type="radio" value="laki" name="gender" id="f6" <?php if (isset($gender) && $gender=="laki") echo "checked";?> required> Laki - Laki</label></td>
                <td><label><input type="radio" value="perempuan" id="f6" name="gender" <?php if (isset($gender) && $gender=="perempuan") echo "checked";?> required> Perempuan</label></td>
            </tr>
            <tr>
                <td COLSPAN="2">Tempat & Tanggal Lahir</td>
            </tr>
            <tr class="form-group">
                <td><input class="form-control" type="text" placeholder="tempat" id="f7" name="tempat_lahir" value="<?php echo $tempat_lahir; ?>" required><div class="php-invalid-feedback"><?php echo $tempat_lahir_err; ?></div></td>
                <td><input class="form-control" style="font-size: 17px;" type="date" id="f8" name="tanggal_lahir" value="<?php echo $tanggal_lahir; ?>" required><div class="php-invalid-feedback"><?php echo $tanggal_lahir_err; ?></div></td>
            </tr>
            <tr>
                <td COLSPAN="2">Alamat</td>
            </tr>
            <tr>
                <td COLSPAN="2"><input class="form-control" type="text" placeholder="Jalan" id="f9" name="alamat" value="<?php echo $alamat; ?>" required>
                <div class="php-invalid-feedback"><?php echo $alamat_err; ?></div></td>
            </tr>
            <tr>
                <td><input class="form-control" type="number" placeholder="RT" name="rt" id="f10" value="<?php echo $rt; ?>" required><div class="php-invalid-feedback"><?php echo $rt_err; ?></div></td>
                <td><input class="form-control" type="number" placeholder="RW" name="rw" id="f11" value="<?php echo $rw; ?>" required><div class="php-invalid-feedback"><?php echo $rw_err; ?></div></td>
            </tr>
            <tr>
                <td COLSPAN="2"><input id="btn"  type="submit" name="submit" class="btn btn-default" value="Buat Akun"></td>
            </tr>
            <tr>
                <td COLSPAN="2">Sudah Punya Akun <a href=""><u>LOGIN</u></a></td>
            </tr>
        </table>
    </form>
</div>

</div>

<br><br>


<!-- offline config -->
<?php include "../config/config_offline.html"; ?>
<script>
$("#btn").click(function(){
    if($('#f1').val() == ''){
    }else if($('#f2').val() == ''){
    }else if($('#f3').val() == ''){
    }else if($('#f4').val() == ''){
    }else if($('#f5').val() == ''){
    }else if($('#f6').val() == ''){
    }else if($('#f7').val() == ''){
    }else if($('#f8').val() == ''){
    }else if($('#f9').val() == ''){
    }else if($('#f10').val() == ''){
    }else if($('#f11').val() == ''){
    }else if($('#f12').val() == ''){
    }else{
        document.getElementById("btn").value = "Loading...";
    }
});
</script>
</body>
</html>