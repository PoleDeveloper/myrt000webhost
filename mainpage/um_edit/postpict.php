<?php
include "../../config/config_all.php";

    $file_path = $_POST['file_path'];
    $target_dir = "../../umum/image/$user_code_ac/$file_path/";
    $target_dir2 = "../../umum/thumbnail/$user_code_ac/$file_path/";
    $allow_types = array('jpg', 'png', 'jpeg');
    $NewImageHeight = 600;
    $NewImageWidth = 600;
    $Quality = 50;
    $get_query = mysqli_query($conn, "SELECT * FROM umum WHERE file_path='$file_path' AND user_code='$user_code_ac' ")or die(mysqli_query($conn));
    while($res = mysqli_fetch_array($get_query)){
        $gum_code = $res['gum_code'];
    }
    if(!empty($_FILES['images'])){
    if(!file_exists("../../umum/image/$user_code_ac/$file_path")){
        mkdir("../../umum/image/$user_code_ac/$file_path", 0777, true)or die("GAGAL");
    }
    if(!file_exists("../../umum/thumbnail/$user_code_ac/$file_path")){
        mkdir("../../umum/thumbnail/$user_code_ac/$file_path", 0777, true)or die("GAGAL");
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
        $path_file = "/".$user_code_ac."/".$file_path."/".$file_name;

        $file_type = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        if(in_array($file_type, $allow_types)){
            if(move_uploaded_file($_FILES['images']['tmp_name'][$key],$targetFilePath)){
                resizeImage($targetFilePath,$thumbnail_location,$NewImageWidth,$NewImageHeight,$Quality);
                $insert2 = mysqli_query($conn, "INSERT INTO gambar_umum(path,gum_code,user_code) VALUES('$path_file','$gum_code','$user_code_ac') ")or die(mysqli_error($conn));
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
$back_query = mysqli_query($conn, "SELECT * FROM gambar_umum WHERE gum_code='$gum_code' ORDER BY upload_date DESC LIMIT 1 ")or die(mysqli_error($conn));
while($res2 = mysqli_fetch_array($back_query)){
    echo "<a id='".$res2['id']."' class='img_box'><img class='img-thumbnail' src='../../umum/thumbnail".$res2['path']."'><button id='btndel' pathattr='".$res2['path']."' idattr='".$res2['id']."' class='btn btn-danger'>Hapus</button></a>";
}
?>