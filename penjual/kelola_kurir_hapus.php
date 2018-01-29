<?php
require_once('../system/engine.php');


$id_petugas = mysqli_real_escape_string($con, $_GET['id_petugas']);
$sql = "DELETE FROM petugas_kurir WHERE id_petugas='".$id_petugas."'";
if(mysqli_query($con, $sql)) {
  set_flashdata('sukses', 'Berhasil menghapus petugas.');
  redirect(base_url('penjual/kelola_kurir.php'));
} else {
  set_flashdata('error', 'Gagal menghapus petugas.');
  redirect(base_url('penjual/kelola_kurir.php'));
}
