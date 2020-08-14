<?php
include "config/config.php";

$data = array();

if(!empty($_COOKIE['email']) && !empty($_COOKIE['brwco']) && !empty($_COOKIE['browser'])){
    $email = $_COOKIE['email'];
    $browser = $_COOKIE['browser'];
    $brwco = $_COOKIE['brwco'];
    $get = mysqli_query($conn, "SELECT * FROM used_browser WHERE email='$email' AND browser='$browser' AND security_code='$brwco' ")or die("error");
    $get_count = mysqli_num_rows($get);
    if($get_count == 0){
        $data['update'] = "r";
    }else if($get_count == 1){
        $data['update'] = "n";
        $keylenght = 20;
        $str = "1234567890avcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $str2 = date("YmdHis");
        $randstrz = substr(str_shuffle($str), 0, $keylenght);
        $randstr = $randstrz.$str2;
        $date = date('Y-m-d H:i:s');
        mysqli_query($conn, "UPDATE used_browser SET security_code='$randstr', create_date='$date' WHERE email='$email' AND browser='$browser' AND security_code='$brwco' ")or die(mysqli_error($conn));
        setcookie("brwco", $randstr, time() + (86400*30), "/")or die("Gagal");
    }else{

    }
    mysqli_close($conn);
}else{
    if(isset($_SESSION['myrt4session']) && $_SESSION['myrt4session'] === true && !empty($_COOKIE['email'])){
        $data['update'] = "r";
    }else if(isset($_SESSION['myrt4session']) && $_SESSION['myrt4session'] === true && !empty($_COOKIE['brwco'])){
        $data['update'] = "r";
    }else if(isset($_SESSION['myrt4session']) && $_SESSION['myrt4session'] === true && !empty($_COOKIE['browser'])){
        $data['update'] = "r";
    }
}

echo json_encode($data);
?>