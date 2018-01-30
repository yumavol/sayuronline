<?php
require_once('../system/engine.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
} else if(get_session('tipe_user') != 'penjual') {
    set_flashdata('error', 'Anda tidak mempunyai hak untuk membuka halaman tersebut.');
    redirect(base_url());
}

$no_kategori = mysqli_real_escape_string($con, $_GET['no_kategori']);
$sql = "DELETE FROM kategori_produk WHERE no_kategori='".$no_kategori."'";
if(mysqli_query($con, $sql)) {
  set_flashdata('sukses', 'Berhasil menghapus kategori.');
  redirect(base_url('penjual/kelola_produk_kategori.php'));
} else {
  set_flashdata('error', 'Gagal menghapus kateogri.');
  redirect(base_url('penjual/kelola_produk_kategori.php'));
}
