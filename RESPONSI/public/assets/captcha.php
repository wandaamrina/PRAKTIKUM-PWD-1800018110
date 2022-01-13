<?php
session_start();
$random_alpha = md5(rand()); //membuat kode random
$captcha_code = substr($random_alpha, 0, 6); //kode memiliki 
$_SESSION["captcha_code"] = $captcha_code; //membuat session captcha kode
$target_layer = imagecreatetruecolor(70,30); //menghasilkan gambar PNG dengan lebar 70 piksel kali tinggi 30 pikse
$captcha_background = imagecolorallocate($target_layer, 255, 160, 119); //Mengalokasikan warna untuk gambar
imagefill($target_layer,0,0,$captcha_background); //mengisi gambar yang sudah dibuat di baris 6 dan diisi dengan warna dari baris 7
$captcha_text_color = imagecolorallocate($target_layer, 0, 0, 0); //membuat warna captcha_code
imagestring($target_layer, 5, 5, 5, $captcha_code, $captcha_text_color); //memasukkan text capthca_code ke dalam gambar
header("Content-type: image/jpeg"); //menampilkan gambar
imagejpeg($target_layer);
?>