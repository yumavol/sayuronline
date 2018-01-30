<?php
require_once('../system/engine.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
} else if(get_session('tipe_user') != 'admin') {
    set_flashdata('error', 'Anda tidak mempunyai hak untuk membuka halaman tersebut.');
    redirect(base_url());
}

redirect(base_url('admin/kelola_user.php'));

define("menu_dashboard", true);
define("SITE_TITLE", 'Selamat Datang');

require_once('layout/header.php');
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php  require_once('layout/footer.php'); ?>
