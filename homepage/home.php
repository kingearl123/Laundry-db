<section class="main">
        <div class="container">
                <h2 class="title">Dashboard</h2>
                <div class="grid">
                        <?php
                        if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'kasir' || $_SESSION['role'] == 'owner') {
                        ?>
                                <!-- Card 1 -->
                                <div class="card">
                                        <div class="card-content">
                                                <?php
                                                $acsql = "SELECT * from tb_transaksi";
                                                if ($sho = mysqli_query($conn, $acsql)) {
                                                        $jumla = mysqli_num_rows($sho);
                                                ?>
                                                        <dl>
                                                                <dt class="description">Total Data Transaksi</dt>
                                                                <dd class="value"><?php printf(" %d\n", $jumla) ?></dd>
                                                        </dl>
                                                <?php } ?>

                                        </div>
                                </div>
                        <?php } ?>

                        <?php
                        if ($_SESSION['role'] == 'admin') {
                        ?>
                                <div class="card">
                                        <div class="card-content">
                                                <?php
                                                $acsql1 = "SELECT * from tb_paket";
                                                if ($sho = mysqli_query($conn, $acsql1)) {
                                                        $jumla = mysqli_num_rows($sho);
                                                ?>
                                                        <dl>
                                                                <dt class="description">Total Paket</dt>
                                                                <dd class="value"><?php printf(" %d\n", $jumla) ?></dd>
                                                        </dl>
                                                <?php } ?>
                                        </div>
                                </div>
                        <?php } ?>

                        <?php
                        if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'kasir') {

                        ?>
                                <div class="card">
                                        <div class="card-content">
                                                <?php
                                                $acsql2 = "SELECT * from tb_member";
                                                if ($sho = mysqli_query($conn, $acsql2)) {
                                                        $jumla = mysqli_num_rows($sho);
                                                ?>
                                                        <dl>
                                                                <dt class="description">Total Member</dt>
                                                                <dd class="value"><?php printf(" %d\n", $jumla) ?></dd>
                                                        </dl>
                                                <?php } ?>
                                        </div>
                                </div>

                        <?php } ?>

                        <!-- Card 4 -->
                        <div class="card">
                                <div class="card-content">
                                        <?php
                                        // Query SQL untuk menghitung jumlah transaksi
                                        $sql = "SELECT SUM(total_harga) AS total_transaksi FROM tb_detail_transaksi";

                                        // Eksekusi query
                                        $result = mysqli_query($conn, $sql);

                                        // Periksa apakah query berhasil dieksekusi
                                        if ($result) {
                                                // Ambil nilai jumlah transaksi dari hasil query
                                                $row = mysqli_fetch_assoc($result);
                                                $total_transaksi = $row['total_transaksi'];
                                        } else {
                                                // Jika query gagal dieksekusi, atur total transaksi menjadi 0
                                                $total_transaksi = 0;
                                        }

                                        ?>
                                        <dl>
                                                <dt class="description">Jumlah Transaksi</dt>
                                                <dd class="value">Rp. <?= number_format($total_transaksi, 0, ',', '.'); ?></dd>
                                        </dl>

                                </div>
                        </div>




                </div>
        </div>

</section>