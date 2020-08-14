<?php
include("../config/config_all.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- important script s -->
    <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css">
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../script/transition/transition.css"/>
    <link rel="stylesheet" type="text/css" href="../script/loading/loading.css"/>
    <link rel="stylesheet" type="text/css" href="../script/lightour.css"/>
    <link rel='stylesheet' type="text/css" href="../script/loading/pload/load.css" />
    <script src="../script/publicjs/publicfunction.js"></script>
    <!-- important script e -->
    <title></title>
    <?php if($display_mode_ac == "light"){ ?>
        <link rel="stylesheet" type="text/css" href="../script/css/kasrt/light.css"/>
        <link rel="stylesheet" type="text/css" href="../script/our.css"/>
    <?php }else if($display_mode_ac == "dark"){ ?>
        <link rel="stylesheet" type="text/css" href="../script/css/kasrt/dark.css"/>
        <link rel="stylesheet" type="text/css" href="../script/darkour.css"/>
    <?php } ?>
    <title>Document</title>
</head>
<body>
    <?php include("../script/full-page-load/loading2.html"); ?>
    <script>
        $(document).ready(function(){
            fpl2s();
        });
    </script>
</body>
</html>