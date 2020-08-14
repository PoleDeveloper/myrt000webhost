<?php
include "../config/config_all.php";

$ganti = $_POST['ganti'];
$user_code = $_POST['uc'];

if($status_ac == "ketua"){
    mysqli_query($conn, "UPDATE users_account SET status='warga' WHERE status='$ganti' AND grup_code='$grup_code_ac' ")or die(mysqli_error($conn));
    mysqli_query($conn, "UPDATE users_account SET status='$ganti' WHERE user_code='$user_code' AND grup_code='$grup_code_ac' ");
}else if($status_ac == "sekretaris"){
    mysqli_query($conn, "UPDATE users_account SET status='warga' WHERE status='sekretaris' AND grup_code='$grup_code_ac' ")or die(mysqli_error($conn));
    mysqli_query($conn, "UPDATE users_account SET status='sekretaris' WHERE user_code='$user_code' AND grup_code='$grup_code_ac' ");
}
?>