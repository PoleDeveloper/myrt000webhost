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
    <link rel="stylesheet" href="../script/photobox/photobox.css">
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
    <script src="../script/jquery/jquery.form.js"></script>
    <script src="../script/photobox/jquery.photobox.js"></script>
<style>
body,
html{
    font-family: arial;
}
.divbody{
    width: 100%;
}
.divbody1{
    position: relative;
    width: 500px;
    padding: 10px;
    margin: auto;
}
.forma{
    width: 100%;
}
#inputumum{
    height: 100px;
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
}
.um_bottom_bar{
    width: 100%;
    padding: 3px;
    background-color: rgb(230, 230, 230);
}
.um_btnu{
    display: inline-block;
    margin: 2px;
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
.container-inn{
    padding: 7px 0px;
    display: none;
}
#btncoina{
    transition: 0.6s;
}
/* slide show top */
#divtad{
    position: relative;
    width: 500px;
    height: 300px;
    top: 20px;
    margin: auto;
}
@media screen and (max-width: 500px){
    .divbody1{
        width: 98%;
    }
    #divtad{
        width: 100%;
        height: 240px;
    }
}
</style>
<script>
/* disable back arrow */
jQuery(document).ready(function($) {

if (window.history && window.history.pushState) {

  $(window).on('popstate', function() {
    var hashLocation = location.hash;
    var hashSplit = hashLocation.split("#!/");
    var hashName = hashSplit[1];

    if (hashName !== '') {
      var hash = window.location.hash;
      if (hash === '') {
          /* make window back not avaliable */
          (function (global) { 

          if(typeof (global) === "undefined") {
              throw new Error("window is undefined");
          }

          var _hash = "!";
          var noBackPlease = function () {
              global.location.href += "#";

              // making sure we have the fruit available for juice (^__^)
              global.setTimeout(function () {
                  global.location.href += "!";
              }, 50);
          };

          global.onhashchange = function () {
              if (global.location.hash !== _hash) {
                  global.location.hash = _hash;
              }
          };

          global.onload = function () {            
              noBackPlease();

              // disables backspace on page except on input fields and textarea..
              document.body.onkeydown = function (e) {
                  var elm = e.target.nodeName.toLowerCase();
                  if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                      e.preventDefault();
                  }
                  // stopping event bubbling up the DOM tree..
                  e.stopPropagation();
              };          
          }

          })(window);
      }
    }
  });

  window.history.pushState('forward', null, './#forward');
}

});
/* disable back arrow */
</script>
</head>
<body>
<?php
include "../config/config_loading.php";
?>
<div class="divbody">

<?php if($session_status == "off"){ ?>
<div id="divtad" tadattr="0">
    <img id="tad1" style="width: 100%;position: absolute;" src="../system/wall/a.png">
    <img id="tad2" style="width: 100%;position: absolute;" src="../system/wall/c.png">
    <script>
        function slideswitch(){
            var tadattr = $("#divtad").attr("tadattr");
            if(tadattr == "0"){
                $("#tad2").css({"z-index":"2",}).fadeIn();
                $("#tad1").css({"z-index":"1"}).fadeOut();
                $("#divtad").attr("tadattr", "1");
            }else if(tadattr == "1"){
                $("#tad1").css({"z-index":"2"}).fadeIn();
                $("#tad2").css({"z-index":"1"}).fadeOut();
                $("#divtad").attr("tadattr", "0");
            }
        }
        setInterval(function(){
            slideswitch();
        }, 3000);
    </script>
</div>
<?php } ?>

