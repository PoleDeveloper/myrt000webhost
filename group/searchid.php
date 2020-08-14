<?php
include "../config/config_all.php";

if(isset($_POST['text'])){
    $id = $_POST['text'];

    $get = mysqli_query($conn, "SELECT * FROM grup WHERE id_grup='$id' ")or die(header("Location: ../error/index.php?errcode=conn"));
    $get_count = mysqli_num_rows($get);
    if($get_count == 0){
        ?>
            <script>
                errordiv1s("", "Tidak Menemukan Grup dengan ID:<?php echo $id; ?>", "0", "error");
            </script>
        <?php
    }else if($get_count == 1){
        while($res = mysqli_fetch_array($get)){
            $access_code = $res['access_code'];
            $grup_code = $res['grup_code'];
        }
        if(empty($access_code)){
            mysqli_query($conn, "UPDATE users_account SET grup_code='$grup_code' WHERE user_code='$user_code_ac' ")or die(header("Location: ../error/index.php?errcode=conn"));
            ?>
                <script>
                    window.location = "../";
                </script>
            <?php
        }else{
            ?>
                <script>
                    $("#page3_output").attr("attrkod", "<?php echo $grup_code; ?>");
                    form1op("Kode Akses", "Masukan Kode Akses <input onkeyup='confirmcode();' id='concode' class='form-control' type='text'>", "<button onclick='jogrca();' class='btn btn-success'>Gabung</button>");
                </script>
            <?php
        }
    }else{
        ?><script> errordiv1s("ERROR", "Terjadi Kesalahan Pada Sistem", "0", "error"); </script><?php
    }

    mysqli_close($conn);
}
?>