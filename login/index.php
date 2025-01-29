<?php
session_start();

// Validasi sesi pengguna
if (!isset($_SESSION['id_user']) || !isset($_SESSION['username'])) {
    header("Location: ../index.php?pesan=belum_login");
    exit();
}

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Expires: 0");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Task Manager</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles_index.css?v=2.0">
    <link rel="stylesheet" href="css/footer.css?v=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://kit.fontawesome.com/a59271b126.js" crossorigin="anonymous"></script>

    <!-- datatables -->
    <link rel="stylesheet" href="css/datatables.css" />
    <script type="text/javascript" src="js/jquery-3.7.1.min.js"></script>
    <script type="text/javascript" src="js/datatables.min.js"></script>

    <!-- select 2   -->
    <link rel="stylesheet" href="select2/css/select2.min.css" />
    <script src="select2/js/select2.min.js"></script>

    <!-- diagram -->
    <script src="js/chart.js"></script>
</head>
<body>
    <div class="dashboard-container">
        <button class="toggle-btn" id="toggle-btn">
            ☰
        </button>

        <div class="sidebar" id="sidebar">
            <h2>Task Manager</h2>
            <nav>
                <ul>
                    <li><a href="index.php?page=dashboard"><i class="fa-solid fa-gauge"></i> Dashboard</a></li>
                    <li><a href="index.php?page=tasks"><i class="fa-solid fa-list-check"></i> Task</a></li>
                    <li><a href="index.php?page=calendar"><i class="fa-regular fa-calendar-days"></i> Calendar</a></li>
                    <li><a href="index.php?page=feed"><i class="fa-solid fa-message"></i> Feedback</a></li>
                    <li><a href="index.php?page=about"><i class="fa-solid fa-user"></i> About</a></li>
                    <li><a href="index.php?page=logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
                </ul>
            </nav>
        </div>

        <?php include 'konten.php'; ?>

    </div>
    <?php
        include'halaman/footer.php';
    ?>
    <!-- Footer -->


    <script>
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('toggle-btn');

        toggleBtn.addEventListener('click', () => {
            sidebar.classList.toggle('hidden');
        });
    </script>
</body>
</html>
