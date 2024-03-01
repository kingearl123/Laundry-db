<section class="main">

    <h2>Data Member</h2>
    <button type="button" class="custom-btn btn-1" onclick="openModal('modaltambah')">
        Tambah
    </button>

    <div id="modaltambah" class="modal">
        <!-- ... (konten modal) ... -->
        <div class="modal-header">
            <h5 class="modal-title">Tambah Data</h5>
            <span class="close" style="cursor: pointer;" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form action="./proses/member/proses-tambah-member.php" class="login-form" method="post">
                <div class="form-group">
                    <label for="nama">Nama Member</label>
                    <input type="text" name="nama" class="form-control" placeholder="Masukan Nama Outlet" required>
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" class="form-control" placeholder="Masukan Alamat Member" required>
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <select name="jenisKelamin" id="jenisKelamin" class="form-control">
                        <option value="">Silahkan Pilih</option>
                        <option value="L">Laki-Laki</option>
                        <option value="P">Perempuan</option>
                    </select>
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
                <td>Jenis Kelamin</td>
                <td>Telpon</td>
                <td colspan="2" align="center">Aksi</td>
            </tr>

            <?php
            $queryoutlet = "SELECT * FROM tb_member ORDER BY id_member ASC";
            $sql_rm = mysqli_query($conn, $queryoutlet) or die(mysqli_error($conn));
            while ($dataoutlet = mysqli_fetch_array($sql_rm)) {
                $modal_id = "modalubah" . $dataoutlet['id_member'];
            ?>
                <tr>
                    <td><?= $dataoutlet['id_member'] ?></td>
                    <td><?= $dataoutlet['nama'] ?></td>
                    <td><?= $dataoutlet['alamat'] ?></td>
                    <td><?= $dataoutlet['jenis_kelamin'] ?></td>
                    <td><?= $dataoutlet['tlp'] ?></td>
                    <td>
                        <button type="button" class="custom-btn btn-2" data-member-id="<?= $dataoutlet['id_member'] ?>" onclick="openModal('<?php echo $modal_id ?>')">Edit</button>

                        <a href="./proses/member/proses-hapus-member.php?id_member=<?= $dataoutlet['id_member'] ?>" class="custom-btn btn-3">Hapus</a>
                    </td>
                </tr>

                <!-- modal edit -->
                <div id="<?php echo $modal_id ?>" class="modal">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <span class="close" style="cursor: pointer;" onclick="closeModal('<?php echo $modal_id; ?>')">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form action="./proses/member/proses-edit-member.php" class="login-form" method="post">

                            <div class="form-group">
                                <input type="text" name="id_member" value="<?= $dataoutlet ['id_member']?>" hidden class="form-control" placeholder="Masukan Nama Outlet" required>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Member</label>
                                <input type="text" name="namaMember" class="form-control" value=" <?= $dataoutlet['nama']?>" placeholder="Masukan Nama Outlet" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" name="alamatMember" value="<?=$dataoutlet['alamat'];?>" class="form-control" placeholder="Masukan Alamat Member" required>
                            </div>
                            <div class="form-group">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <select name="jenisKelaminMember" id="jenisKelamin" class="form-control">
                                    <option value="<?=$dataoutlet['jenis_kelamin'];?>"><?=$dataoutlet['jenis_kelamin'];?></option>
                                    <option value="L">Laki-Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="telpMember">Nomor Telephone</label>
                                <input type="text" name="telpMember" value="<?= $dataoutlet['tlp'];?>" placeholder="Masukan Nomor Telephone" class="form-control" required>
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