<?php
define("load_upload", true);
require_once('../system/engine.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
} else if(get_session('tipe_user') != 'penjual') {
    set_flashdata('error', 'Anda tidak mempunyai hak untuk membuka halaman tersebut.');
    redirect(base_url());
}

define("menu_kelola_produk", true);
define("SITE_TITLE", 'Tambah Produk');

$form_error = [];

$data = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM produk WHERE no_produk='" . mysqli_real_escape_string($con, $_GET['no_produk']) . "'"));

if(!empty($_POST)) {
  trim_validate($_POST);

  $nama = $_POST['nama'];
  $harga = $_POST['harga'];
  $no_kategori = $_POST['no_kategori'];
  $deskripsi = $_POST['deskripsi'];
  $foto = $_FILES['foto'];

  // validasi
  if(is_error($nama, 'required')) {
    $form_error[] = 'Nama wajib diisi.';
  }
  if(is_error($harga, 'required')) {
    $form_error[] = 'Harga wajib diisi.';
  }
  if(is_error($no_kategori, 'required')) {
    $form_error[] = 'Kategori wajib diisi.';
  }
  if(is_error($deskripsi, 'required')) {
    $form_error[] = 'Deskripsi wajib diisi.';
  }
  if(is_error($nama, 'min_length[3]|max_length[50]')) {
    $form_error[] = 'Nama minimal 3 karakter dan maksimal 50 karakter.';
  }
  if(is_error($deskripsi, 'min_length[5]')) {
    $form_error[] = 'Deskripsi minimal 5 karakter.';
  }

  if(empty($form_error)) {

    $slug = url_title($nama);

    // check slug
    $counter = 1;
    do {
      $query_check_slug = mysqli_query($con, "SELECT * FROM produk WHERE slug='" . $slug . "'");
      $cek_slug = mysqli_num_rows($query_check_slug);
      if($cek_slug > 0) {
        $slug = url_title($nama) . '-' . $counter;
        $counter++;
      }
    } while($cek_slug > 0);

    $config_foto['file_name'] = $slug;
    $config_foto['directory'] = 'uploads/foto';
    $config_foto['allowed_ext'] = array('jpg', 'jpeg', 'gif', 'png', 'bmp');

    $data_update = array(
      'no_kategori' => $no_kategori, 
      'nama' => $nama, 
      'deskripsi' => $deskripsi, 
      'harga' => $harga, 
      'slug' => $slug
    );
    if(!empty($foto['name'])) {
      $upload = do_upload($_FILES['foto'], $config_foto);

      if($upload['success'] == true) {
        $data_update['foto'] = $upload['file_name'];
      } else {
        $form_error = array_merge($form_error, $upload['errors']);
      }
    }
    if(update_db($data_update, 'produk', "no_produk='" . mysqli_real_escape_string($con, $_GET['no_produk']) . "'")) {
      set_flashdata('sukses', 'Berhasil mengubah produk.');
      redirect(base_url('penjual/kelola_produk.php'));
    } else {
      set_flashdata('error', 'Gagal mengubah produk.');
      redirect(base_url('penjual/kelola_produk.php'));
    }
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
                  <a class="btn btn-sm btn-default pull-right" href="<?php echo base_url('penjual/kelola_produk.php');?>"><i class="fa fa-chevron-left"></i> Kembali</a>
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
                                <input type="text" id="nama_produk" class="form-control" name="nama" placeholder="Nama ..." value="<?php echo (!empty($_POST['nama'])) ? $_POST['nama'] : $data['nama'];?>" required>
                              </div>

                              <div class="form-group <?php echo (!empty($harga) && is_error($harga, 'required')) ? 'has-error': '' ;?>">
                                <label for="harga_produk">Harga</label>
                                <input type="text" id="harga_produk" class="form-control" name="harga" placeholder="Harga ..." value="<?php echo (!empty($_POST['harga'])) ? $_POST['harga'] : $data['harga'];?>" required>
                              </div>

                              <div class="form-group <?php echo (!empty($no_kategori) && is_error($no_kategori, 'required')) ? 'has-error': '' ;?>">
                                <label for="no_kategori">Kategori</label>
                                <select class="form-control" name="no_kategori" id="no_kategori">
                                  <option value="">-</option>
                                  <?php
                                  $query = mysqli_query($con, "SELECT * FROM kategori_produk");
                                  while($row = mysqli_fetch_array($query)) {
                                    if(!empty($_POST['no_kategori'])) {
                                      echo '<option value="' . $row['no_kategori'] . '" ' . (!empty($_POST['no_kategori']) && ($_POST['no_kategori'] == $row['no_kategori']) ? 'selected' : '') .'>' . $row['nama'] . '</option>';
                                    } else {
                                      echo '<option value="' . $row['no_kategori'] . '" ' . (($data['no_kategori'] == $row['no_kategori']) ? 'selected' : '') .'>' . $row['nama'] . '</option>';
                                    }
                                  }
                                  ?>
                                </select>
                              </div>

                              <div class="form-group <?php echo (!empty($foto) && is_error($foto['name'], 'required')) ? 'has-error': '' ;?>">
                                <label for="foto">Foto</label>
                                <input type="file" id="foto" class="form-control" name="foto">
                                <p class="help-text">Hanya diperbolehkan file jpg, jpeg, gif, png dan bmp.</p>
                              </div>

                              <div class="form-group <?php echo (!empty($deskripsi) && is_error($deskripsi, 'required|min_length[5]')) ? 'has-error': '' ;?>">
                                <label>Deskripsi</label>
                                <textarea class="form-control" style="height: 200px" name="deskripsi" rows="5" cols="20" required><?php echo (!empty($_POST['deskripsi'])) ? $_POST['deskripsi'] : $data['deskripsi'];?></textarea>
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
