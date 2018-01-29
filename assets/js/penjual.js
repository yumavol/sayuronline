$(document).ready(function() {
    $('.btn-isi-kurir').click(function() {
        var no_transaksi = $(this).data('transaksi');

        $('.hidden-input-transaksi').val(no_transaksi);

        $('#select-id-petugas').val($(this).data('kurir'));
        $('#modal-isi-kurir').modal('show');
    });

    $('.btn-status-transaksi').click(function() {
        var no_transaksi = $(this).data('transaksi');

        $('.hidden-input-transaksi').val(no_transaksi);

        $('#select-status-transaksi').val($(this).data('status'));
        $('#modal-ubah-status').modal('show');
    });

    $('.btn-bukti-bayar').click(function() {
        var no_transaksi = $(this).data('transaksi');

        $('#body-pembayaran').load(BASE_URL + '/penjual/kelola_transaksi_bukti_bayar.php?no_transaksi=' + no_transaksi);
        $('#modal-pembayaran').modal('show');
    });
});