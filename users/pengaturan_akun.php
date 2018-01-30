<?php
define("load_pagination", true);
require_once('../system/engine.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
}

define('ON_KERANJANG', false);
define("SITE_TITLE", 'Pengaturan Akun');
define("menu_pengaturan_akun", true);

$id_user=get_session('id_user');


require_once('../layout/header.php');

$form_error = [];

$data = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM user WHERE id_user='".mysqli_real_escape_string($con, $id_user)."'"));

if(!empty($_POST)) {
  trim_validate($_POST);

  $password_baru = $_POST['password_baru'];
  $konfirmasi_password_baru = $_POST['konfirmasi_password_baru'];
  $password_lama = $_POST['password_lama'];

  if(is_error($password_baru, 'required')) {
    $form_error[] = 'Password baru wajib diisi.';
  }
  if(is_error($password_lama, 'required')) {
    $form_error[] = 'Password lama wajib diisi.';
  }
  if(is_error($konfirmasi_password_baru, 'required')) {
    $form_error[] = 'Konfrimasi password wajib diisi.';
  }

  if(empty($form_error) && (password_verify($password_lama, $data['password'])) && $password_baru==$konfirmasi_password_baru && strlen($password_baru)>=6) {

      $data_update = array(
        'password' => encrypt_password($password_baru)
      );

      if(update_db($data_update, 'user', "id_user='" . mysqli_real_escape_string($con, $id_user) . "'")) {
        set_flashdata('sukses', 'Password berhasil diubah.');
        redirect(base_url('users/pengaturan_akun.php'));
      } else {
        set_flashdata('error', 'Password gagal diubah.');
        redirect(base_url('users/pengaturan_akun.php'));
      }
    }
    elseif((password_verify($password_lama, $data['password'])) && $password_baru!=$konfirmasi_password_baru) {
      $form_error[] = 'Konfirmasi password tidak sesuai.';
    }
    elseif((password_verify($password_lama, $data['password'])) && $password_baru==$konfirmasi_password_baru && strlen($password_baru)<5) {
      $form_error[] = 'Password minimal 6 karakter.';
    }
    else {
      $form_error[] = 'Password lama tidak sesuai.';
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

              <div class="row">
                <?php require_once('../layout/sidebar.php'); ?>
                  <div class="col-md-9">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <!-- Custom Tabs -->
                        <div class="box">
                          <div class="box-header">
                            <h3 class="box-title">Ubah Password</h3>
                            <div class="bot-tools pull-right">
                              <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                          </div>
                          <div class="box-body">
                            <div class="form-group <?php echo (!empty($password) && is_error($password, 'required|min_length[6]|max_length[100]')) ? 'has-error': '' ;?>">
                              <label for="password_lama">Password Lama</label>
                              <input type="password" id="password_lama" class="form-control" name="password_lama" placeholder="Password Lama" value="<?php echo (!empty($_POST['password_lama'])) ? $_POST['password_lama'] :'';?>" required>
                            </div>
                            <div class="form-group <?php echo (!empty($password) && is_error($password, 'required|min_length[6]|max_length[100]')) ? 'has-error': '' ;?>">
                              <label for="password_baru">Password Baru</label>
                              <input type="password" id="password_baru" class="form-control" name="password_baru" placeholder="Password Baru" value="<?php echo (!empty($_POST['password_baru'])) ? $_POST['password_baru'] :'';?>" required>
                            </div>
                            <div class="form-group <?php echo (!empty($password) && is_error($password, 'required|min_length[6]|max_length[100]')) ? 'has-error': '' ;?>">
                              <label for="konfirmasi_password_baru">Konfirmasi Password Baru</label>
                              <input type="password" id="konfirmasi_password_baru" class="form-control" name="konfirmasi_password_baru" placeholder="Password Baru" value="<?php echo (!empty($_POST['konfirmasi_password_baru'])) ? $_POST['konfirmasi_password_baru'] :'';?>" required>
                            </div>


                          </div><!-- /.box body -->
                        </form>
                      </div><!--box-->

                  </div><!-- /.col -->
              </div><!-- /.row -->
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
