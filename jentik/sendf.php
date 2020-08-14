<?php
include "../config/config_all.php";

if(isset($_POST['submit'])){
    $isi = $_POST['isi'];
    if(!empty($isi)){
        /*create Jentik code*/
    $jentik_code2 = "J".date("HDsmYudiB")."C";
    /*date format code (([H] 24 fromat hour)[D] 3 letter of a day)([s] seconds 00-59)([m] Numeric Month 01-12)([Y] Four Digit Year)([d] day 01-31)([i] minute)([B] swacth internet Time)*/
        mysqli_query($conn, "INSERT INTO jentik_header(isi,jentik_code,jentik_code2) VALUES('$isi','$jentik_code_ac','$jentik_code2') ")or die(mysqli_error($conn));
    }
}
?>