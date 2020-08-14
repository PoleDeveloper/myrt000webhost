<?php
$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
$txt = "aaa\n";
fwrite($myfile, $txt);
$txt = "aaaa\n";
fwrite($myfile, $txt);
fclose($myfile);
?>