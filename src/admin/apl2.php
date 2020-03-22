<?php

error_reporting(E_ALL); ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE); date_default_timezone_set('Europe/London');
require_once("basic_class.php"); require_once("pclzip.lib.php");
//error_reporting(0);

$ids=cyk($_REQUEST['ids']); $sesja=new TSession(); $ids=$sesja->sprawdz($ids); if ($ids=='1') die('Brak dostepu.'); @$f=cyk($_REQUEST['f']);

function deleteDir($dirPath) {
  
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}

if ($f='') {}