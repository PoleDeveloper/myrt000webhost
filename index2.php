<?php
include "config/config_all.php";
/*deny to open iside iframe*/
header("X-Frame-Options: DENY");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyRt</title>
    <link rel="stylesheet" href="script/bootstrap/css/bootstrap.min.css">
    <script src="script/jquery/jquery.js"></script>
    <script src="script/bootstrap/js/bootstrap.min.js"></script>
<style>
body,
html{
    font-family: arial;
}
.top_header{
    position: absolute;
    top: 0px;
    right: 0px;
    left: 0px;
    background-color: #333333;
    height: 50px;
}
.divbody{
    position: fixed;
    top: 50px;
    right: 0px;
    left: 0px;
    bottom: 0px;
}
.sidenav_back{
    position: fixed;
    z-index: 9;
    top: 0px;
    right: 0px;
    left: 0px;
    bottom: 0px;
    background-color: rgba(35, 35, 35, 0.7);
}
.sidenav_bar{
    position: fixed;
    z-index: 10;
    top: 0px;
    left: -15px;
    bottom: 0px;
    width: 0px;
    background-color: rgb(35, 35, 35);
    overflow-x: hidden;
    overflow-y: auto;
}
.btn-sidenavbar{
    width: 100%;
    margin: 2px 0px;
    background-color: transparent;
    color: white;
}
.btn-inn-div1{
    width: 20%;
    float: left;
}
.btn-inn-div2{
    width: 80%;
    float: left;
    text-align: left;
}
.btn-inn-icon{
    height: 20px;
    width: 20px;
    margin: 0px 0px 0px 0px;
}
/* scrool bar */
::-webkit-scrollbar {
  width: 10px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1;
  cursor: pointer;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #0099ff;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #007acc;
}
/* ^scrool bar^ */
@media screen and (max-width: 505px){
    .divtop_header2{
        display: none;
    }
    ::-webkit-scrollbar{
        width: 3px;
    }
}
</style>
</head>
<body onoffline="offlinefunction()" ononline="onlinefunction()">
<?php
include "config/config_offline.html";
?>

<!-- div top header start -->
<div class="top_header">
    <div style="margin: 5px 10px;float: left;">
        <button class="btn btn-primary" id="sidenav_anim" >&#9776;</button>
    </div>
    <div style="float: left;color: white;font-size: 25px;font-family: DFPOP1-W9;margin: 4px 5px;">
        MyRt 4U
    </div>
    <?php if($session_status == "off"){ ?>
        <div class="divtop_header2" style="float: right;margin: 5px 10px;">
            <a href="login/"><button class="btn btn-success">Masuk</button></a>
            <a href="createaccount/"><button class="btn btn-light">Buat Akun</button></a>
        </div>
    <?php } ?>
</div>
<!-- div top header end -->

<!-- div body start -->
<div class="divbody">
    <iframe id="mainframe" src="mainpage/" style="width: 100%;height: 100%;border: none;"></iframe>
    <div id="um_load_parent" style="display: none;position: fixed;top: 50px;right: 0px;left: 0px;bottom: 0px;background-color: rgb(28, 28, 28);">
        <?php include "config/config_loading2.php"; ?>
    </div>
    <script>
        function loadmainframe(){
            $('#mainframe').ready(function () {
                $("#um_load_parent").fadeIn();
            });
        }
        $('#mainframe').on("load", function () {
            $("#um_load_parent").fadeOut();
        });
    </script>
</div>
<!-- div body end -->

<div id="sidenav_anim" style="display: none;" class="sidenav_back">

