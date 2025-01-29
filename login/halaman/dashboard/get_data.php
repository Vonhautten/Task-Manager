<?php
// Koneksi ke database
include "koneksi.php";

// Periksa koneksi
if ($varkoneksi->connect_error) {
    die("Connection failed: " . $$varkoneksi->connect_error);
}

// Ambil data dari tabel
$sql = "SELECT 
    COUNT(*) AS total_tasks,
    SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) AS completed_tasks,
    SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) AS pending_tasks
    FROM tasks"; 
$result = $varkoneksi->query($sql);

if ($result->num_rows > 0) {
    echo json_encode($result->fetch_assoc());
} else {
    echo json_encode(["total_tasks" => 0, "completed_tasks" => 0, "pending_tasks" => 0]);
}

$varkoneksi->close();
?>
