<?php
include "../config/config_all.php";

$action = $_POST['action'];
$code = $_POST['code'];
$week = $_POST['week'];
$year = $_POST['year'];
$isi = $_POST['isi'];
$check_fjin = mysqli_query($conn, "SELECT * FROM jentik_inner WHERE minggu='$week' AND tahun='$year' AND jentik_code2='$code' AND jentik_code='$jentik_code_ac' ")or die(mysqli_error($conn));
$count_check_fjin = mysqli_num_rows($check_fjin);
if($count_check_fjin == 0){
/*action 1 */
mysqli_query($conn, "INSERT INTO jentik_inner(isi,minggu,tahun,status,jentik_code,jentik_code2) VALUES('$isi','$week','$year','$action','$jentik_code_ac','$code') ")or die(mysqli_error($conn));

$check_jen1 = mysqli_query($conn, "SELECT * FROM jentik_header WHERE jentik_code='$jentik_code_ac' ")or die(mysqli_error($conn));
$count_jen1 = mysqli_num_rows($check_jen1);
if($count_jen1 == 0){

}else{
    $erjn1 = array();
    $erjn2 = array();
    $errbtn1 = "";
    $check_jen2 = mysqli_query($conn, "SELECT * FROM jentik_inner WHERE minggu='$week' AND tahun='$year' AND jentik_code='$jentik_code_ac' ")or die(mysqli_error($conn));
    while($rj1 = mysqli_fetch_array($check_jen1)){
        $erjn1[] = $rj1['jentik_code2'];
    }
    while($rj2 = mysqli_fetch_array($check_jen2)){
        $erjn2[] = $rj2['jentik_code2'];
    }
    $result = array_diff($erjn1,$erjn2);
    if(empty($result)){
        $jhed = mysqli_query($conn, "SELECT * FROM jentik_header_week WHERE minggu='$week' AND tahun='$year' AND jentik_code='$jentik_code_ac' ")or die(mysqli_error($conn));
        $count_jhed = mysqli_num_rows($jhed);
        if($count_jhed == 0){
            mysqli_query($conn, "INSERT INTO jentik_header_week(minggu,tahun,status,jentik_code) VALUES('$week','$year','selesai','$jentik_code_ac') ")or die(mysqli_error($conn));
        }
?>
<script>
var seconds =5;
var url="../jentik/";

function redirect(){
 if (seconds <=0){
 // redirect to new url after counter  down.
  window.location = url;
 }else{
  seconds--;
  document.getElementById("pageInfo").innerHTML = "<h3 style='text-align: center;'>Berhasil<br><br>Mengalihkan Dalam<br> "+seconds+" Detik</h3>"
  setTimeout("redirect()", 1000)
 }
}
</script>
<div id="pageInfo">
    <script>
        redirect();
    </script>
</div>
<?php
    }
}
/*action 1*/
}else{
    mysqli_query($conn, "UPDATE jentik_inner SET status='$action' WHERE jentik_code='$code' AND minggu='$week' AND tahun='$year' AND jentik_code='$jentik_code_ac' ")or die(mysqli_error($conn));
}
?>