<?php

include( "DataTables.php" );
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;
/*
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');
*/
require_once('../basic_class.php'); $ids=$_REQUEST['ids']; $sesja=new TSession(); $ids=$sesja->sprawdz($ids); if ($ids=='1') die('Brak dostepu.');
//if (!($sesja->jestAdminemTechnicznym())) die('Brak uprawnien administratora technicznego.');
// TU TRZEBA SPRAWDZIĆ, CZY MA UPRAWNIENIA DO NADAWANIA UPRAWNIEŃ !!!
	
Editor::inst( $db, 'ts_zgl', 'id' )
	->fields(
		Field::inst( 'id' ),
		Field::inst( 'pesel as Karta' ),
		Field::inst( 'pesel' )
		  ->validator( 'Validate::notEmpty' ),
		Field::inst( 'telefon' )
		    ->validator( 'Validate::notEmpty' ),
		Field::inst( 'idmd5' ),
		Field::inst( 'nazwisko' ),
		Field::inst( 'imie' ),
		Field::inst( 'miejscowosc' ),
		Field::inst( 'wywiad' ),
		Field::inst( 'wywiad_opis' ),
		Field::inst( 'punkty' ),
		Field::inst( 'klasyfikacja' ),
		Field::inst( 'wytyczne' )
	)
	
	->process( $_POST )
	->json();


 