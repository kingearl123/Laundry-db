<section class="main">
    <div class="container">
        <h2 class="title">Dashboard</h2>
        <div class="grid">

            <div class="card">
                <?php
                if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'kasir' || $_SESSION['role'] == 'owner') {
                ?>
                    <div class="card-content">
                        <?php
                        $outlet_id = $_SESSION['idOutlet'];

                        $acsql = "SELECT * FROM tb_transaksi WHERE id_outlet = $outlet_id";

                        if ($sho = mysqli_query($conn, $acsql)) {
                            $jumla = mysqli_num_rows($sho);
                        ?>
                            <dl>
                                <dt class="description">Total Data Transaksi</dt>
                                <a href="./dashboard.php?page=laporan" style="text-decoration: none;">
                                    <dd class="value">
                                        <?php printf(" %d\n", $jumla) ?>
                                    </dd>
                                </a>
                            </dl>
                        <?php } ?>

                    </div>
                <?php } ?>
            </div>


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
                                <a href="./dashboard.php?page=paket" style="text-decoration: none;">
                                    <dd class="value">
                                        <?php printf(" %d\n", $jumla) ?>
                                    </dd>
                                </a>
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
                                <a href="./dashboard.php?page=member" style="text-decoration: none;">

                                    <dd class="value">
                                        <?php printf(" %d\n", $jumla) ?>
                                    </dd>
                                </a>
                            </dl>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>


            <!-- Card 4 -->
            <?php
            if ($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'kasir' || $_SESSION['role'] == 'owner') {
            ?>
                <div class="card">
                    <div class="card-content">
                        <?php
                        $outlet_id = $_SESSION['idOutlet'];

                        $sql_total_transactions_by_outlet = "SELECT SUM(dt.total_harga) AS total_transaksi
                                                FROM tb_transaksi t
                                                LEFT JOIN tb_detail_transaksi dt ON t.id_transaksi = dt.id_transaksi
                                                WHERE t.id_outlet = $outlet_id";

                        $result_total_transactions_by_outlet = mysqli_query($conn, $sql_total_transactions_by_outlet);

                        if ($result_total_transactions_by_outlet) {
                            $row_total_transactions_by_outlet = mysqli_fetch_assoc($result_total_transactions_by_outlet);
                            $total_transaksi = $row_total_transactions_by_outlet['total_transaksi'];

                        ?>
                            <dl>
                                <dt class="description">Total Transaksi</dt>
                                <a href="./dashboard.php?page=laporan" style="text-decoration: none;">
                                    <dd class="value">Rp.
                                        <?php echo number_format($total_transaksi, 0, ',', '.'); ?>
                                    </dd>
                                </a>
                            </dl>
                        <?php
                        } else {
                            echo "Error: " . mysqli_error($conn);
                        }
                        ?>
                    </div>
                </div>


            <?php } ?>
        </div>
    </div>

</section>