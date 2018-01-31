<?php
define("load_pagination", true);
require_once('../system/engine.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
} else if(get_session('tipe_user') != 'penjual') {
    set_flashdata('error', 'Anda tidak mempunyai hak untuk membuka halaman tersebut.');
    redirect(base_url());
}

define("menu_kelola_transaksi", true);
define("SITE_TITLE", 'Kelola Transaksi');


$current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
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
    if($status == 'Menunggu Bukti Transfer') {
        return '<label class="label label-warning">' . $status . '</label>';
    } elseif($status == 'Sedang Diproses') {
        return '<label class="label label-info">' . $status . '</label>';
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
                                            <select class="form-control" name="status" style="width: 90px;">
                                                <option value="" <?php echo ($status == '') ? 'selected' : '';?>>Semua</option>
                                                <option value="Menunggu Bukti Transfer" <?php echo ($status == 'Menunggu Bukti Transfer') ? 'selected' : '';?>>Menunggu Bukti Transfer</option>
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
                                        <th width="20%" class="text-left">Nama Pembeli</th>
                                        <th width="15%" class="text-left">Kurir</th>
                                        <th width="15%" class="text-left">Tanggal</th>
                                        <th width="10%" class="text-center">Status</th>
                                        <th class="pull-right"></th>
                                    </tr> 
                                    <?php
                                    $sql .= " ORDER BY transaksi.tanggal DESC";
                                    $sql .= " LIMIT " . (($current_page - 1) * 10) . ", 10";
                                    $query = mysqli_query($con, $sql); 
                                    while($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $row['pembeli'];?></td>
                                        <td><?php echo $row['kurir'];?></td>
                                        <td><?php echo tanggal_indo($row['tanggal'], true);?></td>
                                        <td class="text-center"><?php echo status_transaksi($row['status']);?></td>
                                        <td class="text-center">
                                        <a href="<?php echo base_url('penjual/kelola_transaksi_detail.php?no_transaksi=' . $row['no_transaksi']);?>" class="btn btn-success btn-xs" data-transaksi="<?php echo $row['no_transaksi'];?>"><i class="fa fa-shopping-basket"></i> Lihat Transaksi</a>
                                        <button type="button" class="btn btn-primary btn-xs btn-isi-kurir" data-transaksi="<?php echo $row['no_transaksi'];?>" data-kurir="<?php echo $row['id_petugas'];?>"><i class="fa fa-truck"></i> Isi Kurir</button>
                                        <button type="button" class="btn btn-warning btn-xs btn-status-transaksi" data-transaksi="<?php echo $row['no_transaksi'];?>" data-status="<?php echo $row['status'];?>"><i class="fa fa-sticky-note-o"></i> Ubah Status</button>
                                        <button type="button" class="btn btn-success btn-xs btn-bukti-bayar" data-transaksi="<?php echo $row['no_transaksi'];?>"><i class="fa fa-money"></i> Bukti Pembayaran</button>
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
                                echo pagination(base_url('penjual/kelola_transaksi.php'), $total_row, 10, $current_page, $query_string);
                                ?>
                            </div><!-- box-footer -->
                        </div><!-- /.box -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </section>
            <!-- /.content --> 
        </div>
        <!-- /.content-wrapper -->

   <div id="modal-isi-kurir" class="modal fade " role="dialog">
      <div class="modal-dialog ">
        <form class="form-horizontal" action="<?php echo base_url('penjual/kelola_transaksi_kurir.php');?>" method="post">
        <input type="hidden" class="hidden-input-transaksi" name="no_transaksi" value="">
        <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Isi Kurir</h4>
            </div>
          
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">

                     <div class="form-group">
                        <label class="col-sm-2 control-label">Kurir</label> 
                        <div class="col-sm-10">
                           <select class="form-control" name="id_petugas" id="select-id-petugas">
                            <?php
                            $query_kurir = mysqli_query($con, "SELECT * FROM petugas_kurir ORDER BY nama ASC");
                            while($row = mysqli_fetch_array($query_kurir)) {
                                echo '<option value="' . $row['id_petugas'] . '">' . $row['nama'] . '</option>';
                            }
                            ?>
                           </select>
                        </div>
                     </div> 

                  </div><!-- ed col -->
               </div><!-- end row -->
            
            </div><!-- modal body -->

            <div class="modal-footer">
               <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               <button type="submit" name="submit" value="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div> 
        </form> 
      </div> 
   </div>  

   <div id="modal-ubah-status" class="modal fade " role="dialog">
      <div class="modal-dialog ">
        <form class="form-horizontal" action="<?php echo base_url('penjual/kelola_transaksi_status.php');?>" method="post">
        <input type="hidden" class="hidden-input-transaksi" name="no_transaksi" value="">
        <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Ubah Status Transaksi</h4>
            </div>
          
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">

                     <div class="form-group">
                        <label class="col-sm-2 control-label">Kurir</label> 
                        <div class="col-sm-10">
                           <select class="form-control" name="status" id="select-status-transaksi">
                                <option value="Sedang Diproses">Sedang Diproses</option>
                                <option value="Sedang Dikirim">Sedang Dikirim</option>
                                <option value="Berhasil">Berhasil</option>
                                <option value="Gagal">Gagal</option>
                           </select>
                        </div>
                     </div> 

                  </div><!-- ed col -->
               </div><!-- end row -->
            
            </div><!-- modal body -->

            <div class="modal-footer">
               <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               <button type="submit" name="submit" value="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Simpan</button>
            </div>
        </div> 
        </form> 
      </div> 
   </div>

   <div id="modal-pembayaran" class="modal fade " role="dialog">
      <div class="modal-dialog ">
        <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Bukti Pembayaran</h4>
            </div>
          
            <div class="modal-body" id="body-pembayaran">

            </div><!-- modal body -->

            <div class="modal-footer">
               <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div> 
      </div> 
   </div>  
    <?php 
    $js = array(
        'assets/js/penjual.js',
    );
    require_once('../layout/footer.php'); ?>
