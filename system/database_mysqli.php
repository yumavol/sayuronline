<?php

defined('BASEPATH') OR exit('No direct script access allowed');


$con = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name']);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

function check_type($value) {
    if(is_int($value)) {
        return $value;
    } else if(is_bool($value)) {
        return $value;
    } else {
        return "'" . $value . "'";
    }
}

function insert_db($data = array(), $table = ''){
    global $con;
    $column = array_keys($data);
    $escaped = array();

    foreach($data as $key=>$val) {
        $escaped[$key] = check_type(mysqli_real_escape_string($con, $val));
    }

    $sql = "INSERT INTO `" . $table ."` (`" . implode("`, `", $column) . "`) VALUES (". implode(", ", $escaped) .")";

    mysqli_query($con, $sql);

    return mysqli_insert_id($con);
}

function update_db($data = array(), $table = '', $where_clause = ''){
    global $con;
    $sql = "UPDATE `" . $table . "` SET ";

    foreach($data as $key => $val) {
        $sql .= $key . "=" . check_type(mysqli_real_escape_string($con, $val)) . ",";
    }

    $sql = substr($sql, 0, -1) . " WHERE " . $where_clause;

    return mysqli_query($con, $sql);;
}