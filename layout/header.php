<?php
ob_start();
if(!defined('on_pendaftaran')) {
  require_once('../system/keranjang.php');
} else {
  require_once('system/keranjang.php');
}
$value_cari = (isset($_GET['cari'])) ? $_GET['cari'] : '';

if(get_session('id_user')) {
  $data_user_login = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM user WHERE id_user='" . get_session('id_user') . "'"));
}
?>
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

  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/skin-custom.css">
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

  .pencarian .form-control:focus{
    border-color: #ccc !important;
  }
  .pencarian .input-group{
    width: 100%;
  }

  .category-group{ 
    padding: 0px;
    border: none;
    overflow: hidden;
  }
  .category-group .form-control{
    border-left: none; 
  }  

  .form-cari{
    border-right: none;
  }

  .btn-cari{
    width: 39px !important;
  }

  .navbar-brand{
    padding: 10px 15px;
  }

  .select-kategori{
    position: relative;
    width: 140px !important; 
    overflow: hidden;
  }
  .select-kategori select{
    width: 120% !important;
    padding-right: 40px;  
    background-image: url(<?php echo base_url(); ?>/assets/images/dropdown.png);
    background-repeat: no-repeat;
    background-size: auto 8px;
    background-position: -webkit-calc(100% - 44px) 13px;
    background-position: calc(100% - 44px) 13px;
    cursor: pointer;
  }

  .pencarian .btn-default:hover, .pencarian .btn-default:active{
    border-color:#bbb;
    background: #bbb;
  }

  .select-kategori:before{
    content: " ";
    height: 25px;
    width: 2px; 
    border-left: 1px solid #bbb;
    display: block;
    z-index: 9;
    position: absolute;
    left: 0px;
    top: 5px;
  }

  div.dataTables_wrapper div.dataTables_processing i{
    position: relative;
    top: 50%; 
  }
</style>

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
          <a href="<?php echo base_url('') ?>" class="navbar-brand"><img src="<?php echo base_url('assets/images/Logo.png');?>" width="125"></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-search"></i>
          </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
          <form class="navbar-form navbar-left" role="search" action="<?php echo base_url('produk/index.php') ?>" method="get">
            <div class="form-group pencarian">
              <div class="input-group">
                <input class="form-control form-cari" name="cari" valu e="<?php echo $value_cari ?>" placeholder="Cari produk .." type="text" value="<?php echo (!empty($_GET['cari'])) ? htmlentities($_GET['cari']) : '';?>"> 
                <div class="category-group input-group-addon select-kategori">
                  <select class="form-control" name="no_kategori">
                    <option value="">Semua Kategori</option> 
                    <?php
                    $query_kategori = mysqli_query($con, "SELECT * FROM kategori_produk ORDER BY nama ASC");
                    while($row = mysqli_fetch_array($query_kategori)) {
                    ?>
                    <option value="<?php echo $row['no_kategori'];?>" <?php echo (!empty($_GET['no_kategori']) && ($_GET['no_kategori'] == $row['no_kategori'])) ? 'selected' : '';?>><?php echo $row['nama'];?></option> 
                    <?php
                    }
                    ?>
                  </select>
                </div>
                <div class="category-group input-group-addon btn-cari">
                  <button type="submit" class="btn btn-default btn-flat"><i class="fa fa-search"></i></button>
                </div>
              </div>
            </div>
          </form>
        
        </div>
        <!-- /.navbar-collapse -->
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- Tasks Menu -->
            <li class="dropdown tasks-menu <?php echo (defined('menu_keranjang')) ? 'active' : '' ; ?>">
              <!-- Menu Toggle Button -->
              <a href="<?php echo base_url('users/keranjang.php'); ?>" >
                <i class="glyphicon glyphicon-shopping-cart"></i>
                <?php echo (isi_keranjang() > 0) ? '<label class="label label-danger">' . isi_keranjang() . '</label>' : '';?>
              </a>
            </li>

          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>