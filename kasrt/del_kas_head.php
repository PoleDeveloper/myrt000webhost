<?php
include "../config/config_all.php";

if($status_ac == "bendahara"){
    if(isset($_POST['code'])){
        $code = $_POST['code'];
    
        mysqli_query($conn, "DELETE FROM kas_header WHERE kas_code='$code' AND grup_code='$grup_code_ac' ")or die("error");
        mysqli_query($conn, "DELETE FROM kas_inner WHERE kas_code='$code' ")or die("error");

        if(file_exists("../sfdatas/grups/$grup_code_ac/kasrt/catatan_temp/".$code."_temp.txt")){
            copy("../sfdatas/grups/$grup_code_ac/kasrt/catatan_temp/".$code."_temp.txt", "../sfdatas/grups/$grup_code_ac/oldfiles/kasrt/".$code."_old.txt");
        }
        if(!file_exists("../sfdatas/grups/$grup_code_ac/oldfiles/kasrt.txt")){
            $myfile = fopen("../sfdatas/grups/$grup_code_ac/oldfiles/kasrt.txt","w")or die("Unable To Open File");
            fwrite($myfile, $code.",");
            fclose($myfile);
        }else{
            $myfile = fopen("../sfdatas/grups/$grup_code_ac/oldfiles/kasrt.txt","r")or die("Unable To Open File");
            $old_file_list = fread($myfile, filesize("../sfdatas/grups/$grup_code_ac/oldfiles/kasrt.txt"));
            fclose($myfile);

            $myfile = fopen("../sfdatas/grups/$grup_code_ac/oldfiles/kasrt.txt","w")or die("Unable To Open File");
            fwrite($myfile, $old_file_list.$code.",");
            fclose($myfile);
        }
        if(file_exists("../sfdatas/grups/$grup_code_ac/kasrt/catatan/$code.txt")){
            unlink("../sfdatas/grups/$grup_code_ac/kasrt/catatan/$code.txt");
            unlink("../sfdatas/grups/$grup_code_ac/kasrt/catatan_temp/".$code."_temp.txt");
        }
    }

}

mysqli_close($conn);
?>