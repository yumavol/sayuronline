<?php
define("load_pagination", true);
require_once('../system/engine.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
}

define('ON_KERANJANG', false);
define("SITE_TITLE", 'Daftar Transaksi');
define("menu_transaksi", true);

require_once('../layout/header.php');



function status_transaksi($status) {
    if($status == 'Menunggu Bukti Transfer') {
        return '<label class="label label-warning">' . $status . '</label>';
    } elseif($status == 'Sedang Diproses') {
        return '<label class="label label-info">' . $status . '</label>';
    } elseif($status == 'Sedang Dikirim') {
        return '<label class="label label-primary">' . $status . '</label>';
    } elseif($status == 'Berhasil') {
        return '<label class="label label-success">' . $status . '</label>';
    } elseif($status == 'Gagal') {
        return '<label class="label label-danger">' . $status . '</label>';
    }
    return $status;
}
$current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;

$sql_transaksi = "SELECT * FROM transaksi WHERE id_user='" . get_session('id_user') . "' ORDER BY tanggal,no_transaksi DESC";

$total_row = mysqli_num_rows(mysqli_query($con, $sql_transaksi));
?>


  <style type="text/css">
    .table > tbody > tr > td {
      vertical-align: middle;
    }
    .img{
      width: 100%;
      max-height: 100px;
      overflow: hidden;
    }
    .img img{
      width: 100%;
    }
  </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
              Transaksi <small>Daftar Transaksi Anda</small>
          </h1>
        </section>

        <!-- Main content -->
        <form method="post" action="<?php echo base_url('users/isi_alamat.php') ?>">
        <section class="content">
          <div class="row">
            <?php
                if(has_flashdata('sukses')){
                    echo alert_sukses(get_flashdata('sukses'));
                }
                if(has_flashdata('error')){
                    echo alert_error(get_flashdata('error'));
                }
                if(has_flashdata('warning')){
                    echo alert_warning(get_flashdata('warning'));
                }
                if(has_flashdata('info')){
                    echo alert_info(get_flashdata('info'));
                }
            ?>
            <?php require_once('../layout/sidebar.php'); ?>
            <div class="col-md-9">
              <div style="" class="box box-success">
                <div class="box-header">
                  <strong>Daftar Transaksi</strong>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th width="12%">No. Transaksi</th>
                        <th width="18%" class="text-center">Tanggal</th>
                        <th width="15%" class="text-center">Status</th>
                        <th width="20%"></th>
                        <th width="20%"></th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $query = mysqli_query($con, $sql_transaksi . " LIMIT " . (($current_page - 1) * 10) . ", 10");
                      while($row = mysqli_fetch_array($query)) {
                      ?>
                      <tr>
                        <td><?php echo $row['no_transaksi'];?></td>
                        <td class="text-center"><?php echo tanggal_indo($row['tanggal'], true);?></td>
                        <td class="text-center"><?php echo status_transaksi($row['status'], true);?></td>
                        <td class="text-center">

                          <a href="<?php echo base_url('users/transaksi_detail.php?no_transaksi=' . $row['no_transaksi']);?>" class="btn btn-sm btn-success"><i class="fa fa-pencil-square-o"></i> Detail Transaksi</a>

                        </td>
                        <td class="text-center">
                          <?php if($row['status'] == 'Menunggu Bukti Transfer') { ?>
                          <a href="<?php echo base_url('users/pembayaran.php?no_transaksi=' . $row['no_transaksi']);?>" class="btn btn-sm btn-primary"><i class="fa fa-credit-card"></i> Konfirmasi Pembayaran</a>
                          <?php } ?>
                        </td>
                      </tr>
                      <?php
                      }
                      ?>
                    </tbody>
                  </table>
                  </div><!-- tableressponsive -->
                  <!--
                  <div class="col-md-4 col-md-offset-8">
                    <div class="row">
                      <div class="col-md-7"><strong>Jumlah Produk</strong></div>
                      <div class="col-md-5">: 5</div>
                    </div>
                    <div class="row">
                      <div class="col-md-7"><strong>Total</strong></div>
                      <div class="col-md-5">: 120000</div>
                    </div>
                  </div>
                  -->
                </div><!--box body-->
                <div class="box-footer">
                  <?php
                  echo pagination(base_url('users/transaksi.php'), $total_row, 10, $current_page);
                  ?>
                </div><!--box footer-->
              </div><!--box-->
            </div>
          </div>
        </section><!-- /.content -->
        </form>
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
