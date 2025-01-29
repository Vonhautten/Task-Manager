<?php
session_start();

include "../../koneksi.php";

// Pastikan pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    header("location:../../index.php?pesan=gagal");
    exit();
}

if (isset($_POST['tomboledit'])) {
    $id       = mysqli_real_escape_string($varkoneksi, $_POST['idtask']);
    $nama     = mysqli_real_escape_string($varkoneksi, $_POST['nama']);
    $ket      = mysqli_real_escape_string($varkoneksi, $_POST['keterangan']);
    $status   = mysqli_real_escape_string($varkoneksi, $_POST['status']);
    $waktu    = mysqli_real_escape_string($varkoneksi, $_POST['waktu']);

    // Validasi input
    if (empty($nama) || empty($ket) || empty($status) || empty($waktu)) {
        echo "<script>alert('Semua field harus diisi!'); window.location.href='../../index.php?page=tasksedit&idtask=$id';</script>";
        exit();
    }

    // Menyimpan data ke database
    $sql = "UPDATE tbl_task SET nama = '$nama', id_keterangan = '$ket', id_status = '$status', waktu = '$waktu' WHERE id_task = '$id'";

    if (mysqli_query($varkoneksi, $sql)) {
        header("Location: ../../index.php?page=tasks"); // Redirect ke halaman task setelah sukses
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($varkoneksi);
    }
}
?>
