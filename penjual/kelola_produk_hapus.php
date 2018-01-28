<?php
require_once('../system/engine.php');


$no_produk = mysqli_real_escape_string($con, $_GET['no_produk']);
$sql = "DELETE FROM produk WHERE no_produk='" . $no_produk . "'";
if(mysqli_query($con, $sql)) {
  set_flashdata('sukses', 'Berhasil menghapus produk.');
  redirect(base_url('penjual/kelola_produk.php'));
} else {
  set_flashdata('error', 'Gagal menghapus produk.');
  redirect(base_url('penjual/kelola_produk.php'));
}