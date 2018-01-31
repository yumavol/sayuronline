<?php
require_once('../system/engine.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
} else if(get_session('tipe_user') != 'admin') {
    set_flashdata('error', 'Anda tidak mempunyai hak untuk membuka halaman tersebut.');
    redirect(base_url());
}


$id_user = mysqli_real_escape_string($con, $_GET['id_user']);
$sql = "DELETE FROM user WHERE id_user='" . $id_user . "'";
if(mysqli_query($con, $sql)) {
  set_flashdata('sukses', 'Berhasil menghapus user.');
  redirect(base_url('admin/kelola_user.php'));
} else {
  set_flashdata('error', 'Gagal menghapus user.');
  redirect(base_url('admin/kelola_user.php'));
}