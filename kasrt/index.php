<?php
include "../config/config_all.php";
include "../config/disable_other_link.php";

if($session_status == "off"){
    header("Location: ../");
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- important script s -->
    <link rel="stylesheet" href="../script/bootstrap/css/bootstrap.min.css">
    <script src="../script/popperjs/popper.js"></script>
    <script src="../script/jquery/jquery.js"></script>
    <script src="../script/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../script/transition/transition.css"/>
    <link rel="stylesheet" type="text/css" href="../script/loading/loading.css"/>
    <link rel="stylesheet" type="text/css" href="../script/public-our.css"/>
    <link rel='stylesheet' type="text/css" href="../script/loading/pload/load.css" />
    <script src="../script/publicjs/publicfunction.js"></script>
    <script src="../script/page/kasrt.js"></script>
        <!-- summer note s -->
            <link rel="stylesheet" href="../script/summernote/dist/summernote-bs4.css">
            <script type="text/javascript" src="../script/summernote/dist/summernote-bs4.js"></script>
            <script type="text/javascript" src="../script/summernote/dist/lang/summernote-id-ID.min.js"></script>
        <!-- summer note e --> 
    <!-- important script e -->
    <title></title>
    <?php if($display_mode_ac == "light"){ ?>
        <link rel="stylesheet" type="text/css" href="../script/css/kasrt/light.css"/>
        <link rel="stylesheet" type="text/css" href="../script/our.css"/>
    <?php }else if($display_mode_ac == "dark"){ ?>
        <link rel="stylesheet" type="text/css" href="../script/css/kasrt/dark.css"/>
        <link rel="stylesheet" type="text/css" href="../script/darkour.css"/>
    <?php } ?>

<style>
html {
  scroll-behavior: smooth;
}
.khtd1{
    width: 7%;
    padding: 2px 4px;
    transition: 0.5s;
}
.modal-backdrop{
    
}
.btn{
    overflow: hidden;
}
.khtd2{
    width: 63%;
    padding: 2px 4px;
    transition: 0.5s;
}
.khtd3{
    text-align: right;
    width: 30%;
    padding: 2px 4px;
    transition: 0.5s;
}
.trhr{
    height: 3px;
}
.btntk{
    transition: 0.5s;
}
.btntk2{
    transition: 0.5s;
}
.trgkhz2{
    display: none;
}
.divkasinn-form{
    width: 80%;
    right: 0px;
    left: 0px;
    margin: auto;
}
@media screen and (max-width: 550px){
    .btntk{
        padding: 5px 8px;
        font-size: 17px;
    }
    .btnbencon{
        width: 100%;
        margin-bottom: 5px;
    }
    .khtd2{
        width: 53%;
        padding: 2px 4px;
    }
}
/* summernote s */
.note-editor .note-editable {
    line-height: 1.2;
}
/* summernote e */
@media screen and (max-width: 450px){
    .btntk{
        width: 90%;
        margin-bottom: 4px;
    }
    .btntk2{
        width: 90%;
        padding: 5px 5%;
        font-size: 17px;
    }
    .khtd3{
        display: none;
    }
    .trgkhz2{
        display: table-row;
    }
}
@media screen and (max-width: 375px){

}
div.divoutput * img{
    width: 100% !important;
}
</style>
</head>
<body>
    <?php include "../script/full-page-load/loading2.html" ?>
    <?php include "../script/form-full-page/form1.html" ?>
    <!-- error notif -->
    <?php include "../script/notif-page/notif1.html" ?>
<div class="divbody ld ld-float-rtl-in">
    <h2 style="text-align: center;">Kas RT</h2>
    <h6 style="text-align: center"><?php echo $jalan_gp; ?><br>Rt. <?php echo $rt_gp; ?> Rw. <?php echo $rw_gp; ?></h6>
    <hr id="get_kas_header_scrool" class="hr">
    <div>
        <div id="navgup">
            <?php if($status_ac == "bendahara"){ ?>
                <button class="btn btn-dark btnbencon ld ld-zoom-in" style='transition: 0.5s;' id="bkbbtn" onclick='btnbkash();'>Buat Kas Baru</button>
                <button class="btn btn-danger btnbencon ld" id='hydpbtn' style="display: none;" onclick='selecteddel();'>Hapus Yang Dipilih</button>
                <button class="btn btn-danger btnbencon ld" style='transition: 0.5s;font-size:0rem;opacity:0;padding:0rem 0rem;' id='hydpbtn2' onclick='selecteddelcon();'>Hapus Yang Dipilih</button>
            <?php } ?>
            <button class="btn btn-dark btnbencon ld" style='transition: 0.5s;display: none;' id='hydpbtn3' code="" id="" onclick='lhtkash2back();'>Kembali</button>
        </div>
        <br>


        <div id="divbody" style="width: 100%;position: relative;height: auto;" class="ld">
            <div id="divoutput" style="width: 100%;word-break: break-all;display: none;"></div>
            <div style="text-align: right;" id="khoutop">
                <select id="datasorting" onChange="get_kas_header();" style="width: auto;cursor: pointer;" class="custom-select">
                    <option value="1">Terbaru</option>
                    <option value="2">Terlama</option>
                <option value="3">A-Z</option>
                </select>
                <select id="dataperpage" onChange="get_kas_header();" style="width: auto;cursor: pointer;" class="custom-select">
                    <option>2</option><!-- delete this when the app is finish -->
                    <option>10</option>
                    <option>20</option>
                    <option>30</option>
                    <option>50</option>
                </select>
            </div>
            <br><br>
            <table id="khout" statkhdel="0" kastotal="" idkhlhbtn="" idkhdelbtn="" style='width: 100%;word-break: break-word;text-align: justify;'></table>
            
            <div id="divoutput2" cod="" style="position: relative;display: block;width: 100%;word-break: break-word;display: none;"></div>
            <div id="divoutput2_b" style="position: relative;display: block;width: 100%;word-break: break-all;display: none;"></div>
            <div style='display: none;' id="divsummernote">
                <textarea id="summernote_textarea" class="summernote">
                </textarea>
                <p style="font-size: 11px;text-align: right;color: grey;">CopyRight SummerNote</p>
                <div style="text-align: right;"><button onClick="save_catatan_kas();" id="summernote_save_btn" class="btn btn-success">Simpan</button></div>
            </div>
        </div>
    </div>

    <div>

    </div>
</div>

<div style="display: none;" id="divscript"></div>

<br><br><br>
</body>
</html>