</div>
<div class="sidenav_bar" posit="0">
        <button id="sidenav_anim" class="btn btn-danger" style="position: absolute;top: 0px;right: 0px;z-index: 2;">X</button>
        <?php if($session_status == "on"){ ?>
        <div style="height: 150px;background: url(system/home_wallpaper.jpg)no-repeat;background-size: cover;">
            <div style="position: relative; width: 100%;height: 100%;background-color: rgba(35, 35, 35, 0.5);">
                <div style="position: absolute;bottom: 10px;left: 5px;width: 70px;height: 70px;background-color: <?php
                    if($session_status== "on"){
                        echo "none";
                    }else{
                        echo "white";
                    }
                ?>;border-radius: 100%;overflow: hidden;">
                    <?php if($session_status == "on"){ ?>
                        <img src="<?php
                        if(empty($picture_ac)){
                            echo "system/icon/user.png";
                        }else{
                            echo $picture_ac;
                        }
                        ?>" style="width: 100%;height: 100%;">
                    <?php } ?>
                </div>
                <div style="position: absolute;bottom: 10px;left: 80px;word-wrap: break-word;width: 168px;color: white;">
                    <?php if($session_status == "on"){ ?>
                        <a id="sidenav_anim" onclick="document.getElementById('mainframe').src = 'mainuser/';"><?php echo $nama_ac; ?></a>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div attrload="0" id="ads_show">
            <!-- ads here -->
        </div>
        <?php }else{ ?>
        <div style="text-align: center;">
            <br><br><br>
            <a href="login/"><button class="btn btn-sidenavbar">Masuk</button></a>
            <a href="createaccount/"><button class="btn btn-sidenavbar">Buat Akun</button></a>
        </div>
        <?php } ?>
        <div style="text-align: center;">
            <?php if($session_status == "on" AND !empty($grup_code_ac)){ ?>
                <button id="sidenav_anim" onclick="document.getElementById('mainframe').src = 'mainpage/';loadmainframe();" class="btn btn-sidenavbar"><div class="btn-inn-div1"><img src="system/icon/home-white.png" class="btn-inn-icon"></div><div class="btn-inn-div2" style="text-align: left;">Home</div></button>
                <button onclick="rtdiv();" class="btn btn-sidenavbar"><div class="btn-inn-div1"><img src="" class="btn-inn-icon"></div><div class="btn-inn-div2" style="text-align: left;">RT</div></button>
                <div id="rtdiv" rtdivattr="0" style="height: 0px;overflow: hidden;padding: 0px 0px 0px 20px;">
                    <button style="text-align: left;padding-left: 45px;" id="sidenav_anim" onclick="document.getElementById('mainframe').src = 'kasrt/';rtdiv();loadmainframe();" class="btn btn-sidenavbar">Kas Rt</button>
                    <button style="text-align: left;padding-left: 45px;" id="sidenav_anim" onclick="document.getElementById('mainframe').src = 'laporrt/';rtdiv();loadmainframe();" class="btn btn-sidenavbar">Lapor RT</button>
                    <button style="text-align: left;padding-left: 45px;" id="sidenav_anim" onclick="document.getElementById('mainframe').src = 'pengajuansurat/';rtdiv();loadmainframe();" class="btn btn-sidenavbar">Pengajuan Surat</button>
                </div>
                <button class="btn btn-sidenavbar" onclick="pkkdiv();"><div class="btn-inn-div1"><img src="" class="btn-inn-icon"></div><div class="btn-inn-div2" style="text-align: left;">PKK</div></button>
                <div id="pkkdiv" pkkdivattr="0" style="height: 0px;overflow: hidden;padding: 0px 0px 0px 20px;">
                    <button style="text-align: left;padding-left: 45px;" id="sidenav_anim" onclick="document.getElementById('mainframe').src = 'jentik/';pkkdiv();loadmainframe();" class="btn btn-sidenavbar">Jentik</button>
                </div>
                <button id="sidenav_anim" onclick="document.getElementById('mainframe').src = 'pengumuman/';loadmainframe();" class="btn btn-sidenavbar"><div class="btn-inn-div1"><img src="system/icon/comment-white.png" class="btn-inn-icon"></div><div class="btn-inn-div2">Pengumuman</div></button>
                <button onclick="document.getElementById('mainframe').src = 'datapenduduk/';loadmainframe();" id="sidenav_anim" class="btn btn-sidenavbar"><div class="btn-inn-div1"><img src="system/icon/gear-white.png" style="height: 20px;width: 20px;margin: 0px 0px 0px 0px;"></div><div class="btn-inn-div2" style="text-align: left;">Data Penduduk</div></button>
                <script>
                    function rtdiv(){
                        var rtdiv = $("#rtdiv").attr("rtdivattr");
                        if(rtdiv == "0"){
                            document.getElementById("rtdiv").style.height = "auto";
                            $("#rtdiv").attr("rtdivattr", "1");
                        }else if(rtdiv == "1"){
                            document.getElementById("rtdiv").style.height = "0px";
                            $("#rtdiv").attr("rtdivattr", "0");
                        }
                    }
                    function pkkdiv(){
                        var pkkdiv = $("#pkkdiv").attr("pkkdivattr");
                        if(pkkdiv == "0"){
                            document.getElementById("pkkdiv").style.height = "auto";
                            $("#pkkdiv").attr("pkkdivattr", "1");
                        }else if(pkkdiv == "1"){
                            document.getElementById("pkkdiv").style.height = "0px";
                            $("#pkkdiv").attr("pkkdivattr", "0");
                        }
                    }
                </script>
                <hr>
                <button id="sidenav_anim" class="btn btn-sidenavbar"><div class="btn-inn-div1"><img src="system/icon/gear-white.png" style="height: 20px;width: 20px;margin: 0px 0px 0px 0px;"></div><div class="btn-inn-div2" style="text-align: left;">Pengaturan Akun</div></button>
                <button onclick="document.getElementById('mainframe').src = 'pengaturangrup/';loadmainframe();" id="sidenav_anim" class="btn btn-sidenavbar"><div class="btn-inn-div1"><img src="system/icon/gear-white.png" style="height: 20px;width: 20px;margin: 0px 0px 0px 0px;"></div><div class="btn-inn-div2" style="text-align: left;">Pengaturan Grup</div></button>
                <button onclick="document.getElementById('mainframe').src = 'devmode/';" id="sidenav_anim" class="btn btn-sidenavbar" style="display: none;"><div class="btn-inn-div1"><img src="system/icon/gear-white.png" style="height: 20px;width: 20px;margin: 0px 0px 0px 0px;"></div><div class="btn-inn-div2" style="text-align: left;">Dev Mode</div></button>
                <button onclick="document.getElementById('mainframe').src = 'coba/history/';" id="sidenav_anim" class="btn btn-sidenavbar"><div class="btn-inn-div1"><img src="system/icon/gear-white.png" style="height: 20px;width: 20px;margin: 0px 0px 0px 0px;"></div><div class="btn-inn-div2" style="text-align: left;">Coba</div></button>
                <a href="logout/"><button style="background-color: #c94c4c;" class="btn btn-sidenavbar">LOGOUT</button></a>
            <?php }else if($session_status == "on" AND empty($grup_code_ac)){ ?>
                <button id="sidenav_anim" onclick="document.getElementById('mainframe').src = 'mainpage/';" class="btn btn-sidenavbar">Home</button>
                <a href="group-login/"><button class="btn btn-sidenavbar">Gabung Group</button></a>
                <a href="logout/"><button class="btn btn-sidenavbar">LOGOUT</button></a>
            <?php } ?>
        </div>
        <script>
            $(document).ready(function(){
                sidenavads();
            });
            $(document).on("click", "#sidenav_anim", function(){
                $(".sidenav_back").fadeToggle();
                var posit = $(".sidenav_bar").attr("posit");
                if(posit == "0"){
                    $(".sidenav_bar").animate({width: '250px', left: '0px'});
                    $(".sidenav_bar").attr("posit", "1");
                }else{
                    $(".sidenav_bar").animate({width: '0px', left: '-15px'});
                    $(".sidenav_bar").attr("posit", "0");
                    sidenavads();
                }
            });
            function sidenavads(){
                $("#ads_show").fadeOut();
                var attrload = $("#ads_show").attr("attrload");
                if(attrload == "0"){
                    $("#ads_show").attr("attrload", "1");
                    $.ajax({
                        method:"post",
                        url:"ads.php",
                        dataType:"text",
                        success:function(data){
                            $("#ads_show").html(data);
                            $("#ads_show").attr("attrload", "0");
                            $("#ads_show").fadeIn();
                        }
                    });
                }else{
                    /* do nothing */
                }
            }
        </script>
</div>
</body>
</html>