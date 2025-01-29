<?php
session_start();

include "../../koneksi.php";

// Pastikan pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    header("location:../../index.php?pesan=gagal");
    exit();
}

if (isset($_POST['tomboltambah'])) {
    // Mengambil data dari form
    $nama     = mysqli_real_escape_string($varkoneksi, $_POST['nama']);
    $ket      = mysqli_real_escape_string($varkoneksi, $_POST['keterangan']);
    $status   = mysqli_real_escape_string($varkoneksi, $_POST['status']);
    $waktu    = mysqli_real_escape_string($varkoneksi, $_POST['waktu']);

    // Validasi input
    if (empty($nama) || empty($ket) || empty($status) || empty($waktu)) {
        echo "<script>alert('Semua field harus diisi!'); window.location.href='../../index.php?page=tasksadd';</script>";
        exit();
    }

    // Validasi apakah id_status ada dalam tbl_status
    $status_check = mysqli_query($varkoneksi, "SELECT * FROM tbl_status WHERE id_status = '$status'");
    if (mysqli_num_rows($status_check) == 0) {
        echo "<script>alert('Status yang dipilih tidak valid!'); window.location.href='../../index.php?page=tasksadd';</script>";
        exit();
    }

    // Menyimpan data ke database
    $id_user = $_SESSION['id_user']; // Ambil ID pengguna dari session

    $sql = "INSERT INTO tbl_task (nama, id_keterangan, id_status, waktu, id_user) VALUES ('$nama', '$ket', '$status', '$waktu', '$id_user')";

    if (mysqli_query($varkoneksi, $sql)) {
        header("Location: ../../index.php?page=tasks"); // Redirect ke halaman task setelah sukses
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($varkoneksi);
    }
}
?>
