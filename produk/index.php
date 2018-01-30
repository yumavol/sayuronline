<?php
  define("load_pagination", true);
  require_once('../system/engine.php');

  define('ON_KERANJANG', true);
  define("SITE_TITLE", 'Produk list');


  $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
  $total_row = 0;
  $limit_page = 12;
  $query_string = $_GET;
  if(!empty($_GET['cari'])) {
      $sql = "SELECT * FROM produk
      WHERE nama LIKE '%" . mysqli_real_escape_string($con, $_GET['cari']) . "%'";

      $total_row = mysqli_num_rows(mysqli_query($con, $sql));
  } else {
      $sql = "SELECT * FROM produk";
      $total_row = mysqli_num_rows(mysqli_query($con, $sql));
  } 
   
  $sql .= " LIMIT " . (($current_page - 1) * $limit_page) . ", $limit_page";  
  $data_produk = mysqli_query($con, $sql);

  
  

    require_once('../layout/header.php'); ?>


    <style type="text/css">
      .image{
        width: 100%;
        overflow: hidden;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        max-height: 183px;
        min-height: 183px;
      }
      .image img{
        width: 100%;
      }
      .a-disabled{
        color: #555;  
      }
      .a-disabled:hover{
        color: #555;
      }
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
              Produk 
              <?php if(isset($_GET['cari'])) { ?>
              <small>Pencarian dengan kata kunci "<?php echo $_GET['cari']; ?>"</small>
              <?php }else{ ?>
              <small>Produk kami</small>
              <?php } ?>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
          
          <?php
          if(has_flashdata('error')) {
            echo alert_error(get_flashdata('error'));
          }
          require_once('../layout/sidebar.php');
          ?>
          
          <div class="col-md-9">
          <?php $i = 1; 

               while($res = mysqli_fetch_array($data_produk)) { 
               if(($i == 1)){ ?>
            <div class="row"><!-- row product -->
          <?php } //end if 
               if(($i % 5 == 0)){ ?>

            </div><!-- ./row product -->

            <div class="row"><!-- row product -->
         <?php  } //end if ?> 

            <div class="col-md-3">
              <div class="box box-solid">
                <div class="box-body no-padding">

                  <div class="image"><img src="<?php echo base_url('uploads/foto/' .$res['foto']); ?>"></div>
                </div>
                <div class="box-footer" style="padding-bottom: 0px">
                  <p><label><?php echo format_uang($res['harga']); ?></span></label></p>
                  <p><label><small><?php echo $res['nama']; ?></small></label></p>
                  <p><a href="<?php echo base_url('produk/detail.php?slug=').$res['slug'] ?>" class="btn btn-block btn-xs btn-info"><i class="fa fa-long-arrow-left"></i> Selengkapnya</a></p>
                </div>
              </div><!-- /.box --> 
            </div>

            <?php $i++; ?>
            <?php } ?>            
            </div><!-- /.row --> 

              <?php
              echo pagination(base_url('produk/index.php'), $total_row, $limit_page, $current_page, $query_string);
              ?>
            

          </div><!-- /.col -->
        </div><!-- /.row -->
        </section>
        <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->


    <?php  require_once('../layout/footer.php'); ?>
    <script type="text/javascript">
      

    </script>
