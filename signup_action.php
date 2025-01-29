<?php
// Mulai session
session_start();

include 'login/koneksi.php';

// Tangkap data dari form sign-up
$username = isset($_POST['username']) ? $_POST['username'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
$confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

// Validasi jika username atau password kosong
if (empty($username) || empty($password) || empty($confirm_password)) {
    header("location:signup.php?pesan=kosong"); 
    exit();
}

if ($password !== $confirm_password) {
    header("location:signup.php?pesan=password_tidak_sesuai"); 
    exit();
}

// Enkripsi password
$password_hashed = md5($password);

$cek_user = mysqli_query($varkoneksi, "SELECT * FROM tbl_user WHERE username='$username'");
if (mysqli_num_rows($cek_user) > 0) {
    header("location:signup.php?pesan=username_terdaftar");
    exit();
}

$tambah_data = mysqli_query($varkoneksi, "INSERT INTO tbl_user (username, password) VALUES ('$username', '$password_hashed')");

if ($tambah_data) {
    header("location:index.php?pesan=berhasil");
} else {
    header("location:signup.php?pesan=gagal");
}

?>
