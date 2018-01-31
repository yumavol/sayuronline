<?php
define("load_pagination", true);
require_once('../system/engine.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
} else if(get_session('tipe_user') != 'admin') {
    set_flashdata('error', 'Anda tidak mempunyai hak untuk membuka halaman tersebut.');
    redirect(base_url());
}

define("menu_kelola_user", true);
define("SITE_TITLE", 'Kelola User');


$current_page = (!empty($_GET['page'])) ? $_GET['page'] : 1;
$total_row = 0;
$query_string = $_GET;
$tipe_user = (!empty($_GET['tipe_user'])) ? $_GET['tipe_user'] : '';

if(!empty($_GET['cari'])) {
  $cari = mysqli_real_escape_string($con, $_GET['cari']);
  $sql = "SELECT * FROM user WHERE (nama LIKE '%" . $cari . "%' OR username LIKE '%" . $cari . "%' OR email LIKE '%" . $cari . "%')";

  if(in_array($tipe_user, array('admin', 'penjual', 'pembeli'))) {
      $sql .= " AND tipe_user='" . mysqli_real_escape_string($con, $tipe_user) . "'";
  }

  $total_row = mysqli_num_rows(mysqli_query($con, $sql));
} else {
  $sql = "SELECT * FROM user ";

  if(in_array($tipe_user, array('admin', 'penjual', 'pembeli'))) {
      $sql .= " WHERE tipe_user='" . mysqli_real_escape_string($con, $tipe_user) . "'";
  }
  $total_row = mysqli_num_rows(mysqli_query($con, $sql));
}

require_once('layout/header.php');


function tipe_user($tipe) {
  if($tipe == 'admin') {
    return '<label class="label label-success">' . $tipe . '</label>';
  } else if($tipe == 'penjual') {
    return '<label class="label label-warning">' . $tipe . '</label>';
  } else {
    return '<label class="label label-default">' . $tipe . '</label>';
  }
}
?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Kelola User
                <a class="btn btn-primary btn-sm pull-right" href="<?php echo base_url('admin/tambah_user.php');?>"><i class="fa fa-plus"></i> Tambah User</a>
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
                            <h3 class="box-title">Daftar User</h3>
                            <div class="box-tools">
                                <form action="" method="get" class="form-horizontal">
                                    <div class="col-md-4 col-md-offset-7">
                                    <div class="input-group">
                                      <input type="text" name="cari" class="form-control" placeholder="Search for..." value="<?php echo (!empty($_GET['cari'])) ? $_GET['cari'] : '';?>">

                                      <div class="input-group-btn ">
                                        <select class="form-control" name="tipe_user">
                                            <option value="" <?php echo ($tipe_user == '') ? 'selected' : '';?>>Semua</option>
                                            <option value="admin" <?php echo ($tipe_user == 'admin') ? 'selected' : '';?>>Admin</option>
                                            <option value="penjual" <?php echo ($tipe_user == 'penjual') ? 'selected' : '';?>>Penjual</option>
                                            <option value="pembeli" <?php echo ($tipe_user == 'pembeli') ? 'selected' : '';?>>Pembeli</option>
                                        </select>
                                        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i> Cari!</button>
                                      </div>
                                    </div><!-- /input-group -->
                                    </div>
                                </form>
                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body">
                          <div class="table-responsive">
                            <table class="table table-bordered">
                              <thead>
                                <tr>
                                  <th width="20%">Nama</th>
                                  <th width="15%">Username</th>
                                  <th width="20%">Email</th>
                                  <th width="15%">No. HP</th>
                                  <th width="10%">Tipe</th>
                                  <th></th>
                              </thead>
                              <tbody>
                                <?php
                                $sql .= " LIMIT " . (($current_page - 1) * 10) . ", 10";
                                $query = mysqli_query($con, $sql); 
                                while($row = mysqli_fetch_array($query)) {
                                ?>
                                <tr>
                                    <td><?php echo $row['nama'];?></td>
                                    <td><?php echo $row['username'];?></td>
                                    <td><?php echo $row['email'];?></td>
                                    <td><?php echo $row['no_hp'];?></td>
                                    <td class="text-center"><?php echo tipe_user($row['tipe_user']);?></td>
                                    <td class="text-center">
                                    <a href="<?php echo base_url('admin/ubah_user.php?id_user=' . $row['id_user']);?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> edit</a>
                                    <a href="<?php echo base_url('admin/hapus_user.php?id_user=' . $row['id_user']);?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> hapus</a>
                                    </td>
                                </tr> 
                                <?php
                                }
                                ?>
                              </tbody>
                            </table>
                          </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer"> 
                          <?php
                          echo pagination(base_url('admin/kelola_user.php'), $total_row, 10, $current_page, $query_string);
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
