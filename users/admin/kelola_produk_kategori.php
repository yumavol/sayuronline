    <?php
    require_once('../../../system/engine.php');


    define("menu_kelola_produk_kategori", true);
    define("SITE_TITLE", 'Kelola produk');
 
    require_once('../layout/header.php');
    ?>
 

      
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
              <h1>
                  Tambah Produk
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
                                  <h3 class="box-title">Daftar Kategori Produk</h3>
                                  <div class="box-tools pull-right">
                                      <!-- Buttons, labels, and many other things can be placed here! -->
                                      <!-- Here is a label for example -->
                                      <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Tambah Kategori</a>
                                  </div><!-- /.box-tools -->
                              </div><!-- /.box-header -->
                              <div class="box-body no-padding">
                                  <table class="table table-hover">
                                      <tr>
                                          <th  class="text-center">Nama Kategori</th>
                                          <th width="20%" class="text-center">Jumlah Produk</th>
                                          <th width="15%"></th>
                                      </tr> 
                                      <tr>
                                          <td class="text-center">Sayuran</td>
                                          <td class="text-center">60</label></td>
                                          <td>
                                          <a href="#" class="btn btn-info btn-xs edit_kategori_produk"><i class="fa fa-pencil"></i> edit</a>
                                          <a href="" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> hapus</a>
                                          </td>
                                      </tr> 
                                  </table>
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


        <!-- Modal Tambah-->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Tambah Kategori</h4>
              </div>
              <div class="modal-body">
                <form action="" method="post">
                  <div class="form-group">
                    <label for="nama" class="control-label">Nama Kategori:</label>
                    <input type="text" class="form-control" id="nama" name="nama">
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Tambah Kategori</button>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- Modal Edit-->
        <div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modal_edit">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Kategori</h4>
              </div>
              <div class="modal-body">
                <form action="" method="post">
                    <input type="hidden" name="id" id="id_kategori">
                  <div class="form-group">
                    <label for="nama_kategori" class="control-label">Nama Kategori:</label>
                    <input type="text" class="form-control" id="nama_kategori" name="nama">
                  </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan Kategori</button>
                </form>
              </div>
            </div>
          </div>
        </div>



    <?php  require_once('../layout/footer.php'); ?>
