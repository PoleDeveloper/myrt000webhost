<?php
//coonection and database config
include "../../config/config.php";

$loadmore_btn = "";
sleep(1);//delay eksekusi
if(isset($_POST['search'])){
    $search = $_POST['search'];
    $limit = $_POST['limit'];
    $offset = $_POST['offset'];
    $offset = $offset+$limit;

    $query = mysqli_query($conn, "SELECT * FROM grup WHERE jalan LIKE '%$search%' OR grup_code='$search' ORDER BY jalan ASC LIMIT $offset,$limit ");
    $query_count = mysqli_num_rows($query);
    if($query_count == '0'){
        $loadmore_btn = "<div style='text-align: center;'>TIDAK ADA HASIL PENCARIAN LAGI</div>";
    }else{
        while($res = mysqli_fetch_array($query)){
            echo    "<tr>
                        <td class='td1'>".$res['jalan'].", ".$res['kelurahan']."
                        <div>
                                ".$res['kecamatan'].", ".$res['kota']."
                            </div>
                            </td>
                            <td class='td2'><a href='".$res['grup_code']."'><button class='btn btn-success'>Gabung</button></a></td>
                    </tr>";
        }
        $loadmore_btn = "<button type='button' name='loadmore' id='loadmore' data-search='".$search."' data-limit='".$limit."' data-offset='".$offset."' class='btn btn-primary'>Load More</button>";
    }
}
?>
<tr id="remove"><td style="text-align: center;" COLSPAN="2">
    <?php echo $loadmore_btn; ?>
</td></tr>