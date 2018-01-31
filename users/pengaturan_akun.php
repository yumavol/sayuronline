<?php
define("load_pagination", true);
require_once('../system/engine.php');
require_once('../system/validasi.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
} else if(get_session('tipe_user') != 'pembeli') {
    set_flashdata('error', 'Anda tidak mempunyai hak untuk membuka halaman tersebut.');
    redirect(base_url());
}

define('ON_KERANJANG', false);
define("SITE_TITLE", 'Pengaturan Akun');
define("menu_pengaturan_akun", true);

$id_user=get_session('id_user');


require_once('../layout/header.php');

$form_error = array();

$data = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM user WHERE id_user='".mysqli_real_escape_string($con, $id_user)."'"));

if(!empty($_POST)) {
  trim_validate($_POST);

  $nama = $_POST["nama"];
  $no_hp = $_POST["no_hp"];
  $email = $_POST["email"]; 

  $password_baru = $_POST['password_baru'];
  $konfirmasi_password_baru = $_POST['konfirmasi_password_baru'];
  $password_lama = $_POST['password_lama'];

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

  if(!empty($password_lama) || !empty($password_baru) || !empty($konfirmasi_password_baru)) {
    if(is_error($password_baru, 'required|min_length[6]')) {
      $form_error['password_baru'] = 'Password baru minimal 6 karakter.';
    }
    if(is_error($password_lama, 'required|min_length[6]')) {
      $form_error['password_lama'] = 'Password lama minimal 6 karakter.';
    }
    if(is_error($konfirmasi_password_baru, 'required|min_length[6]')) {
      $form_error['konfirmasi_password_baru'] = 'Konfrimasi password minimal 6 karakter.';
    }

    if($password_baru != $konfirmasi_password_baru) {
      $form_error['password_baru'] = 'Konfrimasi password tidak sama dengan password baru.';
    }

    if(!password_verify($password_lama, $data['password'])) {
      $form_error['password_lama'] = 'Password lama salah.';
    }

    if(!isset($form_error['password_baru']) && !isset($form_error['password_lama']) && !isset($form_error['konfirmasi_password_baru'])) {
      $data_update['password'] = encrypt_password($password_baru);
    }
  }

  // jika tidak ada error
  if(empty($form_error)) {
    $data_update['nama'] = $nama;
    $data_update['email'] = $email;
    $data_update['no_hp'] = $no_hp;
    update_db($data_update, 'user', "id_user='" . $id_user . "'");
    set_flashdata('sukses', 'Berhasil memperbaharui akun.');
    redirect(base_url('users/pengaturan_akun.php'));
  }
}

?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
              Pengaturan Akun
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
            <form action="" method="POST" >
              <div class="row">
                <?php require_once('../layout/sidebar.php'); ?>
                  <div class="col-md-9">
                        <!-- Custom Tabs -->
                        <div class="box">
                          <div class="box-header">
                            <h3 class="box-title">Pengaturan Akun</h3>
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
                            </div>
                            <div class="col-md-6">
                              <div class="form-group <?php echo isset($form_error['password_lama']) ? 'has-error': '';?>">
                                <label for="password_lama">Password Lama</label>
                                <input type="password" id="password_lama" class="form-control" name="password_lama" placeholder="Password Lama">
                                <small class="help-text">Kosongkan password jika tidak akan diubah</small>
                              </div>
                              <div class="form-group <?php echo (isset($form_error['password_baru']) || isset($form_error['konfirmasi_password_baru'])) ? 'has-error': '';?>">
                                <label for="password_baru">Password Baru</label>
                                <input type="password" id="password_baru" class="form-control" name="password_baru" placeholder="Password Baru">
                                <small class="help-text">Kosongkan password jika tidak akan diubah</small>
                              </div>
                              <div class="form-group <?php echo (isset($form_error['password_baru']) || isset($form_error['konfirmasi_password_baru'])) ? 'has-error': '';?>">
                                <label for="konfirmasi_password_baru">Konfirmasi Password Baru</label>
                                <input type="password" id="konfirmasi_password_baru" class="form-control" name="konfirmasi_password_baru" placeholder="Konfirmasi Password Baru">
                                <small class="help-text">Kosongkan password jika tidak akan diubah</small>
                              </div>
                            </div>
                          </div><!-- /.box body -->
                      </div><!--box-->
                  </div><!-- /.col -->
              </div><!-- /.row -->
            </form>
          </section>
        </div><!-- /.container -->
    </div><!-- /.content-wrapper -->


    <?php  require_once('../layout/footer.php'); ?>
    <script type="text/javascript">
      $('.jumlah_update').on('change', function() {
          var uri = "<?php echo base_url('users/keranjang.php'); ?>";
          var keranjang_id = $(this).data('id');
          var value = $(this).val();
          $.ajax({
              type:'GET',
              dataType:'json',
              data: {update : keranjang_id, qty : value} ,
              url: uri,
              complete :function(data){
                  //location.reload();
              }

          });
      });
    </script>
