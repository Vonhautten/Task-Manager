<link rel="stylesheet" href="css/styles_task.css?v=2.0">
<body>
    <main class="main-content">
        <header class="main-header">
            <h1>Task</h1>  
        </header>

        <section class="task-table-section">
                <a class="add-task-btn" href="index.php?page=tasksadd">Tambah Task</a>
            <table class="task-table" id="tabel-data">
                <thead>
                    <tr class="tbheader">
                        <th>#</th>
                        <th>Task Name</th>
                        <th>keterangan</th>
                        <th>Status</th> 
                        <th>Deadline</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                    // Cek apakah session sudah dimulai, jika belum, mulai session
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start(); // Pastikan session aktif
                    }

                    if (!isset($_SESSION['id_user'])) {
                        header("location:index.php?pesan=gagal");
                        exit();
                    }

                    include "koneksi.php";

                    // Ambil ID pengguna dari session
                    $id_user = $_SESSION['id_user'];

                    // Query untuk mengambil tugas yang terkait dengan pengguna
                    $ambildata = mysqli_query($varkoneksi, "SELECT * FROM tbl_task 
                                                            INNER JOIN tbl_keterangan ON tbl_keterangan.id_keterangan = tbl_task.id_keterangan
                                                            INNER JOIN tbl_status ON tbl_status.id_status = tbl_task.id_status
                                                            WHERE tbl_task.id_user = '$id_user'"); // Filter berdasarkan id_user

                    $nomor = 1;
                    while ($tampildata = mysqli_fetch_array($ambildata)) {
                        // Tentukan class status berdasarkan nilai
                        $statusClass = ($tampildata["statuss"] == "selesai") ? "status completed" : "status pending";
                        ?>
                        <tr>
                            <td><?php echo $nomor++ ?></td>
                            <td><?php echo $tampildata["nama"] ?></td>
                            <td><?php echo $tampildata["keterangan"] ?></td>
                            <!-- Tambahkan class status -->
                            <td><span class="<?php echo $statusClass; ?>"><?php echo $tampildata["statuss"]; ?></span></td>
                            <td><?php echo $tampildata["waktu"] ?></td>
                            <td>
                                <a class="edit-btn" href="index.php?page=tasksedit&idtask=<?php echo $tampildata['id_task']; ?>">
                                <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                
                                <a class="delete-btn" href="halaman/tasks/task_hapus.php?idtask=<?php echo $tampildata['id_task']; ?>" 
                                    onclick="return confirm('Apa Anda yakin akan menghapus Data Tugas?')">
                                    <i class="fa-solid fa-trash-can"> </i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabel-data').DataTable();
    });
    </script>