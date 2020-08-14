<?php
include "../config/config_all.php";

if(isset($_POST['input'])){
    $input = $_POST['input'];
    $offset = $_POST['offset'];
    $limit = 10;
    if(empty($offset)){
        $offset = "0";
    }
    $a = 0;
    $offset2 = $offset+$limit;

    $search = mysqli_query($conn, "SELECT * FROM grup WHERE jalan LIKE '%$input%' OR rt LIKE '%$input%' OR rw LIKE '%$input%' OR kecamatan LIKE '%$input%' OR kota LIKE '%$input%' OR kabupaten LIKE '%$input%' ORDER BY jalan ASC LIMIT $offset,$limit ")or die(mysqli_error($conn));
    $count = mysqli_num_rows($search);
    if($count == 0){
        echo "<div style='text-align: center;'>Tidak Menemukan Hasil Dari <br>( ".$input." )</div>";
        $a = 1;
    }else{
        while($res = mysqli_fetch_array($search)){
            echo "<div class='hsearch'>
                    <div>".$res['jalan']."</div>
                    <div>Rt ".$res['rt']." | Rw ".$res['rw']."</div>
                    <div>".$res['kelurahan'].", ".$res['kecamatan'].", ".$res['kota'].", ".$res['kabupaten']."</div>
                    <div style='text-align: right;'><button onclick='gab(\"".$res['grup_code']."\")' class='btn btn-success'>Gabung</button></div>
                </div><hr class='hr'>";
        }
    }
    $search2 = mysqli_query($conn, "SELECT * FROM grup WHERE jalan LIKE '%$input%' OR rt LIKE '%$input%' OR rw LIKE '%$input%' OR kecamatan LIKE '%$input%' OR kota LIKE '%$input%' OR kabupaten LIKE '%$input%' ORDER BY jalan ASC LIMIT $offset2,$limit ")or die(mysqli_error($conn));
    $count2 = mysqli_num_rows($search2);
    if($count2 == 0){
        if($a == 0){
            echo "<div style='font-size: 20px;text-align: center;font-weight: bold;'>Tidak Ada Lagi</div>";
        }
        ?>
            <script>
                $("#page3_output").attr("attroffset", "empty");
                $("#loadmrdiv").fadeOut();
            </script>
        <?php
    }else{
        ?>
            <script>
                $("#page3_output").attr("attroffset", "<?php echo $offset+$limit; ?>");
            </script>
        <?php
    }

    mysqli_close($conn);
}
?>