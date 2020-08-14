<?php
include "../config/config_all.php";
$um_code = $_POST['um_code'];
$delum = mysqli_query($conn, "SELECT * FROM umum WHERE um_code='$um_code' AND user_code='$user_code_ac' ")or die(mysqli_error($conn));
while($res = mysqli_fetch_array($delum)){
    $gum_code = $res['gum_code'];
    $file_path = $res['file_path'];
    unlink("../umum/likes/".$user_code_ac."/like/".$res['um_code'].".xml");
    unlink("../umum/likes/".$user_code_ac."/likecode/".$res['um_code'].".xml");
    unlink("../umum/dislikes/".$user_code_ac."/dislike/".$res['um_code'].".xml");
    unlink("../umum/dislikes/".$user_code_ac."/dislikecode/".$res['um_code'].".xml");
}
$gum_code_arr = "";
$gamum = mysqli_query($conn, "SELECT * FROM gambar_umum WHERE gum_code='$gum_code' AND user_code='$user_code_ac' ")or die(mysqli_error($conn));
while($res2 = mysqli_fetch_array($gamum)){
    unlink("../umum/image".$res2['path']);
    unlink("../umum/thumbnail".$res2['path']);
    $gum_code_arr .= $res2['gum_code'].",";
}
$get_gum_code = explode(",",$gum_code_arr);
foreach($get_gum_code as $ggum){
    mysqli_query($conn, "DELETE FROM gambar_umum WHERE gum_code='$ggum' AND user_code='$user_code_ac' ")or die(mysqli_error($conn));
}
rmdir("../umum/image/".$user_code_ac."/".$file_path);
rmdir("../umum/thumbnail/".$user_code_ac."/".$file_path);
mysqli_query($conn, "DELETE FROM umum WHERE um_code='$um_code' AND user_code='$user_code_ac' ")or die(mysqli_error($conn));
?>