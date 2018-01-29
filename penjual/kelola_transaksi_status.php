<?php
require_once('../system/engine.php');


$no_transaksi = mysqli_real_escape_string($con, $_POST['no_transaksi']);
$status = mysqli_real_escape_string($con, $_POST['status']);

$sql = "UPDATE transaksi SET status='" . $status . "' WHERE no_transaksi='" . $no_transaksi . "'";
if(mysqli_query($con, $sql)) {
  set_flashdata('sukses', 'Berhasil mengubah status transaksi.');
  redirect(base_url('penjual/kelola_transaksi.php'));
} else {
  set_flashdata('error', 'Gagal mengubah status transaksi.');
  redirect(base_url('penjual/kelola_transaksi.php'));
}