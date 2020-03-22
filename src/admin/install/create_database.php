<?php
// instalowanie struktury bazy danych; ( nie zawiera: CREATE DATABASE )

error_reporting(E_ALL); ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE); date_default_timezone_set('Europe/London');
require_once("../x_cfg.php");

$mysqli = new mysqli($sql_host, $sql_login, $sql_password, $sql_database);
if ($mysqli->connect_errno) { // sprawdzanie połączenia z bazą danych;
    echo "Errno: " . $mysqli->connect_errno . "\n";
    echo "Error: " . $mysqli->connect_error . "\n";
    exit;
}
$script=file_get_contents("sql_structure.sql");
$querytable=explode(';',$script);
for ($i=0;$i<count($querytable);$i++) {
  $query=$querytable[$i];
  if (!$result = $mysqli->query($query)) {
    echo "Query: " . $query . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    // exit;
  }
}
$haslo=md5($hasloprzed.'admin'.$hasloza);
$mysqli->query("INSERT INTO ts_users (login, haslo, rola) values ('admin','{$haslo}','Administrator techniczny')");