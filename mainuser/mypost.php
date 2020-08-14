<?php
include "../config/config_all.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Postingan Saya</title>
    <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css">
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
    <script src="../script/photobox/jquery.photobox.js"></script>
    <link rel="stylesheet" href="../script/photobox/photobox.css">
    <script src="../script/jquery/jquery.form.js"></script>
<style>
body,
html{
    font-family: arial;
}
/*display um*/
.account_pic_div{
    width:60px;
    height: 60px;
    border-radius: 100%;
    overflow: hidden;
    box-shadow: 0px 0px 2px black;
}
.display_um{
    position: relative;
    box-shadow: 0px 0px 1px black;
    margin: 10px 0px 10px 0px;
}
.display_um2{
    padding: 4px 4px;
}
.display_um_top{

}
.um_name{
    padding: 10px 5px;
    font-size: 20px;
}
.um_isi{
    font-size: 20px;
    margin: 5px 0px;
    padding: 5px 5px;
    word-break: break-all;
    text-align: justify;
}
.um_gam{
    overflow: hidden;
}
.um_gami{
    box-shadow: 0px 0px 5px black;
    background: url("../system/icon/loading.gif")no-repeat;
    background-size: 75px;
    background-position: center;
    background-color: white;
}
.um_bottom_bar{
    width: 100%;
    padding: 3px;
    background-color: rgb(230, 230, 230);
}
.um_btni{
    width: 20px;
    height: 20px;
}
.um_gaminner{
    width: 100%;
    max-width: 400px;
}
.um_chosepict{
    background: url("../system/icon/loading.gif")no-repeat;
    background-size: 30px;
    background-position: center;
    background-color: white;
    min-width: 30px;
}
/*display um*/
.seepict{
    position: fixed;
    top: 0px;
    right: 0px;
    left: 0px;
    bottom: 0px;
    background-color: rgba(51, 51, 51, 0.7);
}
</style>
</head>
<body>
<br><br><br>
<div class="divform">
    <div id="forumumload" style="position: absolute;width: 100%;height: 100%;background-color: rgba(229, 239, 241, 0.7);display: none;z-index: 2;">
        <div style="position: absolute;margin: auto;width: 100%;top: 20px;left: 0px;bottom: 0px;right: 0px;">
            <div style="width: 100px;height: 100px;border-radius: 100%;overflow: hidden;margin: auto;">
                <img style="width: 100px;height: auto;" src="../system/icon/upload_process.gif">
            </div>
            <div style="text-align: center;font-size: 20px;" id="progress-bar"></div>
        </div>
    </div>
        <form action="../mainpage/umum_action.php" method="post" id="formumum" enctype="multipart/form-data" style="box-shadow: 0px 5px 30px black;padding: 10px 5px;background-color: #f0f0f0;">
            Bagikan Ke 
            <select id="shareumum" name="share">
                <option value="all">Publik ( Umum )</option>
                <option value="grup">Grup</option>
            </select>
            <textarea id="inputumum" name="post" class="forma form-control" placeholder=""></textarea>
            <br>
            <div>Ukuran Maksimal Gambar <u>( 2 MB )</u></div>
            <div style='position: relative;width: 100%;' id="image_preview"></div>
            <label id="forfileumum" for="fileumum" class="btn btn-dark">Upload Gambar</label>
            <input name="images[]" style="display: none;" id="fileumum" type="file" onchange="previmage();" multiple>
            <input id="formumumbtn" style="float: right;" class="btn btn-success" type="submit" name="submit" value="Post" >
            <label id="forfileumumd" style='display: none;' class="btn btn-danger">Reset Gambar</label>
        </form>
        <br><br><br><br>
        <script>
            $(document).ready(function(){
                $("#formumum").ajaxForm({
                    beforeSubmit:function(){
                        $("#formumumbtn").fadeOut();
                        $("#forfileumum").fadeOut();
                        $("#forfileumumd").fadeOut();
                        $("#forumumload").fadeIn();
                    },
                    uploadProgress: function (event, position, total, percentComplete){
                        $("#progress-bar").html('Memproses ' + percentComplete +'%');
                        if(percentComplete == 100){
                            $("#progress-bar").html("Harap Tunggu Sebentar");
                        }
                    },
                    success:function(){
                        $("#fileumum").val("");
                        $("#inputumum").val("");
                        $("#fileumum").val("");
                        $("#formumumbtn").fadeIn();
                        $("#forfileumum").fadeIn();
                        $("#forfileumum2").fadeIn();
                        $("#progress-bar").html("Berhasil");
                        $("#forumumload").delay("2000").fadeOut();
                        previmage();
                    },
                    error:function(){

                    }
                });
            });
            $(document).on("click", "#forfileumumd", function(){
                $("#fileumum").val("");
                previmage();
            });
            function previmage(){
                var total_file=document.getElementById("fileumum").files.length;
                $("#forfileumum").html("Ganti Gambar");
                $("#image_preview").empty();
                if(total_file == ""){
                    $("#forfileumumd").fadeOut();
                    $("#forfileumum").html("Upload Gambar");
                }else{
                    $("#forfileumumd").fadeIn();
                }
                for(var i=0;i<total_file;i++){
                    $('#image_preview').append("<img id='imgprev' attrimg='"+URL.createObjectURL(event.target.files[i])+"' style='width: 28%;height: auto;margin: 2% 2%;' src='"+URL.createObjectURL(event.target.files[i])+"'>");
                }
            }
        </script>
    </div>

    <!-- div inner 3 -->
    <div class="div_inner3" offattr="0" datapost="getpostdata" id="divinner">

    </div>
    <div>
        <h2 id="loadtext" style="text-align: center;">Loading..</h2>
    </div>
    <script>
        $(document).ready(function(){
            getpostdata();
        });
        // When the user scrolls the page, execute myFunction 
        window.onscroll = function() {myFunction()};

        function myFunction() {
            var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            var finwinScroll = winScroll+10;
            if(finwinScroll > height){
                getpostdata();
            }
        }
        function getpostdata(){
            var datapost = $("#divinner").attr("datapost");
            var offattr = $("#divinner").attr("offattr");
            if(datapost == "getpostdata"){
                postget();
            }else{
                $("#divinner").attr("offattr", "0");
                postget();
            }
            function postget(){
                var offattr = $("#divinner").attr("offattr");
                if(offattr == "none"){
                    
                }else{
                    $("#um_load").fadeIn();
                    $("#loadtext").fadeIn();
                    $.ajax({
                        method:"post",
                        url:"postget.php",
                        data:{offset:offattr},
                        dataType:"text",
                        success:function(data){
                            $("#divinner").append(data);
                            $("#um_load").fadeOut();
                            $("#loadtext").fadeOut();
                        }
                    });
                }
            }
        }
    </script>
    <div class="seepict" style="display: none;">

