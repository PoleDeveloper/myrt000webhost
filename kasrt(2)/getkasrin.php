<?php
include "../config/config_all.php";

$kascodeall = "";
$kaspemall = $kaspenall = "";
$kaspemasukan = "0";
$kaspengeluaran = "0";
$outkpb = "";

$getkas_query = mysqli_query($conn, "SELECT * FROM kas_header WHERE grup_code='$grup_code_ac' AND validasi='ya' ORDER BY created_at DESC ")or die(mysqli_error($conn));
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

    foreach($exkas as $kl){
        if($kl == ""){

        }else{
            $ksget1 = mysqli_query($conn, "SELECT * FROM kas_header WHERE kas_code='$kl' ")or die(mysqli_error($conn));
            while($rk1 = mysqli_fetch_array($ksget1)){
                $outkpb .= "<tr><td COLSPAN='3'>".date("M - Y", strtotime($rk1['created_at']))."</td></tr>";
            }
            $ksget2 = mysqli_query($conn, "SELECT SUM(pemasukan), SUM(pengeluaran) FROM kas_inner WHERE kas_code='$kl' ")or die(mysqli_error($conn));
            foreach($ksget2 as $cal){
                $outkpb .= "<tr>
                                <td>Total Pemasukan</td>
                                <td>:</td>
                                <td>Rp. ".number_format($cal["SUM(pemasukan)"], 0)."</td>
                            </tr>";
                $outkpb .= "<tr>
                                <td>Total Pengeluaran</td>
                                <td>:</td>
                                <td>Rp. ".number_format($cal["SUM(pengeluaran)"], 0)."</td>
                            </tr>";
            }
            $outkpb .= "<tr><td COLSPAN='3'><hr></td></tr>";

        }
    }
}

?>
<div>
    <div style="text-align: center;font-size: 18px;">Total Pemasukan Dan Pengeluaran</div>
    <br>
    <div style="text-align: center;">Total Kas Yang Telah divalidasi</div>
    <hr>
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
    <hr>
    <br>
    <div style="text-align: center;font-size: 16px;">Kas Berdasarkan Tanggal Pembuatan</div><br>
    <table style="width: auto;word-break: break-all;">
        <?php echo $outkpb; ?>
    </table>
</div>