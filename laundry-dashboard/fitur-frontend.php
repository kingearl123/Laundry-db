<?php

include './config/config.php';
// session_start();
// if (@$_SESSION['username'] == null) {
//     echo "<script>
//         alert('Login Terlebih dahulu');
//         window.location.href='./login/login.php';
//         </script>";
// }


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <title>Laundry Project</title>
    <link rel="stylesheet" href="./assets/css/dashboard.css" />
    <style>
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        /* Style untuk modal */
        .modal {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            z-index: 1000;
            max-width: 500px;
            width: 80%;
        }

        /* Style untuk tombol modal */
        .modal-button {
            cursor: pointer;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            transition-duration: 0.4s;
        }

        .modal-button:hover {
            background-color: #0056b3;
            color: white;
        }

        /* Style untuk tombol close modal */
        .close-modal {
            cursor: pointer;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-modal:hover,
        .close-modal:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        /* Style untuk modal aktif */
        .modal.active,
        .overlay.active {
            display: block;
        }

        .component {
        width: 100%;
        border-collapse: collapse;
        overflow-x: auto;
    }

    .component th, .component td {
        border: 1px solid black;
        padding: 10px;
        text-align: left;
    }

   
    </style>

</head>

<body>

    <nav class="navbar">
        <div class="logo_item">
            <i class="bx bx-menu" id="sidebarOpen"></i> NB Laundry
        </div>

        <div class="navbar_content">

        </div>
    </nav>
    <!-- sidebar -->
    <nav class="sidebar">
        <div class="menu_content">
            <ul class="menu_items">
                <div class="menu_title menu_dahsboard"></div>
                <li class="item">
                    <div href="#" class="nav_link submenu_item">
                        <span class="navlink_icon">
                            <i class='bx bx-table'></i> </span>
                        <span class="navlink">Data</span>
                        <i class="bx bx-chevron-right arrow-left"></i>
                    </div>

                    <ul class="menu_items submenu">


                        <a href="./dashboard.php?page=outlet" class="nav_link sublink">Outlet</a>
                        <a href="./dashboard.php?page=paket" class="nav_link sublink">Paket</a>

                        <a href="./dashboard.php?page=member" class="nav_link sublink">Member</a>
                    </ul>
                </li>
                <!-- end -->

            </ul>

            <ul class="menu_items">
                <!-- duplicate these li tag if you want to add or remove navlink only -->
                <!-- Start -->
                <li class="item">
                    <a href="./dashboard.php?page=transaksi" class="nav_link">
                        <span class="navlink_icon">
                            <i class='bx bx-wallet-alt'></i> </span>
                        <span class="navlink">Transaksi</span>
                    </a>
                </li>


                <li class="item">
                    <a href="./dashboard.php?page=laporan" class="nav_link">
                        <span class="navlink_icon">
                            <i class='bx bxs-dock-left'></i> </span>
                        <span class="navlink">Laporan Transaksi</span>
                    </a>
                </li>
                <!-- End -->
            </ul>

            <!-- Sidebar Open / Close -->
            <div class="bottom_content">
                <div class="bottom">
                    <a href="./logout/logout.php">Logout</a>
                    <i class='bx bx-log-out'></i>
                </div>
            </div>
        </div>
    </nav>

    <section class="main">

        <h2>Data Outlet</h2>
        <button type="button" class="custom-btn btn-1" onclick="openModal('modaltambah')">
            Tambah
        </button>

        <div id="modaltambah" class="modal">
            <!-- ... (konten modal) ... -->
            <span class="close" onclick="closeModal('<?php echo $modal_id ?>')">&times;</span>


            <form action="">
                <input type="text" name="" id=""><input type="text" name="" id=""><input type="text" name="" id="">
            </form>
        </div>

        <div class="myclass">
        <table class="component">
        <thead>
            <tr>
                <th>Id outlet</th>
                <th>nama</th>
                <th>alamat</th>
                <th>tlp</th>
                <th>aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- ... (item rows) ... -->
        </tbody>
                <?php
                $queryoutlet = "SELECT * FROM tb_outlet ORDER BY id_outlet ASC";
                $sql_rm = mysqli_query($conn, $queryoutlet) or die(mysqli_error($conn));
                while ($dataoutlet = mysqli_fetch_array($sql_rm)) {
                    $modal_id = "modalubah" . $dataoutlet['id_outlet'];
                ?>
                    <tr>
                        <td><?= $dataoutlet['id_outlet'] ?></td>
                        <td><?= $dataoutlet['nama'] ?></td>
                        <td><?= $dataoutlet['alamat'] ?></td>
                        <td><?= $dataoutlet['tlp'] ?></td>
                        <td>

                            <button type="button" class="custom-btn btn-2" onclick="openModal('<?php echo $modal_id ?>')">Edit</button>
                            <a href="./proses/outlet/proses-hapus-outlet.php?id_outlet=<?= $dataoutlet['id_outlet'] ?>" class="custom-btn btn-3">Hapus</a>
                        </td>
                    </tr>


                    <!-- modal edit -->
                    <div id="<?php echo $modal_id ?>" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal('<?php echo $modal_id ?>')">&times;</span>
                            <h2>Form Edit Outlet</h2>
                            <form action="editbarang.php" method="POST">
                                <input type="hidden" name="id_outlet" value="<?= $dataoutlet['id_outlet'] ?>">
                                <label for="nama">Nama:</label>
                                <input type="text" name="nama" id="nama" value="<?= $dataoutlet['nama'] ?>" required>
                                <!-- ... (field lainnya) ... -->
                                <button type="submit" name="simpan" id="simpan">Simpan</button>
                            </form>
                        </div>
                    </div>

                <?php

                }
                ?>
    </table>


    </section>

    <script src="./assets/js/dashboard.js"></script>
    <script>
        // function openModal(modalId) {
        //     document.getElementById(modalId).classList.add('active');
        //     document.getElementById('overlay-' + modalId).classList.add('active');
        // }

        // function closeModal(modalId) {
        //     document.getElementById(modalId).classList.remove('active');
        //     document.getElementById('overlay-' + modalId).classList.remove('active');
        // }

        // function closeModalById(modalId) {
        //     document.getElementById(modalId).classList.remove('active');
        //     document.getElementById('overlay-' + modalId).classList.remove('active');
        // }
        //     function openModal(outletId) {
        //     var modal = document.getElementById("modal");
        //     var modalContent = document.getElementById("modalContent");

        //     // Clear previous form data
        //     modalContent.innerHTML = "";

        //     // Fetch outlet details using AJAX
        //     var xhr = new XMLHttpRequest();
        //     xhr.onreadystatechange = function () {
        //         if (xhr.readyState == 4 && xhr.status == 200) {
        //             modalContent.innerHTML = xhr.responseText;

        //             // Display the modal
        //             modal.style.display = "block";
        //         }
        //     };

        //     // Send AJAX request to fetch outlet details
        //     xhr.open("GET", "./proses/outlet/proses-tampil-outlet.php?id_outlet=" + outletId, true);
        //     xhr.send();
        // }
        function openModal(modalId) {
            var modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'block';
            } else {
                console.error(`No modal found with id: ${modalId}`);
            }
        }

        function closeModal(modalId) {
            var modal = document.getElementById(modalId);
            if (modal) {
                modal.style.display = 'none';
            } else {
                console.error(`No modal found with id: ${modalId}`);
            }
        }

        // Event listener for closing modal
        var closeButtons = document.getElementsByClassName('close');
        for (var i = 0; i < closeButtons.length; i++) {
            closeButtons[i].addEventListener('click', function() {
                var modalId = this.closest('.modal').id;
                closeModal(modalId);
            });
        }
    </script>
</body>

</html>