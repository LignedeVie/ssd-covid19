<!DOCTYPE html><?php require_once "x_cfg.php"; ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="<?php echo $nazwaapl;?>">
    <link rel="icon" href="../../favicon.ico">
    <title><?php echo $nazwaapl;?></title>
    <link href="css/bootstrap.min.css" rel="stylesheet">    
    <!-- Custom styles for this template -->
    <link href="css/signin.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
  </head>
  <body>
    <div class="container">
	<div class="page-header">
        <h1><?php echo $nazwaapl;?></h1>
      </div>
  <form class="form-signin">
        <h2 class="form-signin-heading">Zaloguj się</h2>
        <label for="inputEmail" class="sr-only">Adres email</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Adres email" required autofocus>
        <label for="inputPassword" class="sr-only">Hasło</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div id="loguj" class="btn btn-lg btn-primary btn-block" >Zaloguj</div>
      </form>
    </div>
<div class="modal fade in active" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Uwaga!</h4>
      </div>
      <div id="info" class="modal-body"> 
      </div>
	  <div id="info2" class="modal-body">
	    Jeśli nie pamiętasz hasła, użyj przycisku poniżej:
		<form class="form-signin">
        <div id="przypomnij" class="btn btn-lg btn-primary btn-block" >Resetuj hasło</div>
      </form>
	  </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zamknij</button>
      </div>
    </div>
  </div>
</div>
<script  type="text/javascript">$(document).ready(
function()
{	function loguj() {  
	var iE=$("#inputEmail").val(); var iP=encodeURIComponent($("#inputPassword").val());
	$('#loguj').html('<img src="images/al.gif" /> Trwa uwierzytelnianie...');
	$('#loguj').prop('disabled', true);
	$.ajax({url:"login.php?iE="+iE+"&iP="+iP,success: function(result){
	   var myarr = result.split("|");
       var akcja = myarr[0]; var ids = myarr[1];
	   if (akcja=='ERR') {
	     $("#info").html(ids); $('#myModal').modal('show');	
         $('#loguj').html('Zaloguj');	
		 $('loguj').prop('disabled', false);
	   } else 
	     if (akcja=='OK') window.location.assign(ids);
	}	
	}); }
	function przypomnij() {  		
	var iE=$("#inputEmail").val(); 
	$.ajax({url:"login.php?f=p&email="+iE,success: function(result){
	   var myarr = result.split("|");
       var akcja = myarr[0]; var ids = myarr[1];
	   if (akcja=='ERR') {
	     $("#info").html(ids); $('#myModal').modal('show');	
	   } else 
	     if (akcja=='OK') { $("#info").html(ids); $("#info2").html('');  }
	}	
	}); }
$("#loguj").click(function() { loguj(); });
$("#przypomnij").click(function() { przypomnij(); });
});</script>
  </body>
</html>
