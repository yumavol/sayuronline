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
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
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
<?php if(isset($js)) {foreach($js as $j) { ?>
  <script src="<?php echo base_url($j);?>" type="text/javascript"></script>
<?php }} ?>

<style type="text/css">
@-webkit-keyframes topToMid {
    from {
      transform: translateX(50px);
      opacity: 0;
    }
    to {
      transform: translateX(0px);
      opacity: 1;
    }
}

/* Standard syntax */
@keyframes topToMid {
    from {
      transform: translateX(50px);
      opacity: 0;
    }
    to {
      transform: translateX(0px);
      opacity: 1;
    }
}

.notifyjs-corner {
    top: 50px !important;
}
.notifyjs-bootstrap-base {
    animation: topToMid 1.5s;
    text-shadow: none !important;
}
.notifyjs-bootstrap-info {
    color: #fff !important;
    background-color: #2EB2F5 !important;
    border-color: #0EA1BF !important;
}
.notifyjs-bootstrap-warn {
    color: #FFF !important;
    background-color: #EFD028 !important;
    border-color: #F3BB4F !important; 
}
.notifyjs-bootstrap-error {
    color: #FFF !important;
    background-color: #EA5D4C !important;
    border-color: #CF4520 !important; 
}
.notifyjs-bootstrap-success {
    color: #FFF !important;
    background-color: #2BD852 !important;
    border-color: #38AA0E !important; 
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

<body class="hold-transition skin-custom sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="<?php echo base_url(); ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SYR</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Sayur</b>Online</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    </nav>
  </header>
  <?php require_once('sidebar.php'); ?>

