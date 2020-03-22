<?php if (!defined('DATATABLES')) exit(); // Ensure being used in DataTables env.

// Enable error reporting for debugging (remove for production)
//error_reporting(E_ALL);
//ini_set('display_errors', '1');

require_once("../x_cfg.php");

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Database user / pass
 */
$sql_details = array(
	"type" => "Mysql",
	"user" => $sql_login,
	"pass" => $sql_password,
	"host" => $sql_host,
	"port" => "3306",
	"db"   => $sql_database,
	"dsn"  => "charset=latin1"
);


