<?php
include "../config/config_all.php";

$jc = $_POST['jc'];
if(empty($jc)){
    $jentik_code = "J".date("HDsmYdiBu")."C";
    mysqli_query($conn, "UPDATE users_account SET jentik_code='$jentik_code' WHERE user_code='$user_code_ac' ")or die(mysqli_error($conn));
}else{
    $jc = $_POST['jc'];
    mysqli_query($conn, "UPDATE users_account SET jentik_code='$jc' WHERE user_code='$user_code_ac' ")or die(mysqli_error($conn));
}
?>