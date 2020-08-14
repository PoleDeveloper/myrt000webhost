<style>
.sidenavbtn{
    width: 250px;
    height: auto;
    margin: 0.5px 0%;
    border-radius: 0px;
    font-size: 20px;
}
.sidenavbtn:hover{
    opacity: 0.85;
}
.divopensidenav{
    position: fixed;
    top: 10px;
    left: 10px;
    background-color: #0000ff;
    color: white;
    font-size: 20px;
    box-shadow: 1px 1px 10px black;
    z-index: 4;
}
/* width */
::-webkit-scrollbar {
  width: 9px;
}

/* Track */
::-webkit-scrollbar-track {
  background: #f1f1f1;
  cursor: pointer;
}

/* Handle */
::-webkit-scrollbar-thumb {
  background: #888;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #555;
}
</style>

<button onclick="opensidenav();bubblemsgupt();" class="btn divopensidenav">&#9776;</button>
<div id="mainsidenavo" onclick="closesidenav();bubblemsgupt();" style="position: fixed;top: 0px;right: 0px;left: 0px;bottom: 0px;background-color: rgba(51, 51, 51, 0.8);z-index: 4;display: none;"></div>
<div id="mainsidenavi" style="position: fixed;top: 0px;left: -12px;bottom: 0px;width: 0px;background-color: #333333;z-index: 4;overflow-x: hidden;overflow-y: auto;transition: 1s;">
    <button  onclick="closesidenav()" style="position: absolute;top: 5px;right: 5px;cursor: pointer;z-index: 2;" class="btn btn-danger">x</button>
    <br>
    <div style="position: relative;height: 150px;background: url(../gambar/mainpage/4.jpg)no-repeat;background-size: cover;background-position: center;">
        <div style="height: 100%;width: 100%;background-color: rgba(51, 51, 51, 0.6);">
            <div style="position: absolute;width: 75px;height: 75px;background-color: white;border-radius: 100%;top: 30px;left: 5px;box-shadow: 0px 0px 10px black;">

            </div>
            <div style="position: absolute;left: 85px;bottom: 10px;color: white;">
                <?php echo $nama_ac; ?>
            </div>
        </div>
    </div>
    <?php
        $sdnv_qu = mysqli_query($link, "SELECT * FROM grup WHERE grup_code='$grup' ")or die("GAGAL");
        while($sdnv = mysqli_fetch_array($sdnv_qu)){
            echo "<div style='color: white;padding: 2px 3px;'>".$sdnv['jalan']."<br>
                    Rt.".$sdnv['rt']." Rw.".$sdnv['rw']."</div>";
        }
    ?>
    <br>
    <button onclick="document.getElementById('mainiframe').src = 'home/';closesidenav();" class="btn sidenavbtn">HOME</button>
    <button onclick="document.getElementById('mainiframe').src = 'kas/';closesidenav();" class="btn sidenavbtn">KAS RT</button>
    <button onclick="document.getElementById('mainiframe').src = 'periksa/';closesidenav();" class="btn sidenavbtn">Periksa Yuk!</button>
    <button onclick="document.getElementById('mainiframe').src = 'laporrt/';closesidenav();" class="btn sidenavbtn">Lapor RT</button>
    <button onclick="document.getElementById('mainiframe').src = 'notifikasi/';closesidenav();" class="btn sidenavbtn">Pengumuman &<br> Notifikasi</button>
    <button onclick="document.getElementById('mainiframe').src = 'allusers/';closesidenav();" class="btn sidenavbtn">Anggota</button>
    <?php
        if($status == "ketua"){
    ?>
        <button onclick="document.getElementById('mainiframe').src = 'groupsetting';closesidenav();" class="btn sidenavbtn">Pengaturan Grup</button>
    <?php
        }
    ?>
    <hr>
    <button onclick="document.getElementById('mainiframe').src = 'setting/';closesidenav();" class="btn sidenavbtn">Pengaturan Akun</button>
    <button onclick="logout()" class="btn sidenavbtn" style="background-color: rgb(225, 34, 34);color: white;">Log Out</button>
    <br><br>
</div>

<script>
function logout(){
    window.top.location = "../logout/";
}
$(function() {
      //Enable swiping...
    $("#mainsidenavo").swipe( {
        //Generic swipe handler for all directions
        swipe:function(event, direction, distance, duration, fingerCount, fingerData) {
        if(direction == "right"){
            $("#mainsidenavo").fadeIn("1000");
            $("#mainsidenavi").width("250px");
            document.getElementById("mainsidenavi").style.left = "0px";
        }else if(direction == "left"){
            $("#mainsidenavo").fadeOut("1900");
            $("#mainsidenavi").width("0px");
            document.getElementById("mainsidenavi").style.left = "-12px";
        }
    },
        //Default is 75px, set to 0 for demo so any distance triggers swipe
        threshold:50
    });
});
function opensidenav(){
    $("#mainsidenavo").fadeIn("1000");
    document.getElementById("mainsidenavi").style.left = "0px";
    $("#mainsidenavi").width("250px");
}
function closesidenav(){
    $("#mainsidenavo").fadeOut("1900");
    document.getElementById("mainsidenavi").style.left = "-12px";
    $("#mainsidenavi").width("0px");
}
</script>