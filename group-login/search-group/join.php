<?php
//coonection and database config
include "../../config/config.php";

//account configuration
sleep(1);
session_start();
if(isset($_SESSION['myrt4session']) && $_SESSION['myrt4session'] === true){
    $email = $_SESSION['email'];
}
//end account configuration

if(isset($_POST['grup'])){
    $grup = $_POST['grup'];
    $email = $_SESSION['email'];

    $query = mysqli_query($conn, "SELECT * FROM grup WHERE grup_code='$grup' ");
    $query_count = mysqli_num_rows($query);
    if($query_count == 0){
        echo "Error";
    }else if($query_count == 1){
        $update_query = mysqli_query($conn, "UPDATE users_account SET grup_code='$grup' WHERE email LIKE '%$email%' ")or die("gagal");
    }else{
        echo "Error";
    }
}

?>