<?php
if(empty($_SERVER['HTTP_REFERER'])){
    header("Location: http://localhost/");
}else{
    $link = $_SERVER["HTTP_REFERER"];
    if($link == "http://localhost/myrt000webhost/"){

    }else if($link == "https://localhost/myrt000webhost/"){

    }else if($link == "http://192.168.137.1/myrt000webhost/"){
        //delete this when you upload it

    }else{
        header("X-Frame-Options: DENY");
        header("Location: http://localhost/myrt000webhost/error/access_denied.html");
    }
}
?>