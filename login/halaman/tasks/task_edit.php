<link rel="stylesheet" href="css/styles_task.css?v=2.0"> 
<link rel="stylesheet" href="css/styles_tambah.css?v=2.0">
<main class="main-content">
    <header class="main-header">
            <h1>Edit Task</h1>
    </header>
    <?php
        include "koneksi.php";

        $idtask = $_GET["idtask"];

        // Ambil data tugas yang akan diubah
        $adt = mysqli_query($varkoneksi,"SELECT * FROM tbl_task 
            INNER JOIN tbl_keterangan ON tbl_keterangan.id_keterangan = tbl_task.id_keterangan
            INNER JOIN tbl_status ON tbl_status.id_status = tbl_task.id_status 
            WHERE id_task = '$idtask'");

        $tdt = mysqli_fetch_array($adt);
    ?>

    <form action="halaman/tasks/task_edit_aksi.php" method="POST">
        <!-- Tambahkan input hidden untuk idtask di sini -->
        <input type="hidden" name="idtask" value="<?php echo htmlspecialchars($tdt['id_task'], ENT_QUOTES, 'UTF-8'); ?>">

        <section class="task-table-section">
            <table class="task-table">
                <!-- Baris ID Task dihapus -->
                
                <tr>
                    <td>Nama Tugas</td>
                    <td><input type="text" name="nama" id="nama" value="<?php echo htmlspecialchars($tdt['nama'], ENT_QUOTES, 'UTF-8'); ?>"></td>
                </tr>

                <tr>
                    <td>Keterangan</td>
                    <td>
                        <select name="keterangan" id="keterangan">
                            <option value="<?php echo htmlspecialchars($tdt['id_keterangan'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($tdt['keterangan'], ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php
                                $adk = mysqli_query($varkoneksi,"SELECT * FROM tbl_keterangan");
                                while($tdk = mysqli_fetch_array($adk)) {
                            ?>
                                <option value="<?php echo htmlspecialchars($tdk['id_keterangan'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($tdk['keterangan'], ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>   

                <tr>
                    <td>Batas Waktu</td>
                    <td><input type="datetime-local" name="waktu" id="waktu" value="<?php echo htmlspecialchars($tdt['waktu'], ENT_QUOTES, 'UTF-8'); ?>"></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="status">
                            <option value="<?php echo htmlspecialchars($tdt['id_status'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($tdt['statuss'], ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php
                                $ads = mysqli_query($varkoneksi,"SELECT * FROM tbl_status");
                                while($tds = mysqli_fetch_array($ads)) {
                            ?>
                                <option value="<?php echo htmlspecialchars($tds['id_status'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlspecialchars($tds['statuss'], ENT_QUOTES, 'UTF-8'); ?></option>
                            <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td><input class="add-task-btn" type="submit" value="Edit Data" id="tomboledit" name="tomboledit" onclick="return confirm('Yakin mau edit?')"></td>
                </tr>
            </table>
        </section>
    </form>
</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Pastikan Anda sudah mengimpor library Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script type="text/javascript">
$(document).ready(function() {
    $('#keterangan').select2({
        placeholder: 'Pilih Keterangan Tugas',
        allowClear: true
    });

    $('#status').select2({
        placeholder: 'Pilih Status Tugas',
        allowClear: true
    });
});
</script>
