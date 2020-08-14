<?php
include "../config/config_all.php";

if(isset($_POST['position'])){
    $position = $_POST['position'];

    if($position == "ketua" OR $position == "sekretaris" OR $position == "bendahara" OR $position == "warga"){
        mysqli_query($conn, "UPDATE users_account SET status='$position' WHERE email='$email' AND user_code='$user_code_ac' ")or die("error");
    }else{
        echo "error";
    }
}else if(isset($_POST['back'])){
    mysqli_query($conn, "UPDATE users_account SET status='' WHERE email='$email' AND user_code='$user_code_ac' ")or die("error");
}else{
    echo "error";
}

mysqli_close($conn);
?>