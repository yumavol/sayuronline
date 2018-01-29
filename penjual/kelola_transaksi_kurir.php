<?php
require_once('../system/engine.php');


$no_transaksi = mysqli_real_escape_string($con, $_POST['no_transaksi']);
$id_petugas = mysqli_real_escape_string($con, $_POST['id_petugas']);

$sql = "UPDATE transaksi SET id_petugas='" . $id_petugas . "' WHERE no_transaksi='" . $no_transaksi . "'";
if(mysqli_query($con, $sql)) {
  set_flashdata('sukses', 'Berhasil mengisi kurir.');
  redirect(base_url('penjual/kelola_transaksi.php'));
} else {
  set_flashdata('error', 'Gagal mengisi kurir.');
  redirect(base_url('penjual/kelola_transaksi.php'));
}