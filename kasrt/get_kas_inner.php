<?php
include "../config/config_all.php";

$data = array();

if(isset($_POST['code'])){
    $code = $_POST['code'];
    $code_avaliable = null;


    $get_query = mysqli_query($conn, "SELECT kas_code FROM kas_header WHERE kas_code='$code' AND grup_code='$grup_code_ac' LIMIT 1 ")or die();
    foreach($get_query as $a){
        $code_avaliable = $a['kas_code'];
    }

    if($code_avaliable == null){
        $data['status'] = "0";
    }else{
        $noarr = 0;
        $data['status'] = "1";
        $get_query2 = mysqli_query($conn, "SELECT * FROM kas_inner WHERE kas_code='$code' ")or die("error");
        $count_get_query2 = mysqli_num_rows($get_query2);
        if($count_get_query2 == 0){
            $data['kasi'] = "empty";
        }else{

            foreach($get_query as $a){

            }
        }
    }
}

echo json_encode($data);
mysqli_close($conn);

?>