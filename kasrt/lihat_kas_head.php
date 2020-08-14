<?php

include "../config/config_all.php";

$outputtext = $outputfooter = "";
$title = "";
$data = array();
if(isset($_POST['code'])){
    $code = $_POST['code'];
    $codesub = substr($code,20);
    $get_query = mysqli_query($conn, "SELECT * FROM kas_header WHERE kas_code='$code' ")or die("error");
    $get_query2 = mysqli_query($conn, "SELECT * FROM kas_inner WHERE kas_code='$code' ")or die("error");
    $count_get_query = mysqli_num_rows($get_query);
    $count2_get_query2 = mysqli_num_rows($get_query2);

    if($count_get_query == 0){
        $data['status'] = "0";
    }else{
        while($rex = mysqli_fetch_array($get_query)){
            $data['namakas'] = $rex['nama'];
            $grup_code_get = $rex['grup_code'];
        }
        $data['kascode'] = $code;


        if($grup_code_get == $grup_code_ac){
            if($count2_get_query2 == 0){
                $data['text'] = "<br><h5 style='text-align: center;'>Kas Kosong</h5>";
                        
                if($status_ac == "bendahara"){
                    $data['footer'] = "<button class='btn btn-success'>Tambah</button>";
                }else{
                    $data['footer'] = "";
                }
            }
        }else{
            $data['status'] = "illegal";
        }
    }
    
    echo json_encode($data);
}

mysqli_close($conn);
?>