<?php if($session_status == "on"){ ?>
    <div class="divbody1">
    <div id="forumumload" style="position: absolute;width: 100%;height: 100%;background-color: rgba(229, 239, 241, 0.7);display: none;z-index: 2;">
        <div style="position: absolute;margin: auto;width: 100%;top: 20px;left: 0px;bottom: 0px;right: 0px;">
            <div style="width: 100px;height: 100px;border-radius: 100%;overflow: hidden;margin: auto;">
                <img style="width: 100px;height: auto;" src="../system/icon/upload_process.gif">
            </div>
            <div style="text-align: center;font-size: 20px;" id="progress-bar"></div>
        </div>
    </div>
        <form action="umum_action.php" method="post" id="formumum" enctype="multipart/form-data" style="box-shadow: 0px 3px 10px black;padding: 10px 5px;background-color: #f0f0f0;">
            Bagikan Ke 
            <select id="shareumum" name="share">
                <option value="all">Publik ( Umum )</option>
                <option value="grup">Grup</option>
            </select>
            <textarea onkeyup="limiter()" id="inputumum" name="post" class="forma form-control" placeholder=""></textarea>
            <div style="width: 100%;text-align: right;font-size: 14px;" id="word"></div>
            <br>
            <div>Ukuran Maksimal Gambar <u>( 2 MB )</u></div>
            <div style='position: relative;width: 100%;' id="image_preview"></div>
            <label id="forfileumum" for="fileumum" class="btn btn-dark">Upload Gambar</label>
            <input name="images[]" style="display: none;" id="fileumum" type="file" onchange="previmage();" multiple>
            <input id="formumumbtn" style="float: right;" class="btn btn-success" type="submit" name="submit" value="Post" >
            <label id="forfileumumd" style='display: none;' class="btn btn-danger">Reset Gambar</label>
        </form>
        <br><br>
        <script>
                //Edit the counter/limiter value as your wish
                var count = "400";
                //Example: var count = "175";
                function limiter(){
                    var tex = document.getElementById("inputumum").value;
                    var len = tex.length;
                    if(len > count){
                        tex = tex.substring(0,count);
                        document.getElementById("inputumum").value = tex;
                        return false;
                    }
                    document.getElementById("word").innerHTML = len+" / "+count;
                }
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
<?php } ?>
    <div class="a">

    </div>
    <div offattr="" id="umumget" attrdate="" class="divbody1" attrload="0">

    </div>
    <!--<div style="width: 100%;text-align: center;padding: 10px 0px;"><button onclick="umumgetdata();" id="btnumumget" class="btn btn-primary">Load More</button></div>-->
    <?php include "../config/config_loading2.php"; ?>
    <script>
        $(document).ready(function(){
            umumgetdata();
        });
        // When the user scrolls the page, execute myFunction 
        window.onscroll = function() {
            myFunction();
        };

        function myFunction() {
            var winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            var height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            var finwinScroll = winScroll+10;
            var attrcond = $(".seepict").attr("attrcond");
            if(attrcond == "1"){
                var x=window.scrollX;
                var y=window.scrollY;
                window.onscroll=function(){window.scrollTo(x, y);};
            }
            if(finwinScroll > height){
                umumgetdata();
            }
        }
        function umumgetdata(){
            offset = $("#umumget").attr("offattr");
            attrload = $("#umumget").attr("attrload");
            ld = $("#umumget").attr("attrdate");
            $("#btnumumget").fadeOut();
            if(offset == "empty"){
                //do nothing
                $("#btnumumget").fadeOut();
            }else{
                if(attrload == 0){
                    umloadcountstart();
                    $("#umumget").attr("attrload", "1");
                    $("#um_load").fadeIn();
                    $.ajax({
                        method:"post",
                        url:"umum_get.php",
                        data:{
                            offset:offset,
                            ld:ld
                        },
                        dataType:"text",
                        success:function(data){
                            $("#umumget").append(data);
                            adsget();
                        }
                    });
                }
            }
        }
        function adsget(){
            offset = $("#umumget").attr("offattr");
            $.ajax({
                method:"post",
                url:"ads.php",
                dataType:"text",
                success:function(data){
                    if(offset == "empty"){
                        /* do nothing */
                    }else{
                        $("#umumget").append(data);
                    }
                    umloadcountend();
                    $("#um_load").fadeOut();
                    $("#btnumumget").fadeIn();
                    $("#umumget").attr("attrload", "0");
                }
            });
        }
    </script>
    <div class="seepict" attrcond="0" attracbef="" style="display: none;">

    </div>
    <script>
        $(document).on("click", "#um_gam", function(){
            var gum_attr = $(this).attr("gumattr");
            var umattr = $(this).attr("umattr");
            var picthframe = $(this).attr("picthframeattr");
            var pictheight = $(this).attr("picthheightattr");
            var pictwidth = $(this).attr("picthwidthattr");
            $(".seepict").empty().html("<div style='position: fixed;margin: auto;width: 100px;height: 100px;top: 0px;left: 0px;right: 0px;bottom: 0px;text-align: center;color: white;'><img style='width: 100%;height: 100%;' src='../system/icon/download.gif'><br>LOADING</div>").fadeIn();
            $(".seepict").attr("attrcond", "1").attr("attracbef", umattr);
            $.ajax({
                method:"post",
                url:"umum_seepict.php",
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
            $(".seepict").attr("attrcond", "0");
            window.onscroll = function() {
                myFunction();
            }
        }
        $(document).on("click", "#pitchchose", function(){
            var pathpic = $(this).attr("pathcattr");
            document.getElementById("pitchframe").src = "../system/icon/download.gif";
            $(document).ready(function(){
                document.getElementById("pitchframe").src = "../umum/image"+pathpic;
            });
        });
    </script>
    <script>
        $(document).on("click", "#postdelete", function(){
            var um_code = $(this).attr("umcodeattr");
            $(this).html("LOADING");
            $.ajax({
                method:'post',
                url:"umum_delete.php",
                data:{um_code:um_code},
                dataType:"text",
                success:function(){
                    $("#"+um_code).fadeOut();
                }
            });
        });
    </script>
    <script>
        $(document).on("click", "#rmbtn", function(){
            var attrrm = $(this).attr("attrrm");
            $("#"+attrrm).fadeIn();
            $(this).fadeOut();
        });
    </script>
    <script>
        $(document).on("click", "#likebtn", function(){
            var likecode = $(this).attr("umcode");
            var attrca = $(".like"+likecode).attr("attrc");
            var attrcb = $(".dislike"+likecode).attr("attrc");
            if(attrca == "ya" && attrcb == "tidak"){
                $(this).css({"background-color":"white", "color":"black"});
                $(".like"+likecode).attr("attrc", "tidak");
            }else if(attrca == "tidak" && attrcb == "tidak"){
                $(this).css({"background-color":"#0066ff", "color":"white"});
                $(".like"+likecode).attr("attrc", "ya");
            }else if(attrca == "tidak" && attrcb == "ya"){
                $(this).css({"background-color":"#0066ff", "color":"white"});
                $(".dislike"+likecode).css({"background-color":"white", "color":"black"});
                $(".dislike"+likecode).attr("attrc", "tidak");
                $(".like"+likecode).attr("attrc", "ya");
            }
            $.ajax({
                method:'post',
                url:"likeorno.php",
                data:{
                    action: "like",
                    umcode:likecode
                },
                dataType:"text",
                success:function(){
                    
                }
            });
        });
        $(document).on("click", "#dislikebtn", function(){
            var likecode = $(this).attr("umcode");
            var attrca = $(".like"+likecode).attr("attrc");
            var attrcb = $(".dislike"+likecode).attr("attrc");
            if(attrcb == "ya" && attrca == "tidak"){
                $(this).css({"background-color":"white", "color":"black"});
                $(".dislike"+likecode).attr("attrc", "tidak");
            }else if(attrcb == "tidak" && attrca == "tidak"){
                $(this).css({"background-color":"#0066ff", "color":"white"});
                $(".dislike"+likecode).attr("attrc", "ya");
            }else if(attrcb == "tidak" && attrca == "ya"){
                $(this).css({"background-color":"#0066ff", "color":"white"});
                $(".like"+likecode).css({"background-color":"white", "color":"black"});
                $(".dislike"+likecode).attr("attrc", "ya");
                $(".like"+likecode).attr("attrc", "tidak");
            }
            $.ajax({
                method:'post',
                url:"likeorno.php",
                data:{
                    action: "dislike",
                    umcode:likecode
                },
                dataType:"text",
                success:function(){
                    
                }
            });
        });
    </script>
    <script>
        $(document).on("click", "#btncoina", function(){
            var divco = $(this).attr("attrcoin");
            var fpl = $(this).attr("attrf");
            if(fpl == 0){
                $(this).css({"transform":"rotateX(180deg)"});
                $(this).attr("attrf", "1");
            }else{
                $(this).css({"transform":"rotateX(360deg)"});
                $(this).attr("attrf", "0");
            }
            $("#"+divco).fadeToggle();
        });
    </script>

</div>
</body>
</html>