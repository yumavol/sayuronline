    <div class="col-md-3">
      <div style="min-height: 500px; padding-left: 10px;" class="box box-solid">
        <div class="box-body">
          <ul class="nav nav-pills nav-stacked">
            <?php
            if(get_session('tipe_user') == 'pembeli') {
            ?>
            <li role="presentation" <?php echo defined('menu_produk') ? 'class="active"' : '';?>><a href="<?php echo base_url('produk');?>"><i class="fa fa-archive"></i> Produk</a></li>
            <li role="presentation" <?php echo defined('menu_keranjang') ? 'class="active"' : '';?>><a href="<?php echo base_url('users/keranjang.php');?>"><i class="fa fa-shopping-cart"></i> Keranjang <?php echo (isi_keranjang() > 0) ? '<label class="label label-success">' . isi_keranjang() . '</label>' : '';?></a></li>
            <li role="presentation" <?php echo defined('menu_transaksi') ? 'class="active"' : '';?>><a href="<?php echo base_url('users/transaksi.php');?>"><i class="fa fa-list"></i> Transaksi</a></li>
            <li role="presentation" <?php echo defined('menu_pengaturan_akun') ? 'class="active"' : '';?>><a href="<?php echo base_url('users/pengaturan_akun.php');?>"><i class="fa fa-user"></i> Pengaturan akun</a></li>

            <li role="presentation"><a href="<?php echo base_url('users/logout.php');?>"><i class="fa fa-sign-out"></i> Logout</a></li>
            <?php
            } else if(get_session('tipe_user')) {
            ?>
            <li role="presentation"><a href="<?php echo base_url('users/logout.php');?>"><i class="fa fa-sign-out"></i> Logout</a></li>
            <?php
            } else {
            ?>
            <li role="presentation"><a href="<?php echo base_url('login.php');?>"><i class="fa fa-sign-in"></i> Login</a></li>
            <li role="presentation"><a href="<?php echo base_url('pendaftaran.php');?>"><i class="fa fa-users"></i> Daftar</a></li>
            <?php } ?>
          </ul>
        </div>
      </div><!-- /.box -->
    </div><!-- /.col -->
