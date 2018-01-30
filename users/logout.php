<?php
session_start();

unset($_SESSION['id_user']);
unset($_SESSION['tipe_user']);
unset($_SESSION['login']);

header('Location: ../produk');