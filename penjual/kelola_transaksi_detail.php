<?php
define("load_pagination", true);
require_once('../system/engine.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
} else if(get_session('tipe_user') != 'penjual') {
    set_flashdata('error', 'Anda tidak mempunyai hak untuk membuka halaman tersebut.');
    redirect(base_url());
}

define("menu_kelola_transaksi", true);
define("SITE_TITLE", 'Detail Transaksi');


require_once('layout/header.php');

$no_transaksi = mysqli_real_escape_string($con, $_GET['no_transaksi']);

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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaksi
        <small>#<?php echo $data_transaksi['no_transaksi'];?></small>
        <a class="btn btn-sm btn-default pull-right" href="<?php echo base_url('penjual/kelola_transaksi.php');?>"><i class="fa fa-chevron-left"></i> Kembali</a>
      </h1>
    </section>

    <!-- Main content -->
    <section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-shopping-basket"></i> SayurOnline.
            <small class="pull-right"><?php echo tanggal_indo($data_transaksi['tanggal'], true);?></small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 invoice-col">
          Pembeli
          <address>
            <strong><?php echo $data_transaksi['nama_pembeli'];?></strong><br>
            <?php echo $data_transaksi['alamat'];?><br>
            Phone: <?php echo $data_transaksi['no_hp_pembeli'];?><br>
            Email: <?php echo $data_transaksi['email'];?>
          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          Kurir :
          <address>
            <strong><?php echo $data_transaksi['nama_kurir'];?></strong><br>
            Phone : <?php echo $data_transaksi['no_hp_kurir'];?>
          </address>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th width="5%">Qty</th>
              <th width="55%">Produk</th>
              <th width="20%">Harga</th>
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
              <td><?php echo $row['jumlah'];?></td>
              <td><?php echo $row['nama_produk'];?></td>
              <td><?php echo format_uang($row['harga']);?></td>
              <td><?php echo format_uang($row['subtotal']);?></td>
            </tr>
            <?php
            }
            ?>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <!-- accepted payments column -->
        <div class="col-xs-6">

        </div>
        <!-- /.col -->
        <div class="col-xs-6">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>Total:</th>
                <td><?php echo format_uang($data_transaksi['total_harga']);?></td>
              </tr>
            </table>
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>
  </div>
  <!-- /.content-wrapper -->
    <?php
    $js = array(
        'assets/js/penjual.js',
    );
    require_once('../layout/footer.php'); ?>
