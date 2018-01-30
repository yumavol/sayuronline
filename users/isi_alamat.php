<?php
    require_once('../system/engine.php');
    require_once('../system/keranjang.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
}

define('ON_KERANJANG', true);
define("SITE_TITLE", 'Produk list');

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
              <a href="<?php echo base_url('users/keranjang.php') ?>" class="btn btn-default pull-right" ><i class="glyphicon glyphicon-shopping-cart"></i> Kembali</a>
          </h1>

        </section>

        <!-- Main content -->
        <form method="post" action="<?php echo base_url('users/keranjang_proses.php') ?>">
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
                      </tr>
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
                    <label for="alamat-tujuan">Alamat Pengiriman</label>
                    <select name="id_alamat" class="form-control" id="alamat-tujuan" onchange="valAlamat1()">
                      <option value="">-</option>
                      <?php
                      $data_alamat = mysqli_query($con, "SELECT * FROM alamat WHERE id_user='" . get_session('id_user') . "'");
                      while($alamat = mysqli_fetch_array($data_alamat)) {
                        ?>
                      <option value="<?php echo $alamat['id_alamat'];?>"><?php echo $alamat['alamat'];?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="alamat-baru">Alamat Baru</label>
                    <input type="text" name="alamat_baru" class="form-control" id="alamat-baru">
                    <p class="help-block pull-right">Alamat baru akan ditambahkan ke list alamat</p>
                  </div>

                </div>
                <div class="box-footer">

                <button type="submit" value="1" name="submit" class="btn btn-primary pull-right" ><i class="fa fa-credit-card"></i> Bayar</button>
                </div><!--box footer-->
              </div><!--box-->
            </div>
          </table>
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
