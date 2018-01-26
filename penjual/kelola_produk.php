    <?php
    require_once('../system/engine.php');


    define("menu_kelola_produk", true);
    define("SITE_TITLE", 'Kelola produk');
 
    require_once('../layout/header.php');
    ?>
 

      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
              <h1>
                  Keloa Produk
              </h1>
          </section>

          <!-- Main content -->
          <section class="content">

                <!-- Main content -->
                <section class="content"> 
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Daftar Produk</h3>
                                    <div class="box-tools pull-right">
                                        <!-- Buttons, labels, and many other things can be placed here! -->
                                        <!-- Here is a label for example -->
                                        <a class="btn btn-primary btn-sm" href="tambah.php"><i class="fa fa-plus"></i> Tambah Produk</a>
                                    </div><!-- /.box-tools -->
                                </div><!-- /.box-header -->
                                <div class="box-body no-padding">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <tr >
                                            <th width="20%" class="text-left">Nama Produk</th>
                                            <th width="20%" class="text-left">Kategori</th>
                                            <th width="15%" class="text-left">Harga</th>
                                            <th width="10%" class="text-left">Stok</th>
                                            <th width="15%" class="text-center">Foto</th>
                                            <th class="pull-right"></th>
                                        </tr> 
                                        <tr>
                                            <td>Sayur Asem</td>
                                            <td>Buah buahan</td>
                                            <td>Rp. 50.000,00</td>
                                            <td>20kg</td> 
                                            <td class="text-center"><img src="#" width="100" height="80"></td>
                                            <td class="text-center">
                                            <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> edit</a>
                                            <a class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> hapus</a>
                                            </td>
                                        </tr> 
                                    </table>
                                </div><!-- /.respo -->
                                </div><!-- /.box-body -->
                                <div class="box-footer"> 
                                </div><!-- box-footer -->
                            </div><!-- /.box -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->


        </section>
        <!-- /.content --> 


    <?php  require_once('../layout/footer.php'); ?>
