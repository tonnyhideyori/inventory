<?php require('mysql_connect.php'); ?>
<?php
if(isset($_POST['submit_admin'])){
	$nom=$db->real_escape_string($_POST['nom_admin']);
	$prenom=$db->real_escape_string($_POST['prenom_admin']);
	$username=$db->real_escape_string($_POST['username']);
	$email=$db->real_escape_string($_POST['email_admin']);
	$password=$db->real_escape_string($_POST['password_admin']);
	if($sqt=$db->query("SELECT username FROM admin WHERE username='$username'")){
		if($sqt->num_rows==0){
			$sql=$db->query("INSERT INTO admin(username,last_log,password)
			VALUES('$username',now(),'$password')")or die(mysql_error());
			}
			else{
				echo 'Jina limeshatumika chagua lengine'. '<a href="new_admin.php"><button type="button" class="btn btn-success">Bonyeza Hapa</button>
      <br /></a>';
				//header("location:inscription.php");
				exit();
				}

		}
	header("location:manager.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Kujiandikisha</title>
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

  <form action="new_admin.php" enctype="multipart/form-data" method="post" name="form">
  <fieldset>
  <legend align="center" style="text-align:center" ><h3>Inscription</h3></legend>
    <table width="66%" border="0" cellspacing="0" cellpadding="0">
      
      <tr>
        <td align="right"><h4>Username</h4></td>
        <td><label for="textfield"></label>
          <input type="text" name="username" id="username_admin" size="50"/></td>
      </tr>
      <tr>
        <td align="right">
          <label><h4>Neno siri(password)</h4></label>
        </td>
        <td><span id="sprypassword1">
        <label for="password_admin"></label>
        <input type="password" name="password_admin" id="password_admin" />
        <span class="passwordRequiredMsg">"password" inaitajika.</span><span class="passwordMinCharsMsg">Weka angalau alama sita(6).</span></span></td>
      </tr>

      <tr>
        <td colspan="2" align="center"><input type="submit" name="submit_admin" id="submit_admin" value="Kubali" /></td>
      </tr>

    </table>
  </fieldset>
    </form>

    <br />

  </div>
    <?php include("footer.php"); ?>
</div>
<script type="text/javascript">
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {minChars:6});
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "email");
</script>
</body>
</html>
