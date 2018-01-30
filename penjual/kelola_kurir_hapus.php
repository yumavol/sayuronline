<?php
require_once('../system/engine.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
} else if(get_session('tipe_user') != 'penjual') {
    set_flashdata('error', 'Anda tidak mempunyai hak untuk membuka halaman tersebut.');
    redirect(base_url());
}

$id_petugas = mysqli_real_escape_string($con, $_GET['id_petugas']);
$sql = "DELETE FROM petugas_kurir WHERE id_petugas='".$id_petugas."'";
if(mysqli_query($con, $sql)) {
  set_flashdata('sukses', 'Berhasil menghapus petugas.');
  redirect(base_url('penjual/kelola_kurir.php'));
} else {
  set_flashdata('error', 'Gagal menghapus petugas.');
  redirect(base_url('penjual/kelola_kurir.php'));
}
