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
    <title>Check Data</title>
<style>
body{
    font-family: Courier New;
    scroll-behavior: smooth;
}
.logdiv{
    margin: 5px 0px;
}
</style>
</head>
<body>

<h1>Checking Data</h1>

<div style="width: 100%; height: 500px;overflow: auto;">

    <div id="logbox" attra="0" attrb="0">

    </div>
    <div id="bottomlogbox" style="margin-top: 50px;">
        Loading....
    </div>

</div>

<div>
    <h1>Error Log</h1>
    <div id="errorlog">

    </div>
</div>

<script>
    $(document).ready(function(){
        check();
    });

    function bottom(){
        document.getElementById('bottomlogbox').scrollIntoView();
    }

    function check(){
        var attra = $("#logbox").attr("attra");
        var attrb = $("#logbox").attr("attrb");
        if(attra == "end" && attrb == "end"){

        }else{
            $.ajax({
                method:"post",
                url:"action1.php",
                data:{
                    attra:attra,
                    attrb:attrb
                },
                dataType:"text",
                success:function(data){
                    $("#logbox").append(data);
                    bottom();
                    check();
                }
            });
        }
    }
</script>

</body>
</html>