<?php
require_once('../system/engine.php');

unset($_SESSION['id_user']);
unset($_SESSION['tipe_user']);
unset($_SESSION['login']);
set_flashdata('sukses', 'Anda berhasil logout.');

header('Location: ../produk');