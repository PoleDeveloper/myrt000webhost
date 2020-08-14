<?php
include "../config/config_all.php";
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
    <title>Pengumuman</title>
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
@media screen and (max-width: 610px){
    .divbody{
        width: 96%;
    }
}
</style>
</head>
<body>

    <h1 style="text-align: center;">Pengumuman</h1>
<div class="divbody">
    <div offattr="0" id="pengdat">

    </div>
</div>
<script>
// When the user scrolls the page, execute myFunction 
window.onscroll = function() {myFunction()};

function myFunction() {
    var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
    var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    var finwinScroll = winScroll+10;
    if(finwinScroll > height){
        getdata();
    }
}
</script>
<script>
$(document).on("click", "#dltbtn", function(){
    var idattr = $(this).attr("idattr");
    $(this).html("Loading");
    $.ajax({
        method:'post',
        url:'delete_data.php',
        data:{id:idattr},
        dataType:'text',
        success:function(){
            $("#"+idattr).fadeOut();
        }
    });
});
</script>

<?php include "../config/config_loading2.php"; ?>

<script>
$(document).ready(function(){
    getdata();
});
function getdata(){
    var offattr = $("#pengdat").attr("offattr");
    if(offattr == "none"){
        /* do nothing */
    }else{
        $("#um_load").fadeIn();
        $.ajax({
            method:"post",
            url:"get_data.php",
            data:{offset:offattr},
            dataType:"text",
            success:function(data){
                $("#pengdat").append(data);
                $("#um_load").fadeOut();
            }
        });
    }
}
</script>

<?php
if($session_status == "on" AND $status_ac != "warga"){
?>
    <div><button onclick="$('#divbody_form').fadeIn();" class="btn btn-dark" style="position: fixed;bottom: 20px;right: 20px;">Buat Pengumuman</button></div>
<?php
}
?>

<div style="position: fixed;top: 0px;right: 0px;left: 0px;bottom: 0px;background-color: rgba(38, 38, 38, 0.7);display: none;" id="divbody_form">
    <button onclick="$('#divbody_form').fadeOut();" style="position: absolute;right: 0px;top: 0px;z-index: 2;border: none;font-size: 20px;border-bottom-left-radius: 50%;color: white;background-color: red;padding: 5px 8px 8px 12px;">X</button>
    <div class="divinner_form" id="divinner_form">
        <form method="post" action="send_data.php" id="formpeng">
            <div class="form-group">
                <textarea name="isi" style="height: 200px;" class="form-control"></textarea>
                <br>
                <div style="text-align: right;"><input class="btn btn-success" type="submit" name="simpan" value="Bagikan"></div>
            </div>
        </form>
    </div>
    <div id="divinner_form2">

    </div>
</div>
<script>
$(document).ready(function(){
    $("#formpeng").ajaxForm({
        success:function(){
            $("#divbody_form").fadeOut();
            prependdata();
        }
    });
});
function prependdata(){
    $("#um_load").fadeIn();
    $.ajax({
        method:"post",
        url:"pre_data.php",
        dataType:"text",
        success:function(data){
            $("#pengdat").prepend(data);
            $("#um_load").fadeOut();
        }
    });
}
$(document).on("click", "#editbtn", function(){
    var id = $(this).attr("idattr");
    $("#divinner_form1").fadeOut();
    $("#um_load").fadeIn();
    $.ajax({
        method:"post",
        url:"edit_dataget.php",
        data:{id:id},
        dataType:"text",
        success:function(data){
            $("#um_load").fadeOut();
            $("#divbody_form").fadeIn();
            $("#divinner_form2").html(data).fadeIn();
        }
    });
});
</script>

<br><br>

</body>
</html>