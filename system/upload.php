<?php
//function do_uploade(file, directory, tipedata)
function do_upload($file, $config) {
	$size = $file['size'];
	$explode = explode('.', $file['name']);
	$ext = end($explode);
	$errors = array();
	$success = false;

	if(isset($config['file_name'])){
		$file_name = $config['file_name'] . '.' . $ext;
	}else{
		$file_name = $file['name'];
	}

	if(isset($config['allowed_ext'])) {
		if(!in_array(strtoupper($ext), array_map('strtoupper', $config['allowed_ext']))) {
			$errors[] = "Hanya diperbolehkan " . implode(',', $config['allowed_ext']);
		}
	}

	if(isset($config['max_size'])) {
		if($size > $config['max_size']) {
			$errors[] = "Ukuran file terlalu besar";
		}
	}

	if(count($errors) === 0) {
		move_uploaded_file($file['tmp_name'], dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . $config['directory'] . DIRECTORY_SEPARATOR . $file_name);
		$success = true;
	}

	return array('file_name' => $file_name, 'success' => $success, 'errors' => $errors);
}
	//print_r(do_upload($_FILES['fileToUpload'], array('directory' => 'uploads')));

?>