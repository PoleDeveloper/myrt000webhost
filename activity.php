<?php
if(!empty($_COOKIE['email']) && !empty($_COOKIE['brwco'])){
    $apois = 0;
    $sesionemail = $_COOKIE['email'];
    $brwco = $_COOKIE['brwco'];
    $browser = $_COOKIE['browser'];
    $get = mysqli_query($conn, "SELECT * FROM used_browser WHERE email='$sesionemail' AND security_code='$brwco' AND browser='$browser' ")or die(mysqli_error($conn));
    $count_get = mysqli_num_rows($get);
    if($count_get == 1){
        if(empty($_SESSION['setcookie']) && !empty($_COOKIE['email'])){
            $_SESSION['setcookie'] = "yes";
        }
        $_SESSION['myrt4session'] = true;
        $_SESSION['email'] = $_COOKIE['email'];
        $apois = 1;
    }else{
        /* to logout */
        setcookie("email", "", time() - 3600, "/")or die("Gagal");
        /* Unset all of the session variables */
        $_SESSION = array("myrt4session");
        /* Destroy the session. */
        session_destroy();
    }

    if($apois == 1){
    $get = mysqli_query($conn, "SELECT * FROM used_browser WHERE email='$sesionemail' AND security_code='$brwco' AND browser='$browser' ")or die(mysqli_error($conn));
    $get_count = mysqli_num_rows($get);
    if($get_count == 0){
            setcookie("email", "", time() - 3600, "/")or die("Gagal");
            setcookie("wc", "", time() - 3600, "/")or die("Gagal");
            setcookie("brwco", "", time() - 3600, "/")or die("Gagal");
            setcookie("browser", "", time() - 3600, "/")or die("Gagal");
            setcookie("version", "", time() - 3600, "/")or die("Gagal");
            if(!isset($_SESSION)){
                session_start();
            }
            $_SESSION = array("myrt4session");
            session_destroy();
            current_url();
        }
    }
    mysqli_close($conn);
}
?>