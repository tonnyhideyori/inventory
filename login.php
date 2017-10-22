<?php
session_start();
if(isset($_SESSION["client"])){
	if(isset($_POST['pid'])||isset($_GET['id'])){
	header("location:pannie.php");
	exit();}else{header("location:client.php");
	
	}
}
?>
<?php
if(isset($_POST["username"])&&isset($_POST["password"])){
$client=preg_replace('#[^A-Za-z0-9]#i','',$_POST["username"]);
$password=preg_replace('#[^A-Za-z0-9]#i','',$_POST["password"]);

include('mysql_connect.php');
$sql=$db->query("SELECT id_client FROM client WHERE username='$client' AND password='$password' LIMIT 1");
if($sql->num_rows){
	$rows=$sql->fetch_all(MYSQLI_ASSOC);
	foreach($rows as $rows){
	$id=$rows["id_client"];
	}
	$_SESSION["id"]=$id;
	$_SESSION["client"]=$client;
	$_SESSION["password"]=$password;
	
	header("location:pannie.php");
	exit();
	}
	else{
		echo "<script>alert('Taarifa zako hazipo kwenye rekodi zetu');
			 window.location.href='login.php'
			 </script>";
	}
}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Log In </title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" media="screen" /></head>

<body>
<div align="center" id="wrapper">
<?php include("header.php"); ?>
  <div id="pageContent"><br />
    <!--<div align="left" style="margin-left:24px;">
      <h2>J'ai un compte, je m'identifie!</h2>
      <form id="form1" name="form1" method="post" action="login.php">
        <table>
          <tr><td><label><i>Votre Nom d'utilisateur</i></label></td><td><input name="username" type="text" id="username" size="40" style="height:25px;" /></td></tr>
        
         <tr><td><label><h4>Votre mot de passe</h4></label></td><td><input name="password" type="password" id="password" size="40" /></td></tr>
         <tr><td></td><td><input type="submit" name="button" id="button" value="S'identifier" /></td></tr>
          </table>

      </form> -->
      <div align="left" style="margin-left:24px;">
      <h2>Jiunganishe </h2><br />
      <form id="form2" name="form1" method="post" action="login.php">
				<table>
          <tr><td><label><br><i>Jina La Matumizi(Username)</i></br></label></td><td><input name="username" type="text" id="username_admi" size="40" style="height:25px" /></td></tr>
          <tr><td><label><br><i>Neno siri(Password)</i></label></td><td><input name="password" type="password" id="password" size="40" style="height:25px" /></td></tr>
				 <tr><td></td><td><input name="button" type="submit" class="btn btn-warning"  id="button" value="Ingia" /></td></tr>
          </table>
      </form>
      <p>&nbsp; </p>
    </div>
    <br />
  <br />
  </div>
  <?php include("footer.php"); ?>
</div>
</body>
</html>
