<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

# regular configuration
$config = array();
$config['base_url'] = 'http://localhost/project/sayuronline/';

# database configuration 
$config['db_type'] = 'mysql';
$config['db_host'] = 'localhost';
$config['db_user'] = 'root';
$config['db_pass'] = 'root';
$config['db_name'] = 'sayuronline';


// cek mod_rewrite aktif untuk url rewrite
if(function_exists('apache_get_modules')){
    $config['url_rewrite'] = in_array('mod_rewrite', apache_get_modules()) ? true : false;
} else {
    $config['url_rewrite'] = false;
}