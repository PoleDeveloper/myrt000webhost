<?php

include "../config/config_all.php";

$data = array();

if($status_ac == "bendahara"){


if(isset($_POST['name'])){

    $kas_status = "";

    $name = $_POST['name'];

    $get_total_kas = mysqli_query($conn, "SELECT * FROM kas_header WHERE grup_code='$grup_code_ac' ")or die(mysqli_error($conn));
    $count_total_kas = mysqli_num_rows($get_total_kas);

    if(file_exists("../sysxml/grup_type.xml")){
        $grup_settings = simplexml_load_file("../sysxml/grup_type.xml");
        foreach($grup_settings as $kastype){
            if($kastype->type == $grup_ac_type){
                if($count_total_kas < $kastype->kasheadmax){
                    $kas_status = "avaliable";
                }else{
                    $kas_status = "not_avaliable";
                }
            break;
            }
        }
    }else{
        $data['error'] = "error";
    }

    if($kas_status == "avaliable"){
        $a = 1;
        for($ab = 0;$ab <= $a;$ab++){
            $date = date("YmdHisu");
            $str = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            $randstr = substr(str_shuffle($str), 0, 5);
            $randstrs = $date.$randstr;
            $ckc = mysqli_query($conn, "SELECT * FROM kas_header WHERE kas_code='$randstrs' ")or die("error");
            $count_ckc = mysqli_num_rows($ckc);
            if($count_ckc == 0){
                mysqli_query($conn, "INSERT INTO kas_header(nama,kas_code,grup_code,validasi) VALUES('$name','$randstrs','$grup_code_ac','') ")or die("error");
            break;
            }else{
                $a = $a+1;
                if($a == 51){
                    $data['error'] = "err90";
                break;
                }
            }
        }
    }else{
        $data['avaliable'] = "no";
    }
    echo json_encode($data);
}

}

mysqli_close($conn);
?>