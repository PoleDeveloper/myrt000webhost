<?php
include "../config/config.php";

$email = $_SESSION['email'];
$kascode =$_GET['kascode'];
$config_query = mysqli_query($conn, "SELECT * FROM users_account WHERE email LIKE '%$email%' ")or die(mysqli_error());
while($coq = mysqli_fetch_array($config_query)){
      $grup_code_ac = $coq['grup_code'];
}
if(!empty($grup_code_ac)){
      $grup_config_query = mysqli_query($conn, "SELECT * FROM grup WHERE grup_code='$grup_code_ac' ")or die(mysqli_error($conn));
      while($gcoq = mysqli_fetch_array($grup_config_query)){
            $rt_gp = $gcoq['rt'];
            $rw_gp = $gcoq['rw'];
            $jalan_gp = $gcoq['jalan'];
      }
}

header("Content-type: application/vnd-ms-doc");
header("Content-Disposition: attachment; filename=KasRt-$jalan_gp-Rt$rt_gp-Rw$rw_gp.docx");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<style>
td{
    padding: 10px 5px;
}
</style>
</head>
<body>

<div>
<?php
$no = 1;
echo "<table style='border: 0.5px solid black;margin: auto;width: 80%;height: auto;'>";
echo "<tr style='font-size: 20pt;'>
      <td Colspan='5'>Kas Rt ".$nama_ac."<br>".$jalan_gp.", Rt ".$rt_gp.", Rw ".$rw_gp."</td>
      </tr>";
echo "<tr>
      <td Colspan='5'></td>
      </tr>";
echo "<tr style='font-size: 18pt;background-color: #cccccc;'>
      <td style='border: 0.5px solid black;'>No</td>
      <td style='border: 0.5px solid black;'>Keperluan</td>
      <td style='border: 0.5px solid black;'>Pemasukan</td>
      <td style='border: 0.5px solid black;'>Pengeluaran</td>
      <td style='border: 0.5px solid black;'>Tanggal</td>
      </tr>";
$query = mysqli_query($conn, "SELECT * FROM kas_inner WHERE kas_code='$kascode' ")or die("GAGAL");
$count_query = mysqli_query($conn, "SELECT SUM(pengeluaran), SUM(pemasukan) FROM kas_inner WHERE kas_code='$kascode' ")or die("GAGAL");
while($res = mysqli_fetch_assoc($query)){
echo "<tr style='font-size: 15pt;'>
        <td style='border: 0.5px solid black;background-color: #cccccc;'>".$no."</td>
        <td style='border: 0.5px solid black;'>".$res['keperluan']."</td>
        <td style='border: 0.5px solid black;'>Rp ".number_format($res['pemasukan'],0)."</td>
        <td style='border: 0.5px solid black;'>Rp ".number_format($res['pengeluaran'],0)."</td>
        <td style='border: 0.5px solid black;'>".date("j, F Y",strtotime($res['tanggal']))."</td>
      </tr>";
      $no++;
}
foreach($count_query as $cpg){
    $count_pengeluaran = $cpg['SUM(pengeluaran)'];
    $count_pemasukan = $cpg['SUM(pemasukan)'];
}
if(empty($count_pemasukan)){
    $total_sum = $count_pengeluaran;
    $count_pemasukan = 0;
}else{
    $total_sum = $count_pemasukan-$count_pengeluaran;
}
echo "<tr style='font-size: 15pt;'>
      <td COLSPAN='2'>Jumlah --></td>
      <td style='border: 0.5px solid black;'>Rp ".number_format($count_pemasukan,0)."</td>
      <td style='border: 0.5px solid black;'>Rp ".number_format($count_pengeluaran,0)."</td>
      <td style='border: 0.5px solid black;'></td>
      </tr>";
echo "<tr style='font-size: 15pt;'>
      <td style='border: 0.5px solid black;' COLSPAN='5'>Total = Rp ".number_format($total_sum,0)."</td>
      </tr>";
echo "<tr>
      <td Colspan='5'><a href='https://rtkugoonline.000webhostapp.com'>https://rtkugoonline.000webhostapp.com</a></td>
      </tr>";
echo "</table>";
?>
</div>
</div>
</body>
</html>