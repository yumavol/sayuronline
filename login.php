<?php
require_once('system/engine.php');

$form_error = [];

if(!empty($_POST)) {
  trim_validate($_POST);

  $username = $_POST['username'];
  $password = $_POST['password'];

  // validasi
  if(is_error($username, 'required')) {
    $form_error[] = 'Username wajib diisi.';
  }
  if(is_error($password, 'required')) {
    $form_error[] = 'Password wajib diisi.';
  }

  if(is_error($username, 'min_length[5]|max_length[25]')) {
    $form_error[] = 'Nama minimal 5 karakter dan maksimal 25 karakter.';
  }
  if(is_error($password, 'min_length[6]')) {
    $form_error[] = 'Password minimal 6 karakter.';
  }

  if(empty($form_error)) {
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    // cek user
    $query = mysqli_query($con, "SELECT * FROM user WHERE username='" . $username . "'");

    if(mysqli_num_rows($query) > 0) {
      $data = mysqli_fetch_array($query);

      if(password_verify($password, $data['password'])) {
        $data_login = array(
          'id_user' => $data['id_user'],
          'tipe_user' => $data['tipe_user'],
          'login' => true
        );
        set_session($data_login);
        if($data['tipe_user'] == 'admin') {
          redirect(base_url('admin'));
        } else if($data['tipe_user'] == 'penjual') {
          redirect(base_url('penjual'));
        } else {
          redirect(base_url());
        }
      } else {
        $form_error[] = 'Username/Password salah.';
      }
    } else {
      $form_error[] = 'User tidak ditemukan.';
    }
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sayur Online Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/plugins/bootstrap/dist/css/bootstrap.min.css'); ?>">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/skin-custom.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/dist/css/AdminLTE.min.css'); ?>">
  <style type="text/css">
    .logo-login{
      position: relative;
      top: -0px;
      left: -3px;
      font-size: 22px;
    }
  </style>
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style type="text/css">
    .login-page, .register-page{
      background-color: #fff;
    }
  </style>

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url() ?>"><img src="<?php echo base_url('assets/images/Logo.png');?>" width="250"> <small class="logo-login">login</small></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Silahkan Login Untuk Melanjutkan</p>
    <?php
    // validasi
    if(!empty($form_error)) {
      echo alert_error(implode($form_error, '<br/>'));
    }
    if(has_flashdata('sukses')) {
      echo alert_sukses(get_flashdata('sukses'));
    }
    ?>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" name="username" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" name="password" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <br>
      <div class="form-group">
        <button type="submit" class="btn btn-green btn-block btn-flat">Sign In</button>
      </div>
        <!-- /.col -->
      <!-- <a href="<?php echo base_url() ?>" class="btn btn-default btn-xs btn-block btn-flat"><i class="fa fa-home"></i> kembali ke awal</a> -->
      </div>
    </form>



  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3.1.1 -->
<script src="<?php echo base_url('assets/plugins/jquery/dist/jquery.min.js'); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assets/plugins/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>



<script type="text/javascript">


</script>
</body>
</html>
