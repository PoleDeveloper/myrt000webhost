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
    <!-- important script e -->
    <title>Document</title>
</head>
<body>
    <div id="divmain"></div>
    <script>
        $(document).ready(function(){
            getdata();
        });
        function getdata(){
            $.ajax({
                method:"post",
                url:"jsonget.php",
                dataType:"json",
                success:function(data){
                    $("#divmain").append(data.status+"<br>");
                    for(var i = 0;i < data.datalen;i++){
                        $("#divmain").append(data.result[i].email+"<br>");
                    }
                }
            });
        }
    </script>
</body>
</html>