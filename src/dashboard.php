<?php


    include_once 'template/header.php';
    include_once 'template/navbar.php';
    include_once 'template/sidebar.php';

    switch ($_GET['page']) {
        case 'homepage':
            include './homepage/home.php';
        break;

        case 'outlet':
            include './outlet/show-outlet.php';
        break;

        case 'member':
            include './member/show-member.php';
        break;

        case 'paket':
            include './paket/show-paket.php';
        break;
        
        case 'transaksi':
            include './transaksi/show-transaksi.php';
        break;
        case 'laporan':
            include './laporan/show-laporan.php';
        break;
        case 'user':
            include './user/show-user.php';
        break;
            //  TRANSAKSI
    case 'show-transaksi':
        include_once '../transaksi/show-transaksi.php';
        break;
    case 'edit-transaksi':
        include_once '../transaksi/edit-transaksi.php';
        break;
    case 'detail-transaksi':
        include_once './transaksi/detail-transaksi.php';
        break;

        
    }

    include_once 'template/footer.php';
?>