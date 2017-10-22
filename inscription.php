<?php require('mysql_connect.php'); ?>
<?php
if(isset($_POST['submit_client'])){
	$nom=$db->real_escape_string($_POST['nom_client']);
	$prenom=$db->real_escape_string($_POST['prenom_client']);
	$username=$db->real_escape_string($_POST['username']);
	$adress=$db->real_escape_string($_POST['adress_client']);
	$tel=$db->real_escape_string($_POST['telephone_client']);
	$password=$db->real_escape_string($_POST['password_client']);
	if($sqt=$db->query("SELECT username FROM client WHERE username='$username'")){
		if($sqt->num_rows==0){
			$sql=$db->query("INSERT INTO client(nom_client,prenom_client,password,username,adress_client,telephone)
			VALUES('$nom','$prenom','$password','$username','$adress','$tel')")or die(mysql_error());
			
			 echo "<script>alert('umefanikiwa kujisajiri');
			 window.location.href='manager.php'
			 </script>";
			}
			else{
				 echo "<script>alert('Jina linatumika tiyari chagua jina lengine');
			 window.location.href='inscription.php'
			 </script>";
				}

		}

	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Inscription</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" media="screen" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#wrapper #pageContent form fieldset h3 {
	color: #900;
}
</style>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
</head>

<body>
<div align="center" id="wrapper">
  <?php include_once("header.php");?>
  <div id="pageContent">

  <form class="form-horizontal" role="form" action="inscription.php" enctype="multipart/form-data" method="post" name="form" style="width:500px; float:left; padding-left:20px; text-align:center">
   <fieldset>
   <table><tr><td><legend ><h2>Hauna Akaunti,Jiandikishe</h2></legend></td></tr></table>
   <div class="form-group">
    <div class="col-sm-10">
      <input type="text" class="form-control" name="nom_client"id="nom_client" placeholder="Andika jina la la Ukoo">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <input type="text" class="form-control" name="prenom_client"id="prenom_client" placeholder="Andika jina">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <input type="text" class="form-control" name="username" id="username"  placeholder="Andika Jina La Matumizi">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
    <span id="sprytextfield2">
      <input type="text" class="form-control" name="telephone_client" id="telephone_client" placeholder="Andika Number Ya simu">
      <!--<span class="textfieldRequiredMsg"></span><span class="textfieldInvalidFormatMsg"></span> --></span>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
    <textarea name="adress_client" id="adress_client" class="form-control" rows="5" placeholder="Andika Anuani Yako(Mahali Unapoishi)"></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
    <span id="sprypassword1">
      <input type="password" class="form-control" name="password_client" id="password_client"  placeholder="Weka neno siri (Angalau herufi 6)">
      <!--<span class="passwordRequiredMsg"></span>
        <span class="passwordMinCharsMsg" ></span> -->
        </span>
    </div>
  </div>

  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-info" name="submit_client" id="submit_client" ><i>Andikisha</i></button>
    </div>
  </div>
  </fieldset>
</form>

  </div>
    <?php include("footer.php"); ?>
</div>
<script type="text/javascript">
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {minChars:6});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "phone_number", {format:"phone_custom", hint:"Weka nambari ya simu"});
</script>
</body>
</html>
