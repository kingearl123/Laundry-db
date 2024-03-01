<section class="main">

    <h2>Data Paket</h2>

    <button type="button" class="custom-btn btn-1" onclick="openModal('modaltambah')">
        Tambah
    </button>

    <div id="modaltambah" class="modal">
        <!-- ... (konten modal) ... -->
        <div class="modal-header">
            <h5 class="modal-title">Tambah Data</h5>
            <span class="close" style="cursor: pointer;" onclick="closeModal('<?php echo $modal_id ?>')">&times;</span>
        </div>
        <div class="modal-body">
            <form action="./proses/paket/proses-tambah-paket.php" class="login-form" method="post">
                <div class="form-group">
                    <label for="nama">Nama Product</label>
                    <input type="text" name="nama" placeholder="Masukan Nama Product" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="nama">Outlet</label>
                    <select name="id_outlet" class="form-control" required>
                        <option value="" selected disabled hidden>Pilih Outlet</option>
                        <option value="">Silahkan Pilih Outlet</option>
                        <?php
                        $queryAdd = "SELECT * FROM  tb_outlet";
                        mysqli_query($conn, $queryAdd);
                        $dataAdd = mysqli_query($conn, $queryAdd);
                        while ($barisAdd = mysqli_fetch_array($dataAdd)) {
                            echo '<option value="' . $barisAdd['id_outlet'] . '">' . $barisAdd['nama'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="jenis">Nama Outlet</label>
                    <select name="jenis" id="jenis" class="form-control">
                        <option value="">Pilih Jenis Product</option>
                        <option value="kiloan">Kiloan</option>
                        <option value="selimut">Selimut</option>
                        <option value="bed_cover">Bed Cover</option>
                        <option value="kaos">Kaos</option>
                        <option value="lain">Lain-Lain</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="harga">Harga Product</label>
                    <input type="text" name="harga" placeholder="Masukan Harga Product" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>


    <div class="myclass">
        <table border="1">
            <tr>
                <td>ID Paket</td>
                <td>ID_outlet</td>
                <td>Jenis</td>
                <td>Nama Paket</td>
                <td>Harga</td>
                <td colspan="2">Aksi</td>
            </tr>

            <?php
            $queryoutlet = "SELECT * FROM tb_paket ORDER BY id_paket ASC";
            $sql_rm = mysqli_query($conn, $queryoutlet) or die(mysqli_error($conn));
            while ($dataoutlet = mysqli_fetch_array($sql_rm)) {
                $modal_id = "modalubah" . $dataoutlet['id_outlet'];

            ?>
                <tr>
                    <td><?= $dataoutlet['id_paket'] ?></td>
                    <td><?= $dataoutlet['id_outlet'] ?></td>
                    <td><?= $dataoutlet['jenis'] ?></td>
                    <td><?= $dataoutlet['nama_paket'] ?></td>
                    <td><?= $dataoutlet['harga'] ?></td>
                    <td>
                        <button type="button" class="custom-btn btn-2" data-outlet-id="<?= $dataoutlet['id_paket'] ?>" onclick="openModal('<?php echo $modal_id ?>')">Edit</button>

                        <a href="./proses/paket/proses-hapus-paket.php?id_paket=<?= $dataoutlet['id_paket'] ?>" class="custom-btn btn-3">Hapus</a>
                    </td>
                </tr>

                <!-- modal edit -->
                <div id="<?php echo $modal_id ?>" class="modal">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <span class="close" style="cursor: pointer;" onclick="closeModal('<?php echo $modal_id ?>')">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form action="./proses/paket/proses-edit-paket.php" class="login-form" method="post">
                            <div class="form-group">
                                <input class="form-control" name="id_paket" value="<?= $dataoutlet['id_paket']; ?>" hidden required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Product</label>
                                <input type="text" name="nama" placeholder="Masukan Nama Product" class="form-control" value="<?= $dataoutlet['nama_paket']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Outlet</label>
                                <select name="id_outlet" value="<?= $dataoutlet['id_outlet'] ?>" class="form-control" required>
                                    <!-- <option value="" selected disabled hidden>Pilih Outlet</option> -->

                                    <?php
                                    $queryAdd = "SELECT * FROM  tb_outlet";
                                    $dataAdd = mysqli_query($conn, $queryAdd);
                                    while ($barisAdd = mysqli_fetch_array($dataAdd)) {
                                    ?>

                                        <option value="<?= $barisAdd['id_outlet'] ?>" <?php if ($dataoutlet['id_outlet'] == $barisAdd['id_outlet']) echo 'selected="selected"'; ?>><?= $barisAdd['nama'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jenis">Nama Outlet</label>
                                <select name="jenis" id="jenis" class="form-control">
                                    <option value="<?= $dataoutlet['jenis'] ?>"><?= $dataoutlet['jenis'] ?></option>
                                    <option value="kiloan">Kiloan</option>
                                    <option value="selimut">Selimut</option>
                                    <option value="bed_cover">Bed Cover</option>
                                    <option value="kaos">Kaos</option>
                                    <option value="lain">Lain-Lain</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga Product</label>
                                <input type="text" name="harga" value="<?= $dataoutlet['harga'] ?>" placeholder="Masukan Harga Product" class="form-control" required>
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