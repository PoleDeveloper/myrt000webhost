<?php
include_once "../config/config_all.php";

$kascodeall = "";
$kaspemall = $kaspenall = "";
$kaspemasukan = "0";
$kaspengeluaran = "0";

$getkas_query = mysqli_query($conn, "SELECT * FROM kas_header WHERE grup_code='$grup_code_ac' AND validasi='ya' ")or die(mysqli_error($conn));
$count_getkas = mysqli_num_rows($getkas_query);
if($count_getkas == 0){

}else{
    while($res1 = mysqli_fetch_array($getkas_query)){
        $kascodeall .= $res1['kas_code'].",";
    }

    $array_kas = $kascodeall;
    $exkas = explode(",", $array_kas);
    foreach($exkas as $k){
        $kascountplus = mysqli_query($conn, "SELECT * FROM kas_inner WHERE kas_code='$k' ")or die(mysqli_error($conn));
        while($rek = mysqli_fetch_array($kascountplus)){
            $kaspemall .= $rek['pemasukan'].",";
            $kaspenall .= $rek['pengeluaran'].",";
        }
    }

    $arraykpm = $kaspemall;
    $kpme = explode(",", $arraykpm);
    foreach($kpme as $kpm){
        if($kpm == ""){

        }else{
            $kaspemasukan = $kaspemasukan+$kpm;
        }
    }

    $arraykpn = $kaspenall;
    $kpne = explode(",", $arraykpn);
    foreach($kpne as $kpn){
        if($kpn == ""){

        }else{
            $kaspengeluaran = $kaspengeluaran+$kpn;
        }
    }
}
?>

<div style="width: 100%;">
    <div>Total Pemasukan Dan Pengeluaran</div><br>
    <table style="width: auto;word-break: break-all;">
        <tr>
            <td>Total Pemasukan</td>
            <td>:</td>
            <td>Rp. <?php echo number_format($kaspemasukan, 0); ?></td>
        </tr>
        <tr>
            <td>Total Pengeluaran</td>
            <td>:</td>
            <td>Rp. <?php echo number_format($kaspengeluaran, 0); ?></td>
        </tr>
    </table>
    <br>
    <button id="ppklr" style="font-size: 15px;" class="btn btn-default">Lihat Lebih Rinci</button>
    <script>
    $(document).on("click", "#ppklr", function(){
        var kascode = $(this).attr("kascode");
        $("#notification").empty().html("loading").fadeIn();
        $.ajax({
        method:"post",
        url:"getkasrin.php",
        dataType:"text",
        success:function(data){
            $("#notification").html("Loading Complete").delay("700").fadeOut();
            openform();
            $(".divshare").html(data).fadeIn();
        }
    });
    });
    </script>
</div>