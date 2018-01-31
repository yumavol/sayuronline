<?php
define("load_upload", true);
require_once('../system/engine.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
}

define('menu_transaksi', false);
define("SITE_TITLE", 'Kirim Bukti Pembayaran');

$no_transaksi = mysqli_real_escape_string($con, $_GET['no_transaksi']);
$id_user = get_session('id_user');
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

      // update status
      update_db(array('status' => 'Sedang Diproses'), 'transaksi', "no_transaksi='" . $no_transaksi . "'");
      $cek_bukti = mysqli_query($con, "SELECT * FROM pembayaran WHERE no_transaksi='" . $no_transaksi . "'");
      if(mysqli_num_rows($cek_bukti) == 0) {
        insert_db($data, 'pembayaran');
        set_flashdata('sukses', 'Berhasil mengkonfirmasi transfer.');
        redirect(base_url('users/transaksi.php'));
      } else {
        update_db($data, 'pembayaran', "no_transaksi='" . $no_transaksi . "'");
        set_flashdata('sukses', 'Berhasil mengkonfirmasi transfer.');
        redirect(base_url('users/transaksi.php'));
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
              Kirim Bukti Pembayaran <small>#<?php echo $no_transaksi;?></small>
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

            <div class="col-md-12">
              <div style="" class="box">
                <div class="box-body">
                  <p>Pembayaran dapat dilakukan ke salah satu rekening dibawah ini.</p>
                  <table class="table">
                    <tr>
                      <td rowspan="2" style="vertical-align: middle;" width="100px"><img src="<?php echo base_url('assets/images/BNI.png');?>" width="80px"></td>
                      <td><b>Bank BNI</b></td>
                      <td rowspan="2" style="vertical-align: middle;" width="100px"><img src="<?php echo base_url('assets/images/BRI.png');?>" width="80px"></td>
                      <td><b>Bank BRI</b></td>
                    </tr>
                    <tr>
                      <td>023 xxx xxx</td>
                      <td>034 xxx xxx xxx xxx</td>
                    </tr>
                    <tr>
                      <td rowspan="2" style="vertical-align: middle;" width="100px"><img src="<?php echo base_url('assets/images/BCA.png');?>" width="80px"></td>
                      <td><b>Bank BCA</b></td>
                      <td rowspan="2" style="vertical-align: middle;" width="100px"><img src="<?php echo base_url('assets/images/Mandiri.png');?>" width="80px"></td>
                      <td><b>Bank Mandiri</b></td>
                    </tr>
                    <tr>
                      <td>731 xxx xxxx</td>
                      <td>0700 xxx xxx xxx</td>
                    </tr>
                  </table>
                </div><!--box body-->
              </div><!--box-->   
            </div>
          </div>
        <div class="row">
        
          <?php require_once('../layout/sidebar.php'); ?>
          <form action="" method="post" class="" enctype="multipart/form-data">
          <div class="col-md-9">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Kirim Bukti Pembayaran</h3>
              </div>
              <div class="box-body">
                <div class="form-group <?php echo (isset($bank_tujuan) && is_error($bank_tujuan, 'required')) ? 'has-error': '';?>">
                  <label for="bank-tujuan">Bank Tujuan</label>
                  <select name="bank_tujuan" class="form-control" id="bank-tujuan">
                    <option value="">-</option>
                    <option value="BNI" <?php echo (isset($bank_tujuan) &&$bank_tujuan == 'BNI') ? 'selected': '';?>>BNI</option>
                    <option value="BCA" <?php echo (isset($bank_tujuan) &&$bank_tujuan == 'BCA') ? 'selected': '';?>>BCA</option>
                    <option value="BRI" <?php echo (isset($bank_tujuan) &&$bank_tujuan == 'BRI') ? 'selected': '';?>>BRI</option>
                    <option value="Mandiri" <?php echo (isset($bank_tujuan) &&$bank_tujuan == 'Mandiri') ? 'selected': '';?>>Mandiri</option>
                  </select>
                </div>
                <div class="form-group <?php echo (isset($bank_asal) && is_error($bank_asal, 'required')) ? 'has-error': '';?>">
                  <label for="bank-asal">Bank Asal</label>
                  <input type="text" name="bank_asal" class="form-control" id="bank-asal" value="<?php echo (!empty($bank_asal)) ? $bank_asal : '';?>">
                </div>
                <div class="form-group <?php echo (isset($atas_nama) && is_error($atas_nama, 'required|min_length[3]|max_length[30]')) ? 'has-error': '';?>">
                  <label for="atas-nama">Atas Nama</label>
                  <input type="text" name="atas_nama" class="form-control" id="atas-nama" value="<?php echo (!empty($atas_nama)) ? $atas_nama : '';?>">
                </div>
                <div class="form-group <?php echo (isset($no_rekening) && is_error($no_rekening, 'required|min_length[3]|max_length[30]')) ? 'has-error': '';?>">
                  <label for="no-rekening">No. Rekening</label>
                  <input type="text" name="no_rekening" class="form-control" id="no-rekening" value="<?php echo (!empty($no_rekening)) ? $no_rekening : '';?>">
                </div>
                <div class="form-group <?php echo (isset($tanggal) && is_error($tanggal, 'required')) ? 'has-error': '';?>">
                  <label for="tanggal">Tanggal</label>
                  <input type="date" name="tanggal" class="form-control" id="tanggal" value="<?php echo (!empty($tanggal)) ? $tanggal : '';?>">
                </div>
                <div class="form-group <?php echo (isset($jumlah) && is_error($jumlah, 'required')) ? 'has-error': '';?>">
                  <label for="jumlah">Jumlah</label>
                  <input type="number" name="jumlah" class="form-control" id="jumlah" value="<?php echo (!empty($jumlah)) ? $jumlah : '';?>">
                </div>
                <div class="form-group <?php echo (isset($bukti_transfer) && is_error($bukti_transfer['name'], 'required')) ? 'has-error': '';?>">
                  <label for="bukti-transfer">Bukti Transfer</label>
                  <input type="file" name="bukti_transfer" id="bukti-transfer">

                  <p class="help-block">Hanya diperbolehkan jpg, jpeg, gif, png, bmp</p>
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