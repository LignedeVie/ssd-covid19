<?php
/*
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');
*/

error_reporting(0);

// w $p - pesel, w $t - telefon
require_once("admin/basic_class.php");

error_reporting(0);

$b=array(); $ef=''; $et=array();
$f=new TForm($b,$ef,$et);
echo $f->naglowek('z3.php','Weryfikacja stanu zdrowia','Diagnostyka covid-19','Diagnostyka covid-19<small><p style="color:red;" >Wersja testowa, nieupoważnionym wstęp wzbroniony!</p></small>');

//echo '<code>SSD COVID-19.</code><code>('.$pes.'/'.$t.')</code><hr>';

echo '<hr><h5>Wywiad</h5>';
echo $f->polem('cb1', 'Kaszel', 'cb', 'kaszel', '', 'onclick="gor(\'cb1\',\'d0\')"', null);
echo '<div style="display:none;" id="d0">';
$temp=array('sporadyczny','bardzo męczący');
echo $f->polem('cb1a', '', 'radio', '', '', '', $temp);
echo '</div>';
echo $f->polem('cb2', 'Gorączka', 'cb', 'gorączka', '', 'onclick="gor(\'cb2\',\'d1\')"', null);
echo '<div style="display:none;" id="d1">';
$temp=array('36,6 – 37,9 st C<br>','38 – 38,9 st C<br>','39 st C lub więcej');
echo $f->polem('cb2a', 'Temperatura ciała', 'radio', '', '', '', $temp);
echo '</div>';
echo $f->polem('cb3', 'Problemy z oddychaniem', 'cb', '', '', 'onclick="gor(\'cb3\',\'d2\')"', null);
echo '<div style="display:none;" id="d2">';
$temp=array('łagodne <small> mogę się swobodnie poruszać, choć oddech nie jest tak swobodny jak zwykle na co dzień<small><br>','umiarkowane <small>mogę poruszać się tylko na odległość kilku, kilkunastu metrów</small><br>','ciężkie <small>odczuwam duszność nawet siedząc – nie mogę nawet przejść kilku kroków</small>');
echo $f->polem('cb3a', '', 'radio', '', '', '', $temp);
echo '</div>';
//echo $f->polem('cb4', 'Bóle mięśni', 'cb', 'kod pocztowy', '', 'onclick="gor(\'cb4\',\'d4\')"', null);
echo $f->polem('cb5', 'Kontakt z osobą zakażoną koronawirusem <small>w ciągu ostatnich 14 dni</small>', 'cb', '', '', 'onclick="gor(\'cb5\',\'d5\')"', null);
//echo $f->polem('cb6', 'Wyrażam zgodę na przetwarzanie danych osobowych i udostępnianie lokalizacji', 'cb', '', '', 'onclick="gor(\'cb6\',\'d6\')"', null);

//echo '<input id="zip" name="zip" type="number" inputmode="numeric" pattern="^(?(^00000(|-0000))|(\d{5}(|-\d{4})))$">';

echo '<div style="display:none;" id="d4"></div><div style="display:none;" id="d6"></div><div style="display:none;" id="d6"></div>';
echo $f->stopka('Sprawdź zalecenia');

// echo hexdec('FFFFFF');

echo '<script> 
function gor(x,v) { 
  var p=document.getElementById(x).value;
  if (p=="") { 
	document.getElementById(x).value="on"; 
	document.getElementById(v).style.display="block"; 
  } else {
	document.getElementById(x).value=""; 
	document.getElementById(v).style.display="none"; 
  }
}</script></body></html>';

?>