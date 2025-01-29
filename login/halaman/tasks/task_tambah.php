<link rel="stylesheet" href="css/styles_task.css?v=2.0"> 
<link rel="stylesheet" href="css/styles_tambah.css?v=2.0">
<main class="main-content">
    <header class="main-header">        
        <h1>Tambah Task</h1>
    </header>
    <?php
    include "koneksi.php";
    ?>

    <form action="halaman/tasks/task_tambah_aksi.php" method="POST">
        <section class="task-table-section">
            <table class="task-table">
                <tr>
                    <td>Nama Tugas</td>
                    <td><input type="text" name="nama" id="nama" placeholder="Masukan Nama Tugas"></td>
                </tr>

                <tr>
                    <td>Keterangan</td>
                    <td>
                        <select name="keterangan" id="keterangan">
                                <option>Pilih Keterangan Tugas</option>
                                <?php
                                    $adk=mysqli_query($varkoneksi,"SELECT * FROM tbl_keterangan");
                                    while($tdk=mysqli_fetch_array($adk))
                                    {
                                ?>
                                    <option value="<?php echo $tdk['id_keterangan']?>">
                                        <?php echo $tdk['keterangan']?>
                                    </option>";
                                <?php
                                    }
                                ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Batas Waktu</td>
                    <td><input type="datetime-local" name="waktu" id="waktu" placeholder="Masukan Tenggat"></td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="status">
                                <option>Pilih Status Tugas</option>
                                <?php
                                    $ads=mysqli_query($varkoneksi,"SELECT * FROM tbl_status");
                                    while($tds=mysqli_fetch_array($ads))
                                    {
                                ?>
                                    <option value="<?php echo $tds['id_status']?>">
                                        <?php echo $tds['statuss']?>
                                    </option>";
                                <?php
                                    }
                                ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td></td>
                    <td><input class="add-task-btn" type="submit" value="Tambah Data" id="tomboltambah" name="tomboltambah"></td>
                </tr>
            </table>
        </section>
    </form>
</main>

<script type="text/javascript">
$(document).ready(function() {
    $('#keterangan').select2({
        placeholder: 'Pilih Keterangan Tugas',
        allowClear: true
    });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
    $('#status').select2({
        placeholder: 'Pilih Status Tugas',
        allowClear: true
    });
});
</script>

