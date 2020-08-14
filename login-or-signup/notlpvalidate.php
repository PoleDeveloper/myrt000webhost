<?php
include "../config/config.php";
if(isset($_POST['notlp'])){
    $notlp = $_POST['notlp'];
    $get_query = mysqli_query($conn, "SELECT * FROM users_account WHERE no_tlp='$notlp' ")or die(mysqli_error($conn));
    $count = mysqli_num_rows($get_query);
    if($count == 0){
        echo "0";
    }else{
        echo "1";
    }
}
?>