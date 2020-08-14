<?php
if(!isset($_SESSION)){
    session_start();
}
if(isset($_SESSION['myrt4session']) && $_SESSION['myrt4session'] === true){
    $email = $_SESSION['email'];
}
if(empty($email)){
    header("location: ../logout/");
}
include "../config/config.php";

//get data
$get_query = mysqli_query($conn, "SELECT * FROM users_account WHERE email LIKE '%$email%' ");
while($res = mysqli_fetch_array($get_query)){
    $user_code = $res['user_code'];
    $status = $res['status'];
    $grup = $res['grup_code'];
}
if(!empty($grup)){
    header("../");
}
if(!empty($status)){
    if($status == "ketua"){
        header("location: create-group/");
    }else{
        header("location: search-group/");
    }
}


//ketika menekan tombol ketua
if(isset($_POST['ketua'])){
    $query = mysqli_query($conn, "UPDATE users_account SET status='ketua' WHERE email LIKE '%$email%' AND user_code='$user_code' ")or die(mysqli_error());
    header("location: create-group/");
}
if(isset($_POST['warga'])){
    $query = mysqli_query($conn, "UPDATE users_account SET status='warga' WHERE email LIKE '%$email%' AND user_code='$user_code' ")or die(mysqli_error());
    header("location: search-group/");
}
if(isset($_POST['bendahara'])){
    $query = mysqli_query($conn, "UPDATE users_account SET status='bendahara' WHERE email LIKE '%$email%' AND user_code='$user_code' ")or die(mysqli_error());
    header("location: search-group/");
}
if(isset($_POST['seketaris'])){
    $query = mysqli_query($conn, "UPDATE users_account SET status='sekretaris' WHERE email LIKE '%$email%' AND user_code='$user_code' ")or die(mysqli_error());
    header("location: search-group/");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gabung Group</title>
    <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css">
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
<style>
html{
    font-family: arial;
}
.divbody{
    width: 500px;
    margin: auto;
    margin-top: 5%;
}
.btn{
    width: 300px;
    margin: 8px 0px;
    font-size: 20px;
}
@media screen and (max-width: 500px){
    .divbody{
        width: 95%;
    }
    .btn{
        width: 90%;
    }
}
</style>
</head>
<body onoffline="offlinefunction()" ononline="onlinefunction()">
<?php
    include "../config/config_loading.php";
?>

<div class="divbody">
    <h1 style="text-align: center;">Hallo Pengguna Baru<br>Anda Ingin Masuk Sebagai</h1><br>
    <div style="text-align: center;">
        <form action="" method="post">
            <input type="submit" name="ketua" value="Ketua Rt" class="btn btn-primary">
            <input type="submit" name="seketaris" value="Sekretaris Rt" class="btn btn-primary">
            <input type="submit" name="bendahara" value="Bendahara Rt" class="btn btn-primary">
            <input type="submit" name="warga" value="Warga" class="btn btn-primary">
        </form>
            <a href="../"><button class="btn btn-danger" style="background-color: red;">LEWATI</button></a>
    </div>
    <br>
    <p>* Jika Status Anda Ketua RT Silahkan Memilih Tombol ( Ketua RT )<br><br>
       * Jika Status Anda Adalah Seketaris RT Silahkan Memilih Tombol ( Seketaris Rt )<br><br>
       * Jika Status Anda Adalah Bendahara Rt Silahkan Memilih Tombol ( Bendahara Rt )<br><br>
       * Jika Status Anda Adalah Warga Silahkan Memilih Tombol ( Warga )</p>
</div>

<!-- offline config -->
<?php include "../config/config_offline.html"; ?>
</body>
</html>