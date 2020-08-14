<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css">
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../script/transition/transition.css"/>
    <link rel="stylesheet" type="text/css" href="../script/loading/loading.css"/>
    <title>Document</title>
</head>
<body>
<button onclick="addpage1();" class="btnq btn btn-primary">Ketua Rt</button>
<script>
            function addpage1(){
                $.ajax({
                    url:"position.php",
                    method:"post",
                    dataType:"text",
                    success:function(data){
                        if(data === "berhasil"){
                            alert("That");
                        }
                    }
                });
            }
        </script>
</body>
</html>