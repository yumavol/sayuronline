<?php
define("load_pagination", true);
require_once('../system/engine.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
}
$no_transaksi = mysqli_real_escape_string($con, $_GET['no_transaksi']);
define('ON_KERANJANG', false);
define("SITE_TITLE", 'Transaksi | '.$no_transaksi);
define("menu_transaksi", true);

require_once('../layout/header.php');

$sql_info = "
SELECT
user.nama as nama_pembeli, user.email, user.no_hp as no_hp_pembeli,
petugas_kurir.nama as nama_kurir, petugas_kurir.no_hp as no_hp_kurir,
alamat.alamat,
transaksi.*
FROM transaksi
JOIN alamat ON alamat.id_alamat=transaksi.id_alamat
JOIN user ON user.id_user=transaksi.id_user
LEFT JOIN petugas_kurir ON petugas_kurir.id_petugas=transaksi.id_petugas
WHERE transaksi.no_transaksi='" . $no_transaksi . "'";
$data_transaksi = mysqli_fetch_array(mysqli_query($con, $sql_info));


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
    .red {
      color: red;
    }

    .table.borderless>thead>tr>th, .table.borderless>tbody>tr>th, .table.borderless>tfoot>tr>th, .table.borderless>thead>tr>td, .table.borderless>tbody>tr>td, .table.borderless>tfoot>tr>td {
      border : 0;
    }

    .box-header {
      padding-bottom: 0;
    }

    hr {
      margin : 0;
    }
  </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
              Transaksi <small># <?php echo $no_transaksi?> <span class="red">(<?php echo $data_transaksi['status'] ?>)</span></small>
              <a class="btn btn-sm btn-default pull-right" href="<?php echo base_url('users/transaksi.php');?>"><i class="fa fa-chevron-left"></i> Kembali</a>
          </h1>
        </section>

        <!-- Main content -->
        <form method="post" action="<?php echo base_url('users/isi_alamat.php') ?>">
        <section class="content">
          <div class="row">
            <?php require_once('../layout/sidebar.php'); ?>
            <div class="col-md-9">
              <div style="" class="box box-success">
                <div class="box-header">
                  <h4>Invoice</h4>
                  <hr>
                </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table borderless">
                      <tr>
                        <th width="20%">Pembeli</th>
                        <td width="40%">: <?php echo $data_transaksi['nama_pembeli'];?></td>
                        <th width="10%">Kurir</th>
                        <td>: <?php echo $data_transaksi['nama_kurir'];?></td>
                      </tr>
                      <tr>
                        <th>Nomor</th>
                        <td>: <?php echo $data_transaksi['no_transaksi'];?></td>
                        <th>No HP</th>
                        <td>: <?php echo $data_transaksi['no_hp_kurir'];?></td>
                      </tr>
                      <tr>
                        <th>Tanggal</th>
                        <td colspan="3">: <?php echo tanggal_indo($data_transaksi['tanggal']);?></td>
                      </tr>
                      <tr>
                        <th>Alamat Pengiriman</th>
                        <td colspan="3">: <?php echo $data_transaksi['alamat'];?></td>
                      </tr>
                    </table>
                  </div>
                <div class="box-body">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                      <tr>
                        <th width="50%">Produk</th>
                        <th width="20%">Harga</th>
                        <th width="10%">Qty</th>
                        <th width="20%">Subtotal</th>
                      </tr>
                      </thead>
                      <tbody>
                      <?php
                      $sql_detail_transaksi = "SELECT produk.nama as nama_produk, detail_transaksi.* FROM detail_transaksi
                      JOIN produk ON produk.no_produk=detail_transaksi.no_produk
                      WHERE detail_transaksi.no_transaksi='" . $no_transaksi . "'";
                      $query_detail = mysqli_query($con, $sql_detail_transaksi);
                      while($row = mysqli_fetch_array($query_detail)) {
                      ?>
                      <tr>
                        <td><?php echo $row['nama_produk'];?></td>
                        <td><?php echo format_uang($row['harga']);?></td>
                        <td><?php echo $row['jumlah'];?></td>
                        <td><?php echo format_uang($row['subtotal']);?></td>
                      </tr>
                      <?php
                      }
                      ?>
                      <tr>
                        <th colspan="3">Total</th>
                        <th><?php echo format_uang($data_transaksi['total_harga']);?></th>
                      </tr>
                      </tbody>
                    </table>
                  </div>

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
