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
        <?php
        function rupiah($angka)
        {
            $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
            return $hasil_rupiah;
        }
        $count = mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_paket");
        $cekCount = mysqli_fetch_row($count)[0];
        ?>
        <table border="1">
            <tr>
                <td>ID Paket</td>
                <td>Nama Outlet</td>
                <td>Jenis</td>
                <td>Nama Paket</td>
                <td>Harga</td>
                <td colspan="2">Aksi</td>
            </tr>

            <?php
<<<<<<< HEAD
            $no = 1;
=======
>>>>>>> fe190269a0087379e86107e40331a1f1a2bcb48b
            $query = "SELECT * FROM tb_paket ORDER BY id_outlet ASC";
            $sql_rm = mysqli_query($conn, $query) or die(mysqli_error($conn));
            while ($data = mysqli_fetch_array($sql_rm)) {
                $modal_id = "modalubah" . $data['id_paket'];
            ?>
                <tr>
                    <td>
<<<<<<< HEAD
                        <?= $no++ ?>
=======
                        <?= $data['id_paket'] ?>
>>>>>>> fe190269a0087379e86107e40331a1f1a2bcb48b
                    </td>

                    <td>
                        <?php
                        $queryOutlet = "SELECT * FROM tb_outlet WHERE id_outlet='" . $data['id_outlet'] . "'";
                        $dataOutlet = mysqli_query($conn, $queryOutlet);
                        $barisOutlet = mysqli_fetch_array($dataOutlet);
                        ?>
                        <?= $barisOutlet['nama'] ?>
                    </td>

                    <td>
                        <?php
                        if ($data['jenis'] == "kiloan") {
                            echo "Kiloan";
                        } else if ($data['jenis'] == "selimut") {
                            echo "Selimut";
                        } else if ($data['jenis'] == "bed_cover") {
                            echo "Bed Cover";
                        } else if ($data['jenis'] == "kaos") {
                            echo "Kaos";
                        } else if ($data['jenis'] == "lain") {
                            echo "Lain-Lain";
                        } else {
                            echo "None";
                        }
                        ?>
                    </td>
                    <td>
                        <?= $data['nama_paket'] ?>
                    </td>
                    <td>
                        <?= rupiah($data['harga']) ?>
                    </td>

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
                                <input class="form-control" name="id_paket" value="<?= $data['id_paket']; ?>" hidden required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Product</label>
                                <input type="text" name="nama" placeholder="Masukan Nama Product" class="form-control" value="<?= $data['nama_paket']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat" class="form-label">Outlet Product</label>
                                <select name="id_outlet" id="id_outlet" class="form-control" style="width: 100%;">
                                    <option value="">Silahkan Pilih Outlet</option>
                                    <?php
                                    $queryAdd = "SELECT * FROM  tb_outlet";
                                    $dataAdd = mysqli_query($conn, $queryAdd);
                                    while ($barisAdd = mysqli_fetch_array($dataAdd)) {
                                    ?>
                                        <option value="<?= $barisAdd['id_outlet'] ?>" <?php if ($data['id_outlet'] == $barisAdd['id_outlet'])
                                                                                            echo 'selected="selected"'; ?>>
                                            <?= $barisAdd['nama'] ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="jenis">Nama Outlet</label>
                                <select name="jenis" id="jenis" class="form-control">
                                    <option value="<?= $data['jenis'] ?>"><?= $data['jenis'] ?></option>
                                    <option value="kiloan">Kiloan</option>
                                    <option value="selimut">Selimut</option>
                                    <option value="bed_cover">Bed Cover</option>
                                    <option value="kaos">Kaos</option>
                                    <option value="lain">Lain-Lain</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="harga">Harga Product</label>
                                <input type="text" name="harga" value="<?= $data['harga'] ?>" placeholder="Masukan Harga Product" class="form-control" required>
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
