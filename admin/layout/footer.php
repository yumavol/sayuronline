  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">

    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2018 RPL 1 - 8 UNIKOM.</strong>
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
</body>
</html>
