<?php
// z2.php - przyjmuje informacje z karty zgłoszeniowej;

$post=array(
// cb1a	cb2a	cb3a	cb5	wynik
//Kaszel	Gorączka	Duszność	Kontakt	Postępowanie
'0000'=>'0',
'1000'=>'B',
'2000'=>'A',
'0010'=>'A+B',
'1010'=>'A',
'2010'=>'A',
'0020'=>'R',
'1020'=>'R',
'2020'=>'R',
'0100'=>'A+B',
'1100'=>'A',
'2100'=>'A',
'0110'=>'A',
'1110'=>'C',
'2110'=>'C',
'0120'=>'R',
'1120'=>'R',
'2120'=>'R',
'0200'=>'A+B',
'1200'=>'C',
'2200'=>'C',
'0210'=>'C',
'1210'=>'C',
'2210'=>'C',
'0220'=>'R',
'1220'=>'R',
'2220'=>'R',
'0001'=>'B',
'1001'=>'B',
'2001'=>'A+B',
'0011'=>'A+B',
'1011'=>'A+B',
'2011'=>'A+B',
'0021'=>'D',
'1021'=>'D',
'2021'=>'D',
'0101'=>'C',
'1101'=>'C',
'2101'=>'C',
'0111'=>'C',
'1111'=>'C',
'2111'=>'C',
'0121'=>'D',
'1121'=>'D',
'2121'=>'D',
'0201'=>'C',
'1201'=>'C',
'2201'=>'C',
'0211'=>'D',
'1211'=>'D',
'2211'=>'D',
'0221'=>'D',
'1221'=>'D',
'2221'=>'D');

$zalecenia=array('0'=>'Nie masz koronawirusa. Więcej informacji znajdziesz na stronie <a href="www.pacjent.gov.pl">pacjent.gov.pl</a>',
'A'=>'Kontakt telefoniczny z lekarzem rodzinnym lub "Wieczorynką"',
'B'=>'Konieczność kwarantanny',
'A+B'=>'Kontakt telefoniczny z lekarzem rodzinnym lub "Wieczorynką".<br>Konieczność kwarantanny',
'C'=>'Koniecznośc badania lekarskiego i testu na obecność wirusa SARS-CoV-2',
'D'=>'Stan zagrożenia i wysokie ryzyko COVID - konieczność wezwania karetki koronarowirusowej',
'R'=>'Stan zagrożenia i niskie ryzyko COVID telefon do centrum ratownictwa (112)');

function createPostString($aPostFields) {
    foreach ($aPostFields as $key => $value) {
                $aPostFields[$key] = urlencode($key) . '=' . urlencode($value);
 }
    return implode('&', $aPostFields);
}
function wywiad_opis($x) {
	// p=73022310213&t=600100101&Imie=Marian&Nazwisko=Opiu%C5%9B&Kod=00-100&Miejscowosc=Warszawa&Ulica=Polna&
	$obj=array( 'cb1'=>'kaszel ', 'cb1a0'=>'sporadyczny, ', 'cb1a1'=>'bardzo męczący, ',
	 'cb2'=>'gorączka ', 'cb2a0'=>'35,1-38, ', 'cb2a1'=>'38,1-39, ', 'cb2a2'=>'powyżej 39, ',
	 'cb3'=>'duszności ', 'cb3a0'=>'łagodne, ', 'cb3a1'=>'umiarkowane, ', 'cb3a2'=>'ciężkie, ',
	 'cb4'=>'bóle mięśni, ', 'cb5'=>'kontakt' );
	$obj_=array(); foreach ($obj as $key=>$value) $obj_[]=$key;
	$tab=explode('&',$x); $b=array(); for ($i=0;$i<count($tab);$i++) { $t=explode('=',$tab[$i]); $b[$t[0]]=$t[1]; }
	$res=''; 
	for ($i=0;$i<count($obj);$i++) 
		if (strlen($obj_[$i])>3) {
		   if (v(substr($obj_[$i],0,4),$b)==substr($obj_[$i],4,1)) $res.=$obj[substr($obj_[$i],0,4).v(substr($obj_[$i],0,4),$b)];
		 }
		 else if (v($obj_[$i],$b)=='on') $res.=$obj[$obj_[$i]];	
	return $res;
}
function punkty($x) {
	$obj=array( 'cb1'=>0, 'cb1a0'=>1, 'cb1a1'=>2,
	 'cb2'=>0, 'cb2a0'=>0, 'cb2a1'=>1, 'cb2a2'=>2,
	 'cb3'=>0, 'cb3a0'=>1, 'cb3a1'=>2, 'cb3a2'=>3,
	 'cb4'=>1, 'cb5'=>1 );
	$obj_=array(); foreach ($obj as $key=>$value) $obj_[]=$key;
	$tab=explode('&',$x); $b=array(); for ($i=0;$i<count($tab);$i++) { $t=explode('=',$tab[$i]); $b[$t[0]]=$t[1]; }
	$res=0; 
	for ($i=0;$i<count($obj);$i++) 
		if (strlen($obj_[$i])>3) {
		   if (v(substr($obj_[$i],0,4),$b)==substr($obj_[$i],4,1)) $res=$res+$obj[substr($obj_[$i],0,4).v(substr($obj_[$i],0,4),$b)];
		 }
		 else if (v($obj_[$i],$b)=='on') $res=$res+$obj[$obj_[$i]];	
	return $res;
}
function wytyczne($x) {
	$tab=explode('&',$x); $b=array(); for ($i=0;$i<count($tab);$i++) { $t=explode('=',$tab[$i]); $b[$t[0]]=$t[1]; }
	$a=intval(v('cb1a',$b)); $q=intval(v('cb2a',$b));	$c=intval(v('cb3a',$b));	
	if (v('cb5',$b)=='on') $d=1; else $d=0;
    global $post; global $zalecenia;
	$stan=$post[$a.$q.$c.$d];
	return "($stan) ".$zalecenia[$stan];
}
function klasyfikacja($x) {
	$tab=explode('&',$x); $b=array(); for ($i=0;$i<count($tab);$i++) { $t=explode('=',$tab[$i]); $b[$t[0]]=$t[1]; }
	$a=intval(v('cb1a',$b)); $q=intval(v('cb2a',$b));	$c=intval(v('cb3a',$b));	
	if (v('cb5',$b)=='on') $d=1; else $d=0;
    global $post; global $zalecenia;
	$stan=$post[$a.$q.$c.$d];
    if (($stan=='0')||($stan=='A')) return '9';
	 else if ($stan=='B') return '0';
	 else if ($stan=='C') return '1';
     else if (($stan=='D')||($stan=='R')) return '2';
	return 0; // 0-zielony, 1-żółty, 2-czerwony
}
function v($x,$tab) {
  if (!(isset($tab[$x]))) return '';
   else return $tab[$x];
}
// tutaj WALIDACJA FORMULARZA !!! i odesłanie spowrotem, jeśli czegoś brakuje;


