<?php
include "../config/config.php";

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $emailbef = $_POST['emailbef'];
    $valc = $_POST['valc'];
    $date_now = date("Y-m-d");
    $create_datenow = date("Y-m-d H:i:s");
    $get_query = mysqli_query($conn, "SELECT * FROM users_account WHERE email='$email' ")or die(mysqli_error($conn));
    while($res = mysqli_fetch_array($get_query)){
        if($res['status'] == "reserved"){
            if(!empty($emailbef)){
                mysqli_query($conn, "DELETE FROM users_account WHERE email='$emailbef' ")or die(mysqli_error($conn));
            }
        }
        $create_date = date("Y-m-d", strtotime($res['create_date']));
    }
    $countget = mysqli_num_rows($get_query);
        if($countget == 0){
            echo "0";
            mysqli_query($conn, "INSERT INTO users_account(nama,email,password,no_kk,jenis_kelamin,no_tlp,alamat,rt,rw,status,user_code,grup_code,persetujuan,tempat_lahir,tanggal_lahir,jentik_code,account_picture,display_mode,web_code) VALUES ('reserved','$email','','','','','','','','reserved','','','','','','','$valc','light','')")or die(mysqli_error($conn));
        }else{
            if($create_date < $date_now){
                echo "0";
                mysqli_query($conn, "UPDATE users_account SET create_date='$create_datenow' WHERE email='$email' ")or die(mysqli_error($conn));
            }else{
                echo "1";
            }
        }
}

mysqli_close($conn);
?>