<?php
session_start();  // Mulai session untuk mengakses session variables

include "../../koneksi.php";

// Pastikan pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    header("location:../../index.php?pesan=gagal");
    exit();
}

if (isset($_GET['idtask'])) {
    $idtask = mysqli_real_escape_string($varkoneksi, $_GET['idtask']);

    // Cek apakah task dengan id tersebut ada
    $result = mysqli_query($varkoneksi, "SELECT * FROM tbl_task WHERE id_task = '$idtask'");

    if (mysqli_num_rows($result) > 0) {
        // Menghapus tugas dari database
        $deleteQuery = "DELETE FROM tbl_task WHERE id_task = '$idtask'";
        
        if (mysqli_query($varkoneksi, $deleteQuery)) {
            header("Location: ../../index.php?page=tasks");  // Redirect ke halaman tasks setelah sukses
        } else {
            echo "Error: " . mysqli_error($varkoneksi);  // Menampilkan error jika query gagal
        }
    } else {
        echo "Tugas tidak ditemukan!";
    }
} else {
    echo "ID Tugas tidak ditemukan!";
}
?>
