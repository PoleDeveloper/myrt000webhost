<?php
include "../config/config_all.php";
if(isset($_POST['submit'])){
    $share = $_POST['share'];
    $post = $_POST['post'];
    if($share == "grup"){
        $share = $grup_code_ac;
    }
    /* */
if(empty($post) AND empty($_FILES['images'])){

}else{

    $um_code = date("sDHmYdiB")."um".date("u");
    $gum_code = date("smYdiHu");
    $com_code = date("sDHmYdiB")."co".date("u");
    $datenow = date("dmYHisu");
    /* insert into database */
    $insert1 = mysqli_query($conn, "INSERT INTO umum(post,share,um_code,gum_code,file_path,com_code,user_code) VALUES('$post','$share','$um_code','$gum_code','$datenow','$com_code','$user_code_ac') ")or die(mysqli_error($conn));
    
    /* create like xml */
    if(!file_exists("../umum/likes/$user_code_ac")){
        mkdir("../umum/likes/$user_code_ac", 0777, true)or die("GAGAL");
    }
    if(!file_exists("../umum/likes/$user_code_ac/like")){
        mkdir("../umum/likes/$user_code_ac/like", 0777, true)or die("GAGAL");
    }
    if(!file_exists("../umum/likes/$user_code_ac/likecode")){
        mkdir("../umum/likes/$user_code_ac/likecode", 0777, true)or die("GAGAL");
    }

    $domlike = new DOMDocument('1.0', 'UTF-8');
    $domlike->formatOutput = true;
    
    $root = $domlike->createElement('likes');
    $domlike->appendChild($root);
    
    $root->appendChild($domlike->createElement('like','0'));

    echo '<xmp>'.$domlike->saveXML().'</xmp>';
    $domlike->save('../umum/likes/'.$user_code_ac.'/like/'.$um_code.'.xml')or die('XML Create Error');


    /*like code*/
    $domlikecode = new DOMDocument('1.0', 'UTF-8');
    $domlikecode->formatOutput = true;

    $root = $domlikecode->createElement('likes');
    $domlikecode->appendChild($root);

    
    $root->appendChild($domlikecode->createElement('user_code', $user_code_ac));

    echo '<xmp>'.$domlikecode->saveXML().'</xmp>';
    $domlikecode->save('../umum/likes/'.$user_code_ac.'/likecode/'.$um_code.'.xml')or die('XML CREATE Error');
    /*create like xml end*/

    /*create dislike*/
    if(!file_exists("../umum/dislikes/$user_code_ac")){
        mkdir("../umum/dislikes/$user_code_ac", 0777, true)or die("GAGAL");
    }
    if(!file_exists("../umum/dislikes/$user_code_ac/dislike")){
        mkdir("../umum/dislikes/$user_code_ac/dislike", 0777, true)or die("GAGAL");        
    }
    if(!file_exists("../umum/dislikes/$user_code_ac/dislikecode")){
        mkdir("../umum/dislikes/$user_code_ac/dislikecode", 0777, true)or die("GAGAL");
    }


    $domdislike = new DOMDocument('1.0', 'UTF-8');
    $domdislike->formatOutput = true;

    $root = $domdislike->createElement('dislikes');
    $domdislike->appendChild($root);

    $root->appendChild($domdislike->createElement('dislike', '0'));

    echo '<xmp>'.$domdislike->saveXML()."</xmp>";
    $domdislike->save('../umum/dislikes/'.$user_code_ac.'/dislike/'.$um_code.'.xml')or die("XML Create Error");

    /*create dislike code*/
    $domdislikecode = new DOMDocument('1.0', 'UTF-8');
    $domdislikecode->formatOutput = true;

    $root = $domdislikecode->createElement('dislikes');
    $domdislikecode->appendChild($root);

    $root->appendChild($domdislikecode->createElement('user_code', $user_code_ac));

    echo '<xmp>'.$domdislike->saveXML()."</xmp>";
    $domdislikecode->save('../umum/dislikes/'.$user_code_ac.'/dislikecode/'.$um_code.'.xml')or die("XML Create Error");
    /*create dislike end */

    /* upload images */
    $target_dir = "../umum/image/$user_code_ac/$datenow/";
    $target_dir2 = "../umum/thumbnail/$user_code_ac/$datenow/";
    $allow_types = array('jpg', 'png', 'jpeg');
    $NewImageHeight = 600;
    $NewImageWidth = 600;
    $Quality = 70;
if(!empty($_FILES['images'])){
    if(!file_exists("../umum/image/$user_code_ac")){
        mkdir("../umum/image/$user_code_ac", 0777, true)or die("GAGAL");
    }
    if(!file_exists("../umum/image/$datenow")){
        mkdir("../umum/image/$user_code_ac/$datenow", 0777, true)or die("GAGAL");
    }
    if(!file_exists("../umum/thumbnail/$user_code_ac")){
        mkdir("../umum/thumbnail/$user_code_ac", 0777, true)or die("GAGAL");
    }
    if(!file_exists("../umum/thumbnail/$datenow")){
        mkdir("../umum/thumbnail/$user_code_ac/$datenow", 0777, true)or die("GAGAL");
    }
    foreach($_FILES['images']['name'] as $key=>$val){
        $image_name = $_FILES['images']['name'][$key];
        $tmp_name = $_FILES['images']['tmp_name'][$key];
        $size = $_FILES['images']['size'][$key];
        $type = $_FILES['images']['type'][$key];
        $error = $_FILES['images']['error'][$key];

        $file_name = preg_replace('/\s/', '', basename($_FILES['images']['name'][$key]));
        $file_name2 = $gum_code.$file_name;
        $targetFilePath = $target_dir.$file_name;
        $thumbnail_location = $target_dir2.$file_name;
        $path_file = "/".$user_code_ac."/".$datenow."/".$file_name;

        $file_type = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        if(in_array($file_type, $allow_types)){
            if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$targetFilePath)){
                resizeImage($targetFilePath,$thumbnail_location,$NewImageWidth,$NewImageHeight,$Quality);
                $insert2 = mysqli_query($conn, "INSERT INTO gambar_umum(path,gum_code,user_code) VALUES('$path_file','$gum_code','$user_code_ac') ")or die(mysqli_error($conn));
            }
        }
    }
}
}
}

//Function that resizes image.
function resizeImage($SrcImage,$DestImage, $MaxWidth,$MaxHeight,$Quality)
{
   	list($iWidth,$iHeight,$type)	= getimagesize($SrcImage);
    $ImageScale          	= min($MaxWidth/$iWidth, $MaxHeight/$iHeight);
    $NewWidth              	= ceil($ImageScale*$iWidth);
    $NewHeight             	= ceil($ImageScale*$iHeight);
    $NewCanves             	= imagecreatetruecolor($NewWidth, $NewHeight);

	switch(strtolower(image_type_to_mime_type($type)))
	{
		case 'image/jpeg':
			$NewImage = imagecreatefromjpeg($SrcImage);
			break;
		case 'image/png':
			$NewImage = imagecreatefrompng($SrcImage);
			break;
		case 'image/gif':
			$NewImage = imagecreatefromgif($SrcImage);
			break;
		default:
			return false;
	}

	// Resize Image
    if(imagecopyresampled($NewCanves, $NewImage,0, 0, 0, 0, $NewWidth, $NewHeight, $iWidth, $iHeight))
    {
        // copy file
        if(imagejpeg($NewCanves,$DestImage,$Quality))
        {
            imagedestroy($NewCanves);
            return true;
        }
    }
}
?>