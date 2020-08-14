<?php
include "../config/config_all.php";

$grup_jalan = "";
if(empty($grup_code_ac)){
    $grup_jalan = "Belum Masuk Dalam Grup";
}else{
    $grup_name_q = mysqli_query($conn, "SELECT * FROM grup WHERE grup_code='$grup_code_ac' ")or die(mysqli_error($conn));
    while($rui = mysqli_fetch_array($grup_name_q)){
        $grup_jalan = $rui['jalan'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengaturan Akun</title>
    <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css">
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
<style>
.ts1{
    width: 35%;
}
.ts2{
    width: 5%;
}
.ts3{
    width: 60%;
}
@media screen and (max-width: 500px){
    .ts1{
        width: 40%;
    }
    .ts2{
        width: 5%;
    }
    .ts3{
        width: 55%;
    }
}
</style>
</head>
<body>

<br>
<h2 style="text-align: center;">Pengaturan Akun</h2>
<br><br>

<table style="width: 100%;word-break: break-all;">
    <tr>
        <td class="ts1">Nama Pengguna</td>
        <td class="ts2">:</td>
        <td class="ts3"><?php echo $nama_ac; ?></td>
    </tr>
    <tr>
        <td class="ts1">Status</td>
        <td class="ts2">:</td>
        <td class="ts3"><?php echo $status_ac; ?></td>
    </tr>
    <tr>
        <td class="ts1">Grup</td>
        <td class="ts2">:</td>
        <td class="ts3"><?php echo $grup_jalan; ?></td>
    </tr>
    <tr>
        <td class="ts1">Email</td>
        <td class="ts2">:</td>
        <td class="ts3"><?php echo $_SESSION['email']; ?></td>
    </tr>
    <tr>
        <td class="ts1">Password</td>
        <td class="ts2">:</td>
        <td class="ts3">*******</td>
    </tr>
    <tr>
        <td class="ts1"></td>
        <td class="ts2"></td>
        <td class="ts3"><button>Ganti Password</button></td>
    </tr>
    <tr>
        <td class="ts1"></td>
        <td class="ts2"></td>
        <td class="ts3"></td>
    </tr>
    <tr>
        <td class="ts1"><br></td>
        <td class="ts2"><br></td>
        <td class="ts3"><br></td>
    </tr>
    <tr>
        <td COLSPAN="3" style="text-align: right;">
            <button class="btn" style="background-color: #f0f0f0;box-shadow: 0px 0px 5px black;"><img style="background-color: white;border-radius: 100%;height: 30px;width: 30px;" src='../system/icon/setting.png'> Ubah Pengaturan</button>
        </td>
    </tr>
</table>

</body>
</html>