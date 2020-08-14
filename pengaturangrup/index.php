<?php
include "../config/config_all.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengaturan Grup</title>
    <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css">
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
    <script src="../script/qrcode/jquery-qrcode-0.17.0.min.js"></script>
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
        <h1 style="text-align: center;">Pengaturan Grup</h1>
        <br><br><br>
        <div id="groupqrcode" style="width: 200px;margin: auto;">

        </div>
        <script>
        $("#groupqrcode").qrcode({
            render: "div",
            minVersion: 6,
            ecLevel: 'H',
            left: 0,
            top: 0,
            size: 200,
            fill: '#000',
            bacground: null,
            text: 'https://myrt4u.000webhostapp.com/joingroup.php?gq=<?php echo $grup_code_ac; ?>',
            radius: 0,
            quiet: 0,
            mode: 0,
            mSize: 0.1,
            mPosX: 0.5,
            mPosY: 0.5,
            label: 'no Label',
            fontname: 'sans',
            fontcolor: '#000',
            image: null
        });
        </script>
        <hr>
        <div style="text-align: center;">Scan QR Code Diatas Untuk Gabung Ke Dalam Group<br><br>ATAU<br><br><button onclick="sendshareviawa()" class="btn btn-success">Kirim Undangan Melalui Whatsapp</button></div>
    
        <script>
            function sendshareviawa(){
                top.window.location = "https://api.whatsapp.com/send?phone=" + "" + "&text=" + "https://myrt4u.000webhostapp.com/rtkugoonline/joingroup.php?gq=<?php echo $grup_code_ac; ?>";
            }
        </script>
        <br><br>
        <table style="width: 100%;">
            <tr>
                <td>Jalan</td>
                <td>:</td>
                <td><?php echo $jalan_gp; ?></td>
            </tr>
            <tr>
                <td>Rt</td>
                <td>:</td>
                <td><?php echo $rt_gp; ?></td>
            </tr>
            <tr>
                <td>Rw</td>
                <td>:</td>
                <td><?php echo $rw_gp; ?></td>
            </tr>
            <tr>
                <td>Kelurahan</td>
                <td>:</td>
                <td><?php echo $kelurahan_gp; ?>
            </tr>
            <tr>
                <td>Kecamatan</td>
                <td>:</td>
                <td><?php echo $kecamatan_gp; ?>
            </tr>
            <tr>
                <td>Kota</td>
                <td>:</td>
                <td><?php echo $kota_gp; ?></td>

            </tr>
        </table>
        <br><br><br>
        <div>
            <?php
                if($status_ac == "ketua"){
            ?>
                <button class="btn btn-dark">Ganti Ketua RT</button>
                <button class="btn btn-dark">Ganti Sekretaris</button>
                <button class="btn btn-dark">Ganti Bendahara</button>
                <button class="btn btn-dark">Keluarkan Anggota</button>
            <?php
                }
            ?>
            
        </div>

    </div>

</body>
</html>