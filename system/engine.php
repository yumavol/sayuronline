<?php
define('BASEPATH', true);
//ini_set('display_errors', 0);
require_once('config.php');

function base_url($string = ''){
	global $config;
	$base = $config['base_url'];
	$base = (substr($base, -1) == '/') ? $base : $base.'/' ;
	return ($string == '') ? $base : $base.$string  ;
}

function encrypt_password($plain_text) {
	$options = array(
		'cost' => 12,
		'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
	);
	return password_hash($plain_text, PASSWORD_BCRYPT, $options);
}

function redirect($url) {
   header('Location: ' . $url, true);
   die();
}

//session
function set_session($data = array()){
	foreach ($data as $key => $val) {
		//print_r($val); die;
		$_SESSION["$key"] = $val;
	}
}

function set_flashdata($name, $text){
	$_SESSION["flashdata_" .$name] = $text;
}

function get_flashdata($session){
	$val = '';
	if(isset($_SESSION["flashdata_$session"])){
		$val = $_SESSION["flashdata_$session"];
		unset($_SESSION["flashdata_$session"]);
	}
	return $val;
}

function has_flashdata($session){
	return (isset($_SESSION["flashdata_$session"])) ? true : false 	;

}

function get_session($string){
	return (isset($_SESSION[$string])) ? $_SESSION[$string]: false ;
}

function destroy_session($data = array()){
	foreach ($data as $dt) {
		unset($_SESSION["$dt"]);
	}
}
 

function is_error($param, $rule = '') {
	$error = false;

	if(preg_match('/required/i', $rule) && empty($param)) {
		$error = true;
	}

	if(preg_match('/min_length\[([0-9]+)\]/i', $rule, $out)) {
		if(strlen($param) < $out[1]) {
			$error = true;
		}
	}

	if(preg_match('/max_length\[([0-9]+)\]/i', $rule, $out)) {
		if(strlen($param) > $out[1]) {
			$error = true;
		}
	}

	if(preg_match('/callback_([_\w]+)/i', $rule, $out)) {
		if(!$out[1]($param)) {
			$error = true;
		}
	}

	if(preg_match('/email/i', $rule)) {
		if(!filter_var($param, FILTER_VALIDATE_EMAIL)) {
			$error = true;
		}
	}

	return $error;
}

function trim_validate(&$data = array(), $exclude = array()){
	//$data = array_map('trim', $_POST);
	array_walk($data, function(&$a, $b, $exclude) {
		$a = (!in_array($b, $exclude) && !is_array($a)) ? trim($a) : $a;
	}, $exclude);

}


if(strtoupper(substr(PHP_OS, 0, 3)) == 'WIN') {
	define('OS_DLM', "\\");
} else {
	define('OS_DLM', "/");
} 

function escape($inp = ''){
	if(is_array($inp))
	       return array_map(__METHOD__, $inp);

	   if(!empty($inp) && is_string($inp)) {
	       return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
	   }

	   //$inp =  str_replace("'", "", $inp);
	   return $inp; 
}

function url_title($str, $separator = '-', $lowercase = FALSE) {
	if ($separator === 'dash') {
		$separator = '-';
	} elseif ($separator === 'underscore') {
		$separator = '_';
	}

	$q_separator = preg_quote($separator, '#');

	$trans = array(
		'&.+?;'			=> '',
		'[^\w\d _-]'		=> '',
		'\s+'			=> $separator,
		'('.$q_separator.')+'	=> $separator
	);

	$str = strip_tags($str);
	foreach ($trans as $key => $val) {
		$str = preg_replace('#'.$key.'#i', $val, $str);
	}

	if ($lowercase === TRUE) {
		$str = strtolower($str);
	}

	return trim(trim($str, $separator));
}

if(isset($_SERVER['HTTP_REFERER'])){
	$_SESSION['referer_from'] = $_SERVER['HTTP_REFERER'];
}

if(defined('load_upload')){
	require_once('upload.php');
}
if(defined('load_pagination')){
	require_once('pagination.php');
}

require_once dirname(dirname(__FILE__)) . '/constanta.php';
require_once('database_mysqli.php');
require_once('helper.php');
