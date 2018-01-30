<?php
require_once('../system/engine.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
} else if(get_session('tipe_user') != 'penjual') {
    set_flashdata('error', 'Anda tidak mempunyai hak untuk membuka halaman tersebut.');
    redirect(base_url());
}

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