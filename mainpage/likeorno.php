<?php
include "../config/config_all.php";
$um_code_get = $_POST['umcode'];
$action = $_POST['action'];

$xmquery = mysqli_query($conn, "SELECT * FROM umum WHERE um_code='$um_code_get' ")or die(mysqli_error($conn));
while($reo = mysqli_fetch_array($xmquery)){
    $user_codez = $reo['user_code'];
}

$likeget = $dislikecode = "";
$likexml = $likexmlend = "";
$index = 0;
$i = 0;

$xml = simplexml_load_file('../umum/likes/'.$user_codez.'/likecode/'.$um_code_get.'.xml');
$likecode = $xml->xpath("//likes/user_code[contains(text(), '$user_code_ac')]");
if(count($likecode) > 0) { // if found
    $likeget = 1;
}else{
    $likeget = 0;
}

$xml = simplexml_load_file('../umum/dislikes/'.$user_codez.'/dislikecode/'.$um_code_get.'.xml');
$dislikecode = $xml->xpath("//dislikes/user_code[contains(text(), '$user_code_ac')]");
if(count($dislikecode) > 0) { // if found
    $dislikeget = 1;
}else{
    $dislikeget = 0;
}

if($likeget == 1 AND $dislikeget == 0 OR $dislikeget == 1 AND $likeget == 0 OR $likeget == 0 AND $dislikeget == 0){

if($action == "like"){
    if($likeget == 0 and $dislikeget == 0){
        $xmlq = simplexml_load_file('../umum/likes/'.$user_codez.'/likecode/'.$um_code_get.'.xml')or die("Gagal");
        
        $user_code = $xmlq->addChild('user_code', $user_code_ac);
	    $user_code->addAttribute('id', $user_code_ac);
        file_put_contents('../umum/likes/'.$user_codez.'/likecode/'.$um_code_get.'.xml', $xmlq->asXML());

        $xml = simplexml_load_file('../umum/likes/'.$user_codez.'/like/'.$um_code_get.'.xml')or die("GAGAL");
        $likexml = $xml->like;
        $likexmlend = $likexml+1;

        $xml->like = $likexmlend;
        file_put_contents('../umum/likes/'.$user_codez.'/like/'.$um_code_get.'.xml', $xml->asXML());

        echo "a";
    }else if($likeget == 1 and $dislikeget == 0){
        $xmlq = simplexml_load_file('../umum/likes/'.$user_codez.'/likecode/'.$um_code_get.'.xml')or die("Gagal");
        
        foreach($xmlq->user_code as $lc){
            if($lc['id'] == $user_code_ac){
                $index = $i;
                break;
            }
            $i++;
        }
        unset($xmlq->user_code[$index]);
        file_put_contents('../umum/likes/'.$user_codez.'/likecode/'.$um_code_get.'.xml', $xmlq->asXML());

        $xml = simplexml_load_file('../umum/likes/'.$user_codez.'/like/'.$um_code_get.'.xml')or die("GAGAL");
        $likexml = $xml->like;
        $likexmlend = $likexml-1;

        $xml->like = $likexmlend;
        file_put_contents('../umum/likes/'.$user_codez.'/like/'.$um_code_get.'.xml', $xml->asXML());

        echo "b";
    }else if($likeget == 0 and $dislikeget == 1){
        $xmlq = simplexml_load_file('../umum/dislikes/'.$user_codez.'/dislikecode/'.$um_code_get.'.xml')or die("Gagal");
        
        foreach($xmlq->user_code as $lc){
            if($lc['id'] == $user_code_ac){
                $index = $i;
                break;
            }
            $i++;
        }
        unset($xmlq->user_code[$index]);
        file_put_contents('../umum/dislikes/'.$user_codez.'/dislikecode/'.$um_code_get.'.xml', $xmlq->asXML());

        $xml = simplexml_load_file('../umum/dislikes/'.$user_codez.'/dislike/'.$um_code_get.'.xml')or die("GAGAL");
        $dislikexml = $xml->dislike;
        $dislikexmlend = $dislikexml-1;

        $xml->dislike = $dislikexmlend;
        file_put_contents('../umum/dislikes/'.$user_codez.'/dislike/'.$um_code_get.'.xml', $xml->asXML());


        $xmlq = simplexml_load_file('../umum/likes/'.$user_codez.'/likecode/'.$um_code_get.'.xml')or die("Gagal");
        
        $user_code = $xmlq->addChild('user_code', $user_code_ac);
	    $user_code->addAttribute('id', $user_code_ac);
        file_put_contents('../umum/likes/'.$user_codez.'/likecode/'.$um_code_get.'.xml', $xmlq->asXML());

        $xml = simplexml_load_file('../umum/likes/'.$user_codez.'/like/'.$um_code_get.'.xml')or die("GAGAL");
        $likexml = $xml->like;
        $likexmlend = $likexml+1;

        $xml->like = $likexmlend;
        file_put_contents('../umum/likes/'.$user_codez.'/like/'.$um_code_get.'.xml', $xml->asXML());


        echo "c";
    }
}else if($action == "dislike"){
    if($likeget == 0 and $dislikeget == 0){
        $xmlq = simplexml_load_file('../umum/dislikes/'.$user_codez.'/dislikecode/'.$um_code_get.'.xml')or die("Gagal");
        
        $user_code = $xmlq->addChild('user_code', $user_code_ac);
	    $user_code->addAttribute('id', $user_code_ac);
        file_put_contents('../umum/dislikes/'.$user_codez.'/dislikecode/'.$um_code_get.'.xml', $xmlq->asXML());

        $xml = simplexml_load_file('../umum/dislikes/'.$user_codez.'/dislike/'.$um_code_get.'.xml')or die("GAGAL");
        $dislikexml = $xml->dislike;
        $dislikexmlend = $dislikexml+1;

        $xml->dislike = $dislikexmlend;
        file_put_contents('../umum/dislikes/'.$user_codez.'/dislike/'.$um_code_get.'.xml', $xml->asXML());

        echo "d";
    }else if($likeget == 0 and $dislikeget == 1){
        $xmlq = simplexml_load_file('../umum/dislikes/'.$user_codez.'/dislikecode/'.$um_code_get.'.xml')or die("Gagal");
        
        foreach($xmlq->user_code as $lc){
            if($lc['id'] == $user_code_ac){
                $index = $i;
                break;
            }
            $i++;
        }
        unset($xmlq->user_code[$index]);
        file_put_contents('../umum/dislikes/'.$user_codez.'/dislikecode/'.$um_code_get.'.xml', $xmlq->asXML());

        $xml = simplexml_load_file('../umum/dislikes/'.$user_codez.'/dislike/'.$um_code_get.'.xml')or die("GAGAL");
        $dislikexml = $xml->dislike;
        $dislikexmlend = $dislikexml-1;

        $xml->dislike = $dislikexmlend;
        file_put_contents('../umum/dislikes/'.$user_codez.'/dislike/'.$um_code_get.'.xml', $xml->asXML());

        echo "e";
    }else if($likeget == 1 and $dislikeget == 0){
        $xmlq = simplexml_load_file('../umum/likes/'.$user_codez.'/likecode/'.$um_code_get.'.xml')or die("Gagal");
        
        foreach($xmlq->user_code as $lc){
            if($lc['id'] == $user_code_ac){
                $index = $i;
                break;
            }
            $i++;
        }
        unset($xmlq->user_code[$index]);
        file_put_contents('../umum/likes/'.$user_codez.'/likecode/'.$um_code_get.'.xml', $xmlq->asXML());

        $xml = simplexml_load_file('../umum/likes/'.$user_codez.'/like/'.$um_code_get.'.xml')or die("GAGAL");
        $likexml = $xml->like;
        $likexmlend = $likexml-1;

        $xml->like = $likexmlend;
        file_put_contents('../umum/likes/'.$user_codez.'/like/'.$um_code_get.'.xml', $xml->asXML());


        $xmlq = simplexml_load_file('../umum/dislikes/'.$user_codez.'/dislikecode/'.$um_code_get.'.xml')or die("Gagal");
        
        $user_code = $xmlq->addChild('user_code', $user_code_ac);
	    $user_code->addAttribute('id', $user_code_ac);
        file_put_contents('../umum/dislikes/'.$user_codez.'/dislikecode/'.$um_code_get.'.xml', $xmlq->asXML());

        $xml = simplexml_load_file('../umum/dislikes/'.$user_codez.'/dislike/'.$um_code_get.'.xml')or die("GAGAL");
        $dislikexml = $xml->dislike;
        $dislikexmlend = $dislikexml+1;

        $xml->dislike = $dislikexmlend;
        file_put_contents('../umum/dislikes/'.$user_codez.'/dislike/'.$um_code_get.'.xml', $xml->asXML());


        echo "f";
    }
}

}else if($likeget == 1 AND $dislikeget == 1){
    echo "HAHAHAHA YOU WANT TO LIKE YOUR OWN POST <br><br><br> NAH YOU CAN'T LIKE YOUR OWN POST";
}
?>