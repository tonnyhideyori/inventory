<?php
session_start();
if(!isset($_SESSION["client"])){
	header("location:login.php");
	exit();
}
$clientID=preg_replace('#[^0-9]#i','',$_SESSION["id"]);
$client=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["client"]);
$password=preg_replace('#[^A-Za-z0-9]#i','',$_SESSION["password"]);
include("mysql_connect.php");
$sql=$db->query("SELECT * FROM client WHERE username='$client' AND password='$password' AND id_client='$clientID' LIMIT 1");
if(($sql->num_rows)==0){
	header("location:home.php");
	}
	else{
		$client_list="";
		$sql=$db->query("SELECT * FROM client WHERE username='$client' AND password='$password' AND id_client='$clientID' LIMIT 1");
        if(($sql->num_rows)>0){
  	$rows=$sql->fetch_all(MYSQLI_ASSOC);
	foreach($rows as $rows){
	$id=$rows["id_client"];
	$username=$rows["username"];
    $nom=$rows["nom_client"];
	$prenom=$rows["prenom_client"];
	$adress=$rows["adress_client"];
	$telephone=$rows["telephone"];
	$client_list.="<p><br/><h4>$nom&nbsp;&nbsp;$prenom</h4><br/>";

	}
		}
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
<title><?php echo $username; ?></title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="W3.css" type="text/css" media="screen" />
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
      <h2>karibu kwenye ukurasa wako!</h2>
      <p><?php echo $client_list; ?></p>
      <p><br />
        <a href="history_cl.php">historia ya manunuzi</a><br />

      </p>

  </div>
  <p>&nbsp;</p>
  <div id="logout" align="right"><h4><a href="client.php?log" class="btn btn-info" role="button">logout&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></h4></div>
  <p>&nbsp;</p>
</div>
  <?php include("footer.php"); ?>

</div>
</body>
</html>
