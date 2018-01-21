<?php

defined('BASEPATH') OR exit('No direct script access allowed');

try {
	$db = new PDO($config['db_type'].':host='.$config['db_host'].';dbname='.$config['db_name'], $config['db_user'], $config['db_pass']);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	//echo 'sukses';
} catch (PDOException $e) {
	print "koneksi gagal " . $e->getMessage() . "<br/>";
	die();
}

function get_pdo_type($value) {
    switch (true) {
        case is_bool($value):
            $dataType = PDO::PARAM_BOOL;
            break;
        case is_int($value):
            $dataType = PDO::PARAM_INT;
            break;
        case is_null($value):
            $dataType = PDO::PARAM_NULL;
            break;
        default:
            $dataType = PDO::PARAM_STR;
    }
    return $dataType;
}

function insert_db($data = array(), $table = ''){
	global $db;
	$column = array_keys($data);

	$sql = "INSERT INTO `" . $table ."` (`" . implode("`, `", $column) . "`) VALUES (:". implode(", :", $column) .")";

	$db->prepare($sql)->execute($data);
	return $db->lastInsertId();
}

function update_db($data = array(), $table = '', $where_clause = ''){
	
		global $db;
		$sql = "UPDATE `" . $table . "` SET ";

		foreach($data as $key => $value) {
			$sql .= $key . "=:" . $key . ",";
		}

		$sql = substr($sql, 0, -1) . " WHERE " . $where_clause;

		try {
			return $db->prepare($sql)->execute($data);
		} catch (Exception $e) {
			return $e;
		}
 
}

?>