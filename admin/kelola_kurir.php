<?php
require_once('../system/engine.php');


define("menu_kelola_kurir", true);
define("SITE_TITLE", 'Keloa Kurir');

require_once('layout/header.php');
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Kelola Kurir
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">Daftar Kurir</h3>
                            <div class="box-tools pull-right"> 
                                <a data-target="#modal_tambah" data-toggle="modal" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Tambah Kurir</a>
                            </div><!-- /.box-tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table id="data_table" class="table table-bordered">
                                <tr>
                                    <th>Nama </th> 
                                    <th>Email</th>
                                    <th>No telepon</th> 
                                    <th width="20%"></th>
                                </tr> 
                                <tr>
                                    <td>Dadang Fauzan</td> 
                                    <td>iad@gmail.com</td>
                                    <td>0812322222131</td>
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



    <!-- Modal Tambah Kurir -->

   <form class="form-horizontal" method="post" action="#">
   <div id="modal_tambah" class="modal fade " role="dialog">
      <div class="modal-dialog ">

        <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Tambah Kurir</h4>
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
               <h4 class="modal-title">Edit Kurir</h4>
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