require_once("admin/basic_class.php");
foreach ($_REQUEST as $key => $value) $_REQUEST[$key] =cyk($value); // filtr
$wywiad=createPostString($_REQUEST);

$m = new mysqli($sql_host, $sql_login, $sql_password, $sql_database);
$m->set_charset("latin1");

// WYWIAD-OPIS i WYTYCZNE DLA PACJENTA:
$wywiad_opis=wywiad_opis($wywiad);
$punkty=punkty($wywiad);
$klasyfikacja=klasyfikacja($wywiad);
$wytyczne=wytyczne($wywiad);

$ip = $_SERVER['REMOTE_ADDR'];
// Dopisanie człowieka do bazy:

$pesel=v('p',$_REQUEST); $telefon=v('t',$_REQUEST); $idmd5=md5($pesel.'2'.$telefon);
$imie=v('Imie',$_REQUEST); $nazwisko=v('Nazwisko',$_REQUEST); $kod=v('Kod',$_REQUEST); $ulica=v('Ulica',$_REQUEST);
$miejscowosc=v('Miejscowosc',$_REQUEST); 

$zglosil=$pesel; // lub infolinia ??
$uwagi='';

$query="insert into ts_zgl (pesel, telefon, idmd5, imie, nazwisko, kod, ulica, miejscowosc, wywiad, wywiad_opis, klasyfikacja, wytyczne, zglosil, uwagi, punkty, ip) values ('{$pesel}','{$telefon}','{$idmd5}','{$imie}','{$nazwisko}','{$kod}','{$ulica}','{$miejscowosc}','{$wywiad}','{$wywiad_opis}','{$klasyfikacja}','{$wytyczne}','{$zglosil}','{$uwagi}',{$punkty},'{$ip}')";

if (!$result = $m->query($query)) {
    echo "Query: " . $query . "\n";
    echo "Errno: " . $m->errno . "\n";
    echo "Error: " . $m->error . "\n";
    die();
  } else {
  $id=$m->insert_id;
  $idmd5=strtoupper(str_pad(dechex($id), 6, "0", STR_PAD_LEFT));  // 268,4 mln zgłoszeń dla 7 cyfr; dla 6 cyfr: 16,7 mln
  $m->query("update ts_zgl set idmd5='{$idmd5}' where id={$id}");
}

$colors=array(9=>'white',0=>'green',1=>'yellow',2=>'red');
$col=$colors[$klasyfikacja];

$b=array(); $ef=''; $et=array();
$f=new TForm($b,$ef,$et);
echo $f->naglowek('index.php','Zalecenia i wytyczne');
echo '<h4>Twoje zgłoszenie dot. stanu zdrowia zostało zarejestrowane.</h4>';
echo '<h1>Twój numer zgłoszenia to: <strong><b>'.$idmd5.'</b></strong></h1>';
echo '<hr><p><b><u>ZALECENIA:</u></b><br>'.$wytyczne.'</p>';
echo '<p style="background-color:'.$col.';">_</p>';
echo $f->stopka('Zamknij','index.html');
echo '</body></html>';

?>