<?php
session_start();
if(isset($_SESSION['myrt4session']) && $_SESSION['myrt4session'] === true){
    header("Location: ../group-login/");
    exit;
}
include "../config/config.php";

$email = $password = "";
$error = $error_display = "";
if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $search_query = mysqli_query($conn, "SELECT * FROM users_account WHERE email LIKE '%$email%' OR no_tlp='$email'")or die(mysqli_error());
    $count_search = mysqli_num_rows($search_query);

    if($count_search == 0){
        $error = "Maaf Tidak Menemukan Email Atau Nomor Telepon<br>( ".$email." )";
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

            $_SESSION['myrt4session'] = true;
            $_SESSION['email'] = $email_get;
            if(empty($_POST["remember"])){
                $_SESSION['setcookie'] = "no";
            }else{
                $_SESSION['setcookie'] = "yes";
            }
            header("location: ../group-login/");
        }else{
            $error = "Maaf Password Salah";
        }
    }
}

//display error
if(empty($error)){
    $error_display = "none";
}else{
    $error_display = "block";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css">
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
<style>
html{
    font-family: arial;
}
body{
    font-family: arial;
}
.divbody{
    width: 400px;
    margin: auto;
    padding: 10px 30px;
    margin-top: 100px;
    background-color: #333333;
    border-radius: 20px;
}
.btn{
    background-color: #0099ff;
    color: white;
}
.input{
    outline: none;
    border-top: none;
    border-right: none;
    border-left: none;
    border-color: white;
    width: 100%;
    padding: 5px;
    background-color: #333333;
    color: #fff;
}
.input:focus{

}
::placeholder{
    color: white;
    opacity: 0.7;
}

@media screen and (max-width: 500px){
    .divbody{
        width: 95%;
    }
}
</style>
</head>
<body onoffline="offlinefunction()" ononline="onlinefunction()">
<div class="divbody">
    <h1 style="text-align: center;color: white;">Masuk</h1><br>
    <div class="form-group">
        <div class="bg-danger" style="text-align: center;color: white;padding: 5px 0px;border-radius: 10px;display: <?php echo $error_display; ?>;"><?php echo $error; ?></div>
    </div>
    <form method="post" action="" class="was-validated">
        <div class="form-group">
            <input type="text" class="input" placeholder="Email ( contoh@contoh.com )" name="email" value="<?php echo $email; ?>" required>
        </div>
        <div class="form-group" id="form-password">
            <input type="password" id="password" class="input" style="width: 90%" placeholder="Password" name="password" value="<?php echo $password; ?>" required><img onclick="seepass()" id="eye" style="width: 20px;height: 20px;cursor: pointer;" src="../gambar/system/eye.png">
        </div>
        <div class="form-group">
            <input type="checkbox" name="remember" id="remember" value="yes" class="input_field"><label style="color: white;padding-left: 10px;" for="remember">Ingat Saya Di Perangkat Ini</label>
        </div>
        <div class="form-group">
            <a href="../forgot-password/">Lupa Password</a>
            <input id="btn" style="float: right;" type="submit" class="btn" value="Masuk" name="submit">
        </div>
    </form>
</div>

<!-- offline config -->
<?php include "../config/config_offline.html"; ?>

<script>
var eye = 0;
function seepass(){
    if(eye == 0){
        document.getElementById("password").type = "text";
        document.getElementById("password").style.background = "#ff1a1a";
        document.getElementById("form-password").style.background = "#ff1a1a";
        eye = 1;
    }else{
        document.getElementById("password").type = "password";
        document.getElementById("password").style.background = "#333333";
        document.getElementById("form-password").style.background = "#333333";
        eye = 0;
    }
}

$("#btn").click(function(){
    if($('#f1').val() == ""){
    }else if($('#f2').val() == ""){
    }else{
        document.getElementById("btn").value = "Loading...";
    }
});$("#btn").click(function(){
    if($('#f1').val() == ""){
    }else if($('#f2').val() == ""){
    }else{
        document.getElementById("btn").value = "Loading...";
    }
});
</script>
</body>
</html>
<?php
include "../config/config_loading.php";
?>