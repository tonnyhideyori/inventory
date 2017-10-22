<?php
session_start();
if(isset($_SESSION["manager"])){
	header("location:manager.php");
	exit();
}
?>
<?php
if(isset($_POST["username"])&&isset($_POST["password"])){
$manager=preg_replace('#[^A-Za-z0-9]#i','',$_POST["username"]);
$password=preg_replace('#[^A-Za-z0-9]#i','',$_POST["password"]);

include('mysql_connect.php');
$sql=$db->query("SELECT id FROM admin WHERE username='$manager' AND password='$password' LIMIT 1");
if($sql->num_rows){
	$rows=$sql->fetch_all(MYSQLI_ASSOC);
	foreach($rows as $rows){
	$id=$rows["id"];
	}
	$_SESSION["id"]=$id;
	$_SESSION["manager"]=$manager;
	$_SESSION["password"]=$password;
	header("location:manager.php");
	exit();
	}
	else{
		echo "<script>alert('hatuna Taarifa zako');
			 window.location.href='login.php'
			 </script>";
			 }
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login admin</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="W3.css" type="text/css" media="screen" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
</head>

<body>
<div align="center" id="wrapper">
<?php include("header.php"); ?>
  <div id="pageContent"><br />
    <div align="left" style="margin-left:24px;">
      <h2>Jitambulishe!</h2><br />
      <form id="form2" name="form2" method="post" action="login_admin.php">
				<table>
          <tr><td><label><br><i>Jina(Username)</i></br></label></td><td><input name="username" type="text" id="username_admin" size="40" style="height:25px" /></td></tr>
          <tr><td><label><br><i>Neno siri(password)</i></label></td><td><input name="password" type="password" id="password" size="40" style="height:25px" /></td></tr>
				 <tr><td></td><td><input type="submit" name="button" id="button1" value="S'identifier" /></td></tr>
          </table>
      </form>
      <p>&nbsp; </p>
    </div>
    <br />
  <br />
  <br />
  </div>
    <?php include("footer.php"); ?>
 </div>
 </body>
 </html>
