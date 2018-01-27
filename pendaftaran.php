<?php
    require_once('system/engine.php');

    define('on_pendaftaran', true);
    define("SITE_TITLE", 'Pendaftaran ');


    require_once('layout/header.php'); ?>


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
          <center>
          <h1>
              Form Pendaftaran
          </h1>
          </center>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
             <div class="col-md-7 col-md-offset-3">
             <form class="form-horizontal">
                <div class="form-group">
                   <label class="col-sm-2 control-label">Nama</label> 
                   <div class="col-sm-8">
                      <input class="form-control" placeholder="nama" type="text">
                   </div>
                </div> 

                <div class="form-group">
                   <label class="col-sm-2 control-label">No Telp</label> 
                   <div class="col-sm-8">
                      <input class="form-control" placeholder="No telepon" type="text">
                   </div>
                </div> 

                <div class="form-group">
                   <label class="col-sm-2 control-label">Email</label> 
                   <div class="col-sm-8">
                      <input class="form-control" placeholder="Email" type="email">
                   </div>
                </div> 

                <div class="form-group">
                   <label class="col-sm-2 control-label">Username</label> 
                   <div class="col-sm-8">
                      <input class="form-control" placeholder="Password" type="text">
                   </div>
                </div>

                <div class="form-group">
                   <label class="col-sm-2 control-label">Password</label> 
                   <div class="col-sm-8">
                      <input class="form-control" placeholder="Password" type="text">
                   </div>
                </div>

                <div class="form-group">
                   <label class="col-sm-2 control-label">Konfirmasi Password</label> 
                   <div class="col-sm-8">
                      <input class="form-control" placeholder="Konfirmasi Password" type="text">
                   </div>
                </div>

                <div class="form-group">
                   <label class="col-sm-2 control-label">Alamat</label> 
                   <div class="col-sm-8">
                      <textarea class="form-control" placeholder="Alamat"></textarea>
                   </div>
                </div>

                <div class="row">
                  <div class="col-sm-8 col-md-offset-2">
                    <button type="submit" class="btn btn-primary btn-flat btn-block"><i class="fa fa-plus"></i> Daftar</button>
                  </div>
                </div>
                </form>

             </div><!-- ed col -->
          </div><!-- end row -->
        </section>
        <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->


    <?php  require_once('layout/footer.php'); ?>
    <script type="text/javascript">
      

    </script>
