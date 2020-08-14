<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
<style>
body{
  font-family: arial;
}
#full-page-load-3{
  position: fixed;
  top: 0px;
  right: 0px;
  left: 0px;
  bottom: 0px;
}
#div-lds-loading{
    position: fixed;
    top: 0px;
    bottom: 0px;
    right: 0px;
    left: 0px;
    background: white;
    z-index: 11;
    margin: auto;
    width: 100px;
    height: 75px;
    overflow: hidden;
}
#div-lds{
  width: 100%;
  height: 60px;
  margin:auto;
  padding-top: 20%;
  text-align: center;
}
.lds-ellipsis {
  display: inline-block;
  position: relative;
  width: 70px;
  height: 20px;
}
.lds-ellipsis div {
  position: absolute;
  top: 0px;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  animation-timing-function: cubic-bezier(0, 1, 1, 0);
}
.lds-ellipsis div:nth-child(1) {
  left: 6px;
  animation: lds-ellipsis1 2.3s infinite;
  background-color: blue;
  z-index: 1;
}
.lds-ellipsis div:nth-child(2) {
  left: 6px;
  animation: lds-ellipsis2a 2.3s infinite;
  background-color: red;
  z-index: 2;
}
.lds-ellipsis div:nth-child(3) {
  left: 26px;
  animation: lds-ellipsis2b 2.3s infinite;
  background-color: yellow;
  z-index: 2;
}
.lds-ellipsis div:nth-child(4) {
  left: 45px;
  animation: lds-ellipsis3 2.3s infinite;
  background-color: blue;
  z-index: 1;
}
@keyframes lds-ellipsis1 {
  0% {
    transform: scale(0);
    background-color: blue; /* 3 */
  }
  33%{
    transform: scale(1);
  }
  33.1111%{
    transform: scale(0);
    background-color: yellow; /* 1 */
  }
  66%{
    transform: scale(1);
  }
  66.1111%{
    transform: scale(0);
    background-color: red; /* 2 */
  }
  100% {
    transform: scale(1);
  }
}
@keyframes lds-ellipsis3 {
  0% {
    transform: scale(1);
    background-color: blue;
  }
  33%{
    transform: scale(0);
  }
  33.1111%{
    transform: scale(1);
    background-color: yellow;
  }
  66%{
    transform: scale(0);
  }
  66.1111%{
    transform: scale(1);
    background-color: red;
  }
  100% {
    transform: scale(0);
  }
}
@keyframes lds-ellipsis2a {
  0% {
    transform: translate(0, 0);
    background-color: red;
  }
  33%{
    transform: translate(19px, 0);
  }
  33.1111%{
    transform: translate(0, 0);
    background-color: blue;
  }
  66%{
    transform: translate(19px, 0);
  }
  66.1111%{
    transform: translate(0, 0);
    background-color: yellow;
  }
  100% {
    transform: translate(19px, 0);
  }
}
@keyframes lds-ellipsis2b {
  0% {
    transform: translate(0, 0);
    background-color: yellow;
  }
  33%{
    transform: translate(19px, 0);
  }
  33.1111%{
    transform: translate(0, 0);
    background-color: red;
  }
  66%{
    transform: translate(19px, 0);
  }
  66.1111%{
    transform: translate(0, 0);
    background-color: blue;
  }
  100% {
    transform: translate(19px, 0);
  }
}
</style>
<script>
/*
window.addEventListener("load", function(){
    var load_screen = document.getElementById("div-lds-loading");
    document.body.removeChild(load_screen);
});
*/
</script>
</head>
<body>
  <div id="full-page-load-3"><div id="div-lds-loading"><div id="div-lds"><div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div><br>Loading</div></div></div>
</body>
</html>