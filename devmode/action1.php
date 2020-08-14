<?php
include "../config/config_all.php";

$attra = $_POST['attra'];/* check offset */
$attrb = $_POST['attrb'];/* check process 0=check post */

$time = date("d-m-Y h:i:sa - u");
if($attrb == 0){
    $get_query = mysqli_query($conn, "SELECT * FROM umum WHERE user_code='$user_code_ac' LIMIT $attra,1 ")or die(mysqli_error($conn));
    $count_gq = mysqli_num_rows($get_query);
    if($count_gq != 0){
        while($cr = mysqli_fetch_array($get_query)){
            /*
                file path 1 for thumbnail
                file path 2 for image
            */
            echo "<div class='logdiv'><b>System : </b>".$time."<br> Check Post | Upload Date ".date("d-m-Y h:i:sa", strtotime($cr['upload_date']))."</div>";
            /* check thumbnail folder */
            if(file_exists("../umum/thumbnail/$user_code_ac/".$cr['file_path'])){
                echo "<div class='logdiv'><b>System</b><br>File Path 1 Exist</div>";
            }else{
                echo "<div class='logdiv'><b>System : </b>".$time."<br>File Path 1 Doesn't Exist</div>";
                ?>
                    <script>
                        $("#errorlog").append("<div class='logdiv'><b>System : </b>Error File Path 1 Doesn't Exist</div>")
                    </script>
                <?php
            }
            /* check image folder */
            if(file_exists("../umum/image/$user_code_ac/".$cr['file_path'])){
                echo "<div class='logdiv'><b>System</b>".$time."<br>File Path 2 Exist</div>";
            }else{
                echo "<div class='logdiv'><b>System</b><br>File Path 2 Doesn't Exist</div>";
                ?>
                    <script>
                        $("#errorlog").append("<div class='logdiv'><b>System : </b>Error File Path 2 Doesn't Exist</div>")
                    </script>
                <?php
            }
        }
        $attrafin = $attra+1;
        ?>
            <script>
                $("#logbox").attr("attra", "<?php echo $attrafin; ?>");
            </script>
        <?php
    }else{
        $get_query2 = mysqli_query($conn, "SELECT * FROM umum WHERE user_code='$user_code_ac' ")or die(mysqli_error($conn));
        $count_post = mysqli_num_rows($get_query2);
        echo "<div class='logdiv'><b>System : </b>".$time." <br> Your Total Post ".$count_post."</div>";
        echo "<div class='logdiv'><b>System : </b> Check 1 Success........  | Time : ".$time."</div>";
        ?>
            <script>
                $("#logbox").attr("attrb", "1");
                $("#logbox").attr("attra", "0");
            </script>
        <?php
    }
}if($attrb == 1){
    $get_query = mysqli_query($conn, "SELECT * FROM gambar_umum WHERE user_code='$user_code_ac' LIMIT $attra,1 ")or die(mysqli_error($conn));
    $count_gq = mysqli_num_rows($get_query);
    if($count_gq != 0){
        while($cr = mysqli_fetch_array($get_query)){
            
            if(file_exists("../umum/thumbnail".$cr['path'])){
                echo "<div class='logdiv'><b>System : </b>".$time."<br>Thumbnail 2 Exist | Upload Date ".date("d-m-Y h:i:sa", strtotime($cr['upload_date']))."</div>";
            }else{
                echo "<div class='logdiv'><b>System : </b>".$time."<br>Thumbnail 2 Doesn't Exist | Upload Date ".date("d-m-Y h:i:sa", strtotime($cr['upload_date']))."</div>";
                ?>
                    <script>
                        $("#errorlog").append("<div class='logdiv'><b>System : </b>Error Thumbnail 2 Doesn't Exist</div>")
                    </script>
                <?php
            }

            if(file_exists("../umum/image".$cr['path'])){
                echo "<div class='logdiv'><b>System : </b>".$time."<br>Image 2 Exist | Upload Date ".date("d-m-Y h:i:sa", strtotime($cr['upload_date']))."</div>";
            }else{
                echo "<div class='logdiv'><b>System : </b>".$time."<br>Image 2 Doesn't Exist | Upload Date ".date("d-m-Y h:i:sa", strtotime($cr['upload_date']))."</div>";
                ?>
                    <script>
                        $("#errorlog").append("<div class='logdiv'><b>System : </b>Error Image 2 Doesn't Exist</div>")
                    </script>
                <?php
            }
        
        }
        $attrafin = $attra+1;
        ?>
            <script>
                $("#logbox").attr("attra", "<?php echo $attrafin; ?>");
            </script>
        <?php
    }else{
        
    }
}

?>