<?php
include "../config/config_all.php";

$output = "";
$check_kk = mysqli_query($conn, "SELECT * FROM users_account WHERE no_kk='$no_kk_ac' AND grup_code='$grup_code_ac' AND user_code!='$user_code_ac' ")or die(mysqli_error($conn));
$count_check_kk = mysqli_num_rows($check_kk);
if($count_check_kk == 0){

    /*create Jentik code*/
    $jentik_code_create = "J".date("DHsmYdiBu")."C";
    /*date format code ([D] 3 letter of a day)([H] 24 fromat hour)([s] seconds 00-59)([m] Numeric Month 01-12)([Y] Four Digit Year)([d] day 01-31)([i] minute)([B] swacth internet Time)*/
    mysqli_query($conn, "UPDATE users_account SET jentik_code='$jentik_code_create' WHERE user_code='$user_code_ac' ")or die(mysqli_error($conn));
    header("Location: index.php");

}else{
    while($rek = mysqli_fetch_array($check_kk)){
        $output .= "<div class='divlist' id='btnljen' attrcode='".$rek['jentik_code']."' avaliable='0'>
                    <a><img style='height: 70px;width: 70px;' src='".$rek['account_picture']."'></a>
                    <a style='display: inline-block;'>".$rek['nama']."</a>
                    </div>";
        $yabtn = "<button onclick='choose();' id='btnljen' attrcode='".$rek['jentik_code']."' avaliable='1' class='btn btn-success'>YA</button>";
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
    text-align: center;
}
.divlist{
    width: 90%;
    margin: auto;
    padding: 5px 3px;
    text-align: left;
    box-shadow: 0px 0px 5px grey;
}
.btn{
    width: 300px;
    margin: 5px 0px;
}
p{
    font-size: 18px;
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
    <h1 style="text-align: center;">Pemeriksaan Jentik</h1>

    <br>
    <p id="toptext">Apakah Anda Mengenal Orang - Orang Dibawah Ini?</p>
    <br>
    <div id="outputdiv">
        <?php echo $output; ?>
    </div>
    <br>
    <p id="bottomtext">Apakah Anda Tinggal Serumah Dengan Orang - Orang Di Atas?</p>
    <div id="btnlist" style="text-align: center;"><button onclick="choose();" class="btn btn-default">Ada Beberapa Yang Tidak</button><br><button onclick="btnjen();" class='btn btn-danger'>Tidak</button><br><?php echo $yabtn; ?></div>
    <script>
        function choose(){
            $(".divlist").attr("avaliable", "1");
            $("#btnlist").fadeOut();
            $("#toptext").html("Silahkan Klik Salah Satu Orang Atau Keluarga Anda Yang Tinggal Serumah Dengan Anda");
            $("#bottomtext").html(" ");
        }
        $(document).on("click", "#btnljen", function(){
            var avaliable = $(this).attr("avaliable");
            var jcok = $(this).attr("attrcode");
            $("#toptext").fadeOut();
            $("#outputdiv").fadeOut().html("<img src='../system/icon/loading.gif' style='width: 50px;height: 50px;'><h3>Memproses</h3>").fadeIn();
            if(avaliable == 1){
                $.ajax({
                    method:"post",
                    url:"startac.php",
                    dataType:"text",
                    data:{jc:jcok},
                    success:function(data){
                        $("#toptext").fadeOut();
                        $("#outputdiv").html("Mengalihkan Harap Tunggu Sebentar");
                        window.location = "index.php";
                    }
                });
            }
        });
        function btnjen(){
            $("#toptext").fadeOut();
            $("#outputdiv").fadeOut().html("<img src='../system/icon/loading.gif' style='width: 50px;height: 50px;'><h3>Memproses</h3>").fadeIn();
            $.ajax({
                method:"post",
                url:"startac.php",
                dataType:"text",
                success:function(data){
                    $("#toptext").fadeOut();
                    $("#outputdiv").html("Mengalihkan Harap Tunggu Sebentar");
                    window.location = "index.php";
                }
            });
        }
    </script>

    <br><br><br>
    <div style="text-align: left;"><button style="width: 90px;" class="btn btn-link">Bantuan</button></div>
</div>

<br><br>
</body>
</html>