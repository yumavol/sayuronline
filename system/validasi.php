<?php
require_once('engine.php');

function validasi_email($email) {
    global $con;
    $cek = mysqli_query($con, "SELECT * FROM user WHERE email='" . mysqli_real_escape_string($con, $email) . "'");
    return mysqli_num_rows($cek) > 0 ? false : true;
}

function validasi_username($username) {
    global $con;
    $cek = mysqli_query($con, "SELECT * FROM user WHERE username='" . mysqli_real_escape_string($con, $username) . "'");
    return mysqli_num_rows($cek) > 0 ? false : true;
}

function validasi_nama($nama) {
    return (!preg_match('/^[a-zA-Z\s]+$/', $nama)) ? false : true;
}

function validasi_no_hp($no_hp) {
    return (!preg_match('/^\+?\d+$/', $no_hp)) ? false : true;
}
?>
