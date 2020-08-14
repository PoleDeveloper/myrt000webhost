<?php
include "../config/config.php";
function checkuscode($conn,$nama,$email,$param_password,$dates,$jkl,$no_tlp,$valc){
    //create user code
    $keylenght = 20;
    $str = "1234567890avcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $randstr = substr(str_shuffle($str), 0, $keylenght);
    $user_code = date("HsmYdiBu")."pc".$randstr.str_shuffle(date("D"));
    //date format code ([D] 3 letter of a day)([H] 24 fromat hour)([s] seconds 00-59)([m] Numeric Month 01-12)([Y] Four Digit Year)([d] day 01-31)([i] minute)([B] swacth internet Time)
    $check_uscode = mysqli_query($conn, "SELECT * FROM users_account WHERE user_code='$user_code' ")or die(mysqli_error($conn));
    $count_check_uscode = mysqli_num_rows($check_uscode);
    if($count_check_uscode == 0){
        mysqli_query($conn, "UPDATE users_account SET nama='$nama', password='$param_password', tanggal_lahir='$dates', jenis_kelamin='$jkl', no_tlp='$no_tlp', user_code='$user_code', status='', account_picture='' WHERE account_picture='$valc' AND email='$email' ")or die(mysqli_error($conn));
    }else{
        checkuscode();
    }
}

if(isset($_POST['cac'])){
    if($_POST['cac'] == "yes"){

        /* get all post data s */
        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $tgl_lahir = $_POST['tgl_lahir'];
        $no_tlp = $_POST['no_tlp'];
        $jkl = $_POST['jkl'];
        $valc = $_POST['valc'];
        /* get all post e */

        /* param password */
        $param_password = password_hash($password, PASSWORD_BCRYPT);
        /* strtotime */
        $dates = date("Y-m-d", strtotime($tgl_lahir));

        $date_now = date("Y-m-d");
        $create_datenow = date("Y-m-d H:i:s");

        $get_query = mysqli_query($conn, "SELECT * FROM users_account WHERE email='$email' ")or die(mysqli_error($conn));
        while($res = mysqli_fetch_array($get_query)){
            $valcg = $res['account_picture'];
            $create_date = date("Y-m-d", strtotime($res['create_date']));
        }
        $countget = mysqli_num_rows($get_query);
        if($countget == 0){
            echo "error";
        }else{
            if($valcg == $valc){
                echo "0";
                checkuscode($conn,$nama,$email,$param_password,$dates,$jkl,$no_tlp,$valc);
            }else{
                echo "errorval";
            }
        }

    }
}else{
    function generatekey(){
        /* generate random string */
        $keylenght = 20;
        $str = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_";
        $randstr = substr(str_shuffle($str), 0, $keylenght);
        return $randstr." [] ".str_shuffle($str);
    }
}

mysqli_close($conn);
?>