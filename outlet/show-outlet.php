<section class="main">

    <div id="overlay" class="overlay"></div>

    <h2>Data Outlet</h2>
    <button type="button" class="custom-btn btn-1" onclick="openModal('modaltambah')">
        Tambah
    </button>


    <div id="modaltambah" class="modal">
        <!-- ... (konten modal) ... -->
        <div class="modal-header" id="modaltambah1">
            <h5 class="modal-title">Tambah Data</h5>
            <span class="close" style="cursor: pointer;" onclick="closeModal1()">&times;</span>
        </div>
        <div class="modal-body">
            <form action="./proses/outlet/proses-tambah-outlet.php" class="login-form" method="post">
                <div class="form-group">
                    <label for="nama">Nama Outlet</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Outlet" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" placeholder="Masukan Alamat Outlet" required>
                </div>
                <div class="form-group">
                    <label for="tlp">Nomor Telephone</label>
                    <input type="text" name="tlp" placeholder="Masukan Nomor Telephone" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>



    <div class="myclass">
        <table border="1">
            <tr>
                <td>ID Outlet</td>
                <td>Nama</td>
                <td>Alamat</td>
                <td>Telpon</td>
                <td colspan="2">Aksi</td>
            </tr>

            <?php
            $no = 1;
            $queryoutlet = "SELECT * FROM tb_outlet ORDER BY id_outlet ASC";
            $sql_rm = mysqli_query($conn, $queryoutlet) or die(mysqli_error($conn));
            while ($dataoutlet = mysqli_fetch_array($sql_rm)) {
                $modal_id = "modalubah" . $dataoutlet['id_outlet'];

            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $dataoutlet['nama'] ?></td>
                    <td><?= $dataoutlet['alamat'] ?></td>
                    <td><?= $dataoutlet['tlp'] ?></td>
                    <td>

                        <button type="button" class="custom-btn btn-2" data-outlet-id="<?= $dataoutlet['id_outlet'] ?>" onclick="openModal('<?php echo $modal_id ?>')">Edit</button>
                        <?php
                        $id = $dataoutlet['id_outlet'];
                        $hide_delete1 = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_outlet INNER JOIN tb_user ON tb_outlet.id_outlet=tb_user.id_outlet WHERE tb_outlet.id_outlet='$id'"));
                        $hide_delete2 = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_outlet INNER JOIN tb_paket ON tb_outlet.id_outlet=tb_paket.id_outlet WHERE tb_outlet.id_outlet='$id'"));
                        $hide_delete3 = mysqli_fetch_row(mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_outlet INNER JOIN tb_transaksi ON tb_outlet.id_outlet=tb_transaksi.id_outlet WHERE tb_outlet.id_outlet='$id'"));

                        if ($hide_delete1[0] == '0' && $hide_delete2[0] == '0' && $hide_delete3[0] == '0') {
                        ?>

                            <a href="./proses/outlet/proses-hapus-outlet.php?id_outlet=<?= $dataoutlet['id_outlet'] ?>" class="custom-btn btn-3">Hapus</a>
                        <?php
                        }
                        ?>

                    </td>
                </tr>

                <!-- modal edit -->
                <div id="<?php echo $modal_id ?>" class="modal">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <span class="close" style="cursor: pointer;" onclick="closeModal('<?php echo $modal_id ?>')">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form action="./proses/outlet/proses-edit-outlet.php" class="login-form" method="post">
                            <div class="form-group">
                                <input type="text" name="id_outlet" value="<?= $dataoutlet['id_outlet'] ?>" hidden class="form-control" placeholder="Masukan Nama Outlet" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Outlet</label>
                                <input type="text" name="nama" value="<?= $dataoutlet['nama'] ?>" class="form-control" placeholder="Masukan Nama Outlet" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamat" value="<?= $dataoutlet['alamat'] ?>" class="form-control" placeholder="Masukan Alamat Outlet" required>
                            </div>
                            <div class="form-group">
                                <label for="tlp">Nomor Telephone</label>
                                <input type="text" name="tlp" value="<?= $dataoutlet['tlp'] ?>" placeholder="Masukan Nomor Telephone" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>

            <?php

            }
            ?>

        </table>
</section>

<script>
    function closeModal1() {
        document.getElementById(modaltambah).classList.remove('active');
        document.getElementById(modaltambah1).classList.remove('active');
    }
</script>