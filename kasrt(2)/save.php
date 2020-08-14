<?php
include "../config/config_all.php";
$kascode = $_POST['kascode'];
echo "<a href='saveas.php?action=excel&kascode=".$kascode."' ><button class='btn btn-light'>Download Excel</button></a>";
    echo "<a href='saveas2.php?action=word&kascode=".$kascode."' ><button class='btn btn-light'>Download Word</button></a>";
/* use when you have grup_tipe declaration
if($grup_tipe == "1"){
    echo "<div style='text-align: justify;'><h1>Maaf</h1>Silahkan upgrade Tipe Grup Anda Menjadi ( Regular ) atau ( Lite ) Untuk Dapat Mendownload File</div>";
}else if($grup_tipe == "2" OR $grup_tipe == "3" & $deadline>=$today_date){
    echo "<a href='saveas.php?action=excel&kascode=".$kascode."' ><button class='btn btn-light'>Download Excel</button></a>";
    echo "<a href='saveas2.php?action=word&kascode=".$kascode."' ><button class='btn btn-light'>Download Word</button></a>";
}
if($grup_tipe == "3" & $deadline<$today_date){
    echo "<h1>Maaf</h1>Maaf Masa Langanan Grup Anda ( Lite ) Sudah Berakhir Silahkan Melakukan Perpanjangan atau Downgrade Tipe Grup Anda Menjadi ( Regular )";
}
*/
?>