<?php
define("load_pagination", true);
require_once('../system/engine.php');


define("menu_kelola_transaksi", true);
define("SITE_TITLE", 'Kelola Transaksi');


$current_page = (!empty($_GET['page'])) ? $_GET['page'] : 0;
$total_row = 0;
$query_string = $_GET;
$status = (!empty($_GET['status'])) ? $_GET['status'] : '';

if(!empty($_GET['cari'])) {
    $sql = "SELECT user.nama as pembeli, IFNULL(petugas_kurir.nama, '-') as kurir,
    transaksi.*
    FROM transaksi
    JOIN user ON user.id_user=transaksi.id_user
    LEFT JOIN petugas_kurir ON petugas_kurir.id_petugas=transaksi.id_petugas
    WHERE user.nama LIKE '%" . mysqli_real_escape_string($con, $_GET['cari']) . "%'";

    if(in_array($status, array('Sedang Diproses', 'Sedang Dikirim', 'Berhasil', 'Gagal'))) {
        $sql .= " AND transaksi.status='" . mysqli_real_escape_string($con, $status) . "'";
    }

    $total_row = mysqli_num_rows(mysqli_query($con, $sql));
} else {
    $sql = "SELECT user.nama as pembeli, IFNULL(petugas_kurir.nama, '-') as kurir,
    transaksi.*
    FROM transaksi
    JOIN user ON user.id_user=transaksi.id_user
    LEFT JOIN petugas_kurir ON petugas_kurir.id_petugas=transaksi.id_petugas";

    if(in_array($status, array('Sedang Diproses', 'Sedang Dikirim', 'Berhasil', 'Gagal'))) {
        $sql .= " WHERE transaksi.status='" . mysqli_real_escape_string($con, $status) . "'";
    }

    $total_row = mysqli_num_rows(mysqli_query($con, $sql));
}
require_once('layout/header.php');

function status_transaksi($status) {
    if($status == 'Sedang Diproses') {
        return '<label class="label label-warning">' . $status . '</label>';
    } elseif($status == 'Sedang Dikirim') {
        return '<label class="label label-primary">' . $status . '</label>';
    } elseif($status == 'Berhasil') {
        return '<label class="label label-success">' . $status . '</label>';
    } elseif($status == 'Gagal') {
        return '<label class="label label-danger">' . $status . '</label>';
    }
    return $status;
}
?>
 

      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
                  Kelola Transaksi
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
                                    Daftar Transaksi
                                </h3>
                                <div class="box-tools">
                                    <form action="" method="get" class="form-horizontal">
                                        <div class="col-md-4 col-md-offset-7">
                                        <div class="input-group">
                                          <input type="text" name="cari" class="form-control" placeholder="Search for..." value="<?php echo (!empty($_GET['cari'])) ? $_GET['cari'] : '';?>">

                                          <div class="input-group-btn ">
                                            <select class="form-control" name="status">
                                                <option value="" <?php echo ($status == '') ? 'selected' : '';?>>Semua</option>
                                                <option value="Sedang Diproses" <?php echo ($status == 'Sedang Diproses') ? 'selected' : '';?>>Sedang Diproses</option>
                                                <option value="Sedang Dikirim" <?php echo ($status == 'Sedang Dikirim') ? 'selected' : '';?>>Sedang Dikirim</option>
                                                <option value="Berhasil" <?php echo ($status == 'Berhasil') ? 'selected' : '';?>>Berhasil</option>
                                                <option value="Gagal" <?php echo ($status == 'Gagal') ? 'selected' : '';?>>Gagal</option>
                                            </select>
                                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Cari!</button>
                                          </div>
                                        </div><!-- /input-group -->
                                        </div>
                                    </form>
                                </div><!-- /.box-tools -->
                            </div><!-- /.box-header -->
                            <div class="box-body no-padding">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr >
                                        <th width="25%" class="text-left">Nama Pembeli</th>
                                        <th width="25%" class="text-left">Kurir</th>
                                        <th width="15%" class="text-left">Tanggal</th>
                                        <th width="15%" class="text-center">Status</th>
                                        <th class="pull-right"></th>
                                    </tr> 
                                    <?php
                                    $sql .= " ORDER BY transaksi.tanggal DESC";
                                    $sql .= " LIMIT " . $current_page . ", 10";
                                    $query = mysqli_query($con, $sql); 
                                    while($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['pembeli'];?></td>
                                        <td><?php echo $row['kurir'];?></td>
                                        <td><?php echo tanggal_indo($row['tanggal'], true);?></td>
                                        <td class="text-center"><?php echo status_transaksi($row['status']);?></td>
                                        <td class="text-center">
                                        <a href="<?php echo base_url('penjual/kelola_produk_ubah.php?no_produk=' . $row['no_produk']);?>" class="btn btn-primary btn-xs"><i class="fa fa-truck"></i> Isi Kurir</a>
                                        <a href="<?php echo base_url('penjual/kelola_produk_hapus.php?no_produk=' . $row['no_produk']);?>" class="btn btn-warning btn-xs"><i class="fa fa-sticky-note-o"></i> Ubah Status</a>
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
