<?php
    require_once('../system/engine.php');

    define('ON_KERANJANG', true);
    define("SITE_TITLE", 'Produk list');


    require_once('layout/header.php'); ?>


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
        <form method="post" action="<?php echo base_url('users/user/checkout_proses.php') ?>">
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
                    
                    <tr>
                      <td><div class="img"><img src="#"></div></td>
                      <td><a href="#">Sauran Basi</a></td> 
                      <td><?php echo format_uang(600000); ?></td>
                      <td class="text-center"> 
                      <select data-id="1" class="form-control jumlah_update" name="jumlah">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                      </select> 

                      </td>
                      <td class="text-center"><a class="btn btn-xs btn-danger" href="#"><i class="fa fa-trash"></i> hapus</a></td>
                    </tr>   
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
              <a href="<?php echo base_url('users/user') ?>" class="btn btn-default pull-left" ><i class="fa fa-shopping-bag"></i> Kembali berbelanja</a>
              <button type="submit" value="1" name="submit" class="btn btn-primary pull-right" ><i class="fa fa-credit-card"></i> Checkout</button>
              </div><!--box footer-->
            </div><!--box-->   
        </section><!-- /.content -->
        </form>
        </div><!-- /.container -->
    </div><!-- /.content-wrapper -->


    <?php  require_once('layout/footer.php'); ?>
    <script type="text/javascript">
      $('.jumlah_update').on('change', function() {
          var uri = "<?php echo base_url() ?>users/user/keranjang_update_stok.php";
          var keranjang_id = $(this).data('id');
          var value = $(this).val();
          $.ajax({
              type:'POST',
              dataType:'json',
              data: {id : keranjang_id, update : value} ,
              url: uri,
              complete :function(data){ 
                  location.reload();         
              }

          });
      });
    </script>
    
