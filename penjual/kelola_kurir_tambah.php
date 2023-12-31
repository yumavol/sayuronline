<?php
define("load_upload", true);
require_once('../system/engine.php');
require_once('../system/validasi.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
} else if(get_session('tipe_user') != 'penjual') {
    set_flashdata('error', 'Anda tidak mempunyai hak untuk membuka halaman tersebut.');
    redirect(base_url());
}

define("menu_kelola_kurir", true);
define("SITE_TITLE", 'Tambah Petugas Kurir');

$form_error = [];

if(!empty($_POST)) {
  trim_validate($_POST);

  $nama = $_POST['nama'];
  $no_hp = $_POST['no_hp'];

  // validasi
  if(is_error($nama, 'min_length[3]|max_length[50]')) {
    $form_error['nama'] = 'Nama minimal 3 karakter dan maksimal 50 karakter.';
  }
  if(is_error($no_hp, 'min_length[10]|max_length[12]')) {
    $form_error['no_hp'] = 'No HP minimal 10 digit dan maksimal 12 digit.';
  }

  if(!is_error($nama, 'required|min_length[3]|max_length[50]') && is_error($nama, 'callback_validasi_nama')) {
    $form_error['nama'] = 'Nama tidak valid.';
  }

  if(!is_error($no_hp, 'min_length[10]|max_length[12]') && is_error($no_hp, 'callback_validasi_no_hp')) {
    $form_error['no_hp'] = 'No. Telp tidak valid.';
  }


  if(empty($form_error)) {




      $data_insert = array(
        'nama' => $nama,
        'no_hp' => $no_hp,
      );

      if(insert_db($data_insert, 'petugas_kurir')) {
        set_flashdata('sukses', 'Berhasil menambah petugas kurir.');
        redirect(base_url('penjual/kelola_kurir.php'));
      }
    } else {
      $form_error = array_merge($form_error);
    }

}

require_once('layout/header.php');
?>



      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
              <h1>
                  Tambah Petugas Kurir
                  <a class="btn btn-sm btn-default pull-right" href="<?php echo base_url('penjual/kelola_kurir.php');?>"><i class="fa fa-chevron-left"></i> Kembali</a>
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
                    <form action="" method="POST" enctype="multipart/form-data">
                        <!-- Custom Tabs -->
                        <div class="box">
                          <div class="box-header">
                            <h3 class="box-title">Informasi Petugas Kurir</h3>
                            <div class="bot-tools pull-right">
                              <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                          </div>
                          <div class="box-body">
                              <div class="form-group <?php echo (isset($form_error['nama'])) ? 'has-error': '' ;?>">
                                <label for="nama_produk">Nama</label>
                                <input type="text" id="nama_produk" class="form-control" name="nama" placeholder="Nama ..." value="<?php echo (!empty($_POST['nama'])) ? $_POST['nama'] : '';?>" required>
                              </div>
                              <div class="form-group <?php echo (isset($form_error['no_hp'])) ? 'has-error': '' ;?>">
                                <label for="no_hp">No HP</label>
                                <input type="text" id="no_hp" class="form-control" name="no_hp" placeholder="no_hp ..." value="<?php echo (!empty($_POST['no_hp'])) ? $_POST['no_hp'] : '';?>" required>
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



    <?php  require_once('../layout/footer.php'); ?>
