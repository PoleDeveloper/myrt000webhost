<?php
include "../config/config_all.php";

$id = $_POST['id'];
mysqli_query($conn, "UPDATE laporrt SET konfirmasi='ya' WHERE id='$id' AND grup_code='$grup_code_ac' ")or die(mysqli_error($conn));
?>