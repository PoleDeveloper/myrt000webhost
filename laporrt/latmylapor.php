<?php
include "../config/config_all.php";

$mylap_query = mysqli_query($conn, "SELECT * FROM laporrt WHERE pengirim='$user_code_ac' ORDER BY upload_date DESC LIMIT 1 ")or die(mysqli_error($conn));
$mylap_count = mysqli_num_rows($mylap_query);
if($mylap_count == 0){
    echo "Tidak Ada Laporan Lagi";
}else{
    while($rml = mysqli_fetch_array($mylap_query)){
        echo "<div class='rml' id='".$rml['id']."'>".date("l, d F Y",strtotime($rml['upload_date']))."<br>";
        if(empty($rml['konfirmasi'])){
            echo "<a id='t".$rml['id']."'>Menunggu Konfirmasi</a>";
        }else{
            echo "Telah Dikonfirmasi";
        }
        echo "<hr>".nl2br($rml['isi'])."<br><br>
                <div style='text-align: right;'>";
            if($status_ac == "ketua"){
                if(empty($rml['konfirmasi'])){
                    echo "<div id='k".$rml['id']."'><button class='btn btn-success' id='konbtn' idattr='".$rml['id']."' >Konfirmasi</button></div>";
                }
            }else{
                echo "<button class='btn btn-danger' id='dltbtn' idattr='".$rml['id']."'>Hapus</button> ";
                if(empty($rml['konfirmasi'])){
                    echo "<button class='btn btn-dark' id='editbtn' idattr='".$rml['id']."'>Ubah</button>";
                }
            }
        echo "</div></div>";
    }
}
?>