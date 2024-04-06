<section class="main">

    <h2>Data User</h2>

    <button type="button" class="custom-btn btn-1" onclick="openModal('modaltambah')">
        Tambah
    </button>

    <div id="modaltambah" class="modal">
        <!-- ... (konten modal) ... -->
        <div class="modal-header">
            <h5 class="modal-title">input Data</h5>
            <span class="close" style="cursor: pointer;" onclick="closeModal1()">&times;</span>
        </div>
        <div class="modal-body">
            <form action="./proses/user/proses-tambah-user.php" method="POST">
                <div class="form-group">
                    <input type="hidden" class="form-control" name="id_user" id="id_user">
                </div>
                <div class="mb-3">
                    <label for="tnim" class="">Nama</label>
                    <input type="text" class="form-control" required name="nama" style="width: 100%;">
                </div>
                <div class="mb-3">
                    <label for="nama" class="">Username</label>
                    <input type="text" class="form-control" required name="username" style="width: 100%;">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="">Password</label>
                    <input type="password" class="form-control" required name="password" style="width: 100%;">
                </div>
                <div class="mb-3">
                    <label for="alamat" class="">Outlet User</label>
                    <select name="id_outlet" id="" class="form-control" required>
                        <?php
                        $query = mysqli_query($conn, "SELECT * FROM tb_outlet");
                        while ($hasil = mysqli_fetch_assoc($query)) {
                        ?>
                            <option value="<?= $hasil['id_outlet']; ?>">
                                <?= $hasil['nama']; ?>
                            </option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="">Password</label>
                    <select name="role" id="" class="form-control" style="width: 100%;" required>
                        <option value="owner">Owner</option>
                        <option value="kasir">Kasir</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <br>
                <button type="submit" name="simpan" id="simpan" class="btn btn-primary mb-3">Save</button>
            </form>
        </div>
    </div>


    <div class="myclass">
        <table border="1">
            <tr>
                <th>ID User</th>
                <th>Nama User</th>
                <th>Username</th>
                <th>Password</th>
                <th>Outlet</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
            <?php
            $no = 1;
            $query = "SELECT * FROM tb_user ORDER BY id_user ASC";

            $sql_rm = mysqli_query($conn, $query) or die(mysqli_error($conn));
            while ($data = mysqli_fetch_array($sql_rm)) {
                $modal_id = "modalubah" . $data['id_user'];

            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['username'] ?></td>
                    <td><?= substr($data['password'], 0, 15) ?></td>
                    <td>
                        <?php
                        $queryOutlet = "SELECT * FROM tb_outlet WHERE id_outlet='" . $data['id_outlet'] . "'";
                        $dataOutlet = mysqli_query($conn, $queryOutlet);
                        $barisOutlet = mysqli_fetch_array($dataOutlet);
                        ?>
                        <?= $barisOutlet['nama'] ?>
                    </td>
                    <td><?= $data['role'] ?></td>
                    <td>
                        <button type="button" class="custom-btn btn-2" data-member-id="<?= $data['id_user'] ?>" onclick="openModal('<?php echo $modal_id ?>')">Edit</button>
                        <?php
                        $id = $data['id_user'];
                        $hide_delete1 = mysqli_query($conn, "SELECT COUNT(*) as total FROM tb_user INNER JOIN tb_transaksi USING(id_user) WHERE id_user = $id");
                        $cek1 = mysqli_fetch_row($hide_delete1)[0];
                        if ($_SESSION['username'] != $data['username']) {
                        ?>
                            <a href="./proses/user/proses-hapus-user.php?id_user=<?= $data['id_user'] ?>" class="custom-btn btn-3">Hapus</a>
                        <?php
                        }
                        ?>
                    </td>
                </tr>

                <!-- modal edit -->
                <div id="<?php echo $modal_id ?>" class="modal">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Data</h5>
                        <span class="close" style="cursor: pointer;" onclick="closeModal('<?php echo $modal_id; ?>')">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form action="./proses/user/proses-edit-user.php" method="POST">
                            <div class="form-group">
                                <input type="hidden" class="form-control" name="id_user" id="id_user" value="<?= $data['id_user'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="tnim" class="">Nama</label>
                                <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>" style="width: 100%;">
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="">Username</label>
                                <input type="text" class="form-control" name="username" value="<?= $data['username'] ?>" style="width: 100%;">
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="">Password</label>
                                <input type="text" class="form-control" name="password" value="<?= $data['password'] ?>" style="width: 100%;" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="">Outlet User</label>
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
                            <div class="mb-3">
                                <label for="alamat" class="">Role</label>
                                <select name="role" id="" class="form-control" style="width: 100%;">
                                    <option value="owner" <?php if ($data['role'] == "owner")
                                                                echo 'selected="selected"'; ?>>Owner</option>
                                    <option value="kasir" <?php if ($data['role'] == "kasir")
                                                                echo 'selected="selected"'; ?>>Kasir</option>
                                    <option value="admin" <?php if ($data['role'] == "admin")
                                                                echo 'selected="selected"'; ?>>Admin</option>
                                </select>
                            </div>

                            <br>
                            <button type="submit" name="simpan" id="simpan" class="btn btn-primary mb-3">Save</button>
                        </form>
                    </div>
                </div>


            <?php
            }

            ?>

        </table>
</section>