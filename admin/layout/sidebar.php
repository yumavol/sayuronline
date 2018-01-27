 
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
<li class="header">MENU MEMMBER</li>

        <li <?php echo (defined('dashboard')) ? 'class="active"' : '';?>><a href="<?php echo base_url('admin/index.php') ?>"><i class="fa fa-th"></i> <span>Dashboard</span></a></li>

        <li <?php echo (defined('menu_kelola_user')) ? 'class="active"' : '';?>><a href="<?php echo base_url('admin/kelola_user.php') ?>"><i class="fa fa-user"></i> <span>Kelola user</span></a></li>

        <li <?php echo (defined('menu_kelola_kurir')) ? 'class="active"' : '';?>><a href="<?php echo base_url('admin/kelola_kurir.php') ?>"><i class="fa fa-user-plus"></i> <span>Kelola Kurir</span></a></li> 
 
 





      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside> 