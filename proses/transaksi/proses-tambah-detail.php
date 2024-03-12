<?php
    include "../../config/config.php";

    extract($_POST);

    if($biaya > 0){
        $queryBiaya = "SELECT biaya_tambahan FROM tb_transaksi WHERE id_transaksi = '$id_transaksi'";
        $hasilBiaya = mysqli_query($conn, $queryBiaya);
        $dataBiaya = mysqli_fetch_array($hasilBiaya);
        
        $lastBiaya = $dataBiaya['biaya_tambahan'];

        // Jika ada data di database maka update jumlah biaya
        
        $biaya += $lastBiaya;
        $updateBiaya = "UPDATE tb_transaksi SET biaya_tambahan = '$biaya' WHERE id_transaksi = '$id_transaksi'";
        $hasilUpdate = mysqli_query($conn, $updateBiaya);
    }

$queryPaket = "SELECT * FROM tb_paket WHERE id_paket = '$id_paket'";
$hasilPaket = mysqli_query($conn, $queryPaket);
$rowPaket = mysqli_fetch_array($hasilPaket);

$harga = $rowPaket['harga'];
$totalHarga = $qty * $harga;

$query = "INSERT INTO tb_detail_transaksi (id_transaksi,id_paket,qty,keterangan,harga_paket,total_harga) values ('$id_transaksi','$id_paket','$qty','$keterangan','$harga','$totalHarga')";
    $hasil = mysqli_query($conn, $query);

    if (!$hasil && !$hasilUpdate) {
    die("QUERY FAILED TO EXECUTE:" . mysqli_errno($conn) . "-" . mysqli_error($conn));
    }else{
    echo "<script>window.location='../../dashboard.php?page=detail-transaksi&id_transaksi=$id_transaksi';</script>";
    }
    
?>