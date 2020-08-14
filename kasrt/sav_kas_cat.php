<?php

include "../config/config_all.php";

$data = array();

if(isset($_POST['text'])){
    if($status_ac == "bendahara"){
        $text = $_POST['text'];
        $code = $_POST['code'];

        $old_text = null;
        $old_text_create_new = null;
        $text_explode = null;
        $total_old_text = null;

        $code_avaliable = null;

        $get_query = mysqli_query($conn, "SELECT kas_code FROM kas_header WHERE kas_code='$code' AND grup_code='$grup_code_ac' LIMIT 1 ")or die("ERROR");
        foreach($get_query as $a){
            $code_avaliable = $a['kas_code'];
        }

        if($code_avaliable == null){
            $data['status'] = "0";
        }else{
            $file_path = "../sfdatas/grups/$grup_code_ac/kasrt/catatan/$code.txt";
            $file_path_temp = "../sfdatas/grups/$grup_code_ac/kasrt/catatan_temp/".$code."_temp.txt";
            if(!file_exists($file_path_temp)){
                $myfile = fopen($file_path_temp, "w")or die("Unable to create file");
                fwrite($myfile, "[".date("Y-m-d H:i:s")."]".$text."\n");
                fclose($myfile);
            }else{
                $myfile = fopen($file_path_temp, "r")or die("Unable to open File");
                $old_text = fread($myfile, filesize($file_path_temp));
                fclose($myfile);
                $old_text_create_new = $old_text;

                $text_explode = explode("\n", $old_text);
                $total_old_text = count($text_explode);
                $old_text = $text_explode[$total_old_text-2]; /* total text - 1 ( count for new text ) -1 ( because z-index always start from 0) */
                $count_char = strlen($old_text);
                $old_text = substr($old_text, 21, $count_char);
            }

                
            $myfile = fopen($file_path, "w") or die("Unable to open file!");
            fwrite($myfile, $text);
            fclose($myfile);

            $file_size = filesize($file_path) or die("Unable to open file!");
            $file_size = $file_size / 1024;
            if($file_size > 1){
                $data['status'] = "error";
                if($total_old_text != 0){
                    $data['old_text'] = $old_text;
                    $myfile = fopen($file_path, "w")or die("Unable To Open File");
                    fwrite($myfile, $old_text);
                    fclose($myfile);
                }

            }else{
                if(file_exists($file_path_temp)){
                    $myfile = fopen($file_path_temp, "w")or die("Unable To Open File");
                    fwrite($myfile, $old_text_create_new."[".date("Y-m-d H:i:s")."]".$text."\n");
                    fclose($myfile);
                }

                $data['status'] = "1";
                $data['file_size'] = $file_size;
            }
        }
    }
}
echo json_encode($data);
mysqli_close($conn);
?>