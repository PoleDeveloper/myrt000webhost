<?php
include "../config/config_all.php";


$data = array();


if(isset($_POST['title'])){

    $title = $_POST['title'];
    $code = $_POST['code'];
    $code_avaliability = null;

    if($status_ac == "bendahara"){
        $get_query = mysqli_query($conn, "SELECT kas_code FROM kas_header WHERE kas_code='$code' and grup_code='$grup_code_ac' LIMIT 1 ")or die(mysqli_error($conn));
        foreach($get_query as $a){
            $code_avaliability = $a['kas_code'];
        }

        if($code_avaliability == null){
            $data['status'] = "0";
        }else{
            $data['status'] = "1";
            mysqli_query($conn, "UPDATE kas_header SET nama='$title' WHERE kas_code='$code' AND grup_code='$grup_code_ac' ")or die(mysqli_error($conn));
        }
    }
}

echo json_encode($data);
?>