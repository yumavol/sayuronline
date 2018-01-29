  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MENU PENJUAL</li>
        <!-- Optionally, you can add icons to the links --> 

      <li <?php echo (defined("menu_dashboard")) ? 'class="active"' : '' ; ?>>
        <a href="<?php echo base_url('penjual') ?>"><i class="fa fa-th"></i> <span>Dasboard</span></a>
      </li> 

      <li class="<?php echo (defined("menu_kelola_produk") || defined("menu_kelola_produk_kategori")) ? 'active' : '' ; ?> treeview">
        <a href="#">
          <i class="fa fa-cubes"></i> <span>Kelola Produk</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php echo (defined("menu_kelola_produk")) ? 'class="active"' : '' ; ?>><a href="<?php echo base_url('penjual/kelola_produk.php');?>"><i class="fa fa-circle-o"></i> Kelola Produk</a></li>
          <li <?php echo (defined("menu_kelola_produk_kategori")) ? 'class="active"' : '' ; ?>><a href="<?php echo base_url('penjual/kelola_produk_kategori.php');?>"><i class="fa fa-circle-o"></i> Kelola Kategori Produk</a></li>
        </ul>
      </li>

      <li <?php echo (defined("menu_kelola_transaksi")) ? 'class="active"' : '' ; ?>>
        <a href="<?php echo base_url('penjual/kelola_transaksi.php');?>"><i class="fa fa-credit-card"></i> <span>Kelola Transaksi</span></a>
      </li>

      <li <?php echo (defined("menu_kelola_kurir")) ? 'class="active"' : '' ; ?>>
        <a href="<?php echo base_url('penjual/kelola_kurir.php');?>"><i class="fa fa-truck"></i> <span>Kelola Petugas Kurir </span></a>
      </li>


      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
