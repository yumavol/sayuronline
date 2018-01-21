    <?php
    require_once('../../../system/engine.php');


    define("menu_kelola_pegawai", true);
    define("SITE_TITLE", 'Keloa Pegawai');
 
    require_once('../layout/header.php');
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Kelola Pegawai
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Pegawai</h3>
                            <div class="box-tools pull-right"> 
                                <a data-target="#modal_tambah" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Tambah Pegawai</a>
                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table id="data_table" class="table table-bordered">
                                <tr>
                                    <th>Nama </th>
                                    <th>Nama Pengguna</th>
                                    <th>Email</th>
                                    <th>No telepon</th> 
                                    <th width="20%"></th>
                                </tr> 
                                <tr>
                                    <td>Yuma Yusuf MA</td>
                                    <td>Yumavol</td>
                                    <td>Yumavol@gmail.com</td>
                                    <td>0813190822131</td>
                                    <td> 
                                    <a  data-target="#modal_edit" data-toggle="modal" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> edit</a>
                                    <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> hapus</a>
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



    <!-- Modal Tambah Pegawai -->

   <form class="form-horizontal" method="post" action="#">
   <div id="modal_tambah" class="modal fade " role="dialog">
      <div class="modal-dialog ">

        <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Tambah Pegawai</h4>
            </div>
          
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">

                     <div class="form-group">
                        <label class="col-sm-4 control-label">Nama</label> 
                        <div class="col-sm-8">
                           <input class="form-control" placeholder="nama" type="text">
                        </div>
                     </div> 

                     <div class="form-group">
                        <label class="col-sm-4 control-label">No Telp</label> 
                        <div class="col-sm-8">
                           <input class="form-control" placeholder="No telepon" type="text">
                        </div>
                     </div> 

                     <div class="form-group">
                        <label class="col-sm-4 control-label">Email</label> 
                        <div class="col-sm-8">
                           <input class="form-control" placeholder="Email" type="email">
                        </div>
                     </div> 

                     <div class="form-group">
                        <label class="col-sm-4 control-label">Pegawainame</label> 
                        <div class="col-sm-8">
                           <input class="form-control" placeholder="Password" type="text">
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="col-sm-4 control-label">Password</label> 
                        <div class="col-sm-8">
                           <input class="form-control" placeholder="Password" type="text">
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="col-sm-4 control-label">Konfirmasi Password</label> 
                        <div class="col-sm-8">
                           <input class="form-control" placeholder="Konfirmasi Password" type="text">
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="col-sm-4 control-label">Alamat</label> 
                        <div class="col-sm-8">
                           <textarea class="form-control" placeholder="Alamat"></textarea>
                        </div>
                     </div>

                  </div><!-- ed col -->
               </div><!-- end row -->
            
            </div><!-- modal body -->

            <div class="modal-footer">
               <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               <button type="submit" name="submit" value="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Simpan</button>
            </div>
        </div>  
      </div> 
   </div>  
   </form><!-- end form -->




   <!-- modal edit -->
   <form class="form-horizontal" method="post" action="#">
   <div id="modal_edit" class="modal fade " role="dialog">
      <div class="modal-dialog ">

        <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Edit Pegawai</h4>
            </div>
          
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">

                     <div class="form-group">
                        <label class="col-sm-4 control-label">Nama</label> 
                        <div class="col-sm-8">
                           <input class="form-control" placeholder="nama" type="text">
                        </div>
                     </div> 

                     <div class="form-group">
                        <label class="col-sm-4 control-label">No Telp</label> 
                        <div class="col-sm-8">
                           <input class="form-control" placeholder="No telepon" type="text">
                        </div>
                     </div> 

                     <div class="form-group">
                        <label class="col-sm-4 control-label">Email</label> 
                        <div class="col-sm-8">
                           <input class="form-control" placeholder="Email" type="email">
                        </div>
                     </div> 

                     <div class="form-group">
                        <label class="col-sm-4 control-label">Pegawainame</label> 
                        <div class="col-sm-8">
                           <input class="form-control" placeholder="Password" type="text">
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="col-sm-4 control-label">Password</label> 
                        <div class="col-sm-8">
                           <input class="form-control" placeholder="Password" type="text">
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="col-sm-4 control-label">Konfirmasi Password</label> 
                        <div class="col-sm-8">
                           <input class="form-control" placeholder="Konfirmasi Password" type="text">
                        </div>
                     </div>

                     <div class="form-group">
                        <label class="col-sm-4 control-label">Alamat</label> 
                        <div class="col-sm-8">
                           <textarea class="form-control" placeholder="Alamat"></textarea>
                        </div>
                     </div>

                  </div><!-- ed col -->
               </div><!-- end row -->
            
            </div><!-- modal body -->

            <div class="modal-footer">
               <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
               <button type="submit" name="submit" value="submit" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Simpan</button>
            </div>
        </div>  
      </div> 
   </div>  
   </form><!-- end frm -->


    <?php  require_once('../layout/footer.php'); ?>
