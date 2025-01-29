<?php
session_start();
include 'login/koneksi.php';

$username = $_POST['pengguna'];
$password = md5($_POST['katakunci']); 

$ambildata = mysqli_query($varkoneksi, "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'");

$cek = mysqli_num_rows($ambildata);

if ($cek > 0) {
    // Ambil data pengguna
    $data = mysqli_fetch_assoc($ambildata);

    // Simpan informasi pengguna ke dalam session
    $_SESSION['id_user'] = $data['id']; 
    $_SESSION['username'] = $data['username'];
    $_SESSION['status'] = "login";

    header("location:login");
} else {
    header("location:index.php?pesan=gagal");
}
?>
