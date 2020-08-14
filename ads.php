<?php
include "config/config.php";

$ads_get = mysqli_query($conn, "SELECT * FROM ads ORDER BY display ASC LIMIT 1")or die(mysqli_error($conn));
$ads_count = mysqli_num_rows($ads_get);
if($ads_count == 0){
    echo "<div style='color: white;background-color: #3e4444;padding: 5px 3px'><div style='text-align: center;'>Mau Pasang Iklan Disini???</div> <div style='text-align: center;'>Klik</div> <div style='text-align: center;'><a href=''><button class='btn btn-success'>Pasang Iklan</button></a></div></div>";
}else{
    while($red = mysqli_fetch_array($ads_get)){
        echo "<div style='margin: 5px; 5% 5px 5%;'><a href='".$red['link']."'><img style='width: 100%;' src='".$red['path']."'></a></div>";
        $display = $red['display'];
        $id = $red['id'];
    }
    $displaynew = $display+1;
    mysqli_query($conn, "UPDATE ads SET display='$displaynew' WHERE id='$id' ")or die(mysqli_error($conn));
}
?>