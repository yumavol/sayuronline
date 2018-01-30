<?php
    require_once('../system/engine.php');
    require_once('../system/keranjang.php');

    define('ON_KERANJANG', true);
    define("SITE_TITLE", 'Produk list');

    if(isset($_GET['hapus'])) {
      hapus_keranjang($_GET['hapus']);
      redirect(base_url('users/keranjang.php'));
    }

    if(isset($_GET['update']) && isset($_GET['qty'])) {
      update_keranjang($_GET['update'], $_GET['qty']);
      die();
    }

    if(isset($_POST['id'])){
      $produk_id = $_POST['id'];

      tambah_keranjang($produk_id);


    }
    require_once('../layout/header.php');

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
    .pemisah {
      margin: 0 0 10px 0;
    }


  </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
              Data Pengiriman <small>#</small>
              <a href="<?php echo base_url('users/keranjang') ?>" class="btn btn-default pull-right" ><i class="glyphicon glyphicon-shopping-cart"></i> Kembali</a>
          </h1>

        </section>

        <!-- Main content -->
        <form method="post" action="<?php echo base_url('users/pembayaran.php') ?>">
        <section class="content">
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
            <div style="" class="box box-primary">
              <div class="box-header">
                <h3 class="box-title">Rincian Transaksi</h3>
              </div>
              <div class="box-body">
                <div class="table-responsive">
                <table class="table table-striped">
                  <tr>
                    <th>Nama</th>
                    <th width="18%">Harga</th>
                    <th width="10%">Qty</th>
                    <th width="10%">Sub Total</th>
                  </tr>
                  <?php
                  $totalharga=0;
                  foreach(daftar_keranjang() as $keranjang) {

                    $data_produk = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM produk WHERE no_produk='" . $keranjang['id'] . "'"));
                  ?>
                    <tr>
                      <td><?php echo $data_produk['nama'];?></td>
                      <td><?php echo format_uang($data_produk['harga']); ?></td>
                      <td>
                        <?php echo $keranjang['qty'];?>
                      </td>
                      <td><?php echo format_uang($data_produk['harga']*$keranjang['qty']); ?></td>
                  <?php
                    $totalharga = $totalharga + ($data_produk['harga'] * $keranjang['qty']) ;
                } ?>
                <tr>
                  <th colspan="3  ">Total</th>
                  <th width="18%"><?php echo format_uang($totalharga) ?></th>
                </tr>
                </table>
                </div>
              </div><!--box body-->
              <hr class="pemisah">
              <div class="box-header">
              <h3 class="box-title">Data Pengiriman</h3>
              </div>
              <div class="box-body">
                <div class="form-group">
                  <label for="nama-penerima">Name Penerima</label>
                  <input type="text" name="nama-penerima" class="form-control" id="nama-penerima">
                </div>
                <div class="form-group">
                  <label for="alamat-tujuan">Alamat Pengiriman</label>
                  <select name="alamat-tujuan" class="form-control" id="alamat-tujuan" onchange="valAlamat1()" required>
                    <option value="">-</option>
                    <option value="Alamat-1">Alamat 1</option>
                    <option value="Alamat-2">Alamat 2</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="alamat-baru">Alamat Baru</label>
                  <input type="text" name="alamat-baru" class="form-control" id="alamat-baru">
                  <p class="help-block pull-right">Alamat baru akan ditambahkan ke list alamat</p>
                </div>

              </div>
              <div class="box-footer">

              <button type="submit" value="1" name="submit" class="btn btn-primary pull-right" ><i class="fa fa-credit-card"></i> Bayar</button>
              </div><!--box footer-->
            </div><!--box-->
        </section><!-- /.content -->
        </form>
        </div><!-- /.container -->
    </div><!-- /.content-wrapper -->


    <?php  require_once('../layout/footer.php'); ?>
    <script type="text/javascript">
    function valAlamat1() {
      var stat ="";
      var alamat_value = document.getElementById('alamat-tujuan').value;
      if(alamat_value == '') {
        $( "#alamat-baru" ).prop( "disabled", false );
      } else {
        $( "#alamat-baru" ).prop( "disabled", true );
      }

    }
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
                  location.reload();
              }

          });
      });


    </script>
