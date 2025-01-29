<?php
include "../../koneksi.php";

session_start();

// Pastikan session berisi ID pengguna
if (!isset($_SESSION['id_user'])) {
    die("Anda harus login untuk mengakses data ini.");
}

$id_user = $_SESSION['id_user'];

// Query untuk mendapatkan data events berdasarkan pengguna saat ini
$sql = "SELECT id_task, nama, waktu FROM tbl_task WHERE id_user = '$id_user'";

if ($varkoneksi->connect_error) {
    die("Connection failed: " . $varkoneksi->connect_error);
}

$result = $varkoneksi->query($sql);

$events = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Validasi waktu agar formatnya benar
        if (!empty($row['waktu']) && strtotime($row['waktu'])) {
            $events[] = [
                'id' => $row['id_task'],
                'title' => $row['nama'],
                'start' => $row['waktu'],
            ];
        }
    }
}

echo json_encode($events);
$varkoneksi->close();
?>
