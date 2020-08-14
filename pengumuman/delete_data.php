<?php
include "../config/config_all.php";

$id = $_POST['id'];
mysqli_query($conn, "DELETE FROM pengumuman WHERE id='$id' AND pengirim='$user_code_ac' ")or die(mysqli_error($conn));
?>