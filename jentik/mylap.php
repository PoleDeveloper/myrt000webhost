<?php
include "../config/config_all.php";
include "../config/config_loading.php";

$yget = $_GET['year'];
if(empty($yget)){
    header("Location: index.php");
}else{
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
#btn{
    margin: 3px 0px;
    width: 350px;
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
@media screen and (max-width: 360px){
    #btn{
        width: 96%;
    }
}
</style>
</head>
<body>
    
<div class="divbody">
<h1 style='text-align: center;'><?php echo $yget; ?></h1>
<div style="text-align: center;">
    <?php
        $year_made = date("Y", strtotime($create_date_ac));
        $year_now = date("Y");
        $week_now = date("W");
        if($yget == $year_made AND $yget != $year_now){
            $minggu_start = date("W", strtotime($create_date_ac));
            for($xi = $minggu_start; $xi <= 53; $xi++){
                $mylap_query = mysqli_query($conn, "SELECT * FROM jentik_header_week WHERE minggu='$xi' AND tahun='$yget' and jentik_code='$jentik_code_ac' ")or die(mysqli_error($conn));
                $mylap_qcount = mysqli_num_rows($mylap_query);
                if($mylap_qcount == 0){
                    echo "<a href='isistat.php?week=".$xi."&year=".$yget."'><button class='btn btn-danger' id='btn'>
                            <h6 style='text-align: left;'>Minggu Ke - ".$xi."</h6>
                            <h6 style='text-align: right;'>Belum Selesai<br>Klik Untuk Menyelesaikan</h6>
                          </button></a><br>";
                }else{
                    while($rey = mysqli_fetch_array($mylap_query)){
                        echo "<a href='isistat.php?week=".$rey['minggu']."&year=".$yget."'><button class='btn btn-success' id='btn'>
                                <h6 style='text-align: left;'>Minggu Ke - ".$rey['minggu']."</h6>
                                <h6 style='float: right;'>Selesai</h6>
                              </button></a><br>";
                    }
                }
            }
        }else if($yget == $year_made AND $yget == $year_now){
            $minggu_start = date("W", strtotime($create_date_ac));
            for($xi = $minggu_start; $xi <= $week_now; $xi++){
                $mylap_query = mysqli_query($conn, "SELECT * FROM jentik_header_week WHERE minggu='$xi' AND tahun='$yget' and jentik_code='$jentik_code_ac' ")or die(mysqli_error($conn));
                $mylap_qcount = mysqli_num_rows($mylap_query);
                if($mylap_qcount == 0){
                    echo "<a href='isistat.php?week=".$xi."&year=".$yget."'><button class='btn btn-danger' id='btn'>
                            <h6 style='text-align: left;'>Minggu Ke - ".$xi."</h6>
                            <h6 style='text-align: right;'>Belum Selesai<br>Klik Untuk Menyelesaikan</h6>
                          </button></a><br>";
                }else{
                    while($rey = mysqli_fetch_array($mylap_query)){
                        echo "<a href='isistat.php?week=".$rey['minggu']."&year=".$yget."'><button class='btn btn-success' id='btn'>
                                <h6 style='text-align: left;'>Minggu Ke - ".$rey['minggu']."</h6>
                                <h6 style='float: right;'>Selesai</h6>
                              </button></a><br>";
                    }
                }
            }
        }else{
            $minggu_start = 1;
            for($xi = $minggu_start; $xi<=$week_now; $xi++){
                $mylap_query = mysqli_query($conn, "SELECT * FROM jentik_header_week WHERE minggu='$xi' AND tahun='$yget' and jentik_code='$jentik_code_ac' ")or die(mysqli_error($conn));
                $mylap_qcount = mysqli_num_rows($mylap_query);
                if($mylap_qcount == 0){
                    echo "<a href='isistat.php?week=".$xi."&year=".$yget."'><button class='btn btn-danger' id='btn'>
                            <h6 style='text-align: left;'>Minggu Ke - ".$xi."</h6>
                            <h6 style='text-align: right;'>Belum Selesai<br>Klik Untuk Menyelesaikan</h6>
                          </button></a><br>";
                }else{
                    while($rey = mysqli_fetch_array($mylap_query)){
                        echo "<a href='isistat.php?week=".$rey['minggu']."&year=".$yget."'><button class='btn btn-success' id='btn'>
                                <h6 style='text-align: left;'>Minggu Ke - ".$rey['minggu']."</h6>
                                <h6 style='float: right;'>Selesai</h6>
                              </button></a><br>";
                    }
                }
            }
            echo "c";
        }
    ?>
</div>

</div>

</body>
</html>
<?php
}
?>