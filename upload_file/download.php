<?php
$myDir = "C:/xampp/htdocs/pwd-1800018121/upload_file/";
$dir = opendir($myDir);
echo "Isi folder (klik link untuk download : <br>";
while($tmp = readdir($dir)){
	echo "<a href='$tmp' target='_blank'>$tmp</a><br>";
}
closedir($dir);
