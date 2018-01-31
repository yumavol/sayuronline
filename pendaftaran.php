<?php
require_once('system/engine.php');
require_once('system/validasi.php');

define('on_pendaftaran', true);
define("SITE_TITLE", 'Pendaftaran ');

$form_error = array();
if (isset($_POST["submit"])) {
  trim_validate($_POST);
  $nama = $_POST["nama"];
  $no_hp = $_POST["no_hp"];
  $email = $_POST["email"]; 
  $username = $_POST["username"];
  $password = $_POST["password"]; 
  $konfirmasi_password = $_POST["password2"]; 

  if(is_error($nama, 'required|min_length[3]|max_length[50]')) {
    $form_error['nama'] = 'Nama minimal 3 karakter.';
  }
  if(is_error($no_hp, 'required')) {
    $form_error['no_hp'] = 'No. Telp wajib diisi.';
  }
  if(is_error($email, 'required|min_length[5]')) {
    $form_error['email'] = 'Email minimal 5 karakter.';
  }
  if(is_error($username, 'required|min_length[5]')) {
    $form_error['username'] = 'Username minimal 5 karakter.';
  }
  if(is_error($password, 'required|min_length[6]')) {
    $form_error['password'] = 'Password minimal 6 karakter.';
  }
  if(is_error($konfirmasi_password, 'required|min_length[6]')) {
    $form_error['password2'] = 'Konfirmasi Password minimal 6 karakter';
  }

  if(!is_error($nama, 'required|min_length[3]') && is_error($nama, 'callback_validasi_nama')) {
    $form_error['nama'] = 'Nama tidak valid.';
  }

  if (
    !is_error($password, 'required|min_length[6]') &&
    !is_error($konfirmasi_password, 'required|min_length[6]') &&
    ($konfirmasi_password != $password)
  ) {
    $form_error['konfirmasi_password'] = 'Konfirmasi Password tidak sama dengan password.';
  }

  if(!is_error($no_hp, 'required') && is_error($no_hp, 'callback_validasi_no_hp')) {
    $form_error['no_hp'] = 'No. Telp tidak valid.';
  }

  if(!is_error($email, 'required|min_length[5]') && is_error($email, 'callback_validasi_email')) {
    $form_error['email'] = 'Email sudah digunakan.';
  }

  if(!is_error($username, 'required|min_length[5]') && is_error($username, 'callback_validasi_username')) {
    $form_error['username'] = 'Username sudah digunakan.';
  }

  // validasi berhasil
  if(empty($form_error)) {
    $data_insert = array(
      'username' => $username,
      'nama' => $nama,
      'email' => $email,
      'password' => encrypt_password($password),
      'no_hp' => $no_hp,
      'tipe_user' => 'pembeli'
    );

    insert_db($data_insert, 'user');
    set_flashdata('sukses', 'Selamat anda berhasil mendaftar, silahkan login ke akun anda.');
    redirect(base_url('login.php'));
  }
}

require_once('layout/header.php'); 
?>


    <style type="text/css">
      .image{
        width: 100%;
        overflow: hidden;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        max-height: 183px;
        min-height: 183px;
      }
      .image img{
        width: 100%;
      }
      .a-disabled{
        color: #555;  
      }
      .a-disabled:hover{
        color: #555;
      }
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <?php
          // validasi
          if(!empty($form_error)) {
            echo alert_error(implode($form_error, '<br/>'));
          }
          ?>
          <center>
          <h1>
              Form Pendaftaran
          </h1>
          </center>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
             <div class="col-md-7 col-md-offset-2">
             <form class="form-horizontal" action='' method="POST">
                <div class="form-group <?php echo isset($form_error['nama']) ? 'has-error': '';?>">
                   <label class="col-sm-3 control-label">Nama</label> 
                   <div class="col-sm-8">
                      <input class="form-control" id="nama" name="nama" placeholder="nama" type="text" value="<?php echo !empty($_POST['nama']) ? $_POST['nama'] : '';?>" max-length="50">
                   </div>
                </div> 

                <div class="form-group <?php echo isset($form_error['no_hp']) ? 'has-error': '';?>">
                   <label class="col-sm-3 control-label">No Telp</label> 
                   <div class="col-sm-8">
                      <input class="form-control" id="no_hp" name="no_hp" placeholder="No telepon" type="text" value="<?php echo !empty($_POST['no_hp']) ? $_POST['no_hp'] : '';?>" max-length="15">
                   </div>
                </div> 

                <div class="form-group <?php echo isset($form_error['email']) ? 'has-error': '';?>">
                   <label class="col-sm-3 control-label">Email</label> 
                   <div class="col-sm-8">
                      <input class="form-control" id="email" name="email" placeholder="Email" type="email" value="<?php echo !empty($_POST['email']) ? $_POST['email'] : '';?>" max-length="40">
                   </div>
                </div> 

                <div class="form-group <?php echo isset($form_error['username']) ? 'has-error': '';?>">
                   <label class="col-sm-3 control-label">Username</label> 
                   <div class="col-sm-8">
                      <input class="form-control" id="username" name="username" placeholder="username" type="text" value="<?php echo !empty($_POST['username']) ? $_POST['username'] : '';?>" max-length="25">
                   </div>
                </div>

                <div class="form-group <?php echo (isset($form_error['password']) || isset($form_error['password2'])) ? 'has-error': '';?>">
                   <label class="col-sm-3 control-label">Password</label> 
                   <div class="col-sm-8">
                      <input class="form-control" id="password" name="password" placeholder="Password" type="password">
                   </div>
                </div>

                <div class="form-group <?php echo (isset($form_error['password']) || isset($form_error['password2'])) ? 'has-error': '';?>">
                   <label class="col-sm-3 control-label">Konfirmasi Password</label> 
                   <div class="col-sm-8">
                      <input class="form-control" id="password2" name="password2" placeholder="Konfirmasi Password" type="password">
                   </div>
                </div>
                <div class="row">
                  <div class="col-sm-8 col-md-offset-3">
                    <button type="submit" name="submit" class="btn btn-green btn-flat btn-block"><i class="fa fa-plus"></i> Daftar</button>
                  </div>
                </div>
                </form>

             </div><!-- ed col -->
          </div><!-- end row -->
        </section>
        <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->


    <?php  require_once('layout/footer.php'); ?>
    <script type="text/javascript">
      

    </script>
