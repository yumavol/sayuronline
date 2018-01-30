<?php
require_once('../system/engine.php');

if(!get_session('login')) {
    redirect(base_url('login.php'));
} else if(get_session('tipe_user') != 'penjual') {
    set_flashdata('error', 'Anda tidak mempunyai hak untuk membuka halaman tersebut.');
    redirect(base_url());
}

$no_transaksi = mysqli_real_escape_string($con, $_GET['no_transaksi']);

$sql = "SELECT * FROM pembayaran WHERE no_transaksi='" . $no_transaksi . "'";
$query = mysqli_query($con, $sql);
if(mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_array($query);
?>
    <p><b>Bank Tujuan:</b> <?php echo $row['bank_tujuan'];?></p>
    <p><b>Bank Asal:</b> <?php echo $row['bank_asal'];?></p>
    <p><b>Atas Nama:</b> <?php echo $row['atas_nama'];?></p>
    <p><b>No. Rekening:</b> <?php echo $row['no_rekening'];?></p>
    <p><b>Tanggal:</b> <?php echo tanggal_indo($row['tanggal']);?></p>
    <p><b>Jumlah:</b> <?php echo format_uang($row['jumlah']);?></p>
    <p><b>Bukti:</b></p>
    <p class="text-center"><img src="<?php echo base_url('uploads/pembayaran/' . $row['bukti_pembayaran']);?>" width="280px"></p>
<?php
}