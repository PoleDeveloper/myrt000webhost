<?php
include "../../config/config_all.php";
$path = $_POST['path'];
$id = $_POST['id'];
unlink("../../umum/image".$path);
unlink("../../umum/thumbnail".$path);
mysqli_query($conn, "DELETE FROM gambar_umum WHERE path='$path' AND user_code='$user_code_ac' ")or die(mysqli_error($conn));
?>