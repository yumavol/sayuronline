<?php
    require_once('../system/engine.php');

    define('ON_KERANJANG', true);
    define("SITE_TITLE", 'Produk list');


    require_once('../layout/header.php'); ?>


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
          <h1>
              Produk <small>Produk kami</small>
          </h1>
        </section>

        <!-- Main content -->
        <section class="content">
        <div class="row">
          <div class="col-md-3">
            <div style="min-height: 500px; padding-left: 10px;" class="box box-solid">
              <div class="box-body">
                <form method="get" action="">
                <label>Kategori</label>
                <select id="urutkan" name="kategori" class="form-control" style="max-width: 150px">
                    <option value="">Pilih Kategori</option>
                  <?php foreach ($kategori as $kat) { ?>
                    <option <?php echo ($kat->id == $kat_id) ? 'selected' : '' ; ?> value="<?php echo $kat->id; ?>"><?php echo $kat->nama; ?></option>
                  <?php } ?>
                </select>
                <br>
                <label>Urutkan</label>
                <select id="urutkan" name="orderby" class="form-control" style="max-width: 150px">
                  <option value="">Urutkan berdasarkan</option>
                  <option <?php echo ($orderby == 'harga_tinggi') ? 'selected' : '' ; ?> value="harga_tinggi">Harga Tertinggi</option>
                  <option <?php echo ($orderby == 'harga_rendah') ? 'selected' : '' ; ?> value="harga_rendah">Harga Terendah</option>
                </select>
                <br>
                <button type="submit" class="btn btn-sm btn-primary" > Kirim</button>
                </form>
              </div>
            </div><!-- /.box -->
          </div><!-- /.col -->
          <div class="col-md-9">
          <?php $i = 1; 
              
              //dummy data
              $result  = array(new StdClass());
              $result[0]->gambar = '#';
              $result[0]->nama =  'Kue Basi';
              $result[0]->harga = 50000;
              $result[0]->id = 2;
              
              @$result[1]->gambar = '#';
              $result[1]->nama =  'Kue Kering';
              $result[1]->harga = 50000;
              $result[1]->id = 1;

              @$result[2]->gambar = '#';
              $result[2]->nama =  'Kue Basi';
              $result[2]->harga = 60000;
              $result[2]->id = 1;

               foreach ($result as $res) { 
               if(($i == 1)){ ?>
            <div class="row"><!-- row product -->
          <?php } //end if 
               if(($i % 5 == 0)){ ?>

            </div><!-- ./row product -->

            <div class="row"><!-- row product -->
         <?php  } //end if ?> 

            <div class="col-md-3">
              <div class="box box-solid">
                <div class="box-body no-padding">

                  <div class="image"><img src="<?php echo base_url('uploads/produk/').$res->gambar; ?>"></div>
                </div>
                <div class="box-footer" style="padding-bottom: 0px">
                  <p><label><?php echo format_uang($res->harga); ?></span></label></p>
                  <p><label><small><?php echo $res->nama; ?></small></label></p>
                  <p><a href="<?php echo base_url('produk/detail.php?id=').$res->id ?>" class="btn btn-block btn-xs btn-info"><i class="fa fa-long-arrow-left"></i> Selengkapnya</a></p>
                </div>
              </div><!-- /.box --> 
            </div>

            <?php $i++; ?>
            <?php } ?>            
            </div><!-- /.row --> 

              <ul class="pagination pagination-sm no-margin pull-right">
                <li><a href="#">«</a></li>
                <li><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">»</a></li>
              </ul>
            

          </div><!-- /.col -->
        </div><!-- /.row -->
        </section>
        <!-- /.content -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->


    <?php  require_once('../layout/footer.php'); ?>
    <script type="text/javascript">
      

    </script>
