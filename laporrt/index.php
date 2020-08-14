<?php
include "../config/config_all.php";
include "../config/config_loading.php";
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
    <title>Lapor RT</title>
<style>
body,
html{
    font-family: arial;
}
.divbody{
    width: 600px;
    margin: auto;
    position: relative;
}
.divinner_form{
    position: absolute;
    padding: 10px 5px;
    top: 0px;
    bottom: 0px;
    left: 0px;
    right: 0px;
    width: 500px;
    height: 280px;
    margin: auto;
    background-color: rgb(38, 38, 38);
    border-radius: 5px;
}
.divget{
    width: 100%;
    height: auto;
    padding: 10px 7px;
    margin: 10px 0px;
    box-shadow: 0px 0px 10px black;
    border-radius: 5px;
    word-break: break-all;
}
.rml{
    background-color: #F7F7F7;
    box-shadow: 0px 0px 10px black;
    word-break: break-all;
    margin: 10px 0px;
    padding: 5px 3px;
}
@media screen and (max-width: 610px){
    .divbody{
        width: 96%;
    }
    .divinner_form{
        width: 98%;
    }
}
</style>
</head>
<body>

    <h1 style="text-align: center;">Lapor RT</h1>
<br><br><br>
<div class="divbody">
<?php if($status_ac == "ketua"){ ?>
    <h3>Seluruh Laporan Warga</h3>
<?php }else{ ?>
    <h3>Laporan Saya</h3>
<?php } ?>
    <div offattr="0" id="pengdat" attrload="0">

    </div>
</div>
<script>
$(document).ready(function(){
    getdata();
});
// When the user scrolls the page, execute myFunction 
window.onscroll = function() {myFunction()};

function myFunction() {
    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    var finwinScroll = winScroll+5;
    if(finwinScroll > height){
        getdata();
    }
}
function getdata(){
    var offattr = $("#pengdat").attr("offattr");
    var attrload = $("#pengdat").attr("attrload");
    $("#pengdat").attr("attrload", "1");
    if(offattr == "none"){
        /* do nothing */
    }else{
        if(attrload == "0"){
            $("#um_load").fadeIn();
            umloadcountstart();
            $.ajax({
                method:"post",
                url:"mylapor.php",
                data:{offset:offattr},
                dataType:"text",
                success:function(data){
                    $("#pengdat").append(data);
                    $("#um_load").fadeOut();
                    umloadcountend();
                    $("#pengdat").attr("attrload", "0");
                }
            });
        }
    }
}
$(document).on("click", "#dltbtn", function(){
    var idattr = $(this).attr("idattr");
    $(this).html("Loading");
    $.ajax({
        method:'post',
        url:'laporac.php',
        data:{id:idattr,
              action:"delete"},
        dataType:'text',
        success:function(){
            $("#"+idattr).fadeOut();
        }
    });
});
</script>

<?php include "../config/config_loading2.php"; ?>

<?php
if($session_status == "on" AND $status_ac != "ketua"){
?>
    <div><button onclick="$('#divbody_form').fadeIn();$('#divinner_form').fadeIn();$('#divinner_form2').html('').fadeOut();texti();" class="btn btn-dark" style="position: fixed;bottom: 20px;right: 20px;">Buat Laporan</button></div>
<?php
}
?>

<div style="position: fixed;top: 0px;right: 0px;left: 0px;bottom: 0px;background-color: rgba(38, 38, 38, 0.7);display: none;" id="divbody_form">
    <button onclick="$('#divbody_form').fadeOut();" style="position: absolute;right: 0px;top: 0px;z-index: 2;border: none;font-size: 20px;border-bottom-left-radius: 50%;color: white;background-color: red;padding: 5px 8px 8px 12px;">X</button>
    <div class="divinner_form" id="divinner_form">
        <form method="post" action="send.php" id="formpeng">
            <div class="form-group">
                <div id='texti'></div>
                <br>
                <div style="text-align: right;"><input class="btn btn-success" type="submit" name="submit" value="Laporkan"></div>
            </div>
        </form>
    </div>
    <script>
        function texti(){
            $("#texti").html("<textarea name='isi' style='height: 200px;' class='form-control'></textarea>");
        }
    </script>
    <div id="divinner_form2">

    </div>
</div>
<script>
$(document).ready(function(){
    $("#formpeng").ajaxForm({
        beforeSubmit:function(){
            $("#um_load").fadeIn();
            umloadcountstart();
        },
        success:function(){
            $("#divbody_form").fadeOut();
            $("#um_load").fadeOut();
            umloadcountend();
            $.ajax({
                method:"post",
                url:"latmylapor.php",
                dataType:"text",
                success:function(data){
                    $("#pengdat").prepend(data);
                }
            });
        }
    });
});
function prependdata(){
    
}
$(document).on("click", "#editbtn", function(){
    var id = $(this).attr("idattr");
    $("#divinner_form1").fadeOut();
    $("#um_load").fadeIn();
    umloadcountstart();
    $.ajax({
        method:"post",
        url:"getdata.php",
        data:{id:id},
        dataType:"text",
        success:function(data){
            $("#um_load").fadeOut();
            umloadcountend();
            $("#divbody_form").fadeIn();
            $("#divinner_form2").html(data).fadeIn();
        }
    });
});
</script>
<?php if($status_ac == "ketua"){ ?>
<script>
$(document).on("click", "#konbtn", function(){
    var id = $(this).attr("idattr");
    $.ajax({
        method:"post",
        url:"condata.php",
        data:{id:id},
        dataType:"text",
        success:function(){
            $("#k"+id).fadeOut();
            $("#t"+id).html("Telah Dikonfirmasi");
        }
    });
});
</script>
<?php } ?>

<br><br>

</body>
</html>