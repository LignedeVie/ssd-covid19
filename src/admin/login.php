<?php

require_once("basic_class.php"); // zawiera już zaczytanie: x_cfg.php;

error_reporting(E_ALL); ini_set('display_errors', TRUE); 
ini_set('display_startup_errors', TRUE); date_default_timezone_set('Europe/London');

error_reporting(0);

 @$f=cyk($_REQUEST['f']);
 if ($f=='p') { // przypomnij hasło
   @$email=cyk($_REQUEST['email']);
   $db = new mysqli($sql_host, $sql_login, $sql_password, $sql_database);
   $z=$db->query("select count(id) ile, haslo from ts_users where login='{$email}'"); $wynik=$z->fetch_assoc();
   if ($wynik['ile']==0) echo "ERR|Nie znaleziono użytkownika z takim adresem email."; else {
	$haslo=$wynik['haslo']; $login=$email;
	require_once("addons/mail_class.php");
	$w=new eMail('2');
	$ip = getenv("REMOTE_ADDR").":".getenv("REMOTE_PORT");
    $link=$host.'/login.php?f=r&k='.$haslo.'&l='.$login;		
    $tresc="Z komputera <strong>{$ip}</strong> dnia <strong>".date("d.m.y, h:i:s")."</strong> została wysłana prośba o przypomnienie hasła. <br>".
    'Kliknij w link poniżej: <br><br><a href="'.$link.'">'.$link.'</a><br><br> aby zresetowac hasło.<br/><br/>
	<strong>Uwaga!</strong> Jeśli ta prośba została wygenerowana bez Twojej wiedzy, zgłoś incydent do <code>'.$cok.'</code><br><br>'.$mail_podpis; 
    $w->eMailContent("$nazwaapl. Przypomnienie hasła.", $tresc); $w->eMailSend("$login");
	echo "OK|Dalsze instrukcje postępowania zostały wysłane na podany adres e-mail (<code>$login</code>)."; 
   }
 } else
 if ($f=='r') { // resetuj hasło
   $k=cyk($_REQUEST['k']); $l=cyk($_REQUEST['l']);
   $db = new mysqli($sql_host, $sql_login, $sql_password, $sql_database);
   $zap="select count(id) ile, id from ts_users where login='{$l}' and haslo='{$k}'"; $z=$db->query($zap); // sprawdzenie, czy ten login i key są prawidłowe;
   $wyn=$z->fetch_assoc();
   if ($wyn['ile']>0) {
     $id=$wyn['id'];
	 // RESTUJĘ HASŁO:
	 $nowe=cyk_generujhaslo();
	 $has=$hasloprzed.$nowe.$hasloza;
	 $z=$db->query("update ts_users set haslo=md5('{$has}') where id='{$id}'");
	 require_once("addons/mail_class.php");
	 $w = new eMail('2');
	 $ip = getenv("REMOTE_ADDR").":".getenv("REMOTE_PORT");
     $tresc="Z komputera <strong>$ip</strong> dnia <strong>".date("d.m.y, h:i:s")."</strong> została wysłana prośba o zresetowanie hasła. <br><br>".
      "Twoje nowe tymczasowe hasło to: <b>$nowe</b><br/> Możesz je zmienić po zalogowaniu do systemu.</br>
	   Twój login to: <strong>$l</strong><br/>Adres systemu $nazwaapl: <a href=\"$host\">$host</a><br><br>".$mail_podpis;       
	 $w ->eMailContent("{$nazwaapl}. Nowe tymczasowe hasło.", $tresc); 
	 $w ->eMailSend("{$l}");
	 echo 'Twoje nowe tymczasowe hasło zostało do Ciebie wysłane na podaną skrzynkę email.<br> Po zalogowaniu możesz skorzystać z opcji zmiany hasła.';	
   } else echo 'Brak dostępu.';
 }
 else {
   @$iE=trim(cyk($_REQUEST['iE']));
   @$iP=trim(cyk($_REQUEST['iP']));   
   $x=new TSession();
   $ids=$x->loguj($iE,$iP);
   if ($ids!=1) echo "OK|apl1.php?ids={$ids}"; else echo "ERR|<b>Podano błędny login lub hasło.</b> Spróbuj ponownie. Sprawdź, czy nie masz włączonego przycisku <i>CAPSLOCK.</i><br>";
 }
 
?>