</div>
<script>
    $(document).on("click", "#um_gam", function(){
        var gum_attr = $(this).attr("gumattr");
        var picthframe = $(this).attr("picthframeattr");
        var pictheight = $(this).attr("picthheightattr");
        var pictwidth = $(this).attr("picthwidthattr");
        $(".seepict").empty().html("<div style='position: fixed;margin: auto;width: 100px;height: 100px;top: 0px;left: 0px;right: 0px;bottom: 0px;text-align: center;color: white;'><img style='width: 100%;height: 100%;' src='../system/icon/download.gif'><br>LOADING</div>").fadeIn();
        $.ajax({
            method:"post",
            url:"../mainpage/umum_seepict.php",
            data:{gum_code:gum_attr},
            dataType:"text",
            success:function(data){
                $(".seepict").html(data);
                document.getElementById("pitchframe").src = "../system/icon/download.gif";
                $(document).ready(function(){
                    document.getElementById("pitchframe").src = "../umum/image"+picthframe;
                });
            }
        });
    });
    function pictureprev(){
        $(".seepict").fadeOut();
    }
    $(document).on("click", "#pitchchose", function(){
        var pathpic = $(this).attr("pathcattr");
        document.getElementById("pitchframe").src = "../system/icon/download.gif";
        $(document).ready(function(){
            document.getElementById("pitchframe").src = "../umum/image"+pathpic;
        });
    });
    $(document).on("click", "#postdelete", function(){
            var um_code = $(this).attr("umcodeattr");
            $(this).html("LOADING");
            $.ajax({
                method:'post',
                url:"../mainpage/umum_delete.php",
                data:{um_code:um_code},
                dataType:"text",
                success:function(){
                    $("#"+um_code).fadeOut();
                }
            });
        });
</script>

</body>
</html>