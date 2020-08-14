<?php
include "../config/config_all.php";

$old_file_list = null;

if($status_ac == "bendahara"){

$data = array();

    if(isset($_POST['list'])){

        $list = $_POST['list'];

        $list = explode('#', $list);
        foreach($list as $a){
            $get_query = mysqli_query($conn, "SELECT grup_code FROM kas_header WHERE kas_code='$a' ")or die("ERROR");
            $count = mysqli_num_rows($get_query);
            if($count == 1){
                foreach($get_query as $b){
                    if($grup_code_ac == $b['grup_code']){
                        mysqli_query($conn, "DELETE FROM kas_header WHERE kas_code='$a' ")or die("error");
                        mysqli_query($conn, "DELETE FROM kas_inner WHERE kas_code='$a' ")or die("error");
                        if(file_exists("../sfdatas/grups/$grup_code_ac/kasrt/catatan_temp/".$a."_temp.txt")){
                            copy("../sfdatas/grups/$grup_code_ac/kasrt/catatan_temp/".$a."_temp.txt", "../sfdatas/grups/$grup_code_ac/oldfiles/kasrt/".$a."_old.txt");
                        }
                        if(!file_exists("../sfdatas/grups/$grup_code_ac/oldfiles/kasrt.txt")){
                            $myfile = fopen("../sfdatas/grups/$grup_code_ac/oldfiles/kasrt.txt","w")or die("Unable To Open File");
                            fwrite($myfile, $a.",");
                            fclose($myfile);
                        }else{
                            $myfile = fopen("../sfdatas/grups/$grup_code_ac/oldfiles/kasrt.txt","r")or die("Unable To Open File");
                            $old_file_list = fread($myfile, filesize("../sfdatas/grups/$grup_code_ac/oldfiles/kasrt.txt"));
                            fclose($myfile);

                            $myfile = fopen("../sfdatas/grups/$grup_code_ac/oldfiles/kasrt.txt","w")or die("Unable To Open File");
                            fwrite($myfile, $old_file_list.$a.",");
                            fclose($myfile);
                        }
                        if(file_exists("../sfdatas/grups/$grup_code_ac/kasrt/catatan/$a.txt")){
                            unlink("../sfdatas/grups/$grup_code_ac/kasrt/catatan/$a.txt");
                            unlink("../sfdatas/grups/$grup_code_ac/kasrt/catatan_temp/".$a."_temp.txt");
                        }
                    }else{
                        $data['status'] = "illegal";
                    }
                }
            }else if($count > 1){
                $data['error'] = "error";
            }
        }
    }

    echo json_encode($data);
}

mysqli_close($conn);
?>