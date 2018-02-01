<?php
define("load_upload", true);
require_once('../system/engine.php');
require_once('../system/validasi.php');


define("menu_tambah_user", true);
define("SITE_TITLE", 'Tambah User');

$form_error = [];

if(!empty($_POST)) {
  trim_validate($_POST);
  $nama = $_POST["nama"];
  $no_hp = $_POST["no_hp"];
  $email = $_POST["email"]; 
  $username = $_POST["username"];
  $tipe_user = $_POST["tipe_user"];
  $password = $_POST["password"]; 
  $konfirmasi_password = $_POST["konfirmasi_password"]; 

  if(is_error($nama, 'required|min_length[3]')) {
    $form_error['nama'] = 'Nama minimal 3 karakter.';
  }
  if(is_error($no_hp, 'required|min_length[10]|max_length[12]')) {
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
    $form_error['konfirmasi_password'] = 'Konfirmasi Password minimal 6 karakter';
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

  if(!is_error($no_hp, 'required|min_length[10]|max_length[12]') && is_error($no_hp, 'callback_validasi_no_hp')) {
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
      'tipe_user' => $tipe_user
    );

    insert_db($data_insert, 'user');
    set_flashdata('sukses', 'Berhasil menambah user baru.');
    redirect(base_url('admin/kelola_user.php'));
  }
}

require_once('layout/header.php');
?>



      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
              <h1>
                  Tambah User
                  <a class="btn btn-sm btn-default pull-right" href="<?php echo base_url('admin/kelola_user.php');?>"><i class="fa fa-chevron-left"></i> Kembali</a>
              </h1>
          </section>

          <!-- Main content -->
          <section class="content">
            <?php
            // validasi
            if(!empty($form_error)) {
              echo alert_error(implode($form_error, '<br/>'));
            }
            ?>
            <div class="row">
                <div class="col-md-12">
                  <form action="" method="POST">
                      <!-- Custom Tabs -->
                      <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Tambah User</h3>
                          <div class="bot-tools pull-right">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                          </div>
                        </div>
                        <div class="box-body">
                          <div class="col-md-6">
                            <div class="form-group <?php echo isset($form_error['nama']) ? 'has-error': '';?>">
                              <label for="nama">Nama</label>
                              <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama" value="<?php echo (!empty($_POST['nama'])) ? $_POST['nama'] : '';?>" max-length="50" required>
                            </div>
                            <div class="form-group <?php echo isset($form_error['email']) ? 'has-error': '';?>">
                              <label for="email">Email</label>
                              <input type="email" id="email" class="form-control" name="email" placeholder="Email" value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : '';?>" max-length="40" required>
                            </div>
                            <div class="form-group <?php echo isset($form_error['no_hp']) ? 'has-error': '';?>">
                              <label for="no_hp">No. HP</label>
                              <input type="text" id="no_hp" class="form-control" name="no_hp" placeholder="No. HP" value="<?php echo (!empty($_POST['no_hp'])) ? $_POST['no_hp'] : '';?>" max-length="15" required>
                            </div>
                            <div class="form-group">
                              <label for="tipe_user">Tipe User</label>
                              <select class="form-control" id="tipe_user" name="tipe_user">
                                <option value="pembeli">Pembeli</option>
                                <option value="penjual">Penjual</option>
                                <option value="admin">Admin</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group <?php echo isset($form_error['username']) ? 'has-error': '';?>">
                              <label for="username">Username</label>
                              <input type="text" id="username" class="form-control" name="username" placeholder="Username" value="<?php echo (!empty($_POST['username'])) ? $_POST['username'] : '';?>" max-length="25" required>
                            </div>
                            <div class="form-group <?php echo (isset($form_error['password']) || isset($form_error['konfirmasi_password'])) ? 'has-error': '';?>">
                              <label for="password">Password</label>
                              <input type="password" id="password" class="form-control" name="password" placeholder="Password Baru">
                            </div>
                            <div class="form-group <?php echo (isset($form_error['password']) || isset($form_error['konfirmasi_password'])) ? 'has-error': '';?>">
                              <label for="konfirmasi_password">Konfirmasi Password</label>
                              <input type="password" id="konfirmasi_password" class="form-control" name="konfirmasi_password" placeholder="Konfirmasi Password">
                            </div>
                          </div>

                        </div><!-- /.box body -->
                      </form>
                    </div><!--box-->

                </div><!-- /.col -->
            </div><!-- /.row -->

        </section>
                <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->



    <?php  require_once('layout/footer.php'); ?>
