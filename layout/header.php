<?php ob_start(); ?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php  echo (defined("SITE_TITLE")) ? SITE_TITLE : 'untitled' ; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, admin-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">

  <link rel="stylesheet" href="<?php echo(base_url('assets/css/font.css')) ?>">

<?php if(isset($css)) {foreach($css as $c) { ?>
  <link rel="stylesheet" href="<?php echo base_url($c);?>">
<?php }} ?>

 
<style type="text/css">
  div.dataTables_wrapper div.dataTables_processing{
    border-color: transparent !important;
    box-shadow: none !important;
    position: absolute;
    top: 0px;
    left: 5px;
    width: 98%;
    margin-left: -100px;
    margin-top: -26px;
    text-align: center;
    padding: 0px;
    background: rgba(255,255,255,0.8);
    height: 100%;
    margin: 0px auto;
    margin-left: 1%; 
    margin-right: 1%;
  }


  div.dataTables_wrapper div.dataTables_processing i{
    position: relative;
    top: 50%;

  }
</style>
 
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/skin-custom.css">

  <script>
    var BASE_URL = '<?php echo base_url();?>';
  </script>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>

<body class="hold-transition skin-custom layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="<?php echo base_url('') ?>" class="navbar-brand"><b>Sayur</b>Online</a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-search"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <form class="navbar-form navbar-left" role="search">
            <div class="form-group">
              <input class="form-control" id="navbar-search-input" placeholder="Cari produk .." type="text">
            </div>
          </form>
        
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Tasks Menu -->
            <li class="dropdown tasks-menu">
              <!-- Menu Toggle Button -->
              <a href="<?php echo base_url('users/keranjang.php'); ?>" >
                <i class="glyphicon glyphicon-shopping-cart"></i>
                <span class="label label-danger">5</span>
              </a>
            </li>
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#"  class="dropdown-toggle" data-toggle="dropdown">
                <span class=""> 
                  <i class="fa fa-user"></i>
                  Yuma Yusuf
                </span>
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <span style="
                    font-size: 70px;
                    background: #fff;
                    width: 100px;
                    height: 100px;
                    display: inline-block;
                    border-radius: 50%;
                    -webkit-touch-callout: none;
                    -webkit-admin-select: none;
                    -khtml-admin-select: none;
                    -moz-admin-select: none;
                    -ms-admin-select: none;
                    admin-select: none;

                  ">Y</span>

                  <p>
                    Yuma Yusuf
                    <small>Selamat datang</small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                 <div class="pull-left">
                  <a href="<?php echo base_url('users/user/pengaturan.php'); ?>" class="btn btn-sm btn-default btn-flat"><i class="fa fa-gear"></i> Setings</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url('users/user/login/destroy.php'); ?>" class="btn btn-default btn-sm btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>