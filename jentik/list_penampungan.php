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
}
#formc{
    width: 75%;
    margin-right: 5px;
}
#btnc{
    width: auto;
}
@media screen and (max-width: 610px){
    .divbody{
        width: 96%;
    }
}
@media screen and (max-width: 400px){
    #formc{
        width: 98%;
        margin-bottom: 5px;
    }
    #btnc{
        width: 98%;
    }
}
</style>
</head>
<body>

<div class="divbody">
    <h1 style="text-align: center;">Jentik</h1>
    <br><br>
    <div id="divtmptpen">

    </div>
    <br>
    <div>
        <form id="form-tambah" class="form-inline" method="post" action="sendf.php">
            <input class="form-control" id="formc" type="text" name="isi" placeholder="Nama Tempat Penampungan" required>
            <input class="btn btn-success" id="btnc" type="submit" name="submit" value="Tambah">
        </form>
    </div>
    <script>
        $(document).ready(function(){
            getdata();
        });
        function getdata(){
            $("#um_load").fadeIn();
            $.ajax({
                method:"post",
                url:"getheader.php",
                dataType:"text",
                success:function(data){
                    $("#divtmptpen").html(data);
                    $("#um_load").fadeOut();
                }
            });
        }
        $("#form-tambah").ajaxForm({
            beforeSubmit:function(){
                $("#um_load").fadeIn();
            },
            success:function(){
                getdata();
                $("#formc").val("");
            }
        });
        $(document).on("click", "#dltbtn", function(){
            var id = $(this).attr("codeattr");
            $.ajax({
                method:"post",
                url:"deletef.php",
                data:{id:id},
                dataType:"text",
                success:function(){
                    getdata();
                }
            });
        });
    </script>
</div>

<div id="um_load" style="display: none;position: fixed;top: 0px;right: 0px;left: 0xp;bottom: 0px;width: 100%;height: 100%;background-color: rgba(229, 239, 241, 0.7);z-index: 2;">
    <div style="position: fixed;width: 80px;height: 80px;margin: auto;top: 0px;right: 0px;left: 0px;bottom: 0px;margin: auto;">
        <div style="width: 80px;height: 80px;overflow: hidden;margin: auto;">
            <img style="width: 80px;height: auto;margin: auto;" src="../system/icon/loading.gif">
        </div>
    </div>
</div>

</body>
</html>