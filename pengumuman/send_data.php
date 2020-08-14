<?php
include "../config/config_all.php";

if(isset($_POST['simpan'])){
    $isi = $_POST['isi'];
    if(!empty($isi)){
        mysqli_query($conn, "INSERT INTO pengumuman(isi,pengirim,grup_code) VALUES('$isi','$user_code_ac','$grup_code_ac') ")or die(mysqli_error($conn));
    }
}

?>