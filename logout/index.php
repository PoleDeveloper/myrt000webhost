<?php
include "../config/config.php";
// Initialize the session
session_start();
 
// Unset all of the session variables
$_SESSION = array("myrt4session");

// Destroy the session.
session_destroy();

//redirect ke menu utama dan menghapus cookie
setcookie("email", "", time() - 3600, "/")or die("Gagal");
setcookie("wc", "", time() - 3600, "/")or die("Gagal");
setcookie("brwco", "", time() - 3600, "/")or die("Gagal");
setcookie("browser", "", time() - 3600, "/")or die("Gagal");
setcookie("version", "", time() - 3600, "/")or die("Gagal");
header("Location: ../");

?>