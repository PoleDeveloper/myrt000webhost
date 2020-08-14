<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css">
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
    <title>Tentang Aplikasi Ini</title>
<style>
html,
body{
background-color: whitesmoke;
}
.divmain{
    position: fixed;
    top: 0px;
    right: 0px;
    left: 0px;
    bottom: 0px;
    width: 100%;
    height: 100px;
    margin: auto;
    text-align: center;
}
</style>
</head>
<body>
    <div class="divmain">
        <h1 id="1" style="font-family: DFPOP1-W9;display: none;">MyRt4U</h1>
        <h3 id="2" style="display: none;">By: PoleDev</h3>
        <h3 id="3" style="display: none;">All rights reserved</h3>
        <h3 id="4" style="display: none;">-------------------</h3>
        <h3 id="5" style="display: none;">Facebook<br><a href="https://facebook.com">Pole Dev</a></h3>
    </div>
    <script>
        $(document).ready(function(){
            display();
        });
        var number = 1;
        function display(){
            $("#"+number).delay(400).fadeIn();
            setTimeout(function(){
                $("#"+number).fadeOut();
                number = number+1;
                if(number == 6){
                    number = 1;
                }
                display();
            }, 4000);
        }
    </script>
</body>
</html>