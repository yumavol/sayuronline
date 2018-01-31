<?php
define("load_upload", true);
require_once('../system/engine.php');
require_once('../system/validasi.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
} else if(get_session('tipe_user') != 'admin') {
    set_flashdata('error', 'Anda tidak mempunyai hak untuk membuka halaman tersebut.');
    redirect(base_url());
}

define("menu_pengaturan_akun", true);
define("SITE_TITLE", 'Ubah User');
$id_user = mysqli_real_escape_string($con, $_GET['id_user']);
$form_error = array();

$data = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM user WHERE id_user='" . $id_user . "'"));

if(!empty($_POST)) {
  trim_validate($_POST);

  $nama = $_POST["nama"];
  $no_hp = $_POST["no_hp"];
  $email = $_POST["email"]; 
  $username = $_POST["username"]; 
  $tipe_user = $_POST["tipe_user"]; 

  $password = $_POST['password'];
  $konfirmasi_password = $_POST['konfirmasi_password'];

  $data_update = array();
  if(is_error($nama, 'required|min_length[3]')) {
    $form_error['nama'] = 'Nama minimal 3 karakter.';
  }
  if(is_error($no_hp, 'required')) {
    $form_error['no_hp'] = 'No. Telp wajib diisi.';
  }
  if(is_error($email, 'required|min_length[5]')) {
    $form_error['email'] = 'Email minimal 5 karakter.';
  }

  if(!is_error($nama, 'required|min_length[3]') && is_error($nama, 'callback_validasi_nama')) {
    $form_error['nama'] = 'Nama tidak valid.';
  }

  if(!is_error($no_hp, 'required') && is_error($no_hp, 'callback_validasi_no_hp')) {
    $form_error['no_hp'] = 'No. Telp tidak valid.';
  }

  if($email != $data['email']) {
    if(!is_error($email, 'required|min_length[5]') && is_error($email, 'callback_validasi_email')) {
      $form_error['email'] = 'Email sudah digunakan.';
    }
  }

  if($username != $data['username']) {
    if(!is_error($username, 'required|min_length[5]') && is_error($username, 'callback_validasi_username')) {
      $form_error['username'] = 'Username sudah digunakan.';
    }
  }

  if(!empty($password) || !empty($konfirmasi_password)) {
    if(is_error($password, 'required|min_length[6]')) {
      $form_error['password'] = 'Password baru minimal 6 karakter.';
    }
    if(is_error($konfirmasi_password, 'required|min_length[6]')) {
      $form_error['konfirmasi_password'] = 'Konfrimasi password minimal 6 karakter.';
    }

    if($password != $konfirmasi_password) {
      $form_error['password'] = 'Konfrimasi password tidak sama dengan password baru.';
    }

    if(!isset($form_error['password']) && !isset($form_error['konfirmasi_password'])) {
      $data_update['password'] = encrypt_password($password);
    }
  }

  // jika tidak ada error
  if(empty($form_error)) {
    $data_update['nama'] = $nama;
    $data_update['username'] = $username;
    $data_update['tipe_user'] = $tipe_user;
    $data_update['email'] = $email;
    $data_update['no_hp'] = $no_hp;
    update_db($data_update, 'user', "id_user='" . $id_user . "'");
    set_flashdata('sukses', 'Berhasil memperbaharui user.');
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
                  Ubah User
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
            if(has_flashdata('sukses')) {
              echo alert_sukses(get_flashdata('sukses'));
            }
            if(has_flashdata('error')) {
              echo alert_error(get_flashdata('error'));
            }
            ?>
            <div class="row">
                <div class="col-md-12">
                  <form action="" method="POST">
                      <!-- Custom Tabs -->
                      <div class="box">
                        <div class="box-header">
                          <h3 class="box-title">Ubah User</h3>
                          <div class="bot-tools pull-right">
                            <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                          </div>
                        </div>
                        <div class="box-body">
                          <div class="col-md-6">
                            <div class="form-group <?php echo isset($form_error['nama']) ? 'has-error': '';?>">
                              <label for="nama">Nama</label>
                              <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama" value="<?php echo (!empty($_POST['nama'])) ? $_POST['nama'] : $data['nama'];?>" max-length="50" required>
                            </div>
                            <div class="form-group <?php echo isset($form_error['email']) ? 'has-error': '';?>">
                              <label for="email">Email</label>
                              <input type="email" id="email" class="form-control" name="email" placeholder="Email" value="<?php echo (!empty($_POST['email'])) ? $_POST['email'] : $data['email'];?>" max-length="40" required>
                            </div>
                            <div class="form-group <?php echo isset($form_error['no_hp']) ? 'has-error': '';?>">
                              <label for="no_hp">No. HP</label>
                              <input type="text" id="no_hp" class="form-control" name="no_hp" placeholder="No. HP" value="<?php echo (!empty($_POST['no_hp'])) ? $_POST['no_hp'] : $data['no_hp'];?>" max-length="15" required>
                            </div>
                            <div class="form-group">
                              <label for="tipe_user">Tipe User</label>
                              <select class="form-control" id="tipe_user" name="tipe_user">
                                <option value="pembeli" <?php echo ($data['tipe_user'] == 'pembeli') ? 'selected' : '';?>>Pembeli</option>
                                <option value="penjual" <?php echo ($data['tipe_user'] == 'penjual') ? 'selected' : '';?>>Penjual</option>
                                <option value="admin" <?php echo ($data['tipe_user'] == 'admin') ? 'selected' : '';?>>Admin</option>
                              </select>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="form-group <?php echo isset($form_error['username']) ? 'has-error': '';?>">
                              <label for="username">Username</label>
                              <input type="text" id="username" class="form-control" name="username" placeholder="Username" value="<?php echo (!empty($_POST['username'])) ? $_POST['username'] : $data['username'];?>" max-length="25" required>
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
