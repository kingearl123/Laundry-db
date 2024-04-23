<?php
function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
    return $hasil_rupiah;
}
?>


<section class="main">

    <h2>Data Laporan</h2>
    <br>
    <form action="./laporan/print-laporan.php" target="_blank" method="post">
        <span>Start Date</span>
        <input type="date" name="tgl_awal" class="input" style="width:120px; font-size: 16px;" required>
        <span>End Date</span>
        <input type="date" name="tgl_akhir" class="input" style="width:120px; font-size: 16px;" required>
        <button type="submit" class="btn-4" name="submit">Generate Laporan</button>
    </form>


    <div class="myclass">

        <table onchange="myFunction()" id="myTable" class="table-bordered" border="1" cellpadding="10" cellspacing="0" align="center">
            <tr>
                <th>Kode Invoice</th>
                <th>Nama Member</th>
                <th style="width:400px;">Nama Product</th>
                <th>
                    <select id="myList" name="filter" class="input" style="width:150px; font-size: 16px;">
                        <option value="">Default</option>
                        <option value="baru">Baru</option>
                        <option value="proses">Proses</option>
                        <option value="selesai">Selesai</option>
                        <option value="diambil">Diambil</option>
                    </select>
                </th>
            </tr>
            <?php
            $queryUser = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '" . $_SESSION['username'] . "'");
            $hasilUser = mysqli_fetch_array($queryUser);

            $query = "SELECT * FROM tb_transaksi WHERE id_outlet = '" . $hasilUser['id_outlet'] . "' ORDER BY id_member ASC";
            $sql_rm = mysqli_query($conn, $query) or die(mysqli_error($conn));
            while ($data = mysqli_fetch_array($sql_rm)) {
                $querymember = mysqli_query($conn, "SELECT * from tb_member WHERE id_member = '" . $data['id_member'] . "'");
                $hasilmember = mysqli_fetch_array($querymember);
                $queryoutlet = mysqli_query($conn, "SELECT * from tb_outlet WHERE id_outlet = '" . $data['id_outlet'] . "'");
                $hasiloutlet = mysqli_fetch_array($queryoutlet);
                if ($data['status'] == "baru") {
            ?>
                    <tr style="background-color: #f69990;">

                        <td>
                            Batas Waktu :
                            <?= substr($data['batas_waktu'], 0, -8) ?>
                            <br>
                            Jam :
                            <?= substr($data['batas_waktu'], -8, 5) ?>
                            <br>
                            nama outlet :
                            <?= $hasiloutlet['nama'] ?>
                            <br><br>
                            <b>
                                <?= $data['kode_invoice'] ?>
                            </b>
                        </td>
                        <td>
                            <?= $hasilmember['nama'] ?>
                        </td>
                        <td>
                            <?php
                            $idTransaksi = $data['id_transaksi'];
                            $queryDetail = mysqli_query($conn, "SELECT * FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket WHERE id_transaksi = '$idTransaksi'");
                            $totalHarga = 0;
                            $biaya_tambahan = $data['biaya_tambahan'];
                            while ($hasilDetail = mysqli_fetch_array($queryDetail)) {
                                $totalHarga += $hasilDetail['total_harga'];
                            ?>
                                <?= $hasilDetail['nama_paket'] ?>
                                <br>
                            <?php
                            }
                            $totalHarga += $biaya_tambahan;
                            if ($data['diskon'] > 0) {
                                $diskon = $totalHarga * $data['diskon'] / 100;
                                $totalHarga -= $diskon;
                            }
                            $pajak = $totalHarga * $data['pajak'];
                            $totalHarga += $pajak;
                            ?>
                            <br><br>
                            Total Harga : <b>
                                <?= rupiah($totalHarga) ?>
                            </b>
                            <br>
                        </td>

                        <td align="center">
                            <form id="status-form" action="./proses/transaksi/proses-edit-status-transaksi.php" method="post">
                                <input type="text" name="id_transaksi" value="<?= $data['id_transaksi'] ?>" hidden>
                                <input type="text" name="page" value="laporan" hidden>
                                <select id="status-select-<?= $data['id_transaksi'] ?>" name="status" class="input" style="width: 150px; font-size:16px;">
                                    <option value="baru" <?php if ($data['status'] == 'baru')
                                                                echo "selected='selected'"; ?>>
                                        Baru</option>
                                    <option value="proses" <?php if ($data['status'] == 'proses')
                                                                echo "selected='selected'"; ?>>Proses</option>
                                    <option value="selesai" <?php if ($data['status'] == 'selesai')
                                                                echo "selected='selected'"; ?>>Selesai</option>
                                    <option value="diambil" <?php if ($data['status'] == 'diambil')
                                                                echo "selected='selected'"; ?>>Diambil</option>
                                </select>
                            </form>
                            <br>
                            <?php
                            if ($data['dibayar'] == 'belum_dibayar') {
                            ?>
                                <a href="./dashboard.php?page=detail-transaksi&id_transaksi=<?= $data['id_transaksi'] ?>" class="btn btn-primary mb-3">Continue</a>
                            <?php
                            } else {
                            ?>
                                <a href="./dashboard.php?page=detail-transaksi&id_transaksi=<?= $data['id_transaksi'] ?>" class="btn btn-success mb-3">Lihat Detail</a>
                            <?php
                            }
                            ?>
                        </td>

                    </tr>
                <?php
                } else if ($data['status'] == "proses") {
                ?>
                    <tr style="background-color: #e4d385;">

                        <td>
                            Batas Waktu :
                            <?= substr($data['batas_waktu'], 0, -8) ?>
                            <br>
                            Jam :
                            <?= substr($data['batas_waktu'], -8, 5) ?>
                            <br>
                            nama outlet :
                            <?= $hasiloutlet['nama'] ?>
                            <br><br>
                            <b>
                                <?= $data['kode_invoice'] ?>
                            </b>
                        </td>
                        <td>
                            <?= $hasilmember['nama'] ?>
                        </td>
                        <td>
                            <?php
                            $idTransaksi = $data['id_transaksi'];
                            $queryDetail = mysqli_query($conn, "SELECT * FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket WHERE id_transaksi = '$idTransaksi'");
                            $totalHarga = 0;
                            $biaya_tambahan = $data['biaya_tambahan'];
                            while ($hasilDetail = mysqli_fetch_array($queryDetail)) {
                                $totalHarga += $hasilDetail['total_harga'];
                            ?>
                                <?= $hasilDetail['nama_paket'] ?>
                                <br>
                            <?php
                            }
                            $totalHarga += $biaya_tambahan;
                            if ($data['diskon'] > 0) {
                                $diskon = $totalHarga * $data['diskon'] / 100;
                                $totalHarga -= $diskon;
                            }
                            $pajak = $totalHarga * $data['pajak'];
                            $totalHarga += $pajak;
                            ?>
                            <br><br>
                            Total Harga : <b>
                                <?= rupiah($totalHarga) ?>
                            </b>
                            <br>
                        </td>

                        <td align="center">
                            <form id="status-form" action="./proses/transaksi/proses-edit-status-transaksi.php" method="post">
                                <input type="text" name="id_transaksi" value="<?= $data['id_transaksi'] ?>" hidden>
                                <input type="text" name="page" value="laporan" hidden>
                                <select id="status-select-<?= $data['id_transaksi'] ?>" name="status" class="input" style="width: 150px; font-size:16px;">
                                    <option value="baru" <?php if ($data['status'] == 'baru')
                                                                echo "selected='selected'"; ?>>
                                        Baru</option>
                                    <option value="proses" <?php if ($data['status'] == 'proses')
                                                                echo "selected='selected'"; ?>>Proses</option>
                                    <option value="selesai" <?php if ($data['status'] == 'selesai')
                                                                echo "selected='selected'"; ?>>Selesai</option>
                                    <option value="diambil" <?php if ($data['status'] == 'diambil')
                                                                echo "selected='selected'"; ?>>Diambil</option>
                                </select>
                            </form>
                            <br>
                            <?php
                            if ($data['dibayar'] == 'belum_dibayar') {
                            ?>
                                <a href="./dashboard.php?page=detail-transaksi&id_transaksi=<?= $data['id_transaksi'] ?>" class="btn btn-primary mb-3">Continue</a>
                            <?php
                            } else {
                            ?>
                                <a href="./dashboard.php?page=detail-transaksi&id_transaksi=<?= $data['id_transaksi'] ?>" class="btn btn-success mb-3">Lihat Detail</a>
                            <?php
                            }
                            ?>
                        </td>


                    </tr>
                <?php
                } else if ($data['status'] == "selesai") {
                ?>
                    <tr style="background-color: #90ee90;">

                        <td>
                            Batas Waktu :
                            <?= substr($data['batas_waktu'], 0, -8) ?>
                            <br>
                            Jam :
                            <?= substr($data['batas_waktu'], -8, 5) ?>
                            <br>
                            nama outlet :
                            <?= $hasiloutlet['nama'] ?>
                            <br><br>
                            <b>
                                <?= $data['kode_invoice'] ?>
                            </b>
                        </td>
                        <td>
                            <?= $hasilmember['nama'] ?>
                        </td>
                        <td>
                            <?php
                            $idTransaksi = $data['id_transaksi'];
                            $queryDetail = mysqli_query($conn, "SELECT * FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket WHERE id_transaksi = '$idTransaksi'");
                            $totalHarga = 0;
                            $biaya_tambahan = $data['biaya_tambahan'];
                            while ($hasilDetail = mysqli_fetch_array($queryDetail)) {
                                $totalHarga += $hasilDetail['total_harga'];
                            ?>
                                <?= $hasilDetail['nama_paket'] ?>
                                <br>
                            <?php
                            }
                            $totalHarga += $biaya_tambahan;
                            if ($data['diskon'] > 0) {
                                $diskon = $totalHarga * $data['diskon'] / 100;
                                $totalHarga -= $diskon;
                            }
                            $pajak = $totalHarga * $data['pajak'];
                            $totalHarga += $pajak;
                            ?>
                            <br><br>
                            Total Harga : <b>
                                <?= rupiah($totalHarga) ?>
                            </b>
                            <br>
                        </td>

                        <td align="center">
                            <form id="status-form" action="./proses/transaksi/proses-edit-status-transaksi.php" method="post">
                                <input type="text" name="id_transaksi" value="<?= $data['id_transaksi'] ?>" hidden>
                                <input type="text" name="page" value="laporan" hidden>
                                <select id="status-select-<?= $data['id_transaksi'] ?>" name="status" class="input" style="width: 150px; font-size:16px;">
                                    <option value="baru" <?php if ($data['status'] == 'baru')
                                                                echo "selected='selected'"; ?>>
                                        Baru</option>
                                    <option value="proses" <?php if ($data['status'] == 'proses')
                                                                echo "selected='selected'"; ?>>Proses</option>
                                    <option value="selesai" <?php if ($data['status'] == 'selesai')
                                                                echo "selected='selected'"; ?>>Selesai</option>
                                    <option value="diambil" <?php if ($data['status'] == 'diambil')
                                                                echo "selected='selected'"; ?>>Diambil</option>
                                </select>
                            </form>
                            <br>
                            <?php
                            if ($data['dibayar'] == 'belum_dibayar') {
                            ?>
                                <a href="./dashboard.php?page=detail-transaksi&id_transaksi=<?= $data['id_transaksi'] ?>" class="btn btn-primary mb-3">Continue</a>
                            <?php
                            } else {
                            ?>
                                <a href="./dashboard.php?page=detail-transaksi&id_transaksi=<?= $data['id_transaksi'] ?>" class="btn btn-success mb-3">Lihat Detail</a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                } else if ($data['status'] == "diambil") {
                ?>
                    <tr style="background-color: #00bfff;">

                        <td>
                            Batas Waktu :
                            <?= substr($data['batas_waktu'], 0, -8) ?>
                            <br>
                            Jam :
                            <?= substr($data['batas_waktu'], -8, 5) ?>
                            <br>
                            nama outlet :
                            <?= $hasiloutlet['nama'] ?>
                            <br><br>
                            <b>
                                <?= $data['kode_invoice'] ?>
                            </b>
                        </td>
                        <td>
                            <?= $hasilmember['nama'] ?>
                        </td>
                        <td>
                            <?php
                            $idTransaksi = $data['id_transaksi'];
                            $queryDetail = mysqli_query($conn, "SELECT * FROM tb_detail_transaksi INNER JOIN tb_paket ON tb_detail_transaksi.id_paket=tb_paket.id_paket WHERE id_transaksi = '$idTransaksi'");
                            $totalHarga = 0;
                            $biaya_tambahan = $data['biaya_tambahan'];
                            while ($hasilDetail = mysqli_fetch_array($queryDetail)) {
                                $totalHarga += $hasilDetail['total_harga'];
                            ?>
                                <?= $hasilDetail['nama_paket'] ?>
                                <br>
                            <?php
                            }
                            $totalHarga += $biaya_tambahan;
                            if ($data['diskon'] > 0) {
                                $diskon = $totalHarga * $data['diskon'] / 100;
                                $totalHarga -= $diskon;
                            }
                            $pajak = $totalHarga * $data['pajak'];
                            $totalHarga += $pajak;
                            ?>
                            <br><br>
                            Total Harga : <b>
                                <?= rupiah($totalHarga) ?>
                            </b>
                            <br>
                        </td>


                        <td align="center">
                            <form id="status-form" action="./proses/transaksi/proses-edit-status-transaksi.php" method="post">
                                <input type="text" name="id_transaksi" value="<?= $data['id_transaksi'] ?>" hidden>
                                <input type="text" name="page" value="laporan" hidden>
                                <select id="status-select-<?= $data['id_transaksi'] ?>" name="status" class="input" style="width: 150px; font-size:16px;">
                                    <option value="baru" <?php if ($data['status'] == 'baru')
                                                                echo "selected='selected'"; ?>>
                                        Baru</option>
                                    <option value="proses" <?php if ($data['status'] == 'proses')
                                                                echo "selected='selected'"; ?>>Proses</option>
                                    <option value="selesai" <?php if ($data['status'] == 'selesai')
                                                                echo "selected='selected'"; ?>>Selesai</option>
                                    <option value="diambil" <?php if ($data['status'] == 'diambil')
                                                                echo "selected='selected'"; ?>>Diambil</option>
                                </select>
                            </form>
                            <br>
                            <?php
                            if ($data['dibayar'] == 'belum_dibayar') {
                            ?>
                                <a href="./dashboard.php?page=detail-transaksi&id_transaksi=<?= $data['id_transaksi'] ?>" class="btn btn-primary mb-3">Continue</a>
                            <?php
                            } else {
                            ?>
                                <a href="./dashboard.php?page=detail-transaksi&id_transaksi=<?= $data['id_transaksi'] ?>" class="btn btn-success mb-3">Lihat Detail</a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
    </div>
</section>
<script>
    function myFunction() {
        var filter, table, tr, td, i, status;
        filter = document.getElementById("myList").value;
        table = document.getElementById("myTable");
        tr = table.getElementsByTagName("tr");

        for (let i = 0; i < tr.length; i++) {
            let tds = tr[i].getElementsByTagName("td");
            let selectElement = null;
            for (let j = 0; j < tds.length; j++) {
                let select = tds[j].getElementsByTagName("select")[0];
                if (select && select.id.startsWith("status-select-")) {
                    selectElement = select;
                    break;
                }
            }
            if (selectElement) {
                status = selectElement.value;
                if (filter === "" || status === filter) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    document.querySelectorAll('select[id^="status-select-"]').forEach(function(select) {
        select.addEventListener('change', function() {
            var form = this.closest('tr').querySelector('form');
            form.submit();
        });
    });

    document.getElementById("myList").addEventListener("change", myFunction);
</script>