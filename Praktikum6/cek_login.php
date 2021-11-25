<?php
// koneksi kedatabase
include "koneksi.php";
// memulai session
session_start();
// mengambil input id_user dan password(enkrispi terlebih dahulu menggunakan md5)
$id_user = $_POST["id_user"];
$password = md5($_POST['password']);
// query kedatabase dengan kondisi rule id_user dan password sama dengan inputan
$sql = mysqli_query($con, "SELECT * FROM users WHERE id_user='$id_user' AND PASSWORD='$password'");
// fetch dalam bentuk array dari hasil query kedalam variable $u
$u = mysqli_fetch_array($sql);
// melakukan pengecekan capctha apakah sesuai dengan session yang dibuat pada captcha.php
if ($_POST['captcha_code'] == $_SESSION['captcha_code']) {
    // cek user apakah terdapat data yang terambil
    if ($sql->num_rows > 0) {
        // set session id_user dan nama
        $_SESSION['id_user'] = $u['id_user'];
        $_SESSION['nama'] = $u['nama_lengkap'];
        echo "User berhasil login! <br>";
        echo "Id user : " . $_SESSION['id_user'] .  "<br>";
        echo "Nama : " . $_SESSION['nama'] . "<br>";
        echo "<a href='logout.php'>Log out</a>";
    } else {
        // jika user tidak ada atau username/password salah tidak sesuai maka notif berikut
        echo "<center>Login gagal! Username & Password tidak sesuai <br> <a href='form_login.php'>Ulangi</a></center>";
    }
} else {
    // jika captcha salah maka notif berikut
    echo "<center>Login gagal! Capctha tidak sesuai <br> <a href='form_login.php'>Ulangi</a></center>";
}