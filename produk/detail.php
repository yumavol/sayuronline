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
      /* Indicators list style */
      .carousel{
        padding: 2px;
        margin-left: 115px;
      }
      .article-slide .item{
        background: #fff;
      }
      .article-slide .carousel-indicators {
          top: 0px;
          left: -105px;
          margin-left: 5px;
          width: 100px;
      }
      /* Indicators list style */
      .article-slide .carousel-indicators li {
          border: medium none;
          border-radius: 0;
          float: left;
          height: 100px;
          margin-bottom: -1px;
          margin-left: 0;
          margin-right: 5px !important;
          margin-top: 0;
          width: 100px;
      }
      /* Indicators images style */
      .article-slide .carousel-indicators img {
          border: 2px solid #fff;
          border-right: none;
          float: left;
          height: 100%;
          left: 0;
          width: 100px;
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
        <form id="form-input" method="post" action="">
        <section class="content">
            <div style="min-height: 500px" class="box box-primary">
              <div class="box-header">
              <strong>Kategori Barang</strong>
              <button type="submit" value="1" name="submit" class="pull-right btn btn-sm btn-primary"><i class="fa fa-shopping-bag"></i> Tambah Ke keranjang</button>
              </div>  
              <div class="box-body">
                <div class="row">
                  <div class="col-md-6 ">
                  <div class="carousel slide article-slide" id="article-photo-carousel" data-ride="false">
                    <!-- Wrapper for slides -->
                    <div class="carousel-inner cont-slider">
                      <div class="item active">
                        <img alt="" title="" src="#">
                      </div>
                      <div class="item">
                        <img alt="" title="" src="#">
                      </div>
                    </div>

                    <a class="left carousel-control" href="#article-photo-carousel" data-slide="prev">
                      <span class="fa fa-angle-left"></span>
                    </a>
                    <a class="right carousel-control" href="#article-photo-carousel" data-slide="next">
                      <span class="fa fa-angle-right"></span>
                    </a>

                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                      <li class="active" data-slide-to="1" data-target="#article-photo-carousel">
                        <img alt="" src="#">
                      </li>
                      <li class="" data-slide-to="2" data-target="#article-photo-carousel">
                        <img alt="" src="#">
                      </li>
                    </ol>
                  </div>
                  </div>

                  <div class="col-md-6">
                    <p><h3><strong>Produk Sayuar Basi</strong></h3></p>
                    <blockquote>
                      <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                      tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                      quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                      consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                      cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                      proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</small>
                    </blockquote>
                    <br>
                    <span class="btn-sm bg-gray" ><strong>Rp 150.000000</strong></span>
                      
                  </div>
                </div><!--row-->
                </div><!--box body-->
            </div><!--box-->   
        </section><!-- /.content -->
        <input type="hidden" name="id" value="<?php echo $result->id ?>">
        </form>
        </div><!-- /.container -->
    </div><!-- /.content-wrapper -->


    <?php  require_once('../layout/footer.php'); ?>

    <script type="text/javascript">
        $( "#form-input" ).validate( {
            onkeyup: false,
            rules: {
                ukuran: "required"
            },
            messages: {
                ukuran: "Silahkan pilih ukuran produk"
            },
            errorElement: "span",
            errorPlacement: function ( error, element ) {
                // Add the `help-block` class to the error element
                error.addClass( "help-block" );

                if ( element.prop( "type" ) === "checkbox" ) {
                    error.insertAfter( element.parent( "label" ) );
                } else {
                    error.insertAfter( element );
                }
            },
            highlight: function ( element, errorClass, validClass ) {
                $( element ).parents( ".form-group" ).addClass( "has-error" ).removeClass( "has-success" );
            },
            unhighlight: function (element, errorClass, validClass) {
                $( element ).parents( ".form-group" ).removeClass( "has-error" );//.addClass( "has-success" );
            }
        });

      </script>
