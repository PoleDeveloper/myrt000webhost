<?php
include "../config/config_all.php";

$offset = $_POST['offset'];
$last_date = $_POST['ld'];
$lasdate = "";
if(empty($offset)){
    $offset = 0;
}
if(empty($last_date)){
    $fld = date("Y-m-d H:i:s");
}else{
    $fld = date("Y-m-d H:i:s", strtotime($last_date));
}
$limit = 10;
$offset2 = $limit+$offset;
if($session_status == "on"){
    $get_query = mysqli_query($conn, "SELECT * FROM umum WHERE share='all' AND upload_date<'$fld' OR share='$grup_code_ac' AND upload_date<'$fld' ORDER BY upload_date DESC LIMIT $offset,$limit ")or die(mysqli_error($conn));
    $last_date = mysqli_query($conn, "SELECT * FROM umum WHERE share='all' OR share='$grup_code_ac' ORDER BY upload_date DESC LIMIT $offset2,1 ")or die(mysqli_error($conn));
    while($kli = mysqli_fetch_array($last_date)){
        $lasdate = date("Y-m-d H:i:s", strtotime($kli['upload_date']));
    }
}else if($session_status == "off"){
    $get_query = mysqli_query($conn, "SELECT * FROM umum WHERE share='all' ORDER BY upload_date DESC LIMIT $offset,$limit ")or die(mysqli_error($conn));
}
$count_query = mysqli_num_rows($get_query);
if($count_query == 0){
    echo "<h3 style='text-align: center;'>Tidak Ada Lagi</h3>";
    ?>
        <script>
            $("#umumget").attr("offattr", "empty");
        </script>
    <?php
}else{
    while($res = mysqli_fetch_array($get_query)){
        $user_codez = $res['user_code'];
        $gum_code = $res['gum_code'];
        $um_code = $res['um_code'];
        $get_query2 = mysqli_query($conn, "SELECT * FROM users_account WHERE user_code = '$user_codez' ")or die(mysqli_error($conn));
        while($res2 = mysqli_fetch_array($get_query2)){
            $ap_up = $res2['account_picture'];
            $nama_up = $res2['nama'];
        }
        if(empty($ap_up)){
            $ap_up = "../system/icon/user.png";
        }
        $get_query3 = mysqli_query($conn, "SELECT * FROM gambar_umum WHERE gum_code='$gum_code' ORDER BY upload_date ASC ")or die(mysqli_error($conn));
        $count_gum_code = mysqli_num_rows($get_query3);
        echo "<div class='display_um'";
                if($session_status == "on" AND $user_codez==$user_code_ac){
                    echo "id='".$um_code."' ";
                }
        echo ">
                <div class='display_um2'>
                    <div class='container'>
                        <div class='row'>
                            <div class='account_pic_div'><img style='width: 100%;height:100%;' src='".$ap_up."'></div>
                            <div class='um_name'>".htmlentities($nama_up)."</div>
                        </div>
                    </div>
                </div>";
        echo "<div class='container'>
                    <div class='row um_isi'>";
                        if(strlen(nl2br($res['post'])) > 100){
                            echo "<p>".substr(nl2br(strip_tags($res['post'])), 0, 100), "<p><a><br>")."
                                <a style='display: none;' id='".$res['id']."rm'>".strip_tags(substr(nl2br($res['post']), 100), "<p><a><br>")."</a>
                                <a id='rmbtn' attrrm='".$res['id']."rm' style='color: #034f84;cursor: pointer;'>Read More</a>
                                </p>";
                        }else{
                            echo nl2br(strip_tags($res['post']), '<br>');
                        }
        echo        "</div>
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
                            echo "<img style='margin: auto;' class='img-thumbnail um_gami' src='../umum/thumbnail/".$res3['path']."'>";
                        }
                    }else{
                        $get_query4 = mysqli_query($conn, "SELECT * FROM gambar_umum WHERE gum_code='$gum_code' ORDER BY upload_date ASC LIMIT 1 ")or die(mysqli_error($conn));
                        while($res4 = mysqli_fetch_array($get_query4)){
                            echo "<img style='margin: auto;' class='img-thumbnail um_gami' src='../umum/thumbnail/".$res4['path']."'>";
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
                        echo "<button class='like".$um_code."' id='likebtn' umcode='".$um_code."' style='margin: 0px 4px;border: none;padding: 3px 5px;border-radius: 4px;background-color: ";

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
                        echo "<button class='btn btn-link'>";
                    }
                        $xml = simplexml_load_file('../umum/likes/'.$user_codez.'/like/'.$um_code.'.xml')or die("Error");
                        echo $xml->like;
            echo        " Like </button>";
            
                    if($session_status == "on"){
                        echo "<button class='dislike".$um_code."' id='dislikebtn' umcode='".$um_code."' style='margin: 0px 4px;border: none;padding: 3px 5px;border-radius: 4px;background-color: ";

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
                        echo "<button class='btn btn-link'>";
                    }
                        $xml = simplexml_load_file('../umum/dislikes/'.$user_codez.'/dislike/'.$um_code.'.xml')or die("Error");
                        echo $xml->dislike;
            echo        " DisLike </button>";
                        if($session_status == "on"){
                            if($user_codez != $user_code_ac){
                                echo "<button class='btn' id='btncoina' attrf='0' attrcoin='coin".$um_code."' style='position: absolute;right: 0px;'><img src='../system/icon/carat-d-black.png'></button>";
                            }
                        }
            echo    "</div>";
                    if($session_status == "on"){
                        if($user_codez != $user_code_ac){
                            echo    "<div class='container-inn' id='coin".$um_code."'>
                                        <button class='btn btn-danger'>Laporkan Postingan</button>
                                    </div>";
                        }
                    }else{
                        echo    "<a href='../login/'><div class='container-inn'>
                                    <button class='btn btn-danger'>Laporkan Postingan</button>
                                </div></a>";
                    }
            echo "</div>";
        echo "</div>";
        if($session_status == "on" AND $user_code_ac==$user_codez){
            echo "<div class='um_bottom_bar'>
                    <div class='container'>
                        <div class='row'>
                            <div class='um_btnu'><button umcodeattr='".$um_code."' id='postdelete' class='btn btn-danger'>Hapus Postingan</button></div>
                            <div class='um_btnu'><a href='um_edit/?c=".$um_code."'><button class='btn btn-info'>Edit Postingan</button></a></div>
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
    }
    $offsetpost = $offset+$limit;
    ?>
        <script>
            $("#umumget").attr("offattr", "<?php echo $offsetpost; ?>");
            $("#umumget").attr("attrdate", "<?php echo $lasdate; ?>");
        </script>
    <?php
}
?>