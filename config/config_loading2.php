<style>
.lds-spinner {
  color: official;
  display: inline-block;
  position: relative;
  width: 64px;
  height: 64px;
}
.lds-spinner div {
  transform-origin: 32px 32px;
  animation: lds-spinner 1.2s linear infinite;
}
.lds-spinner div:after {
  content: " ";
  display: block;
  position: absolute;
  top: 3px;
  left: 29px;
  width: 5px;
  height: 14px;
  border-radius: 20%;
  background: white;
}
.lds-spinner div:nth-child(1) {
  transform: rotate(0deg);
  animation-delay: -1.1s;
}
.lds-spinner div:nth-child(2) {
  transform: rotate(30deg);
  animation-delay: -1s;
}
.lds-spinner div:nth-child(3) {
  transform: rotate(60deg);
  animation-delay: -0.9s;
}
.lds-spinner div:nth-child(4) {
  transform: rotate(90deg);
  animation-delay: -0.8s;
}
.lds-spinner div:nth-child(5) {
  transform: rotate(120deg);
  animation-delay: -0.7s;
}
.lds-spinner div:nth-child(6) {
  transform: rotate(150deg);
  animation-delay: -0.6s;
}
.lds-spinner div:nth-child(7) {
  transform: rotate(180deg);
  animation-delay: -0.5s;
}
.lds-spinner div:nth-child(8) {
  transform: rotate(210deg);
  animation-delay: -0.4s;
}
.lds-spinner div:nth-child(9) {
  transform: rotate(240deg);
  animation-delay: -0.3s;
}
.lds-spinner div:nth-child(10) {
  transform: rotate(270deg);
  animation-delay: -0.2s;
}
.lds-spinner div:nth-child(11) {
  transform: rotate(300deg);
  animation-delay: -0.1s;
}
.lds-spinner div:nth-child(12) {
  transform: rotate(330deg);
  animation-delay: 0s;
}
@keyframes lds-spinner {
  0% {
    opacity: 1;
  }
  100% {
    opacity: 0;
  }
}
</style>
<div id="um_load" style="position: fixed;top: 0px;right: 0px;left: 0xp;bottom: 0px;width: 100%;height: 100%;background-color: rgba(229, 239, 241, 0.7);z-index: 2;background-color: rgba(50, 50, 50, 0.5);">
    <div style="position: fixed;overflow: hidden;width: 120px;height: 125px;margin: auto;top: 0px;right: 0px;left: 0px;bottom: 0px;margin: auto;text-align: center;">
        <div style="width: 80px;height: 80px;overflow: hidden;margin: auto;text-align: center;">
            <div class="lds-spinner"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
        <div attrloadtext="0" id="um_load_text" style="color: white;text-shadow: 0.5px 0.5px 1px black;">Loading</div>
    </div>
    <div style="position: fixed;bottom: 5px;left: 5px;">
      <!-- change the src image when you upload it -->
      <a href="https://youtube.com" target="black"><img style="width: 30px;height: 30px;cursor: pointer;" src="http://localhost/myrt000webhost/system/wall/poledevlogo.jpg"></a>
      <a href="https://facebook.com" target="black"><img style="width: 30px;height: 30px;cursor: pointer;" src="http://localhost/myrt000webhost/system/icon/facebook-icon.png"></a>
    </div>
</div>
<script>
var umloadcas = 0;
var umloadcam = 0;
function umloadcountstart(){
  $("#um_load_text").attr("attrloadtext", "0");
  countumloadca();
}
function umloadcountend(){
  $("#um_load_text").attr("attrloadtext", "1");
  countumloadca();
}
function countumloadca(){
  attrloadtext = $("#um_load_text").attr("attrloadtext");
  if(attrloadtext == "0"){
    setTimeout(function(){
    umloadcas = umloadcas+1;
    if(umloadcas == 60){
      umloadcas = 0;
      umloadcam = umloadcam+1;
    }
    $("#um_load_text").html("Loading<br>"+umloadcam+"menit "+umloadcas+"detik");
      countumloadca();
    }, 1000);
  }else if(attrloadtext == "1"){
    $("#um_load_text").html("Loading");
    umloadcas = 0;
    umloadcam = 0;
  }
}
</script>