<?php
include "../config/config_all.php";
    if(isset($_POST['submit'])){
        $isi = $_POST['isi'];
        $ps_code = date("sDHmYdiB")."ps".date("u");
        mysqli_query($conn, "INSERT INTO pengajuan_surat_header(isi,grup_code,ps_code) VALUES('$isi','$grup_code_ac','$ps_code') ")or die(mysqli_error($conn));
    }
    echo "a";
?>