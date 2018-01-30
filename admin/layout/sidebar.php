 
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <li class="header">MENU ADMIN</li>

        <!-- <li <?php echo (defined('menu_dashboard')) ? 'class="active"' : '';?>><a href="<?php echo base_url('admin') ?>"><i class="fa fa-th"></i> <span>Dashboard</span></a></li> -->

        <li <?php echo (defined('menu_kelola_user')) ? 'class="active"' : '';?>><a href="<?php echo base_url('admin/kelola_user.php') ?>"><i class="fa fa-users"></i> <span>Kelola user</span></a></li>

        <li><a href="<?php echo base_url('users/logout.php') ?>"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
 





      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside> 