<?php
//function do_uploade(file, directory, tipedata)
function do_upload($file, $config) {
	if(isset($config['file_name'])){
		$file_name = $config['file_name'];
	}else{
		$file_name = $file['name'];
	}
	$size = $file['size'];
	$ext = end(explode('.', $file_name));
	$errors = array();
	$success = false;
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
		move_uploaded_file($file['tmp_name'], dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . $config['directory'] . DIRECTORY_SEPARATOR . $file['name']);
		$success = true;
	}

	return array('success' => $success, 'errors' => $errors);
}
	//print_r(do_upload($_FILES['fileToUpload'], array('directory' => 'uploads')));

?>