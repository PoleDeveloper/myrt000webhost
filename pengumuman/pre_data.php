<?php
include "../config/config_all.php";

$preq = mysqli_query($conn, "SELECT * FROM pengumuman WHERE pengirim='$user_code_ac' AND grup_code='$grup_code_ac' ORDER BY date DESC LIMIT 1 ")or die(mysqli_error($conn));
while($rpre = mysqli_fetch_array($preq)){
    echo "<div class='divget' id='".$rpre['id']."'>
            <div class='divget_a'>
                ".date("l, d F Y", strtotime($rpre['date']))."
            </div>
            <hr>
            <div class='divget_b'>
                ".nl2br($rpre['isi'])."
            </div>";
        if($rpre['pengirim'] == $user_code_ac){
            echo "<div style='text-align: right;'><button id='editbtn' idattr='".$rpre['id']."' class='btn btn-info'>Edit</button> <button id='dltbtn' idattr='".$rpre["id"]."' class='btn btn-danger'>Hapus</button></div>";
        }
    echo  "</div>";
    $id = $rpre['id'];
}
?>