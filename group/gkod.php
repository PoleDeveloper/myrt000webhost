<?php
include "../config/config_all.php";

if(isset($_POST['id'])){
    $kode = $_POST['id'];
    $access_code = "";
    $get = mysqli_query($conn, "SELECT * FROM grup WHERE grup_code='$kode' ")or die("error");
    $count = mysqli_num_rows($get);
    if($count == 0){
        echo "3";
    }else{
        while($res = mysqli_fetch_array($get)){
            $access_code = $res['access_code'];
            $grup_code = $res['grup_code'];
        }
        if(empty($access_code)){
            mysqli_query($conn, "UPDATE users_account SET grup_code='$grup_code' WHERE user_code='$user_code_ac' ")or die("error");
            echo "0";
        }else{
            echo "1";
        }
    }
    mysqli_close($conn);
}
?>