<?php
include "../../config/config_all.php";
$um_code = $_POST['c'];
$share = $_POST['share'];
$post = $_POST['post'];
mysqli_query($conn, "UPDATE umum SET share='$share', post='$post' WHERE um_code='$um_code' ")or die(mysqli_query($conn));
echo "<h1 style='text-align: center;'>Berhasil</h1>"
?>
<script>
var seconds =5;
var url="../";

function redirect(){
 if (seconds <=0){
 // redirect to new url after counter  down.
  window.location = url;
 }else{
  seconds--;
  document.getElementById("pageInfo").innerHTML = "<h3 style='text-align: center;'>Mengalihkan Dalam<br> "+seconds+" Detik</h3>"
  setTimeout("redirect()", 1000)
 }
}
</script>
<div id="pageInfo">
    <script>
        redirect();
    </script>
</div>