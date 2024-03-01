<section class="main">

    <center>

        <h2>Data Transaksi</h2>
        <button type="button" class="custom-btn btn-1" onclick="openModal('modaltambah')">
            Tambah
        </button>
    </center>

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

</section>