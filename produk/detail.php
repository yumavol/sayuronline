<?php
require_once('../system/engine.php');

    define('ON_KERANJANG', true);
    define("SITE_TITLE", 'Produk list');
    define("menu_produk", true);

    $data = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM produk WHERE slug='" . mysqli_real_escape_string($con, $_GET['slug']) . "'"));

    require_once('../layout/header.php'); ?>

    <style type="text/css">
      .image{
        overflow: hidden;
        border-top-left-radius: 3px;
        border-top-right-radius: 3px;
        max-height: 300px;
      }
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->

        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
              Produk <small>Produk kami</small>
              <a class="btn btn-sm btn-default pull-right" href="<?php echo base_url('produk');?>"><i class="fa fa-chevron-left"></i> Kembali</a>
          </h1>
        </section>

        <!-- Main content -->
        <form id="form-input" method="post" action="<?php echo base_url('users/keranjang.php'); ?>">
        <section class="content">
            <div style="min-height: 490px" class="box box-primary">
              <div class="box-header">
              <strong>Kategori Barang</strong>
              <button type="submit" value="1" name="submit" class="pull-right btn btn-sm btn-primary"><i class="fa fa-shopping-bag"></i> Tambah Ke keranjang</button>
              </div>
              <div class="box-body">
                <div class="row">
                  <div class="col-md-4 ">

                    <div class="image">
                      <img src="<?php echo base_url('uploads/foto/' . $data['foto']); ?>">
                    </div>

                  </div><!-- end col -->

                  <div class="col-md-6">
                    <p><h3><strong><?php echo $data['nama'] ?></strong></h3></p>
                    <blockquote>
                      <small><?php echo $data['deskripsi'] ?></small>
                    </blockquote>
                    <br>
                    <span class="btn-sm bg-gray" ><strong><?php echo format_uang($data['harga']) ?></strong></span>

                  </div>
                </div><!--row-->
                </div><!--box body-->
            </div><!--box-->
        </section><!-- /.content -->
        <input type="hidden" name="id" value="<?php echo $data['no_produk'] ?>">
        </form>
        </div><!-- /.container -->
    </div><!-- /.content-wrapper -->


    <?php  require_once('../layout/footer.php'); ?>

    <script type="text/javascript">


      </script>
