<?php
  define("load_pagination", true);
  require_once('../system/engine.php');
 
  define("SITE_TITLE", 'Produk list');
  define("menu_produk", true);

  $current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
  $total_row = 0;
  $limit_page = 8;
  $query_string = $_GET;
  $no_kategori = (!empty($_GET['no_kategori'])) ? $_GET['no_kategori'] : '';
  if(!empty($_GET['cari'])) {
      $sql = "SELECT kategori_produk.slug as kategori_slug, kategori_produk.nama as nama_kategori, produk.* FROM produk 
      JOIN kategori_produk ON kategori_produk.no_kategori=produk.no_kategori
      WHERE produk.nama LIKE '%" . mysqli_real_escape_string($con, $_GET['cari']) . "%'";

      if($no_kategori != '') {
        $sql .= " AND produk.no_kategori='" . mysqli_real_escape_string($con, $no_kategori) . "'";
      }

      $sql .= " ORDER BY produk.no_produk DESC";
      $total_row = mysqli_num_rows(mysqli_query($con, $sql));
  } else {
      $sql = "SELECT kategori_produk.slug as kategori_slug, kategori_produk.nama as nama_kategori, produk.* FROM produk 
      JOIN kategori_produk ON kategori_produk.no_kategori=produk.no_kategori
      ORDER BY produk.no_produk DESC";
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
              <a class="btn btn-sm btn-default pull-right" href="<?php echo base_url('produk');?>"><i class="fa fa-chevron-left"></i> Kembali</a>
              <?php }else{ ?>
              <small>Produk kami</small>
              <?php } ?>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
 
          <?php
          require_once('../layout/sidebar.php');
          ?>

          <div class="col-md-9">
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

          <?php $i = 1;

               while($res = mysqli_fetch_array($data_produk)) {

                $url_produk = $config['url_rewrite'] ? $res['kategori_slug'] . '/' . $res['slug'] . '.html' : 'produk/detail.php?kategori=' . $res['kategori_slug'] . '&slug=' . $res['slug'];

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
                  <a href="<?php echo base_url($url_produk); ?>">
                    <div class="image"><img src="<?php echo base_url('uploads/foto/' .$res['foto']); ?>"></div>
                  </a>
                </div>
                <div class="box-footer" style="padding-bottom: 0px">
                  <p><label><a href="<?php echo base_url($url_produk); ?>" class="text-black"><?php echo $res['nama']; ?></span></a></label><br/>
                  <label class="text-danger"><small><?php echo format_uang($res['harga']); ?></small></label><br/>
                  <small><i class="fa fa-tag"></i> <?php echo $res['nama_kategori']; ?></small></p>
                  <p><a href="<?php echo base_url($url_produk); ?>" class="btn btn-block btn-xs btn-green"><i class="fa fa-search"></i> Selengkapnya</a></p>
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
