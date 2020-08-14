<?php

include "../config/config_all.php";
include "../config/config_folder.php";

$data = array();


if(isset($_POST['code'])){
    $code = $_POST['code'];

    $code_avaliable = null;

    $get_query = mysqli_query($conn, "SELECT kas_code FROM kas_header WHERE kas_code='$code' AND grup_code='$grup_code_ac' LIMIT 1 ")or die("ERROR");
    foreach($get_query as $a){
        $code_avaliable = $a["kas_code"];
    }

    if($code_avaliable == null){
        $data['status'] = "0";
    }else{
        $data['status'] = "1";

        if(!file_exists("../sfdatas/grups/$grup_code_ac/kasrt/catatan/$code.txt")){
            $myfile = fopen("../sfdatas/grups/$grup_code_ac/kasrt/catatan/$code.txt", "w") or die("Unable to open file!");
            fwrite($myfile, "");
            fclose($myfile);
        }
    
        $myfile = fopen("../sfdatas/grups/$grup_code_ac/kasrt/catatan/$code.txt", "r") or die("Unable to open file!");
        if(filesize("../sfdatas/grups/$grup_code_ac/kasrt/catatan/$code.txt") > 0){
            $catatan = fread($myfile,filesize("../sfdatas/grups/$grup_code_ac/kasrt/catatan/$code.txt"));;
            if($catatan == "<p><br></p>"){
                $data['catatan'] = "";
            }else{
                $data['catatan'] = $catatan;
            }
        }else{
            $data['catatan'] = "";
        }
        fclose($myfile);
    
    
        if($status_ac == "bendahara"){
            $data['button'] = "<br><br><button onClick='kas_cat_summernote()' class='btn btn-success'>Edit Catatan Kas</button>";
        }
    }

    echo json_encode($data);

}

mysqli_close($conn);
?>