<?php


/*
NOTE

THE REAL PHP FILE IS get_kas_head2.php

This is Old file, do not use it
*/


include "../config/config_all.php";

$limit = 5;
if(isset($_POST['offset'])){
    $offset = $_POST['offset'];
}else{
    $offset = 0;
}
$offsetnext = $offset+$limit;

$page = $offset+$limit/$limit;

$get = mysqli_query($conn, "SELECT * FROM kas_header WHERE grup_code='$grup_code_ac' LIMIT $offset,$limit ")or die("error");
$get_next = mysqli_query($conn, "SELECT * FROM kas_header WHERE grup_code='$grup_code_ac' LIMIT $offsetnext,$limit ")or die("error");
$get_all = mysqli_query($conn, "SELECT * FROM kas_header WHERE grup_code='$grup_code_ac' ")or die("error");

$count_get = mysqli_num_rows($get);
$count_next = mysqli_num_rows($get_next);
$count_all = mysqli_num_rows($get_all);

$page_all = $count_all/$limit;

if($count_get == 0){
    echo "Kas Kosong";
}else{
    $no = 1;
    $animdur = 0.25;
    while($res = mysqli_fetch_array($get)){
        echo    "<tr id='trgkh".$no."' class='ld ld-fall-ttb-in' style='animation-duration: ".$animdur."s;'>
                    <td class='khtd1'>".$no.". </td>
                    <td class='khtd2'>".$res['nama']."</td>
                    <td class='khtd3'><button id='blhkh".$no."' style='transition: 1s;' onclick=\"lhtkash('".$res['kas_code']."', 'blhkh".$no."');\" class='btntk btn btn-dark'>Lihat</button> ";
                    if($status_ac == "bendahara"){
                        echo    "<button id='bdelkh".$no."' attrchecked='0' attrkc='".$res['kas_code']."' style='transition: 0.2s;' onclick=\"delkash('".$res['kas_code']."', 'bdelkh".$no."');\" class='btntk btn btn-danger ld '>Hapus</button></td>";
                    }
        echo    "</tr>
                <tr class='trhr'>
                    <td COLSPAN='3'><br></td>
                </tr>";
        $no++;
        $animdur = $animdur+0.25;
    }
}

if($count_next == 0){
    echo "WHAT";
}else{
    echo "<tr class='trgkh'>
            <td COLSPAN='3' style='text-align: center;'>";
            if($page == 1){
                echo "<button class='btntk btn btn-success ld ld-jump-alt-in' disabled>Sebelumnya</button>";
            }   
    echo "<span class='btntk'>Halaman ".$page." / ".round($page_all)." </span>";
    
    echo "<button class='btntk btn btn-success ld ld-jump-alt-in'>Selanjutnya</button></td>
        </tr>";
}
?>

<script>
$("#khout").attr("kastotal", "<?php echo $count_get+1; ?>");
$("#khout").attr("idkhdelbtn", "bdelkh");
$("#khout").attr("idkhlhbtn", "blhkh");
</script>

<?php
mysqli_close($conn);
?>