<?php
include "../config/config_all.php";

if(isset($_POST['s'])){
    $nama = $_POST['nama'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $kelurahan = $_POST['kelurahan'];
    $kota = $_POST['kota'];
    $kabupaten = $_POST['kabupaten'];
    $kecamatan = $_POST['kecamatan'];
    $kode = $_POST['kode'];
    $u = 1;
    for ($i = 1; $i <= $u; $i++) {
        $str_idgrup = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $idgrup = substr(str_shuffle($str_idgrup), 0, 5);
        $get = mysqli_query($conn, "SELECT * FROM grup WHERE id_grup='$idgrup' ")or die("error");
        $getc = mysqli_num_rows($get);
        if($getc == 0){
            $date = date("YdmiHsu");
            $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890-_";
            $randstr = substr(str_shuffle($str), 0, 25);
            $stry = $randstr.$date;
            mysqli_query($conn, "INSERT INTO grup(id_grup,jalan,rt,rw,kelurahan,kecamatan,kota,kabupaten,grup_code,access_code) VALUES('$idgrup','$nama','$rt','$rw','$kelurahan','$kecamatan','$kota','$kabupaten','$stry','$kode') ")or die("error");
            mysqli_query($conn, "UPDATE users_account SET grup_code='$stry', persetujuan='ya' WHERE user_code='$user_code_ac' ")or die("error");
            break;
        }else{
            $u = $u+1;
        }
    }

    mysqli_close($conn);
}
?>