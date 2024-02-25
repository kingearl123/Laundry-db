<section class="main">

    <h2>Data User</h2>

    <div class="myclass">
        <table>
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
            $query = "SELECT * FROM tb_user ORDER BY id_user ASC";

            $sql_rm = mysqli_query($conn, $query) or die(mysqli_error($conn));
            while ($data = mysqli_fetch_array($sql_rm)) {
                $modal_id = "modalubah" . $data['id_user'];

            ?>
                <tr>
                    <td><?= $data['id_user'] ?></td>
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
                            <a href="./proses/proses-hapus-user.php?id_user=<?= $data['id_user'] ?>" class="custom-btn btn-3">Hapus</a>
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
                                    <label for="alamat" class="">Password</label>
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