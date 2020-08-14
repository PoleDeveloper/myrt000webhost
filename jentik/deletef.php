<?php
include "../config/config_all.php";

$id = $_POST['id'];
mysqli_query($conn, "DELETE FROM jentik_header WHERE jentik_code='$jentik_code_ac' AND id='$id' ")or die(mysqli_error($conn));
?>