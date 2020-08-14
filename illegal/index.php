<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ILLEGAL</title>
<style>
body,
html{
    font-family: arial;
}
.divbody{
    width: 700px;
    margin: auto;
}
@media screen and (max-width: 710px){
    .divbody{
        width: 100%;
    }
}
</style>
</head>
<body>

<div class="divbody">
    <h1 style="color: red;text-align: center;">Gagal Memuat Halaman!!!</h1>
    <br><br>
    <h2 style="color: red;">My Rt Menolak Untuk Terhubung</h2>
    <p style="font-size: 20px;">
    Silahkan Check Url Anda Kembali<br><br>
    ( <?php echo $_SERVER['HTTP_REFERER']; ?> ) Bukan URL Kami</p>
    <br>
    <a href="http://localhost/myrt/" target="_parent">Klik Untuk Menuju Homepage Kami</a>
</div>

</body>
</html>