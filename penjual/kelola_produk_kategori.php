<?php
define("load_pagination", true);
require_once('../system/engine.php');


define("menu_kelola_produk_kategori", true);
define("SITE_TITLE", 'Kelola Kategori Produk');

$current_page = (!empty($_GET['page'])) ? $_GET['page'] : 0;
$total_row = 0;
$query_string = $_GET;
if(!empty($_GET['cari'])) {
    $sql = "SELECT * FROM kategori_produk
    WHERE nama LIKE '%" . mysqli_real_escape_string($con, $_GET['cari']) . "%'";
    $total_row = mysqli_num_rows(mysqli_query($con, $sql));
} else {
    $sql = "SELECT * FROM kategori_produk";
    $total_row = mysqli_num_rows(mysqli_query($con, $sql));
}

require_once('layout/header.php');
?>



      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
              <h1>
                  Tambah Kategori Produk
                  <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url('penjual/kelola_produk_kategori_tambah.php');?>"><i class="fa fa-plus"></i> Tambah Kategori</a>
              </h1>
          </section>

                <section class="content">
                  <?php
                  // validasi
                  if(has_flashdata('sukses')) {
                    echo alert_sukses(get_flashdata('sukses'));
                  }
                  if(has_flashdata('error')) {
                    echo alert_error(get_flashdata('error'));
                  }
                  ?>
                  <div class="row">
                      <div class="col-md-12">
                          <div class="box">
                              <div class="box-header with-border">
                                  <h3 class="box-title">Daftar Kategori Produk</h3>
                                  <div class="box-tools pull-right">
                                    <form action="" method="get" class="form-horizontal">
                                        <div class="input-group pull-right col-md-4">
                                          <input type="text" name="cari" class="form-control" placeholder="Search for..." value="">
                                          <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Cari!</button>
                                          </span>
                                        </div><!-- /input-group -->
                                    </form>
                                  </div><!-- /.box-tools -->
                              </div><!-- /.box-header -->
                              <div class="box-body no-padding">
                                  <table class="table table-hover">
                                      <tr>
                                          <th  class="text-center" width="85%">Nama Kategori</th>
                                          <th></th>
                                      </tr>
                                      <?php
                                      $sql .= " LIMIT " . $current_page . ", 10";
                                      $query = mysqli_query($con, $sql);
                                      while($row = mysqli_fetch_array($query)) {
                                      ?>
                                      <tr>
                                          <td class="text-center"><?php echo $row['nama'];?></td>
                                          <td class="text-center">
                                          <a href="<?php echo base_url('penjual/kelola_produk_kategori_ubah.php?no_kategori=' . $row['no_kategori']);?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> edit</a>
                                          <a href="<?php echo base_url('penjual/kelola_produk_kategori_hapus.php?no_kategori=' . $row['no_kategori']);?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> hapus</a>
                                          </td>
                                      </tr>
                                      <?php
                                      }
                                      ?>
                                  </table>
                              </div><!-- /.box-body -->
                              <div class="box-footer">
                                  <?php
                                  echo pagination(base_url('penjual/kelola_produk.php'), $total_row, 10, $current_page, $query_string);
                                  ?>
                              </div><!-- box-footer -->
                          </div><!-- /.box -->
                      </div><!-- /.col -->
                  </div><!-- /.row -->
                </section>
</div>

    <?php  require_once('../layout/footer.php'); ?>
