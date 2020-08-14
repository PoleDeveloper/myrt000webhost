<?php
include "../config/config_all.php";
$ganti = "";
$ganti2 = "";
if(isset($_GET['g'])){

    $ganti = $_GET['g'];

    if($ganti == "ketua"){
        $ganti = "Ketua Rt";
        $ganti2 = "ketua";
    }else if($ganti == "sekretaris"){
        $ganti = "Sekretaris";
        $ganti2 = "sekretaris";
    }else if($ganti == "bendahara"){
        $ganti = "Bendahara";
        $ganti2 = "bendahara";
    }else{
        header("Location: index.php");
    }

}else{
    header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ganti <?php echo $ganti; ?></title>
    <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css">
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
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
        <h1 style="text-align: center;">Ganti <?php echo $ganti; ?></h1>
        <br><br>
        <div>
            Pilih Salah Satu Anggota Yang Akan Dijadikan <?php echo $ganti; ?> Berikutnya
        </div>
        <hr>

        <div id="output">

        </div>
    </div>

<script>
    $(document).ready(function(){
        $.ajax({
            method:"post",
            url:"gantiget.php",
            data:{
                ganti:"<?php echo $ganti ?>"
            },
            dataType:"text",
            success:function(data){
                $("#output").html(data);
            }
        });
    });
    $(document).on("click", "#btnganti", function(){
        ganti2 = "<?php echo $ganti2; ?>";
        uc = $(this).attr("attruc");
        var dataga = "";
        if(ganti2 == "ketua"){
            dataga = "ketua";
        }else if(ganti2 == "sekretaris"){
            dataga = "sekretaris";
        }else if(ganti2 == "bendahara"){
            dataga = "bendahara";
        }
        $("#output").html(uc+" "+dataga);
        $.ajax({
            method:"post",
            url:"gantiac.php",
            data:{
                ganti:dataga,
                uc:uc
            },
            dataType:"text",
            success:function(data){

            }
        });
    });
</script>
</body>
</html>