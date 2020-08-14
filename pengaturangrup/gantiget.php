<?php
include "../config/config_all.php";

$ganti = $_POST['ganti'];
if($ganti == "ketua"){
    $ganti = "Ketua Rt";
}else if($ganti == "sekretaris"){
    $ganti = "Sekretaris";
}else if($ganti == "bendahara"){
    $ganti = "Bendahara";
}

$today = date("Y-m-d");
$get_fam = mysqli_query($conn, "SELECT * FROM users_account WHERE grup_code='$grup_code_ac' AND user_code!='$user_code_ac' AND status!='sekretaris' AND status!='bendahara' ")or die(mysqli_error($conn));
while($rgf = mysqli_fetch_array($get_fam)){
    echo    "<table>
                <tr>
                    <td COLSPAN=3><img class='img_acc' src='";
                if(empty($rgf['account_picture'])){
                    echo "../system/icon/user.png";
                }else{
                    echo $rgf['account_picture'];
                }
    echo    "'></td>
                </tr>
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td>".ucwords($rgf['nama'])."</td>
                </tr>
                <tr>
                    <td>Umur</td>
                    <td>:</td>
                    <td>";
                    $birth = new DateTime($rgf['tanggal_lahir']);
                    $today = new DateTime();
                    
                    $diffbirth = $today->diff($birth);
    echo            $diffbirth->y;
    echo    "    Tahun</td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>:</td>
                    <td>".$rgf['alamat']."</td>
                </tr>
                <tr>
                    <td>Nomor Telepon</td>
                    <td>:</td>
                    <td>".$rgf['no_tlp']."</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>".$rgf['email']."</td>
                </tr>
                <tr>
                    <td style='text-align: right;' COLSPAN='3'>";
                    if($status_ac == "ketua" or $status_ac == "sekretaris" or $status_ac == "bendahara"){
                        echo "<button id='btnganti' attruc='".$rgf['user_code']."' class='btn btn-success'>Pilih Sebagai ".$ganti."</button>";
                    }else{
                        
                    }
    echo            "</td>
                </tr>
                </table>";
}
?>