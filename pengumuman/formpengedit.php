<?php
include "../config/config_all.php";

if(isset($_POST['simpan'])){
    $id = $_POST['id'];
    $isi = $_POST['isi'];

    mysqli_query($conn, "UPDATE pengumuman SET isi='$isi' WHERE id='$id' AND pengirim='$user_code_ac' ")or die(mysqli_error($conn));
}
?>