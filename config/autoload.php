<?php
session_start();

ini_set('memory_limit','-1');
date_default_timezone_set('Asia/Kolkata');
$fm_caid 	= "";
$date 		= new DateTime(null, new DateTimeZone('Asia/Kolkata'));
$datetime 	= $date->format('Y-m-d H:i:s');

define('DATETIME', $datetime);
define('DATE', date('Y-m-d'));

$json 	= file_get_contents('php://input');
$obj 	= json_decode($json);

require($_SERVER['DOCUMENT_ROOT'].'/applepanel/config/constant.php');
require($_SERVER['DOCUMENT_ROOT'].'/applepanel/classes/database.php');
require($_SERVER['DOCUMENT_ROOT'].'/applepanel/classes/location.php');
require($_SERVER['DOCUMENT_ROOT'].'/applepanel/classes/Farmer_info.php');
require($_SERVER['DOCUMENT_ROOT'].'/applepanel/helper/helper_functions.php');


$database = new Database();
$db_con = $database->get_connection();

$location = new Location();
?>