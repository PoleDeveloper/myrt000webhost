<?php
include "../config/config_all.php";

if(empty($jentik_code_ac)){
    header("Location: start.php");
}
$year_now = date("Y");
$week_now = date("W");
if($week_now < 10){
    $week_now = str_replace("0","",$week_now);
}
$errbtn1 = "";
$check_jen1 = mysqli_query($conn, "SELECT * FROM jentik_header WHERE jentik_code='$jentik_code_ac' ")or die(mysqli_error($conn));
$count_jen1 = mysqli_num_rows($check_jen1);
if($count_jen1 == 0){
    $errbtn1 = "<h4>Silahkan Membuat List Penampungan Terlebih Dahulu</h4>
                <a href='list_penampungan.php'><button style='font-size: 20px;' class='btn btn-link'>Klik Untuk Membuat<br>List Penampungan</button></a>";
}else{
    $jenhw = mysqli_query($conn, "SELECT * FROM jentik_header_week WHERE minggu='$week_now' AND tahun='$year_now' AND jentik_code='$jentik_code_ac' ")or die(mysqli_error($conn));
    $count_jenhw = mysqli_num_rows($jenhw);
    if($count_jenhw == 0){
        $erjn1 = array();
        $erjn2 = array();
        $check_jen2 = mysqli_query($conn, "SELECT * FROM jentik_inner WHERE minggu='$week_now' AND tahun='$year_now' AND jentik_code='$jentik_code_ac' ")or die(mysqli_error($conn));
        while($rj1 = mysqli_fetch_array($check_jen1)){
            $erjn1[] = $rj1['jentik_code'];
        }
        while($rj2 = mysqli_fetch_array($check_jen2)){
            $erjn2[] = $rj2['jentik_code'];
        }
        $result = array_diff($erjn1,$erjn2);
        if(!empty($result)){
            $errbtn1 = "<h4 class='text-danger'>Laporan Minggu Ke ".$week_now.", ".$year_now."<br> Belum Selesai!!</h4><a href='isistat.php?week=".$week_now."&year=".$year_now."'><button class='btn btn-danger'>Klik Untuk Menyelesaikan<br>Laporan Minggu Ke- ".$week_now."</button></a>";
        }else{
            $errbtn1 = "<h4 class='text-success'>Laporan Minggu Ke ".$week_now."<br> Sudah Selesai</h4>";
        }
    }else{
        $errbtn1 = "<h4 class='text-success'>Laporan Minggu Ke ".$week_now."<br> Sudah Selesai</h4>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jentik</title>
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
@media screen and (max-width: 610px){
    .divbody{
        width: 96%;
    }
}
</style>
</head>
<body>

<div class="divbody">
    <h1 style="text-align: center;">Jentik</h1>
    <br>
        <p><b>Perhatian</b> penanggalan disini menggunakan tipe penanggalan ISO 8601, Untuk mengetahui lebih lajut klik link dibawah</p>
        <div style='text-align: center;'><a href="../bantuan/penanggalaniso.html"><button class='btn btn-link'>Pelajari Penanggalan ISO</button></a></div>
    <br>
    <br>
    <a href="list_penampungan.php"><button class="btn btn-primary">List Penampungan Saya</button></a>
    <br><br>
    <div style="padding: 10px 0px;text-align: center;">
        <?php echo $errbtn1; ?>
    </div>
    <br><br><br>
    <div>
    <h4>Laporan Saya</h4>
    <?php
        $tahun_start = date("Y", strtotime($create_date_ac));
        for($xt = $tahun_start; $xt<=$year_now; $xt++){
            echo "<a href='mylap.php?year=$xt'><button style='width: 100%;font-size: 25px;background-color: #36486b;color: white;' class='btn'>Tahun ".$xt."</button></a>";
        }
    ?>
    </div>

</body>
</html>