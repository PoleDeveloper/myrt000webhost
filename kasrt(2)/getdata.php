<?php
//all config without loading
include "../config/config_all.php";


$notif = "";
if($status_ac != "warga"){
    $get_query = mysqli_query($conn, "SELECT * FROM kas_header WHERE grup_code='$grup_code_ac' ORDER BY nama ASC")or die(mysqli_error($conn));
}else{
    $get_query = mysqli_query($conn, "SELECT * FROM kas_header WHERE grup_code='$grup_code_ac' AND validasi='ya' ORDER BY nama ASC")or die(mysqli_error($conn));
}
$count_query = mysqli_num_rows($get_query);
$no = 1;
if($count_query == 0){
    echo "Catatan Kas Kosong";
}else{
    while($res = mysqli_fetch_array($get_query)){
        echo "<tr style='";
            if(empty($res['validasi'])){
                echo "background-color: #00b300;color: white;";
            }else if($res['validasi'] == "tidak"){
                echo "background-color: #e61919;color: white;";
            }
        echo "'>
                <td style='width: 70%;'>";
                if(empty($res['validasi'])){
                    echo "<div class='vadtxt'>Menunggu Validasi</div>";
                }
                if($status_ac == "bendahara" AND $res['validasi'] == "tidak"){
                    echo "<div class='vadtxt'>Validasi Ditolak</div>";
                }
                if($res['validasi'] == "ya"){
                    echo "<div class='vadtxt'>Data Telah TerValidasi</div>";
                }
        echo "".$no.") ".$res['nama']."</td>
                <td style='width: 30%;'>";
                if($status_ac == "bendahara"){
                    echo "<button name='readkas' id='readkas' kascode='".$res['kas_code']."' class='btn btn-primary'>Edit</button>
                          <button name='headerdelete' id='headerdelete' headerdeletedata='".$res['kas_code']."' class='btn btn-danger'>Hapus</button>";
                }else if($status_ac == "sekretaris" AND empty($res['validasi'])){
                    echo "<button name='readkas' id='readkas' kascode='".$res['kas_code']."' class='btn btn-primary'>Lihat</button>";
                }else{
                    echo "<button name='readkas' id='readkas' kascode='".$res['kas_code']."' class='btn btn-info'>Lihat</button>";
                }
                if($res['validasi'] == "ya"){
                    /* kas rt download belum tersedia */
                    echo "<button name='download' id='download' kascode='".$res['kas_code']."' class='btn' style='background-color: #009900;color: white;display: none;'>Download [ Belum Tersedia ]</button> <button id='sharekas' kascode='".$res['kas_code']."' class='btn btn-dark'>Bagikan</button>";
                }

        echo    "</td>
              <tr>";
        $no++;
        }
    }
?>