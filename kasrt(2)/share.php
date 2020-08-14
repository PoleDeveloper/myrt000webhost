<?php
include "../config/config_all.php";

if(isset($_POST['kascode'])){
    $kascode = $_POST['kascode'];

    $get = mysqli_query($conn, "SELECT * FROM kas_header WHERE kas_code='$kascode' ")or die(mysqli_error($conn));
    $get_count = mysqli_num_rows($get);
    if($get_count != 0){
        while($res = mysqli_fetch_array($get)){
            $grup_kas_code = $res['grup_code'];
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css">
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
    <script src="../script/mobile/jquery.touchSwipe.min.js"></script>
    <script src="../script/qrcode/jquery-qrcode-0.17.0.min.js"></script>
<style>
.sharebody{
    font-size: 18px;
    color: white;
}
@media screen and (max-width: 520px){
    .sharebody{
        width: 95%;
        font-size: 16px;
    }
}
</style>
</head>
<body>

<div class="sharebody">

<div id="shareqrkas" style="width: 200px;margin: auto;">

</div>
<br>
<div style='font-color: white;text-align: center;'>Scan Kode QR di atas<br>atau<br>Bagikan Melalui</div>
<script>
$("#shareqrkas").qrcode({
    render: "div",
    minVersion: 6,
    ecLevel: 'H',
    left: 0,
    top: 0,
    size: 200,
    fill: '#000',
    bacground: null,
    text: 'https://myrt4u.000webhostapp.com/public/kasrt.php?a=<?php echo $kascode; ?>&b=<?php echo $grup_kas_code; ?>',
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
<br>
<div style='text-align: center;'>
    <div onclick="sendshareviawa();" class='btn btn-success'><img src='../system/icon/whatapps.ico' style="height: 35px;width: 35px;"> Whatsapp</div>
</div>
<script>
    function sendshareviawa(){
        top.window.location = "https://api.whatsapp.com/send?phone=" + "" + "&text=" + "https://myrt4u.000webhostapp.com/public/kasrt.php?a=<?php echo $kascode; ?>&b=<?php echo $grup_kas_code; ?>";
    }
</script>
</div>

</body>
</html>