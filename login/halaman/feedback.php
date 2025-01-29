<?php
// Koneksi ke database
include "koneksi.php";

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['id_user']) || !isset($_SESSION['username'])) {
    die("Anda harus login untuk mengakses halaman ini.");
}

// Proses pengiriman feedback
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_user = $_SESSION['id_user']; 
    $pesan = $_POST['pesan'];

    // Query untuk menyimpan feedback
    $sql = "INSERT INTO tbl_feedback (id_user, pesan) VALUES (?, ?)";
    $stmt = $varkoneksi->prepare($sql);
    $stmt->bind_param("is", $id_user, $pesan);
    $stmt->execute();
    $stmt->close();

    header("Location: index.php?page=feed"); 
    exit; 
}


$sql_feedback = "
    SELECT f.pesan, f.tanggal, u.username AS nama_pengguna
    FROM tbl_feedback f
    JOIN tbl_user u ON f.id_user = u.id
    ORDER BY f.tanggal DESC
";
$result_feedback = $varkoneksi->query($sql_feedback);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/styles_feedback.css?v=2.0">

</head>
<body>
    <main class="main-content">
        <header class="main-header">
            <h1>Feedback</h1>
        </header>  
        <section class="feedback-form">
            <form action="index.php?page=feed" method="POST">
                <p><strong>Nama Pengguna:</strong> <?php echo htmlspecialchars($_SESSION['username']); ?></p>
                
                <label for="pesan">Pesan</label>
                <textarea id="pesan" name="pesan" required placeholder="Tulis feedback atau saran Anda"></textarea>

                <button type="submit">Kirim</button>
            </form>
        </section>
        <section class="feedback-list">
            <h2>Daftar Feedback</h2>
            <?php if ($result_feedback && $result_feedback->num_rows > 0): ?>
                <ul>
                    <?php while ($row = $result_feedback->fetch_assoc()): ?>
                        <li>
                            <p id="iden"><strong><?php echo htmlspecialchars($row['nama_pengguna']); ?></strong> 
                            (<?php echo htmlspecialchars($row['tanggal']); ?>)</p>
                            <p><?php echo htmlspecialchars($row['pesan']); ?></p>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>Belum ada feedback yang masuk.</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('pesan');

    textarea.addEventListener('input', function () {
        this.style.height = 'auto'; 
        this.style.height = this.scrollHeight + 'px';
    });
});

</script>