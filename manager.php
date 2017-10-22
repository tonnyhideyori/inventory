<?php
session_start();
if(!isset($_SESSION["manager"])){
	header("location:login_admin.php");
	exit();
}
$managerID=preg_replace('#[^0-9]#i','',$_SESSION["id"]);
$manager=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["manager"]);
$password=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);
include("mysql_connect.php");
$sql=$db->query("SELECT * FROM admin WHERE username='$manager' AND password='$password' AND id='$managerID' LIMIT 1");
if(($sql->num_rows)==0){
	header("location:home.php");
	}

?>
<?php
if(isset($_GET['log'])){
	session_destroy();
	header("location:home.php");
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>home admin</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css" media="screen" />
<link rel="stylesheet" href="W3.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" media="screen" />
<style type="text/css">
a:link {
}
</style>
</head>
<body>
<div align="center" id="wrapper">
<?php include_once("header.php");?>
<div align="center" id="pageContent">
  <p>&nbsp;</p>
    <div align="left" style="margin-left:24px">
      <h2>karibu kwenye ukurasa wa meneja</h2>
      <p><a href="stockage.php">kuongeza bidhaa</a><br />
        <br />
        <a href="history.php">historia ya mauzo yote</a><br />
        <br />
        <a href="today_history.php">historia ya mauzo kwa siku</a><br />
        <br /><a href="inscription.php">Ongeza Muuzaji</a></br>

      </p>

  </div>
  <p>&nbsp;</p>
  <div id="logout" align="right"><h4><a href="manager.php?log" class="btn btn-info" role="button">logout&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h4></div>
  <p>&nbsp;</p>
</div>
  <?php include("footer.php"); ?>

</div>
</body>
</html>
