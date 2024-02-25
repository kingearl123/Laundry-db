<section class="main">

    <h2>Data Transaksi</h2>
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
            <form action="./proses/transaksi/proses-tambah-transaksi.php" class="login-form" method="post">
                <div class="form-group">
                    <label for="id_member">Nama Member</label>
                    <input type="list" list="id_member" name="id_member" class="form-control">
                    <datalist name="id_member" id="id_member">
                        <?php
                        $queryAdd = "SELECT * FROM  tb_member";
                        mysqli_query($conn, $queryAdd);
                        $dataAdd = mysqli_query($conn, $queryAdd);
                        while ($barisAdd = mysqli_fetch_array($dataAdd)) {
                            echo '<option value="' . $barisAdd['id_member'] . '">' . $barisAdd['nama'] . '</option>';
                        }
                        ?>
                    </datalist>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <div class="myclass">
        <table>
            <tr>
                <th>ID Transaksi</th>
                <th>Nama Outlet</th>
                <th>Kode Invoice</th>
                <th>Nama Member</th>
                <th>Tanggal</th>
                <th>Batas Waktu</th>
                <th>Tanggal Bayar</th>
                <th>Biaya Tambahan</th>
                <th>Diskon</th>
                <th>Pajak</th>
                <th>Status</th>
                <th>Dibayar</th>
                <th>Nama User</th>
                <th colspan="2">Aksi</th>
            </tr>

            <?php
            $query = "SELECT * FROM tb_transaksi ORDER BY id_transaksi ASC";

            $sql_rm = mysqli_query($conn, $query) or die(mysqli_error($conn));
            while ($data = mysqli_fetch_array($sql_rm)) {
            ?>
                <tr>
                    <td><?= $data['id_transaksi'] ?></td>
                    <td>
                        <?php
                        $queryOutlet = "SELECT * FROM tb_outlet WHERE id_outlet='" . $data['id_outlet'] . "'";
                        $dataOutlet = mysqli_query($conn, $queryOutlet);
                        $barisOutlet = mysqli_fetch_array($dataOutlet);
                        ?>
                        <?= $barisOutlet['nama'] ?>
                    </td>
                    <td><?= substr($data['kode_invoice'], 0, 10) ?></td>
                    <td>
                        <?php
                        $queryMember = "SELECT * FROM tb_member WHERE id_member='" . $data['id_member'] . "'";
                        $dataMember = mysqli_query($conn, $queryMember);
                        $barisMember = mysqli_fetch_array($dataMember);
                        ?>
                        <?= $barisMember['nama'] ?>
                    </td>
                    <td><?= $data['tgl'] ?></td>
                    <td><?= $data['batas_waktu'] ?></td>
                    <td><?= $data['tgl_bayar'] ?></td>
                    <td><?= $data['biaya_tambahan'] ?></td>
                    <td><?= $data['diskon'] ?></td>
                    <td><?= $data['pajak'] ?></td>
                    <td><?= $data['status'] ?></td>
                    <td><?= $data['dibayar'] ?></td>
                    <td>
                        <?php
                        $queryUser = "SELECT * FROM tb_user WHERE id_user='" . $data['id_user'] . "'";
                        $dataUser = mysqli_query($conn, $queryUser);
                        $barisUser = mysqli_fetch_array($dataUser);
                        ?>
                        <?= $barisUser['nama'] ?>
                    </td>
                    <td>
                        <?php
                        if ($data['dibayar']  == 'belum_dibayar') {
                        ?>
                            <a href="./dashboard.php?page=detail-transaksi&id_transaksi=<?= $data['id_transaksi'] ?>" class="custom-btn btn-1">Continue</a>
                        <?php
                        } else {
                        ?>
                            <a href="./dashboard.php?page=detail-transaksi&id_transaksi=<?= $data['id_transaksi'] ?>" class="btn-2 custom-btn" >Edit</a>
                        <?php
                        }
                        ?>
                    </td>


                <?php
            }
                ?>

        </table>
</section>