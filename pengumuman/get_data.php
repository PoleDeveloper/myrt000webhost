<?php
include "../config/config_all.php";

$offset = $_POST['offset'];
$limit = 10;
$get_dt = mysqli_query($conn, "SELECT * FROM pengumuman WHERE grup_code='$grup_code_ac' ORDER BY date DESC LIMIT $offset,$limit ")or die(mysqli_error($conn));
$c_get_dt = mysqli_num_rows($get_dt);
if($c_get_dt == 0){
    echo "<h2 style='text-align: center;'>Tidak Ada Pengumuman Lagi</h2>";
?>
    <script>
        $("#pengdat").attr("offattr", "none");
    </script>
<?php
}else{
    while($rgd = mysqli_fetch_array($get_dt)){
        echo "<div class='divget' id='".$rgd['id']."'>
                <div class='divget_a'>
                    ".date("l, d F Y", strtotime($rgd['date']))."
                </div>
                <hr>
                <div class='divget_b'>
                    ".nl2br($rgd['isi'])."
                </div>";
            if($rgd['pengirim'] == $user_code_ac){
                echo "<div style='text-align: right;'><button id='editbtn' idattr='".$rgd['id']."' class='btn btn-info'>Edit</button> <button id='dltbtn' idattr='".$rgd["id"]."' class='btn btn-danger'>Hapus</button></div>";
            }
        echo  "</div>";
    }
    $offsetl = $offset+$limit;
?>
    <script>
        $("#pengdat").attr("offattr", "<?php echo $offsetl; ?>");
    </script>
<?php
}
?>