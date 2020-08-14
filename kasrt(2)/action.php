<?php
//coonection and database config
include "../config/config_all.php";

$err = "";

if(isset($_POST['nama'])){
    $nama = $_POST['nama'];
    /* grup tipe
    if($grup_tipe == "1"){
        if($count_dtkh>=3){
            echo "Maaf Penyimpanan Penuh";
            $err = "err";
        }
    }else if($grup_tipe == "2"){
        if($count_dtkh>=6){
            echo "Maaf Penyimpanan Penuh";
            $err = "err";
        }
    }else if($grup_tipe == "3" & $deadline<$today_date){
        echo "Gagal (Paket Habis)";
        $err = "err";
    }
    */
    if(empty($err)){
        //create Grup code
        $kas_code = "K".date("mHsDYduiB")."C";
        //date format code ([D] 3 letter of a day)([H] 24 fromat hour)([s] seconds 00-59)([m] Numeric Month 01-12)([Y] Four Digit Year)([d] day 01-31)([i] minute)([B] swacth internet Time)
        if(strlen($nama) > 30){
            echo "Max 30 Karakter";
        }else{
            $query = mysqli_query($conn, "INSERT INTO kas_header(nama,kas_code,grup_code) VALUES('$nama','$kas_code','$grup_code_ac') ")or die(mysqli_error($conn));
            echo "Berhasil";
        }
    }
}else if(isset($_POST['inputkasinner'])){
    $keperluan = $_POST['keperluan'];
    $pemasukan = $_POST['pemasukan'];
    $pengeluaran = $_POST['pengeluaran'];
    $tanggal = $_POST['tanggal'];
    $kascode = $_POST['kascode'];
    $query_ki_get = mysqli_query($conn, "SELECT * FROM kas_inner WHERE kas_code='$kascode' ")or die("GAGAL");
    $count_ki_get = mysqli_num_rows($query_ki_get);
    /* grup tipe
    if($grup_tipe == "1" & $count_ki_get>="20"){
        echo "Penyimpanan Penuh";
        $err = "err";
    }else if($grup_tipe == "2" & $count_ki_get>="35"){
        echo "Penyimpanan Penuh";
        $err = "err";
    }else if($grup_tipe == "3" & $deadline<$today_date){
        echo "Gagal (Paket Habis)";
        $err = "err";
    } */
    if(empty($err)){
        //kas inner code
        $kasinnercode = "KI".date("mHsDYudiB")."C";
        //date format code ([D] 3 letter of a day)([H] 24 fromat hour)([s] seconds 00-59)([m] Numeric Month 01-12)([Y] Four Digit Year)([d] day 01-31)([i] minute)([B] swacth internet Time)
        $query = mysqli_query($conn, "INSERT INTO kas_inner(keperluan,pemasukan,pengeluaran,tanggal,kas_code,kasinner_code) VALUES('$keperluan','$pemasukan','$pengeluaran','$tanggal','$kascode','$kasinnercode') ")or die("GAGAL");
        echo "Berhasil";
    }
}else if(isset($_POST['editkasinner'])){
    $keperluan = $_POST['keperluan'];
    $pemasukan = $_POST['pemasukan'];
    $pengeluaran = $_POST['pengeluaran'];
    $tanggal = $_POST['tanggal'];
    $kasinner_code = $_POST['kasinner_code'];
    //kas inner code
    $kasinnercode = "KI".date("mHsDYudiB")."C";
    //date format code ([D] 3 letter of a day)([H] 24 fromat hour)([s] seconds 00-59)([m] Numeric Month 01-12)([Y] Four Digit Year)([d] day 01-31)([i] minute)([B] swacth internet Time)
    $query = mysqli_query($conn, "UPDATE kas_inner SET keperluan='$keperluan', pemasukan='$pemasukan', pengeluaran='$pengeluaran', tanggal='$tanggal' WHERE kasinner_code='$kasinner_code' ")or die("GAGAL");
    echo "Berhasil";
}else if(isset($_POST['kasinnerdelete'])){
    $kasinnercode = $_POST['kasinnercode'];
    $query = mysqli_query($conn, "DELETE FROM kas_inner WHERE kasinner_code='$kasinnercode' ")or die("GAGAL");
    echo "Berhasil";
}else if(isset($_POST['headerdelete'])){
    $headerdelete = $_POST['headerdelete'];
    $query = mysqli_query($conn, "DELETE FROM kas_header WHERE kas_code='$headerdelete'")or die("Gagal");
    $query2 = mysqli_query($conn, "DELETE FROM kas_inner WHERE kas_code='$headerdelete'")or die("Gagal");
    echo "Berhasil";
}else if(isset($_POST['titlekas'])){
    $titlekas = $_POST['titlekas'];
    $kascode = $_POST['kascode'];
    $query = mysqli_query($conn, "UPDATE kas_header SET nama='$titlekas' WHERE kas_code='$kascode' ")or die("GAGAL");
    echo "Berhasil";
}else if(isset($_POST['kasvalidation'])){
    $action = $_POST['kasvalidation'];
    $kascode = $_POST['kascode'];
    if($action == "repeat"){
        $query = mysqli_query($conn, "UPDATE kas_header SET validasi='' WHERE kas_code='$kascode' ")or die("GAGAL");
        echo "Berhasil";
    }else if($action == "ya"){
        $query = mysqli_query($conn, "UPDATE kas_header SET validasi='ya' WHERE kas_code='$kascode' ")or die("GAGAL");
        echo "Berhasil";
    }else if($action == "tidak"){
        $query = mysqli_query($conn, "UPDATE kas_heder SET validasi='tidak' WHERE kas_code='$kascode' ")or die("GAGAL");
        echo "Berhasil";
    }
}
?>