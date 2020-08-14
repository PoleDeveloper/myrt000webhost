<?php
include "../config/config_all.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengajuan Surat</title>
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
}
.divbodyinner{
    position: fixed;
    top: 0px;
    bottom: 0px;
    left: 0px;
    right: 0px;
    width: 100%;
    height: 100%;
    background-color: rgba(38, 38, 38, 0.9);
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
<?php include "../config/config_loading2.php"; ?>
<script>
$(document).on('load', function () {
    $("#um_load").fadeIn();

    setTimeout(function () {
        alert('page is loaded and 1 minute has passed');   
    }, 60000);

});
</script>
<div class="divbody">
    <h1 style="text-align: center;">Pengajuan Surat</h1>
    <br><br><br>
    <?php if($status_ac == "ketua"){
    ?>
        <div>
            <button onclick="openform();" id="btntl" class="btn btn-primary">Tambah List Pengajuan</button>
        </div>
        <script>
            $(document).on("click", "#btntl", function(){
                $(".divinner_form").css({"height":"100px"});
                $("#form1").fadeIn();
            });
            $(document).ready(function(){
                $("#formpsh").ajaxForm({
                    beforeSubmit:function(){
                        $("#form1").fadeOut();
                        $("#um_load").fadeIn();
                    },
                    uploadProgress: function (event, position, total, percentComplete){
                        
                    },
                    success:function(){
                        $("#um_load").fadeOut();
                        closeform();
                        getps();
                        $("#f11").val("");
                    },
                    error:function(){

                    }
                });
            });
        </script>
    <?php
    }
    ?>

    <div style="position: fixed;top: 0px;right: 0px;left: 0px;bottom: 0px;background-color: rgba(38, 38, 38, 0.7);display: none;" id="divbody_form">
        <button onclick="closeform();" style="position: absolute;right: 0px;top: 0px;z-index: 2;border: none;font-size: 20px;border-bottom-left-radius: 50%;color: white;background-color: red;padding: 5px 8px 8px 12px;">X</button>
        <div class="divinner_form" id="divinner_form">
            <div id="form1" style='text-align: right;display: none;'>
                <form action='psh.php' method='post' id='formpsh'>
                    <input id="f11" class='form-control' style='margin-bottom: 10px;' type='text' name='isi'>
                    <input type="submit" name="submit" value="Tambah" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
        <script>
            function openform(){
                $("#divbody_form").fadeIn();
            }
            function closeform(){
                $("#divbody_form").fadeOut();
            }
        </script>

        <br><br>
        <table style="width: 100%;" id="listps" loadattr="0">

        </table>
        <script>
            $(document).ready(function(){
                getps();
            });
            function getps(){
                $("#um_load").fadeIn();
                var loadattr = $("#listps").attr("loadattr");
                if(loadattr == 2){
                    /* do nothing */
                }else if(loadattr == 0){
                    $("#listps").attr("loadattr", "1");
                    $.ajax({
                        method:"post",
                        url:"getps.php",
                        dataType:"text",
                        success:function(data){
                            $("#listps").html(data);
                            $("#um_load").fadeOut();
                            $("#listps").attr("loadattr", "0");
                        }
                    });
                }
            }
        </script>
</div>

</body>
</html>