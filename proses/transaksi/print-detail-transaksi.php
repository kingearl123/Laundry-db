<?php

    include '../../config/config.php'

?>

<section class="main">


    <h2 align="center">Detail Transaksi</h2>
    

    <div class="flex" style="display: flex;
        justify-content: space-between; flex-direction: column; align-items: center;"">
        <table border=" 1" style="  width:  45%; /* Anda dapat menyesuaikan lebar sesuai kebutuhan */
        border-collapse: collapse;
">
        <?php
        @$id_transaksi = $_GET['id_transaksi'];
        if (!$id_transaksi) {
            $queryTransaksi = "SELECT * FROM tb_transaksi ORDER BY id_transaksi DESC LIMIT 1";
        } else {
            $queryTransaksi = "SELECT * FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'";
        }
        $hasilTransaksi = mysqli_query($conn, $queryTransaksi);
        $rowTransaksi = mysqli_fetch_array($hasilTransaksi);

        $id_member = $rowTransaksi['id_member'];
        $queryMember = "SELECT nama,alamat,tlp FROM tb_member WHERE id_member = '$id_member'";
        $hasilMember = mysqli_query($conn, $queryMember);
        $rowMember = mysqli_fetch_array($hasilMember);

        $id_outlet = $rowTransaksi['id_outlet'];

        $id_user = $rowTransaksi['id_user'];
        $queryUser = "SELECT * FROM tb_user WHERE id_user = '$id_user'";
        $hasilUser = mysqli_query($conn, $queryUser);
        $rowUser = mysqli_fetch_array($hasilUser);
        ?>

        <tr>
            <td>Kode Invoice</td>
            <td><?= $rowTransaksi['kode_invoice'] ?></td>
        </tr>
        <tr>
            <td>Nama Pelanggan</td>
            <td><?= $rowMember['nama'] ?></td>
        </tr>
        <tr>
            <td>No. Telp</td>
            <td><?= $rowMember['tlp'] ?></td>
        </tr>
        <tr>
            <td>Alamat Pelanggan</td>
            <td><?= $rowMember['alamat'] ?></td>
        </tr>
        <tr>
            <td>Nama Kasir</td>
            <td><?= $rowUser['nama'] ?></td>
        </tr>
        <tr>
            <td>Ambil Sebelum</td>
            <td><?= $rowTransaksi['batas_waktu'] ?></td>
        </tr>
        <tr>
            <td>Status</td>
            <td>
                <form id="status-form" action="./proses/transaksi/proses-edit-status-transaksi.php" method="post">
                    <input type="text" name="id_transaksi" value="<?= $rowTransaksi['id_transaksi'] ?>" hidden>
                    <select id="status-select" name="status" class="input" style="width: 150px; font-size:16px;">
                        <option value="baru" <?php if ($rowTransaksi['status'] == 'baru') echo "selected='selected'"; ?>>Baru</option>
                        <option value="proses" <?php if ($rowTransaksi['status'] == 'proses') echo "selected='selected'"; ?>>Proses</option>
                        <option value="selesai" <?php if ($rowTransaksi['status'] == 'selesai') echo "selected='selected'"; ?>>Selesai</option>
                        <option value="diambil" <?php if ($rowTransaksi['status'] == 'diambil') echo "selected='selected'"; ?>>Diambil</option>
                    </select>
                </form>
            </td>
        </tr>
        </table>
        <br>
        <table style="  width:  45%; /* Anda dapat menyesuaikan lebar sesuai kebutuhan */
        border-collapse: collapse;">
            <tr style="background-color: #569DAA;">
                <td>Nama Product</td>
                <td>Keterangan</td>
                <td>Qty</td>
                <td>Harga</td>
                <td>Total Harga</td>
            </tr>
            <?php
            function rupiah($angka)
            {
                $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
                return $hasil_rupiah;
            }

            $id_transaksi = $rowTransaksi['id_transaksi'];
            $queryDetailProduct = "SELECT * FROM tb_detail_transaksi WHERE id_transaksi = '$id_transaksi'";
            $dataDetailProduct = mysqli_query($conn, $queryDetailProduct);

            @$totalHarga += $rowTransaksi['biaya_tambahan'];

            while ($rowDetailProduct = mysqli_fetch_array($dataDetailProduct)) {
                $id_paket = $rowDetailProduct['id_paket'];
                $queryProduct = "SELECT * FROM tb_paket WHERE id_paket = '$id_paket'";
                $dataProduct = mysqli_query($conn, $queryProduct);
                $hasilProduct = mysqli_fetch_array($dataProduct);

                @$totalHargaPerItem = $rowDetailProduct['qty'] * $hasilProduct['harga'];
                @$totalHarga += $totalHargaPerItem;

                $total = @$totalHarga;
                if ($rowTransaksi['diskon'] > 0) {
                    $diskon = $total * $rowTransaksi['diskon'] / 100;
                    $total -= $diskon;
                }
                $pajak = $total * $rowTransaksi['pajak'];
                $total += $pajak;
            ?>
                <tr>
                    <td>
                        <?= @$hasilProduct['nama_paket'] ?>
                        <br>
                        <a style="font-size: 14px; color:#577D86;"><?= @$hasilProduct['jenis'] ?></a>
                    </td>
                    <td><?= @$rowDetailProduct['keterangan'] ?></td>
                    <td><?= @$rowDetailProduct['qty'] ?></td>
                    <td><?= rupiah(@$hasilProduct['harga']) ?></td>
                    <td align="right"><?= rupiah(@$totalHargaPerItem) ?></td>
                    <td><a href="./proses/transaksi/detail-product-transaksi.php?id_detail_transaksi=<?= @$rowDetailProduct['id_detail_transaksi'] ?>&id_transaksi=<?= $id_transaksi ?>">X</a></td>
                </tr>
            <?php
            }
            if ($rowTransaksi['biaya_tambahan'] > 0) {
            ?>
                <tr>
                    <td>Biaya Tambahan</td>
                    <td colspan="4" align="right"><?= rupiah(@$rowTransaksi['biaya_tambahan']) ?></td>
                </tr>
            <?php
            }
            ?>
            <tr">
                <td>Total Keseluruhan</td>
                <td colspan="4" align="right"><?= rupiah(@$totalHarga) ?></td>
            </tr>
            <?php
            if ($rowTransaksi['diskon'] > 0) {
            ?>
                <tr>
                    <td>Discount</td>
                    <td colspan="4" align="right"><?= $rowTransaksi['diskon'] ?>%</td>
                </tr>
            <?php
            }
            ?>
            <tr>
                <td>Tax</td>
                <td colspan="4" align="right"><?= $rowTransaksi['pajak'] * 100 ?></td>
            </tr>
            <tr>
                <td>Total</td>
                <td colspan="4" align="right"><?= rupiah(round(@$total));
                                                ?></td>
            </tr>
        </table>
    </div>




</section>

<!-- <script>
    window.print();
</script> -->