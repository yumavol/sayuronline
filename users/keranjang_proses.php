<?php
require_once('../system/engine.php');
require_once('../system/keranjang.php');

function no_transaksi() {
    $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    return substr(str_shuffle($karakter), 0, 10);
}

if(!get_session('login')) {
    redirect(base_url('login.php'));
}

$id_alamat = 0;
$id_user = get_session('id_user');


if(empty($_POST['id_alamat']) && empty($_POST['alamat_baru'])) {
    set_flashdata('error', 'Alamat belum diisi.');
    redirect(base_url('users/isi_alamat.php'));
}

if(empty(trim($_POST['id_alamat']))) {
    // insert alamat baru
    $alamat_baru = $_POST['alamat_baru'];
    $data_alamat = array(
        'id_user' => $id_user,
        'alamat' => $alamat_baru
    );
    //$id_alamat = insert_db($data_alamat, 'alamat');
    insert_db($data_alamat, 'alamat');
    $id_alamat = mysqli_fetch_array(mysqli_query($con, "SELECT LAST_INSERT_ID()"))[0];
} else {
    $id_alamat = $_POST['id_alamat'];
}

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

redirect(base_url('users/transaksi.php'));