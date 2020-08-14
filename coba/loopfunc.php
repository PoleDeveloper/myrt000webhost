<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <script>
    var a = 0;
    var b = 200;
    loop();
    function loop(){
        if(a != b){
            a+1;
            loop();
        }
        alert("DONE");
    }
    </script>
</body>
</html>