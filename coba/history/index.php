<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../script/bootstrap/css/bootstrap.min.css">
    <script src="../../script/jquery/jquery.js"></script>
    <script src="../../script/bootstrap/js/bootstrap.min.js"></script>
    <title>Document</title>
<script>
jQuery(document).ready(function($) {

if (window.history && window.history.pushState) {

  $(window).on('popstate', function() {
    var hashLocation = location.hash;
    var hashSplit = hashLocation.split("#!/");
    var hashName = hashSplit[1];

    if (hashName !== '') {
      var hash = window.location.hash;
      if (hash === '') {
          var attrcond = $(".divbodyinner").attr("attrcond");
          if(attrcond == "1"){
                closeform();
          }else if(attrcond == "eki"){
                editinnerkascancel();
          }else if(attrcond == "buk"){
                submitkascancel();
          }else{
            
          }
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
</script>
</head>
<body>
    b
</body>
</html>