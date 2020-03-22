<?php

include( "DataTables.php" );
use
	DataTables\Editor,
	DataTables\Editor\Field,
	DataTables\Editor\Format,
	DataTables\Editor\Mjoin,
	DataTables\Editor\Upload,
	DataTables\Editor\Validate;

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

require_once('../basic_class.php'); $ids=$_REQUEST['ids']; $sesja=new TSession(); $ids=$sesja->sprawdz($ids); if ($ids=='1') die('Brak dostepu.');
if (!($sesja->jestAdminemTechnicznym())) die('Brak uprawnien administratora technicznego.');
// TU TRZEBA SPRAWDZIĆ, CZY MA UPRAWNIENIA DO NADAWANIA UPRAWNIEŃ !!!
	
Editor::inst( $db, 'ts_users', 'id' )
	->fields(
		Field::inst( 'id' ),
		Field::inst( 'last_name' )
		    ->validator( 'Validate::notEmpty' ),
		Field::inst( 'first_name' )
		    ->validator( 'Validate::notEmpty' ),
		Field::inst( 'rola' )
		    ->validator( 'Validate::notEmpty' ),
		Field::inst( 'login' )
		    ->validator( 'Validate::notEmpty' )
			->validator( 'Validate::email' )
			->validator( 'Validate::unique' ),
		Field::inst( 'klasa' ),
		Field::inst( 'jednostka' ),
		Field::inst( 'grupa' ),
		Field::inst( 'haslo' )->xss( function ($d) { global $hasloprzed; global $hasloza; return md5($hasloprzed.$d.$hasloza); } )
	)
	
	->process( $_POST )
	->json();


 