<section class="main">
        <div class="container">
                <h2 class="title">Dashboard</h2>
                <div class="grid">
                        <!-- Card 1 -->
                        <div class="card">
                                <div class="card-content">
                                        <?php
                                        $acsql = "SELECT * from tb_transaksi";
                                        if ($sho = mysqli_query($conn, $acsql)) {
                                                $jumla = mysqli_num_rows($sho);
                                        ?>
                                                <dl>
                                                        <dt class="description">Total Transaksi</dt>
                                                        <dd class="value"><?php printf(" %d\n", $jumla) ?></dd>
                                                </dl>
                                        <?php } ?>

                                </div>
                        </div>

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

                </div>
        </div>

</section>


</section>