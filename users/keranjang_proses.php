<?php
require_once('../system/engine.php');
require_once('../system/keranjang.php');

function no_transaksi() {
    $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    return substr(str_shuffle($karakter), 0, 10);
}

$id_alamat = 1;
$id_user = 1;

$total = 0;
$jumlah_kuantiti = 0;

$detail_transaksi = array();
foreach(daftar_keranjang() as $keranjang) {
    $produk = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM produk WHERE no_produk='" . $keranjang['id'] . "'"));

    $subtotal = $produk['harga'] * $keranjang['qty'];

    $detail_transaksi[] = array(
        'no_produk' => $produk['no_produk'],
        'harga' => $produk['harga'],
        'jumlah' => $keranjang['qty'],
        'subtotal' => $subtotal
    );

    $jumlah_kuantiti += $keranjang['qty'];
    $total += $subtotal;
}

// insert transaksi
$no_transaksi = no_transaksi();
$data_transaksi = array(
    'no_transaksi' => $no_transaksi,
    'id_alamat' => $id_alamat,
    'id_user' => $id_user,
    'tanggal' => date('Y-m-d'),
    'jumlah_kuantiti' => $jumlah_kuantiti,
    'total_harga' => $total,
    'status' => 'Menunggu Bukti Transfer'
);

insert_db($data_transaksi, 'transaksi');

foreach($detail_transaksi as $dt_transaksi) {
    $dt_transaksi['no_transaksi'] = $no_transaksi;
    insert_db($dt_transaksi, 'detail_transaksi');
}

bersihkan_keranjang();