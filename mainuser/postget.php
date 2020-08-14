<?php
include "../config/config_all.php";

$offset = $_POST['offset'];
$limit = 10;
$postgetq = mysqli_query($conn, "SELECT * FROM umum WHERE user_code='$user_code_ac' ORDER BY upload_date DESC LIMIT $offset,$limit ")or die(mysqli_error($conn));
$postgetq_count = mysqli_num_rows($postgetq);
if($postgetq_count == 0){
    echo "<h1 style='text-align: center;'>Tidak Ada Lagi</h1>";
?>
    <script>
        $("#divinner").attr("offattr", "none");
    </script>
<?php
}else{
    while($res = mysqli_fetch_array($postgetq)){
        $user_codez = $res['user_code'];
        $gum_code = $res['gum_code'];
        $um_code = $res['um_code'];
        $up_date = $res['upload_date'];
        $get_query2 = mysqli_query($conn, "SELECT * FROM users_account WHERE user_code = '$user_codez' ")or die(mysqli_error($conn));
        while($res2 = mysqli_fetch_array($get_query2)){
            $ap_up = $res2['account_picture'];
            $nama_up = $res2['nama'];
        }
        $get_query3 = mysqli_query($conn, "SELECT * FROM gambar_umum WHERE gum_code='$gum_code' ORDER BY upload_date ASC ")or die(mysqli_error($conn));
        $count_gum_code = mysqli_num_rows($get_query3);
        echo "<div class='display_um'";
                if($session_status == "on" AND $user_codez==$user_code_ac){
                    echo "id='".$um_code."' ";
                }
        echo ">
                <div class='display_um2'>
                    <h3 style='font-size: 20px;text-align: right;'>".date("l, d F Y", strtotime($up_date))."</h3>
                </div>";
        echo "<div class='container'>
                    <div class='row um_isi'>
                        ".nl2br($res['post'])."
                    </div>
                </div>";
                echo "<div class='container'>
                <div gumattr='$gum_code' class='row um_gam' id='um_gam'"; 
                $get_query3_1 = mysqli_query($conn, "SELECT path FROM gambar_umum WHERE gum_code='$gum_code' ORDER BY upload_date ASC LIMIT 1 ")or die(mysqli_error($conn));
                while($gret = mysqli_fetch_array($get_query3_1)){
                    echo "picthframeattr=".$gret['path']." ";
                }
                echo ">";
                if($count_gum_code != 0){
                    if($count_gum_code <= 2){
                        while($res3 = mysqli_fetch_array($get_query3)){
                            echo "<img style='margin: auto;' class='img-thumbnail um_gami' src='../umum/thumbnail".$res3['path']."'>";
                        }
                    }else{
                        $get_query4 = mysqli_query($conn, "SELECT * FROM gambar_umum WHERE gum_code='$gum_code' ORDER BY upload_date ASC LIMIT 1 ")or die(mysqli_error($conn));
                        while($res4 = mysqli_fetch_array($get_query4)){
                            echo "<img style='margin: auto;' class='img-thumbnail um_gami' src='../umum/thumbnail".$res4['path']."'>";
                            echo "<div id='seegumpict' gum_code='$gum_code' style='text-align: right;width: 100%;'>Lihat Gambar Lainnya</div>";
                        }
                    }
                }
        echo    "</div>
            </div>";
        echo "<div>";
            echo "<div class='container'>
                    <div class='row'>";
                    if($session_status == "on"){
                        echo "<button class='like".$um_code."' id='likebtn' umcode='".$um_code."' style='margin: 0px 4px;padding: 0px 5px;border-radius: 4px;background-color: ";

                        $xml = simplexml_load_file('../umum/likes/'.$user_codez.'/likecode/'.$um_code.'.xml');
                        $likecode = $xml->xpath("//likes/user_code[contains(text(), '$user_code_ac')]");
                        if(count($likecode) > 0) { // if found
                            echo "#0066ff;color: white;";
                            echo "' attrc='ya'><img src='../system/icon/like.png' style='width: 25px;height: 25px;background-color: white;margin: 0px 5px 0px 0px;padding: 1px 1px;'>";
                        }else{
                            echo "white;color: black;";
                            echo "' attrc='tidak'><img src='../system/icon/like.png' style='width: 25px;height: 25px;background-color: white;margin: 0px 5px 0px 0px;padding: 1px 1px;'>";
                        }
                    }else{
                        echo "<a>";
                    }
                        $xml = simplexml_load_file('../umum/likes/'.$user_codez.'/like/'.$um_code.'.xml')or die("Error");
                        echo $xml->like;
            echo        " Like </button>";
            
                    if($session_status == "on"){
                        echo "<button class='dislike".$um_code."' id='dislikebtn' umcode='".$um_code."' style='margin: 0px 4px;padding: 0px 5px;border-radius: 4px;background-color: ";

                        $xml = simplexml_load_file('../umum/dislikes/'.$user_codez.'/dislikecode/'.$um_code.'.xml');
                        $dislikecode = $xml->xpath("//dislikes/user_code[contains(text(), '$user_code_ac')]");
                        if(count($dislikecode) > 0) { // if found
                            echo "#0066ff;color: white;";
                            echo "' attrc='ya'><img src='../system/icon/dislike.png' style='width: 25px;height: 25px;background-color: white;margin: 0px 5px 0px 0px;padding: 1px 1px;'>";
                        }else{
                            echo "white;color: black;";
                            echo "' attrc='tidak'><img src='../system/icon/dislike.png' style='width: 25px;height: 25px;background-color: white;margin: 0px 5px 0px 0px;padding: 1px 1px;'>";
                        }
                    }else{
                        echo "<a>";
                    }
                        $xml = simplexml_load_file('../umum/dislikes/'.$user_codez.'/dislike/'.$um_code.'.xml')or die("Error");
                        echo $xml->dislike;
            echo        " DisLike </button>";
            echo    "</div>
                  </div>";
        echo "</div>";
        if($session_status == "on" AND $user_code_ac==$user_codez){
            echo "<div class='um_bottom_bar'>
                    <div class='container'>
                        <div class='row'>
                            <button style='display: inline-block;margin-right: 5px;' umcodeattr='".$um_code."' id='postdelete' class='btn btn-danger'>Hapus Postingan</button>
                            <a href='../mainpage/um_edit/?c=".$um_code."'><button style='display: inline-block;' class='btn btn-info'>Edit Postingan</button></a>
                        </div>
                    </div>
                  </div>";
        }else{
            echo "<div class='um_bottom_bar'>
                    <div class='container'>
                        <div class='row'>
                            
                        </div>
                    </div>
                  </div>";
        }
        echo  "</div>";
        $offsetpost = $offset+$limit;
?>
    <script>
        $("#divinner").attr("offattr", "<?php echo $offsetpost; ?>");
    </script>
<?php
    }
}
?>