<?php
    include_once "../config/config_all.php";

    $output = "";
    $today = date("Y-m-d");
    $get_fam = mysqli_query($conn, "SELECT * FROM users_account WHERE grup_code='$grup_code_ac' ")or die(mysqli_error($conn));
    while($rgf = mysqli_fetch_array($get_fam)){
        $output .= "<table>
                    <tr>
                        <td COLSPAN=3><img style='border-radius: 100%;box-shadow: 0px 0px 2px black;' class='img_acc' src='";
                    if(empty($rgf['account_picture'])){
                        $output .= "../system/icon/user.png";
                    }else{
                        $output .= $rgf['account_picture'];
                    }
        $output .= "'></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>".ucwords($rgf['nama'])."</td>
                    </tr>
                    <tr>
                        <td>Umur</td>
                        <td>:</td>
                        <td>";
                        $birth = new DateTime($rgf['tanggal_lahir']);
                        $today = new DateTime();
                        
                        $diffbirth = $today->diff($birth);
        $output .=      $diffbirth->y;
        $output .=  "    Tahun</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>".$rgf['alamat']."</td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon</td>
                        <td>:</td>
                        <td>".$rgf['no_tlp']."</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>".$rgf['email']."</td>
                    </tr>
                    </table>";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Kependudukan</title>
    <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css">
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
    <script src="../script/jquery/jquery.form.js"></script>
<style>
body,
html{
    font-family: arial;
    word-break: break-word;
}
.divbody{
    position: relative;
    width: 600px;
    margin: auto;
}
table{
    width: 100%;
    margin-bottom: 15px;
    box-shadow: 0px 3px 1px #999999;
}
.img_acc{
    width: 70px;
    height: 70px;
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
    <h1 style='text-align: center;'>Data Kependudukan</h1>
    <h4 style='text-align: center;'><?php echo $jalan_gp; ?> Rt.<?php echo $rt_gp; ?>, Rw.<?php echo $rw_gp; ?></h4>
    <h4 style='text-align: center;'><?php echo $kelurahan_gp; ?>, <?php echo $kecamatan_gp; ?>, <?php echo $kota_gp; ?></h4>

    <br><br><br>

    <div style="width: 100%;">
        <?php echo $output; ?>
    </div>
</div>

</body>
</html>