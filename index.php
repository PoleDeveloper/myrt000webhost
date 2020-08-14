<?php
/* before you upload and post this page always remember to check -> required-change <- */
include "config/config_all.php";
include "detect_used_browser.php";

header("X-Frame-Options: DENY");

if(!empty($_SERVER['HTTP_REFERER'])){
    header("X-Frame-Options: DENY");
}
if($_SESSION['myrt4ucookiestat'] == null){
    header("Location: load/");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- important script s -->
    <link rel="stylesheet" href="script/bootstrap/css/bootstrap.min.css">
    <script src="script/jquery/jquery.js"></script>
    <script src="script/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="script/transition/transition.css"/>
    <link rel="stylesheet" type="text/css" href="script/loading/loading.css"/>
    <link rel="stylesheet" type="text/css" href="script/our.css"/>
    <!-- important script e -->
    <title>MyRt4U</title>
    <?php if($session_status == "on"){ ?>
        <?php if($display_mode_ac == "light"){ ?>
        <link rel="stylesheet" type="text/css" href="script/css/home_page/light.css"/>
        <link rel="stylesheet" type="text/css" href="script/lightour.css"/>
        <?php }else if($display_mode_ac == "dark"){ ?>
        <link rel="stylesheet" type="text/css" href="script/css/home_page/dark.css"/>
        <link rel="stylesheet" type="text/css" href="script/darkour.css"/>
        <?php } ?>
    <?php }else{ ?>
        <link rel="stylesheet" type="text/css" href="script/css/home_page/light.css"/>
    <?php } ?>
    <!-- other script s -->

    <!-- other script e -->
</head>
<body>
    <!-- loading full page -->
    <?php include "script/full-page-load/loading1.html" ?>
    <?php include "script/full-page-load/loading2.html" ?>
    <?php include "script/full-page-load/loading3.html" ?>
    <!-- error notif -->
    <?php include "script/notif-page/notif1.html" ?>
    <script>
        $(document).ready(function(){
            $("#full-page-load-1").addClass("ld-zoom-out").delay(250).fadeOut();
        });
        function pageload1s(){
            $("#full-page-load-1").removeClass("ld-zoom-out").fadeIn().addClass("ld-zoom-in");
        }
    </script>


    <!-- div header s -->
    <div class="main-header">
        <div class="side-menu-div"><button onclick="sidemenu();" class='btn side-menu-btn'>&#9776;</button></div>
        <div class="myrt-logo">MyRt4u</div>
        <div class="mh-right-div">
            <?php if($session_status == "off"){ ?>
                <a href="login-or-signup/" onclick="pageload1s();" class="btn btn-success">Masuk</a>
                <a href="login-or-signup/?f=r" onclick="pageload1s();" class="btn mh-masuk-btn">Buat Akun</a>
            <?php } ?>
        </div>
    </div>
    <!-- div header e -->
    
    <!-- div side menu s -->
    <div attrsit="0" id="side-menu">
        <?php if($session_status == "off"){ ?>
            <br>
            <a href="login-or-signup/" onclick="pageload1s();sidemenu();" style="width: 100%;margin-bottom: 5px;" href="" class="btn btn-success">Masuk</a><br>
            <a href="login-or-signup/?f=r" onclick="pageload1s();sidemenu();" style="width: 100%;margin-bottom: 5px;" href="" class="btn btn-primary">Buat Akun</a>
            <button onclick="sidemenu();loadmainframe();document.getElementById('mainframe').src = 'tentang_aplikasi_ini/';" style="width: 100%;" class="btn btn-dark">Tentang Aplikasi Ini</button>
        <?php }else if($session_status == "on" AND empty($grup_code_ac)){ ?>
            <br>
            <a href="login-or-signup/" onclick="pageload1s();sidemenu();" style="width: 100%;margin-bottom: 5px;" href="" class="btn btn-success">Gabung Grup</a>
            <button onclick="sidemenu();loadmainframe();document.getElementById('mainframe').src = 'tentang_aplikasi_ini/';" style="width: 100%;" class="btn btn-dark">Tentang Aplikasi Ini</button>
        <?php }else if($session_status == "on" AND !empty($grup_code_ac)){ ?>
            <div class="side-menu-inner-head" style="background: url(system/home_wallpaper.jpg)no-repeat;background-size: cover;">
                <div class="side-menu-inner-acp" style="<?php
                        if(empty($picture_ac)){
                            echo "background: url(system/icon/user.png)no-repeat;";
                        }else{

                        }
                    ?>
                background-size: cover;">
                </div>
                <div class="side-menu-inner-act">
                    <?php echo $nama_ac; ?>
                </div>
            </div>
            <div style="box-shadow: 0px 0px 5px black;">
                <div class="btn sm-btn" onclick="rotate('rtmain');"><a class="sm-btn-a">RT</a><a id="rtmain" attrcon="0" class="sm-btn-b">></a></div>
                <div id="rtmain-div">
                    <button class="btn sm-btn-2" onclick="mainframe('kasrt/','rtmain');">Kas RT</button>
                </div>
                <button onclick="sidemenu();loadmainframe();document.getElementById('mainframe').src = 'tentang_aplikasi_ini/';" style="width: 100%;" class="btn sm-btn">Tentang Aplikasi Ini</button>
            </div>
            <script>
                function rotate(id){
                    var attrcon = $("#"+id).attr("attrcon");
                    if(attrcon == "0"){
                        $("#"+id).css({"transform":"rotate(90deg)"});
                        $("#"+id).attr("attrcon", "1");
                        $("#"+id+"-div").slideDown("fast");
                    }else if(attrcon == "1"){
                        $("#"+id).css({"transform":"rotate(0deg)"});
                        $("#"+id).attr("attrcon", "0");
                        $("#"+id+"-div").slideUp("fast");
                    }
                }
                function mainframe(src,id){
                    document.getElementById("mainframe").src = src;
                    rotate(id);
                    sidemenu();
                    loadmainframe();
                }
            </script>
                <a href='logout/'><button class="btn sm-btn" style="background-color: #c83349;color: white;border-color: none;">Logout</button></a>
        <?php } ?>
    </div>
    <div id="side-menu-back" onclick="sidemenu();">
    </div>
    <script>
        function sidemenu(){
            var sit = $("#side-menu").attr("attrsit");
            if(sit == 0){
                $("#side-menu").css({"left":"0px"});
                $("#side-menu-back").fadeIn();
                $("#side-menu").attr("attrsit", "1");
            }else{
                $("#side-menu").css({"left":"-260px"});
                $("#side-menu-back").fadeOut();
                $("#side-menu").attr("attrsit", "0");
            }
        }
    </script>
    <!-- div side menu e -->

    <!-- main frame start -->
    <div id="mainframediv">
        <iframe id="mainframe" src="home/" style="width: 100%;height: 100%;border: none;"></iframe>
        <script>
            $(document).ready(function(){
                loadmainframe();
            });
            function loadmainframe(){
                $('#mainframe').ready(function () {
                    load3s();
                });
            }
            $('#mainframe').on("load", function () {
                load3e();
            });
        </script>
    </div>
    <!-- main frame end -->

    <div id="auto_check_ac"></div>
    <script>
        $(document).ready(function(){
            checkactivity();
        });
        var ajaxcheckac = null;
        function checkactivity(){
            ajaxcheckac = $.ajax({
                method:"post",
                url:"activity_check.php",
                dataType:"json",
                success:function(data){
                    if(data.update == "r"){
                        location.reload();
                    }
                    setTimeout(function(){
                        checkactivity();
                    }, 60000);
                }
            });
        }
    </script>


    <script>
        $(document).ready(function(){
            var urlloc = window.location.pathname;
            var loc = window.top.location.hash;
            var hash = loc.split("#");
            var hashlen = hash.length;
            if(hashlen == "2"){
                hash = hash[1].split("=");
                if(hash[0] == "reload"){
                    window.history.pushState("", "", urlloc);
                }
            }
        });
    </script>
</body>
</html>