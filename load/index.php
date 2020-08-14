<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../script/jquery/jquery.js"></script>
    <title></title>
<style>
    body,
    html{
        font-family: arial;
        background-color: #333333;
        word-break: break-all;
    }
    .div-body{
        position: fixed;
        width: 100%;
        height: 70px;
        margin: auto;
        top: 0px;
        right: 0px;
        left: 0px;
        bottom: 0px;
    }
    .container { 
        background-color: rgb(192, 192, 192);
        width: 100%;
        border-radius: 15px;
        overflow: hidden;
    } 
      
    .load-bar { 
        background-color: rgb(116, 194, 92); 
        width: 0%;
        height: 7px;
        color: white;
        text-align: right;
        font-size: 20px;
        border-radius: 15px;
        transition: 0.6s;
    }
      
</style>
</head>
<body>
    <div class="div-body">
        <div class="container"> 
            <div id="load-bar" class="load-bar"></div>
        </div>
        <br>
        <div style="text-align: center;color: white;font-size: 25px;">
            Loading
        </div>
        <div style="text-align: center;color: white;padding-top: 4px;" id="load-text">
            script/jquery.js
        </div>
    </div>
<script>
var total_script = 11;
var width = 100/total_script;
var bar_width = width;
$(document).ready(function(){
    $("#load-bar").css({"width":bar_width+"%"});
    widthp();
    load_bootstrap_js();
});
function widthp(){
    bar_width = bar_width+width;
}
function load_bootstrap_js(){
    $("#load-text").html("script/bootstrap.js");
    $.ajax({
        url: "../script/bootstrap/js/bootstrap.min.js",
        dataType: "script",
        cache: true,
        success:function(){
            $("#load-bar").css({"width":bar_width+"%"});
            widthp();
            load_bootstrap_css();
        }
    });
}
function load_bootstrap_css(){
    $("#load-text").html("script/bootstrap.css");
    $.ajax({
        url: "../script/bootstrap/css/bootstrap.min.css",
        dataType: "text",
        cache: true,
        success:function(){
            $("#load-bar").css({"width":bar_width+"%"});
            widthp();
            load_transition_css();
        }
    });
}
function load_transition_css(){
    $("#load-text").html("script/transition.css");
    $.ajax({
        url: "../script/transition/transition.css",
        dataType: "text",
        cache: true,
        success:function(){
            $("#load-bar").css({"width":bar_width+"%"});
            widthp();
            load_loading_css();
        }
    });
}
function load_loading_css(){
    $("#load-text").html("script/loading.css");
    $.ajax({
        url: "../script/loading/loading.css",
        dataType: "text",
        cache: true,
        success:function(){
            $("#load-bar").css({"width":bar_width+"%"});
            widthp();
            load_summernote_css();
        }
    });
}
function load_summernote_css(){
    $("#load-text").html("script/summernote.css");
    $.ajax({
        url: "../script/summernote/dist/summernote-bs4.css",
        dataType: "text",
        cache: true,
        success:function(){
            $("#load-bar").css({"width":bar_width+"%"});
            widthp();
            load_summernote_js();
        }
    });
}
function load_summernote_js(){
    $("#load-text").html("script/summernote.js");
    $.ajax({
        url: "../script/summernote/dist/summernote-bs4.js",
        dataType: "script",
        cache: true,
        success:function(){
            $("#load-bar").css({"width":bar_width+"%"});
            widthp();
            load_popper_js();
        }
    });
}
function load_popper_js(){
    $("#load-text").html("script/popper.js");
    $.ajax({
        url: "../script/popperjs/popper.js",
        dataType: "script",
        cache: true,
        success:function(){
            $("#load-bar").css({"width":bar_width+"%"});
            widthp();
            load_pload_css();
        }
    });
}
function load_pload_css(){
    $("#load-text").html("script/loading2.css");
    $.ajax({
        url: "../script/loading/pload/load.css",
        dataType: "text",
        cache: true,
        success:function(){
            $("#load-bar").css({"width":bar_width+"%"});
            widthp();
            load_public_js();
        }
    });
}
function load_public_js(){
    $("#load-text").html("script/public.js");
    $.ajax({
        url: "../script/publicjs/publicfunction.js",
        dataType: "script",
        cache: true,
        success:function(){
            $("#load-bar").css({"width":bar_width+"%"});
            widthp();
            saving_stat();
        }
    });
}

function saving_stat(){
    $("#load-text").html("Please Wait...");
    $.ajax({
        method:"post",
        url:"save_stat.php",
        success:function(data){
            $("body").append(data);
            $("#load-bar").css({"width":bar_width+"%"});
            redirect();
        }
    });
}


function redirect(){
    $("#load-text").html("Redirecting...");
    location.href = "../";
}
</script>
</body>
</html>