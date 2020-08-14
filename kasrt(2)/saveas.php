<?php
include "../config/config.php";
/* config all */

$email = $_SESSION['email'];
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

/*config_all*/
$action = $_GET['action'];
$kascode = $_GET['kascode'];
if($action == "excel"){
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=KasRt-$jalan_gp-Rt$rt_gp-Rw$rw_gp.xls");

echo "<!DOCTYPE html>
      <html>
      <head>
      <meta http-equiv='Content-Type' Content='text/html; charset=utf-8'/>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'/>
      </head>
      <body> ";
    $no = 1;
    echo "<table>";
    echo "<tr>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          </tr>";
    echo "<tr>
          <td></td>
          <td Colspan='5'>Kas Rt<br>".ucwords($jalan_gp).", Rt ".$rt_gp.", Rw ".$rw_gp."</td>
          </tr>";
    echo "<tr>
          <td></td>
          <td Colspan='5'></td>
          </tr>";
    echo "<tr>
          <td></td>
          <td style='border: 0.7px solid black;width: auto;height: auto;'>No</td>
          <td style='border: 0.7px solid black;width: auto;height: auto;'>Keperluan</td>
          <td style='border: 0.7px solid black;width: auto;height: auto;'>Pemasukan</td>
          <td style='border: 0.7px solid black;width: auto;height: auto;'>Pengeluaran</td>
          <td style='border: 0.7px solid black;width: auto;height: auto;'>Tanggal</td>
          </tr>";
    $query = mysqli_query($conn, "SELECT * FROM kas_inner WHERE kas_code='$kascode' ORDER BY tanggal ASC ")or die("GAGAL");
    $count_query = mysqli_query($conn, "SELECT SUM(pengeluaran), SUM(pemasukan) FROM kas_inner WHERE kas_code='$kascode' ")or die("GAGAL");
    while($res = mysqli_fetch_assoc($query)){
    echo "<tr>
            <td></td>
            <td style='border: 0.7px solid black;width: auto;height: auto;text-align: left;'>".$no."</td>
            <td style='border: 0.7px solid black;width: auto;height: auto;'>".ucfirst($res['keperluan'])."</td>
            <td style='border: 0.7px solid black;width: auto;height: auto;'>Rp ".number_format($res['pemasukan'],0)."</td>
            <td style='border: 0.7px solid black;width: auto;height: auto;'>Rp ".number_format($res['pengeluaran'],0)."</td>
            <td style='border: 0.7px solid black;width: auto;height: auto;text-align: left;'>".date("j, F Y",strtotime($res['tanggal']))."</td>
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
    echo "<tr>
          <td></td>
          <td COLSPAN='2' style='border: 0.7px solid black;width: auto;height: auto;'></td>
          <td style='border: 0.7px solid black;width: auto;height: auto;'>Rp ".number_format($count_pemasukan,0)."</td>
          <td style='border: 0.7px solid black;width: auto;height: auto;'>Rp ".number_format($count_pengeluaran,0)."</td>
          <td style='border: 0.7px solid black;width: auto;height: auto;'></td>
          </tr>";
    echo "<tr>
          <td></td>
          <td COLSPAN='5' style='border: 0.7px solid black;width: auto;height: auto;text-align: right;'>Total = Rp ".number_format($total_sum,0)."</td>
          </tr>";
    echo "<tr>
          <td></td>
          <td Colspan='5'><a href='https://rtkugoonline.000webhostapp.com'>https://rtkugoonline.000webhostapp.com</a></td>
          </tr>";
    echo "</table>";
}
?>