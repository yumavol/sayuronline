<?php
define("load_upload", true);
require_once('../system/engine.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
} else if(get_session('tipe_user') != 'penjual') {
    set_flashdata('error', 'Anda tidak mempunyai hak untuk membuka halaman tersebut.');
    redirect(base_url());
}

define("menu_kelola_produk_kategori", true);
define("SITE_TITLE", 'Tambah Produk');

$form_error = [];

if(!empty($_POST)) {
  trim_validate($_POST);

  $nama = $_POST['nama'];

  // validasi
  if(is_error($nama, 'required')) {
    $form_error[] = 'Nama wajib diisi.';
  }
    if(is_error($nama, 'min_length[3]|max_length[50]')) {
    $form_error[] = 'Nama minimal 3 karakter dan maksimal 50 karakter.';
  }

  if(empty($form_error)) {

    $slug = url_title($nama);

    // check slug
    $counter = 1;
    do {
      $query_check_slug = mysqli_query($con, "SELECT * FROM kategori_produk WHERE slug='" . $slug . "'");
      $cek_slug = mysqli_num_rows($query_check_slug);
      if($cek_slug > 0) {
        $slug = url_title($nama) . '-' . $counter;
        $counter++;
      }
    } while($cek_slug > 0);

      $data_insert = array(
        'nama' => $nama,
        'slug' => $slug
      );

      if(insert_db($data_insert, 'kategori_produk')) {
        set_flashdata('sukses', 'Berhasil menambah kategori produk.');
        redirect(base_url('penjual/kelola_produk_kategori.php'));
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
                  Tambah Produk
                  <a class="btn btn-sm btn-default pull-right" href="<?php echo base_url('penjual/kelola_produk_kategori.php');?>"><i class="fa fa-chevron-left"></i> Kembali</a>
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
                            <h3 class="box-title">Informasi Produk</h3>
                            <div class="bot-tools pull-right">
                              <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                            </div>
                          </div>
                          <div class="box-body">
                              <div class="form-group <?php echo (!empty($nama) && is_error($nama, 'required|min_length[3]|max_length[50]')) ? 'has-error': '' ;?>">
                                <label for="nama_produk">Nama</label>
                                <input type="text" id="nama_kategori" class="form-control" name="nama" placeholder="Nama ..." value="<?php echo (!empty($_POST['nama'])) ? $_POST['nama'] : '';?>" required>
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
