  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      anithing
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2017 <a href="#"> </a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="<?php echo base_url() ?>assets/plugins/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url() ?>assets/plugins/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="<?php echo base_url() ?>assets/js/moment.min.js"></script>

<script src="<?php echo base_url() ?>assets/dist/js/app.min.js"></script>


<?php if(isset($js)) {foreach($js as $j) { ?>
  <script src="<?php echo base_url($j);?>" type="text/javascript"></script>
<?php }} ?>

<script type="text/javascript">

  $(document).ready(function() {

    //data table
    if(typeof $('#data_table').DataTable !== 'undefined'){
      $('#data_table').DataTable( {
          "paging":   true,
          "ordering": true,
          "info":     true,
          columnDefs: [
             { orderable: false, targets: -1 }
          ]
      });
    }

  });

</script>
</body>
</html>
