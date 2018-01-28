<?php
define("load_pagination", true);
require_once('../system/engine.php');


define("menu_kelola_produk", true);
define("SITE_TITLE", 'Kelola Produk');


$current_page = (!empty($_GET['page'])) ? $_GET['page'] : 0;
$total_row = 0;
$query_string = $_GET;
if(!empty($_GET['cari'])) {
    $sql = "SELECT kategori_produk.nama as kategori, produk.* FROM produk 
    JOIN kategori_produk ON kategori_produk.no_kategori=produk.no_kategori
    WHERE produk.nama LIKE '%" . mysqli_real_escape_string($con, $_GET['cari']) . "%'";

    $total_row = mysqli_num_rows(mysqli_query($con, $sql));
} else {
    $sql = "SELECT kategori_produk.nama as kategori, produk.* FROM produk 
    JOIN kategori_produk ON kategori_produk.no_kategori=produk.no_kategori";
    $total_row = mysqli_num_rows(mysqli_query($con, $sql));
}
require_once('layout/header.php');
?>
 

      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
                  Kelola Produk
              
                <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url('penjual/kelola_produk_tambah.php');?>"><i class="fa fa-plus"></i> Tambah Produk</a>
            </h1>
          </section>

          <!-- Main content -->
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
                                <h3 class="box-title">
                                    Daftar Produk
                                </h3>
                                <div class="box-tools pull-right">
                                    <form action="" method="get" class="form-horizontal">
                                        <div class="input-group pull-right col-md-4">
                                          <input type="text" name="cari" class="form-control" placeholder="Search for..." value="<?php echo (!empty($_GET['cari'])) ? $_GET['cari'] : '';?>">
                                          <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Cari!</button>
                                          </span>
                                        </div><!-- /input-group -->
                                    </form>
                                </div><!-- /.box-tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body no-padding">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr >
                                        <th width="25%" class="text-left">Nama Produk</th>
                                        <th width="25%" class="text-left">Kategori</th>
                                        <th width="15%" class="text-left">Harga</th>
                                        <th width="15%" class="text-center">Foto</th>
                                        <th class="pull-right"></th>
                                    </tr> 
                                    <?php
                                    $sql .= " LIMIT " . $current_page . ", 10";
                                    $query = mysqli_query($con, $sql); 
                                    while($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['nama'];?></td>
                                        <td><?php echo $row['kategori'];?></td>
                                        <td><?php echo $row['harga'];?></td>
                                        <td class="text-center"><img src="<?php echo base_url('uploads/foto/' . $row['foto']);?>" width="100" height="80"></td>
                                        <td class="text-center">
                                        <a href="<?php echo base_url('penjual/kelola_produk_ubah.php?no_produk=' . $row['no_produk']);?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> edit</a>
                                        <a href="<?php echo base_url('penjual/kelola_produk_hapus.php?no_produk=' . $row['no_produk']);?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> hapus</a>
                                        </td>
                                    </tr> 
                                    <?php
                                    }
                                    ?>
                                </table>
                            </div><!-- /.respo -->
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
            <!-- /.content --> 
        </div>
        <!-- /.content-wrapper -->


    <?php  require_once('../layout/footer.php'); ?>
