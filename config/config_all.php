<?php
/* start a session */
session_start();
/* server config */
include "config.php";
if(empty($_COOKIE['email']) AND isset($_GET['action'])){
    header("Location: ../");
}else if(!empty($_COOKIE['email']) AND isset($_GET['action'])){
    $action = $_GET['action'];
    if($action == "logout"){
        setcookie("email", "", time() - 3600, "/")or die("Gagal");
        header("Location: ../");
    }else if(empty($action)){
        header("Location: ../");
    }
}else if(!empty($_COOKIE['email']) AND !isset($_GET['email'])){
    $_SESSION['myrt4session'] = true;
    $_SESSION['email'] = $_COOKIE['email'];
    setcookie("email", $_COOKIE['email'], time() + (86400*7), "/")or die("Gagal");
}
if(isset($_SESSION['myrt4session']) && $_SESSION['myrt4session'] === true){
    $session_status = "on";
    if(!empty($_SESSION['email'])){
        $email = $_SESSION['email'];
    }
    if(!empty($_SESSION['wc'])){
        $wc = $_SESSION['wc'];
    }
    if(!empty($_SESSION['setcookie'])){
        if($_SESSION['setcookie'] == "yes"){
            setcookie("email", $email, time() + (86400*7), "/")or die("Gagal");
        }
    }
    $config_query = mysqli_query($conn, "SELECT * FROM users_account WHERE email='$email' ")or die(mysqli_error());
    while($coq = mysqli_fetch_array($config_query)){
        $nama_ac = htmlspecialchars($coq['nama']);
        $status_ac = htmlspecialchars($coq['status']);
        $user_code_ac = htmlspecialchars($coq['user_code']);
        $grup_code_ac = htmlspecialchars($coq['grup_code']);
        $no_kk_ac = htmlspecialchars($coq['no_kk']);
        $jentik_code_ac = htmlspecialchars($coq['jentik_code']);
        $picture_ac = htmlspecialchars($coq['account_picture']);
        $create_date_ac = htmlspecialchars($coq['create_date']);
        $display_mode_ac = htmlspecialchars($coq['display_mode']);
        $web_code_ac = htmlspecialchars($coq['web_code']);
    }
    if(!empty($grup_code_ac)){
        $grup_config_query = mysqli_query($conn, "SELECT * FROM grup WHERE grup_code='$grup_code_ac' ")or die(mysqli_error($conn));
        while($gcoq = mysqli_fetch_array($grup_config_query)){
            $rt_gp = htmlspecialchars($gcoq['rt']);
            $rw_gp = htmlspecialchars($gcoq['rw']);
            $jalan_gp = htmlspecialchars($gcoq['jalan']);
            $kelurahan_gp = htmlspecialchars($gcoq['kelurahan']);
            $kecamatan_gp = htmlspecialchars($gcoq['kecamatan']);
            $kota_gp = htmlspecialchars($gcoq['kota']);
            $kabupaten_gp = htmlspecialchars($gcoq['kabupaten']);
            $grup_ac_type = htmlspecialchars($gcoq['type']);
        }
        if(strlen($rt_gp == 1)){
            $rt_gp = "0".$rt_gp;
        }
        if(strlen($rw_gp == 1)){
            $rw_gp = "0".$rw_gp;
        }
    }

}else{
    $session_status = "off";
    setcookie("email", "", time() - 3600, "/")or die("Gagal");
    setcookie("wc", "", time() - 3600, "/")or die("Gagal");
    setcookie("brwco", "", time() - 3600, "/")or die("Gagal");
    setcookie("browser", "", time() - 3600, "/")or die("Gagal");
    setcookie("version", "", time() - 3600, "/")or die("Gagal");
}
/*
if(isset($_SERVER['HTTP_REFERER'])){
    $server_url = $_SERVER['HTTP_REFERER'];
    $server_url_check = substr($server_url, 0,5);
    if($server_url_check == "https"){
        $true_url = "https://myrt4u.000webhostapp.com/"; change it when you upload it, to prefent iframe in different url
        $check_server_url = substr($server_url, 0,33); change it, depend on url lenght
    }else{
        $true_url = "http://myrt4u.000webhostapp.com/"; change it when you upload it, to prefent iframe in different url
        $check_server_url = substr($server_url, 0,32); change it, depend on url lenght
    }
    if($check_server_url != $true_url){
        header("X-Frame-Options: DENY");
    }else{
        header("X-Frame-Options: SAMEORIGIN");
    }
}else{
    
}
*/
?>