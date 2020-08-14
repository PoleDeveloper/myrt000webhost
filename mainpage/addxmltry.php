<?php
include "../config/config_all.php";
$user_codem = "Fridada29122019200512312300000";
$user_codez = "Fri05291220192005212c000000";
$um_code = "16Fri091220192038401um000000";
$user_add = "iuyeaoiuwyheoiayhis";
    $xmlq = simplexml_load_file('../umum/likes/'.$user_codez.'/likecode/'.$um_code.'.xml')or die("Error");

	$user_code = $xmlq->addChild('user_code', $user_add);
	$user_code->addAttribute('id', $user_add);
	file_put_contents('../umum/likes/'.$user_codez.'/likecode/'.$um_code.'.xml', $xmlq->asXML());
?>