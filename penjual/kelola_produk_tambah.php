<?php
require_once('../system/engine.php');


define("menu_kelola_produk", true);
define("SITE_TITLE", 'kelola produk');

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
                        <div class="col-md-6">
                                  <form action="" method="POST" enctype="multipart/form-data">
                              <!-- Custom Tabs -->
                              <div class="box">
                                <div class="box-header">
                                <button class="btn btn-sm btn-primary pull-right" type="submit" value="1" name="submit"><i class="fa fa-save"></i> simpan</button>
                                <input type="hidden" name="foto" id="foto_produk" value="">
                                </div>
                                <div class="box-body">
                                    <div class="form-group">
                                      <label for="nama_produk">Nama</label>
                                      <input type="text" id="nama_produk" class="form-control" name="nama" placeholder="Nama ..." value="">
                                    </div>

                                    <div class="form-group">
                                      <label for="harga_produk">Harga</label>
                                      <input type="text" id="harga_produk" class="form-control" name="harga" placeholder="Harga ..." value="">
                                    </div>

                                    <div class="form-group">
                                      <label for="harga_produk">Stok</label> 
                                      <input type="number" class="form-control" name="stok" placeholder="" value="">
                                    </div> 

                                    <div class="form-group">
                                      <label>Kategori</label>
                                      <select class="form-control" name="kat_id" id="kat_id">
                                        <option value="">-</option>
                                        <option value="">Sayur</option>
                                      </select>
                                    </div>

                                    <div class="form-group">
                                      <label>Deskripsi</label>
                                      <textarea class="form-control" style="height: 200px" name="deskripsi" rows="5" cols="20"> </textarea>
                                    </div>

                                </div><!-- /.box body -->
                                  </form>
                            </div><!--box-->      

                        </div><!-- /.col -->

                        <div class="col-md-6">
                            <div class="box">
                                <div class="box-body">
                                    <form id="fileupload" action="" method="POST" enctype="multipart/form-data">
                                        <!-- Redirect browsers with JavaScript disabled to the origin page -->
                                        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript>
                                        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
                                        <div class="row fileupload-buttonbar">
                                            <div class="col-md-12">
                                                <!-- The fileinput-button span is used to style the file input field as button -->
                                                <span class="btn btn-success fileinput-button">
                                                    <i class="glyphicon glyphicon-plus"></i>
                                                    <span>Add files...</span>
                                                    <input type="file" name="userfile" multiple>
                                                </span>
                                                <button type="submit" class="btn btn-primary start">
                                                    <i class="glyphicon glyphicon-upload"></i>
                                                    <span>Start upload</span>
                                                </button>
                                                <button type="reset" class="btn btn-warning cancel">
                                                    <i class="glyphicon glyphicon-ban-circle"></i>
                                                    <span>Cancel upload</span>
                                                </button>
                                                <button type="button" class="btn btn-danger delete">
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                    <span>Delete</span>
                                                </button>
                                                <input type="checkbox" class="toggle">
                                                <!-- The global file processing state -->
                                                <span class="fileupload-process"></span>
                                            </div>
                                            <!-- The global progress state -->
                                            <div class="col-lg-5 fileupload-progress fade">
                                                <!-- The global progress bar -->
                                                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                                                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                                                </div>
                                                <!-- The extended global progress state -->
                                                <div class="progress-extended">&nbsp;</div>
                                            </div>
                                        </div>
                                        <!-- The table listing the files available for upload/download -->
                                        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
                                    </form>
                                </div><!-- /.box-body -->
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
