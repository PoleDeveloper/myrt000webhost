<?php
include "../config/config_all.php";

if(isset($_POST['action'])){
    $action = $_POST['action'];
    $id = $_POST['id'];
        mysqli_query($conn, "DELETE FROM laporrt WHERE id='$id' AND pengirim='$user_code_ac' ")or die(mysqli_error($conn));
}else if(isset($_POST['edit'])){
    $id = $_POST['id'];
    $isi = $_POST['isi'];
    mysqli_query($conn, "UPDATE laporrt SET isi='$isi' WHERE id='$id' AND pengirim='$user_code_ac' ")or die(mysqli_error($conn));
}
?>