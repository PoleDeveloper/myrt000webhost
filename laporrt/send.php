<?php
include "../config/config_all.php";

if(isset($_POST['submit'])){
    $isi = $_POST['isi'];
    if(!empty($isi)){
        mysqli_query($conn, "INSERT INTO laporrt(isi,pengirim,grup_code,konfirmasi) VALUES('$isi','$user_code_ac','$grup_code_ac','') ")or die(mysqli_error($conn));
    }
}
?>