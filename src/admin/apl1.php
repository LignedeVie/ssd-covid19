<?php

require_once("basic_class.php");
error_reporting(E_ALL); ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE); date_default_timezone_set('Europe/London');
require_once("template/app_class.php"); // klasa $page i pochodne;
$ids=$_REQUEST['ids']; $sesja=new TSession(); $ids=$sesja->sprawdz($ids); if ($ids=='1') die('Brak dostepu.');
@$f=$_REQUEST['f'];
if ($f=='logout') { $sesja->wyloguj(); include "index.php";  die(); }
// Wybór strony w zależności od parametru "f";
echo '<!DOCTYPE html><html>';
if ($f=='usa') $page= new TUserspage($_REQUEST,$sesja,$nazwaapl,'apl1.php');
else if ($f=='zgl') $page= new TZglpage($_REQUEST,$sesja,$nazwaapl,'zgl.php');
 else if ($f=='mp') $page= new TProfilpage($_REQUEST,$sesja,$nazwaapl,'apl1.php');
   else if ($f=='rpas') $page= new TLogipage($_REQUEST,$sesja,$nazwaapl,'apl1.php');
     else  $page= new Tpage($_REQUEST,$sesja,$nazwaapl,'apl1.php'); 
echo $page->content(); echo '</html>';