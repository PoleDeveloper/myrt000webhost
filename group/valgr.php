<?php
include "../config/config_all.php";

if(isset($_POST['text'])){
    $id = $_POST['attrkod'];
    $kode = $_POST['text'];

    if(empty($id) OR empty($kode)){
        echo "1";
    }else{
        $get = mysqli_query($conn, "SELECT * FROM grup WHERE grup_code='$id' ")or die("error");
        $get_count = mysqli_num_rows($get);
        if($get_count == 0){
            echo "4";
        }else if($get_count == 1){
            while($res = mysqli_fetch_array($get)){
                $res_kode = $res['access_code'];
                $grup_code = $res['grup_code'];
            }
            if($res_kode == $kode){
                mysqli_query($conn, "UPDATE users_account SET grup_code='$grup_code' WHERE user_code='$user_code_ac' ")or die("error");
                echo "0";
            }else{
                echo "1";
            }
        }else{
            echo "3";
        }
    }

    mysqli_close($conn);
}
?>