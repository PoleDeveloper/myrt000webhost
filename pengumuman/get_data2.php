<?php
include "../config/config_all.php";
$id = $_POST['id'];
$gdt2 = mysqli_query($conn, "SELECT * FROM pengumuman WHERE id='$id' AND grup_code='$grup_code_ac' ")or die(mysqli_error($conn));
while($rgd2 = mysqli_fetch_array($gdt2)){
    echo "<div class='divget_a'>
                ".date("l, d F Y", strtotime($rgd2['date']))."
            </div>
            <hr>
            <div class='divget_b'>
                ".nl2br($rgd2['isi'])."
            </div>";
        if($rgd2['pengirim'] == $user_code_ac){
            echo "<div style='text-align: right;'><button id='editbtn' idattr='".$rgd2['id']."' class='btn btn-info'>Edit</button> <button id='dltbtn' idattr='".$rgd2["id"]."' class='btn btn-danger'>Hapus</button></div>";
        }
}
?>