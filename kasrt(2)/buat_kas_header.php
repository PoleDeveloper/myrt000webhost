<?php
//coonection and database config
include "../../config/config.php";
//account configuration
session_start();
if(isset($_SESSION['rtonline.PLDV.session']) && $_SESSION['rtonline.PLDV.session'] === true){
    $email = $_SESSION['email'];
    $grup = $_SESSION['grup'];
}
if(empty($email)){
    header("location: ../../logout/");
}
//get data
$account_query = mysqli_query($conn, "SELECT * FROM users_account WHERE email LIKE '%$email%' ");
while($res = mysqli_fetch_array($account_query)){
    $user_code = $res['user_code'];
    $status = $res['status'];
    $grup = $res['grup'];
}
if(empty($status)){
    header("location: ../../group-login/");
}
//end account configuration

$nama = $_POST['nama'];
$created_at = getdate();
//create Grup code
$kas_code = "K".date("mHsDYdiuB")."C";
//date format code ([D] 3 letter of a day)([H] 24 fromat hour)([s] seconds 00-59)([m] Numeric Month 01-12)([Y] Four Digit Year)([d] day 01-31)([i] minute)([B] swacth internet Time)
$query = mysqli_query($conn, "INSERT INTO kas_header(nama,kas_code,grup_code) VALUES('$nama','$kas_code','$grup ') ")or die();

?>