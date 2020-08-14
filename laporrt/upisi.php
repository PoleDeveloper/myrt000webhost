<?php
include "../config/config_all.php";
$id = $_POST['id'];
$upisi_query = mysqli_query($conn, "SELECT * FROM laporrt WHERE id='$id' AND pengirim='$user_code_ac' ")or die(mysqli_error($conn));
while($rup = mysqli_fetch_array($upisi_query)){
    echo "( Berhasil Di Ubah )<br>".$rup['isi']."";
}
?>