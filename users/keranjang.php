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
  </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
              Keranjang <small>Keranjang belanja anda</small>
          </h1>
        </section>

        <!-- Main content -->
        <form method="post" action="<?php echo base_url('users/keranjang_proses.php') ?>">
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
                <strong>Keranjang belanja </strong>
              </div>  
              <div class="box-body">
                <div class="table-responsive">
                <table class="table table-bordered">
                  <tr>
                    <th width="10%">Produk</th>
                    <th>Nama</th> 
                    <th width="18%">Harga</th>
                    <th width="10%">Jumlah</th>
                    <th width="10%"></th>
                  </tr> 
                  <?php
                  foreach(daftar_keranjang() as $keranjang) {

                    $data_produk = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM produk WHERE no_produk='" . $keranjang['id'] . "'"));
                  ?>
                    <tr>
                      <td><div class="img"><img src="<?php echo base_url('uploads/foto/' .$data_produk['foto']); ?>"></div></td>
                      <td><a href="<?php echo base_url('produk/detail.php?slug=' . $data_produk['slug']);?>"><?php echo $data_produk['nama'];?></a></td> 
                      <td><?php echo format_uang($data_produk['harga']); ?></td>
                      <td class="text-center"> 
                        <input type="number" data-id="<?php echo $keranjang['id'];?>" class="form-control jumlah_update" name="jumlah" value="<?php echo $keranjang['qty'];?>">
                      </td>
                      <td class="text-center"><a class="btn btn-xs btn-danger" href="<?php echo base_url('users/keranjang.php?hapus=' . $keranjang['id']);?>"><i class="fa fa-trash"></i> hapus</a></td>
                    </tr>
                  <?php } ?> 
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
              <a href="<?php echo base_url('produk/') ?>" class="btn btn-default pull-left" ><i class="fa fa-shopping-bag"></i> Kembali berbelanja</a>
              <button type="submit" value="1" name="submit" class="btn btn-primary pull-right" ><i class="fa fa-credit-card"></i> Checkout</button>
              </div><!--box footer-->
            </div><!--box-->   
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
                  location.reload();         
              }

          });
      });
    </script>
    
