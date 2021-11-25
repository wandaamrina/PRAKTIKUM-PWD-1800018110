<?php
    // memulai session
    session_start();
    // membuat random angka dan dienkripsi kedalam bentuk md5
    $random_alpha = md5(rand());
    // membuat captcha code dengan mengambil dari random_alpha(mnd5) dimulai dari 0 dengan panjang code 6 karakter
    $captcha_code = substr($random_alpha, 0, 6);
    // memasukan captcha code kedalam session "captcha code"
    $_SESSION["captcha_code"] = $captcha_code;
    // membuat layer dengan ukuran 70 x 30 piksel
    $target_layer = imagecreatetruecolor(70, 30);
    // menentukan warna background captcha
    $captcha_background = imagecolorallocate($target_layer, 255, 160, 199);
    // membuat gambar berdasarkan ukuran $target_layer dan memberikan koordinatas x dan y dan meberikan warna paramenter $captcha_background
    imagefill($target_layer, 0, 0, $captcha_background);
    // menetapkan warna text captcha
    $captcha_text_color =imagecolorallocate($target_layer, 0, 0, 0);
    // menentukan tulisan apa yang akan ditulis pada gambar dan warna apa posisi dimana dengan parameter x, y, z dengan layer $target_layer
    imagestring($target_layer, 5, 5, 5, $captcha_code, $captcha_text_color);
    // memberikan header berupa type contentnya image/jpeg
    header("Content-type:image/jpeg");
    // output image ke browser atau file
    imagejpeg($target_layer);

?>