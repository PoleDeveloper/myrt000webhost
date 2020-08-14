<?php
include "../config/config_all.php";

$w = $_GET['week'];
$y = $_GET['year'];

$output = $edit_stat = "";
$jhead = mysqli_query($conn, "SELECT * FROM jentik_header_week WHERE minggu='$w' AND tahun='$y' AND jentik_code='$jentik_code_ac' ")or die(mysqli_eror($conn));
$count_jhead = mysqli_num_rows($jhead);
if($count_jhead == 0){

$isia1 = array();
$isia2 = array();
$isi_query1 = mysqli_query($conn, "SELECT * FROM jentik_header WHERE jentik_code='$jentik_code_ac' ")or die(mysqli_error($conn));
while($rei1 = mysqli_fetch_array($isi_query1)){
    $isia1[] = $rei1['jentik_code2'];
}
$isi_query2 = mysqli_query($conn, "SELECT * FROM jentik_inner WHERE minggu='$w' AND tahun='$y' AND jentik_code='$jentik_code_ac' ")or die(mysqli_error($conn));
while($rei2 = mysqli_fetch_array($isi_query2)){
    $isia2[] = $rei2['jentik_code2'];
}
$isiaf = array_diff($isia1,$isia2);
if(!empty($isiaf)){
    foreach($isiaf as $reif){
        $isiao = mysqli_query($conn, "SELECT * FROM jentik_header WHERE jentik_code2='$reif' ")or die(mysqli_error($conn));
        while($rei3 = mysqli_fetch_array($isiao)){
            $output .= "<tr id='".$rei3['jentik_code2']."'>
                            <td class='td1'>".$rei3['isi']."</td>
                            <td class='td2'>
                                <button class='btn btn-danger' id='btnac' attrisi='".$rei3['isi']."' acattr='ada' codeattr='".$rei3['jentik_code2']."'>Ada</button>
                                <button class='btn btn-success' id='btnac' attrisi='".$rei3['isi']."' acattr='tidak' codeattr='".$rei3['jentik_code2']."'>Tidak Ada</button>
                            </td>
                       </tr>";
        }
    }
}else{
    $output .= "<div style='text-align: center;'><h4>Silahkan Membuat List Penampungan Terlebih Dahulu</h4>
                <a href='list_penampungan.php'><button style='font-size: 20px;' class='btn btn-link'>Klik Untuk Membuat<br>List Penampungan</button></a></div>";
}

}else{
    $edit_stat = 1;
    $output .= "Laporan Selesai";
    $isiao = mysqli_query($conn, "SELECT * FROM jentik_inner WHERE minggu='$w' AND tahun='$y' AND jentik_code='$jentik_code_ac' ")or die(mysqli_error($conn));
    while($rei1 = mysqli_fetch_array($isiao)){
        $output .= "<tr>
                        <td>".$rei1['isi']."</td>
                        <td>".$rei1['status']."<br></td>
                        <td style='display: none;'>
                            <button class='btn btn-danger' id='btnac' attrisi='".$rei1['isi']."' acattr='ada' codeattr='".$rei1['jentik_code2']."'>Ada</button>
                            <button class='btn btn-success' id='btnac' attrisi='".$rei1['isi']."' acattr='tidak' codeattr='".$rei1['jentik_code2']."'>Tidak Ada</button>
                        </td>
                    </tr>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css">
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
    <script src="../script/jquery/jquery.form.js"></script>
<style>
html,
body{
    font-family: arial;
}
.divbody{
    position: relative;
    width: 600px;
    margin: auto;
}
.td1{
    width: 60%;
}
.td2{
    width: 40%;
}
.btn{
    margin: 2px;
}
@media screen and (max-width: 610px){
    .divbody{
        width: 96%;
    }
    .btn{
        width: 90%;
    }
}
</style>
</head>
<body>
<div class="divbody">
    <h1 style="text-align: center;">Laporan Jentik</h1>
    <h5>Minggu Ke <?php echo $w; ?>, <?php echo $y; ?></h5>
    <br>

    <table class="table">
        <?php echo $output; ?>
    </table>
    <?php 
        if(!empty($edit_stat)){
            echo "<button style='width: 100%;' id='btned' class='btn btn-primary'>Edit</button>";
        }
    ?>
            <div id="selesai"></div>
<script>
$(document).on("click", "#btnac", function(){
        var action = $(this).attr("acattr");
        var code = $(this).attr("codeattr");
        var isi = $(this).attr("attrisi");
        $(this).html("Loading");
        $.ajax({
            method:"post",
            url:"isistataction.php",
            data:{action:action,
                 code:code,
                 isi:isi,
                 week:"<?php echo $w; ?>",
                 year:"<?php echo $y; ?>"},
        dataType:"text",
        success:function(data){
            $("#"+code).fadeOut();
            $("#selesai").append(data);
        }
    });
});
$(document).on("click", "#btned", function(){

});
</script>
</div>
</body>
</html>