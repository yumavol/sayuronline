    <div class="col-md-3">
      <div style="min-height: 500px; padding-left: 10px;" class="box box-solid">
        <div class="box-body">
          <ul class="nav nav-pills nav-stacked">
            <?php
            if(get_session('user_login')) {
            ?>
            <li role="presentation"><a href="#"><i class="fa fa-archive"></i> Produk</a></li>
            <li role="presentation" class="active"><a href="#"><i class="fa fa-shopping-cart"></i>Keranjang</a></li>
            <li role="presentation"><a href="#"><i class="fa fa-credit-card"></i>Pemesanan</a></li>
            <li role="presentation"><a href="#"><i class="fa fa-sign-out"></i>Logout</a></li>
            <?php } else { ?>
            <li role="presentation"><a href="#"><i class="fa fa-sign-in"></i> Login</a></li>
            <li role="presentation"><a href="#"><i class="fa fa-users"></i>Daftar</a></li>
            <?php } ?>
          </ul>
        </div>
      </div><!-- /.box -->
    </div><!-- /.col -->