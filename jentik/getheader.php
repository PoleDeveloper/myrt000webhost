<?php
include "../config/config_all.php";

$jenquery = mysqli_query($conn, "SELECT * FROM jentik_header WHERE jentik_code='$jentik_code_ac' ORDER BY upload_date ASC")or die(mysqli_error($conn));
$count_jenquery = mysqli_num_rows($jenquery);
if($count_jenquery == 0){
    echo "Belum Ada List Tempat Penampungan Anda<br>Silahkan Membuat Dengan Mengisi Form Dibawah";
}else{
    echo "List Tempat Penampungan Saya : <br>";
    while($rjn = mysqli_fetch_array($jenquery)){
        echo "<div style='box-shadow: 0px 0px 5px black;margin: 10px 0px;padding: 3px 4px;'>
                <div>
                    ".$rjn['isi']."
                </div>
                <div style='text-align: right;'>
                    <button class='btn btn-danger' id='dltbtn' codeattr='".$rjn['id']."'>Hapus</button>
                </div>
              </div>";
    }
}
?>