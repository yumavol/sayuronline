  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header"></li>
        <!-- Optionally, you can add icons to the links --> 

      <li <?php echo (defined("menu_dashboard")) ? 'class="active"' : '' ; ?>>
        <a href="<?php echo base_url('users/admin') ?>"><i class="fa fa-th"></i> <span>Dasboard</span></a>
      </li> 
      <li <?php echo (defined("menu_kelola_user")) ? 'class="active"' : '' ; ?>>
        <a href="<?php echo base_url('users/admin/kelola_user') ?>"><i class="fa fa-users"></i> <span>Kelola User</span></a>
      </li> 
      <li <?php echo (defined("menu_kelola_pegawai")) ? 'class="active"' : '' ; ?>>
        <a href="<?php echo base_url('users/admin/kelola_pegawai') ?>"><i class="fa fa-user-secret"></i> <span>Kelola Pegawai</span></a>
      </li> 

      <li <?php echo (defined("menu_kelola_produk")) ? 'class="active"' : '' ; ?>>
        <a href="<?php echo base_url('users/admin/kelola_produk') ?>"><i class="fa fa-archive"></i> <span>Kelola Produk</span></a>
      </li> 
      
      <li <?php echo (defined("menu_kelola_produk_kategori")) ? 'class="active"' : '' ; ?>>
        <a href="<?php echo base_url('users/admin/kelola_produk/kategori.php') ?>"><i class="fa fa-bars"></i> <span>Kelola Kategori Produk </span></a>
      </li> 


      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>
