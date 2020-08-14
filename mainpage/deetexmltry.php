<?php
include "../config/config_all.php";
$user_codem = "Fridada29122019200512312300000";
$user_codez = "Fri05291220192005212c000000";
$um_code = "16Fri091220192038401um000000";
    $xmlq = simplexml_load_file('../umum/likes/'.$user_codez.'/likecode/'.$um_code.'.xml')or die("Error");
	$index = 0;
	$i = 0;
	foreach($xmlq->user_code as $lc){
		if($lc['id']==$user_codem){
			$index = $i;
			break;
		}
		$i++;
	}
	unset($xmlq->user_code[$index]);
	file_put_contents('../umum/likes/'.$user_codez.'/likecode/'.$um_code.'.xml', $xmlq->asXML());
?>