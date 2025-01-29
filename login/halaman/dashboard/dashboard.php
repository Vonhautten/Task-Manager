<?php
// Koneksi ke database
include "koneksi.php";

// Cek jika session sudah dimulai, jika belum, mulai session
if (session_status() == PHP_SESSION_NONE) {
    session_start(); // Pastikan session aktif
}

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['id_user'])) {
    header("location:index.php?pesan=gagal");
    exit();
}

$id_user = $_SESSION['id_user']; // Ambil ID pengguna dari session

// Query untuk mendapatkan data tugas pengguna
$sql = "SELECT 
    COUNT(*) AS total_tasks,
    SUM(CASE WHEN id_status = 1 THEN 1 ELSE 0 END) AS completed_tasks,
    SUM(CASE WHEN id_status = 2 THEN 1 ELSE 0 END) AS pending_tasks
    FROM tbl_task
    WHERE id_user = ?"; // Tambahkan filter berdasarkan id_user

$stmt = $varkoneksi->prepare($sql);
$stmt->bind_param("i", $id_user); // Bind parameter id_user
$stmt->execute();
$result = $stmt->get_result();

$totalTasks = 0;
$completedTasks = 0;
$pendingTasks = 0;

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $totalTasks = $row['total_tasks'];
    $completedTasks = $row['completed_tasks'];
    $pendingTasks = $row['pending_tasks'];
}

// Query untuk menghitung total waktu yang dihabiskan pada tugas yang selesai
$query_time_spent = "
    SELECT SUM(TIMESTAMPDIFF(MINUTE, waktu, NOW())) AS total_time 
    FROM tbl_task 
    WHERE id_user = ? AND id_status = 1"; // Tambahkan filter id_user

$stmt_time = $varkoneksi->prepare($query_time_spent);
$stmt_time->bind_param("i", $id_user);
$stmt_time->execute();
$result_time = $stmt_time->get_result();
$totalTimeInMinutes = 0;

if ($result_time && $result_time->num_rows > 0) {
    $row_time = $result_time->fetch_assoc();
    $totalTimeInMinutes = $row_time['total_time'] ?? 0;
}

// Mengonversi total waktu dari menit ke format jam dan menit
$hours = floor($totalTimeInMinutes / 60);
$minutes = $totalTimeInMinutes % 60;
$formattedTime = $hours . ' jam ' . $minutes . ' menit';

$varkoneksi->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles_dasboard.css?v=3.0">
    <title>Dashboard</title>
</head>
<body>
    <main class="main-content">
        <header class="main-header">
            <h1>Dashboard</h1>
        </header>

        <section class="dashboard-overview">
            <div class="card1">
                <h3>Total Tasks</h3>
                <p><?php echo $totalTasks; ?></p>
            </div>
            <div class="card2">
                <h3>Selesai</h3>
                <p><?php echo $completedTasks; ?></p>
            </div>
            <div class="card3">
                <h3>Belum Selesai</h3>
                <p><?php echo $pendingTasks; ?></p>
            </div>
            <div class="card4">
                <h3>Total Waktu Dihabiskan Untuk Mengerjakan Tugas</h3>
                <p><?php echo $formattedTime; ?></p>
            </div>
        </section>

        <section class="chart-section">
            <h2>Task Statistics</h2>
            <canvas id="taskChart"></canvas>
        </section>
    </main>
    
    <script>
        const completedTasks = <?php echo $completedTasks; ?>;
        const pendingTasks = <?php echo $pendingTasks; ?>;

        // Membuat chart
        const ctx = document.getElementById('taskChart').getContext('2d');
        const taskChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Selesai', 'Belum selesai'],
                datasets: [{
                    label: 'Task Status',
                    data: [completedTasks, pendingTasks],
                    backgroundColor: ['#4caf50', '#ff9800'],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true
                    }
                }
            }
        });
    </script>
</body>
</html>
