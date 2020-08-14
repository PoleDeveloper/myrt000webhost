<?php
//coonection and database config
include "../config/config_all.php";

$kascode = $_POST['kascode'];
$get_query = mysqli_query($conn, "SELECT * FROM kas_inner WHERE kas_code='$kascode' ORDER BY tanggal ASC ")or die("gagal");
$get_query2 = mysqli_query($conn, "SELECT * FROM kas_header WHERE kas_code='$kascode' ")or die("GAGAL");
$count_query = mysqli_query($conn, "SELECT SUM(pengeluaran), SUM(pemasukan) FROM kas_inner WHERE kas_code='$kascode' ")or die("GAGAL");
while($row = mysqli_fetch_array($get_query2)){
    echo "<tr><td style='text-align: center;font-size: 30px;' id='tdtitlekas'>".$row['nama']."";
    if($status_ac == "bendahara"){
    echo    "<br><button kascode='".$kascode."' titlekas='".$row['nama']."' id='btn-titlekas-edit' class='btn btn-success' style='font-size: 15px;'>Edit Judul</button></td>
              <td style='text-align: right;font-size: 30px;display: none;' id='tdformtitlekas'><input onkeyup='limitertxt2();' id='inputtitlekas' class='form-control' type='text'> <button id='btn-simpantitlekas' kascode='' class='btn btn-success'>Simpan</button></td>";
    }
              echo "</tr>";
    $validasi = $row['validasi'];
}
$get_query_count = mysqli_num_rows($get_query);
if($get_query_count == 0){
    echo "<tr><td style='text-align: center;'>Kas Kosong</td></tr>";
}else{
    $no = 1;
    while($res = mysqli_fetch_array($get_query)){
        echo "<tr>
                <td><div class='divtd1'>".date('d F Y', strtotime($res['tanggal']))."</div><div class='divtd2'>".$no.". ".$res['keperluan']."</div>
                    <div class='divtd3'>Pemasukan</div><div class='divtd4'>:</div><div class='divtd5'>Rp ".number_format($res['pemasukan'], 0)."</div>
                    <div class='divtd3'>Pengeluaran</div><div class='divtd4'>:</div><div class='divtd5'>Rp ".number_format($res['pengeluaran'], 0)."</div>";
                    if($status_ac == "bendahara"){
                        echo "<div class='divtd1'><button id='btn-edit-kas-inner' editkas_keperluan='".$res['keperluan']."' editkas_pemasukan='".$res['pemasukan']."' editkas_pengeluaran='".$res['pengeluaran']."' editkas_tanggal='".$res['tanggal']."' kasinner_code='".$res['kasinner_code']."' kascode='".$res['kas_code']."' class='btn btn-primary'>Edit</button> 
                            <button id='hapus-kas-inner' kasinnercode='".$res['kasinner_code']."' kascode='".$kascode."' class='btn btn-danger'>Hapus</button></div>";
                    }
        echo    "</td>
              </tr>";
        $no++;
    }

    foreach($count_query as $cpg){
        $count_pengeluaran = $cpg['SUM(pengeluaran)'];
        $count_pemasukan = $cpg['SUM(pemasukan)'];
    }
    if(empty($count_pemasukan) or empty($count_pengeluaran)){
        $saldo_akhir = "----";
    }else{
        $saldo_akhir = $count_pemasukan-$count_pengeluaran;
    }
    echo "<tr><td>Total Pemasukan : Rp ".number_format($count_pemasukan, 0)."<br>Total Pengeluaran : Rp ".number_format($count_pengeluaran, 0)."<br>Saldo Akhir : Rp ".number_format($saldo_akhir, 0)."</td></tr>";

    echo "<tr style='text-align: center;'>
            <td>";
            if($validasi == "tidak" AND $status_ac == "bendahara"){
                echo "<h4 style='text-align: center;-webkit-text-stroke: 0.2px #FF0000;'>Validasi Telah Ditolak, Silahkan Periksa Kembali</h4>
                      <button id='kasvalidation' dataaction='repeat' kascode='$kascode' class='btn btn-success'>Ajukan Validasi Lagi</button>
                      <button class='btn btn-danger'>Hapus Kas</button>";
            }
            if($validasi == "" AND $status_ac == "sekretaris"){
                echo "<h4 style='text-align: center;'>Konfirmasi Data</h4>
                      <button id='kasvalidation' dataaction='ya' kascode='$kascode' class='btn btn-success'>Terima</button>
                      <button id='kasvalidation' dataaction='tidak' kascode='$kascode' class='btn btn-danger'>Tolak</button>";
            }
    echo"</td>
          </tr>";
}
?>