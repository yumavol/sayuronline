<?php
 
function alert_sukses($teks) {
	return '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-check"></i> Sukses!</h4>' . $teks .'</div>';
}

function alert_warning($teks) {
	return '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-warning"></i> Peringatan!</h4>' . $teks .'</div>';
}

function alert_error($teks) {
	return '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-ban"></i> Error!</h4>' . $teks .'</div>';
}

function alert_info($teks) {
	return '<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-info"></i> Info!</h4>' . $teks .'</div>';
}

function alert_sukses_login($teks) {
	return '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $teks .'</div>';
}

function alert_warning_login($teks) {
	return '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $teks .'</div>';
}

function alert_error_login($teks) {
	return '<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $teks .'</div>';
}

function alert_info_login($teks) {
	return '<div class="alert alert-info alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $teks .'</div>';
}

function format_uang($number = ''){
	$value = 'Rp. ' . number_format($number, 2, ',', '.') ;
	return $value;
}
 

?>