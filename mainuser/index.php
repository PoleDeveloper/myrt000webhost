<?php
include "../config/config_all.php";
include "../config/config_loading.php";
if($session_status == "off"){
    header("Location: ../");
}
/*display on iframe if the link is same*/
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
<style>
.div_body{
    position: relative;
    width: 700px;
    margin: auto;
    padding: 0px 0px;
    box-shadow: 0px 0px 3px rgb(38, 38, 38);
}
.div_inner1{
    position: relative;
    background: url(../system/home_wallpaper.jpg)no-repeat;
    background-size: cover;
    background-position: center;
    position: relative;
    width: 100%;
    height: 200px;
}
.ac_pict{
    bottom: 10px;
    margin-left: 10px;
    position: absolute;
    width: 70px;
    height: 70px;
    border-radius: 100%;
    overflow: hidden;
}
.ac_txt{
    position: absolute;
    bottom: 10px;
    margin-left: 85px;
    width: 200px;
    font-size: 25px;
    color: white;
    text-shadow: 2px 2px black;
    word-break: break-all;
}
.div_inner2{
    padding: 2px 2px;
    overflow: hidden;
    overflow-y: hidden;
    overflow-x: auto;
    white-space: nowrap;
    position: relative;
    color: white;
}
.btn-mside{
    display: inline-block;
    background-color: #034f84;
}
#inputumum{
    height: 180px;
}

@media screen and (max-width: 710px){
    .div_body{
        width: 96%;
    }
    .div_inner1{
        height: 150px;
    }
}
</style>
</head>
<body>
    
<div class="div_body">

    <div class="div_inner1">
        <div class="prof">
            <div class="ac_pict" style="float: left;"><img style="width: 100%;height: 100%;" src="<?php
                if(empty($picture_ac)){
                    echo "../system/icon/user.png";
                }else{
                    echo $picture_ac;
                }
            ?>"></div>
            <div class="ac_txt" style="float: left;"><?php echo $nama_ac; ?></div>
        </div>
    </div>
    <div class="div_inner2">
        <a class="btn btn-mside" urlattr="mypost" id="mybps">Postingan Saya</a>
        <a class="btn btn-mside" >Gallery</a>
        <a class="btn btn-mside" urlattr="myset" id="mybps">Pengaturan Akun</a>
    </div>

    <div id="divinnerframe" srcattr='mypost'>

    </div>

    <script>
    $(document).on("click", "#mybps", function(){
        var url = $(this).attr("urlattr");
        var srcattr = $("#divinnerframe").attr("srcattr");
        if(url == "mypost"){
            if(url != srcattr){
                mypost();
                $("#divinnerframe").attr("srcattr", "mypost");
            }
        }else if(url == "myset"){
            if(url != srcattr){
                myset();
                $("#divinnerframe").attr("srcattr", "myset");
            }
        }
    });
    $(document).ready(function(){
        mypost();
    });
    function mypost(){
        $("#um_load").fadeIn();
        $.ajax({
            method:"post",
            url:"mypost.php",
            dataType:"text",
            success:function(data){
                $("#divinnerframe").html(data);
                $("#um_load").fadeOut();
            }
        });
    }
    function myset(){
        $("#um_load").fadeIn();
        $.ajax({
            method:"post",
            url:"myset.php",
            dataType:"text",
            success:function(data){
                $("#divinnerframe").html(data);
                $("#um_load").fadeOut();
            }
        });
    }
    </script>

<?php include "../config/config_loading2.php"; ?>

</div>

</body>
</html>