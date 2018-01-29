<?php
define("load_upload", true);
require_once('../system/engine.php');

define('ON_KERANJANG', false);
define("SITE_TITLE", 'Kirim Bukti Pembayaran');

$no_transaksi = mysqli_real_escape_string($con, $_GET['no_transaksi']);
$id_user = 1;
// cek transaksi
$query_cek_transaksi = mysqli_query($con, "SELECT * FROM transaksi WHERE no_transaksi='" . $no_transaksi . "' AND id_user='" . $id_user . "'");

if(mysqli_num_rows($query_cek_transaksi) < 1) {
  redirect(base_url('users/transaksi.php'));
}

$form_error = [];

if(!empty($_POST)) {
  trim_validate($_POST);

  $bank_tujuan = $_POST['bank_tujuan'];
  $bank_asal = $_POST['bank_asal'];
  $atas_nama = $_POST['atas_nama'];
  $no_rekening = $_POST['no_rekening'];
  $tanggal = $_POST['tanggal'];
  $jumlah = $_POST['jumlah'];
  $bukti_transfer = $_FILES['bukti_transfer'];

  // validasi
  if(is_error($bank_tujuan, 'required')) {
    $form_error[] = 'Bank tujuan wajib diisi.';
  }
  if(is_error($bank_asal, 'required')) {
    $form_error[] = 'Bank asal wajib diisi.';
  }
  if(is_error($atas_nama, 'required')) {
    $form_error[] = 'Atas nama wajib diisi.';
  }
  if(is_error($no_rekening, 'required')) {
    $form_error[] = 'No. Rekening wajib diisi.';
  }
  if(is_error($tanggal, 'required')) {
    $form_error[] = 'Tanggal wajib diisi.';
  }
  if(is_error($jumlah, 'required')) {
    $form_error[] = 'Jumlah wajib diisi.';
  }
  if(is_error($bukti_transfer['name'], 'required')) {
    $form_error[] = 'Bukti Transfer wajib diisi.';
  }

  if(is_error($atas_nama, 'min_length[3]|max_length[30]')) {
    $form_error[] = 'Atas nama minimal 3 karakter dan maksimal 30 karakter.';
  }
  if(is_error($no_rekening, 'min_length[3]|max_length[30]')) {
    $form_error[] = 'No. Rekening minimal 3 karakter dan maksimal 30 karakter.';
  }

  if(empty($form_error)) {

    $config_foto['file_name'] = $_GET['no_transaksi'];
    $config_foto['directory'] = 'uploads/pembayaran';
    $config_foto['allowed_ext'] = array('jpg', 'jpeg', 'gif', 'png', 'bmp');

    $upload = do_upload($_FILES['bukti_transfer'], $config_foto);

    if($upload['success'] == true) {
      $file_foto = $upload['file_name'];


      $data = array(
        'no_transaksi' => $no_transaksi,
        'bank_tujuan' => $bank_tujuan,
        'bank_asal' => $bank_asal,
        'atas_nama' => $atas_nama,
        'no_rekening' => $no_rekening,
        'tanggal' => $tanggal,
        'jumlah' => $jumlah,
        'bukti_pembayaran' => $file_foto
      );

      $cek_bukti = mysqli_query($con, "SELECT * FROM pembayaran WHERE no_transaksi='" . $no_transaksi . "'");
      if(mysqli_num_rows($cek_bukti) == 0) {
        if(insert_db($data, 'pembayaran')) {
          set_flashdata('sukses', 'Berhasil mengkonfirmasi transfer.');
          redirect(base_url('users/transaksi.php'));
        }
      } else {
        if(update_db($data, 'pembayaran', "no_transaksi='" . $no_transaksi . "'")) {
          set_flashdata('sukses', 'Berhasil mengkonfirmasi transfer.');
          redirect(base_url('users/transaksi.php'));
        }
      }
    } else {
      $form_error = array_merge($form_error, $upload['errors']);
    }
  }
}

require_once('../layout/header.php');
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
              Kirim Bukti Pembayaran <small>#</small>
              <a class="btn btn-sm btn-default pull-right" href="<?php echo base_url('users/transaksi.php');?>"><i class="fa fa-chevron-left"></i> Kembali</a>
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
        
          <?php require_once('../layout/sidebar.php'); ?>
          <form action="" method="post" class="" enctype="multipart/form-data">
          <div class="col-md-9">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Kirim Bukti Pembayaran</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="bank-tujuan">Bank Tujuan</label>
                  <select name="bank_tujuan" class="form-control" id="bank-tujuan">
                    <option value="">-</option>
                    <option value="BNI">BNI</option>
                    <option value="BCA">BCA</option>
                    <option value="BRI">BRI</option>
                    <option value="Mandiri">Mandiri</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="bank-asal">Bank Asal</label>
                  <input type="text" name="bank_asal" class="form-control" id="bank-asal">
                </div>
                <div class="form-group">
                  <label for="atas-nama">Atas Nama</label>
                  <input type="text" name="atas_nama" class="form-control" id="atas-nama">
                </div>
                <div class="form-group">
                  <label for="no-rekening">No. Rekening</label>
                  <input type="text" name="no_rekening" class="form-control" id="no-rekening">
                </div>
                <div class="form-group">
                  <label for="tanggal">Tanggal</label>
                  <input type="date" name="tanggal" class="form-control" id="tanggal">
                </div>
                <div class="form-group">
                  <label for="jumlah">Jumlah</label>
                  <input type="number" name="jumlah" class="form-control" id="jumlah">
                </div>
                <div class="form-group">
                  <label for="bukti-transfer">Bukti Transfer</label>
                  <input type="file" name="bukti_transfer" class="form-control" id="bukti-transfer">
                </div>
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-sm btn-primary pull-right"><i class="fa fa-send"></i> Kirim</button>
              </div>
            </div>
          </div><!-- /.col -->
          </form>
        </div><!-- /.row -->
        </section>
        <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
<?php  require_once('../layout/footer.php'); ?>