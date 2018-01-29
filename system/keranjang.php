<?php
require_once('engine.php');

function tambah_keranjang($produk_id, $qty=1) {
    if(isset($_SESSION['keranjang']['produk_' . $produk_id])) {
        $_SESSION['keranjang']['produk_' . $produk_id]['qty'] += $qty;
    } else {
        $_SESSION['keranjang']['produk_' . $produk_id] = array('id' => $produk_id,'qty' => $qty);
    }
}

function update_keranjang($produk_id, $qty) {
    $_SESSION['keranjang']['produk_' . $produk_id]['qty'] = $qty;
}

function hapus_keranjang($produk_id) {
    if(isset($_SESSION['keranjang']['produk_' . $produk_id])) {
        unset($_SESSION['keranjang']['produk_' . $produk_id]);
    }
}

function daftar_keranjang() {
    return $_SESSION['keranjang'];
}