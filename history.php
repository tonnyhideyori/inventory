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
//this is for viewing all the list
$client_list="";
//$date_=strftime("%y /%m /%d",strtotime(date("Y/m/d")));
$sql=$db->query("SELECT * FROM transactions ORDER BY date_transaction DESC");
if(($sql->num_rows)>0){
	$rows=$sql->fetch_all(MYSQLI_ASSOC);
	foreach($rows as $rows){
	//$id=$rows["id_trans"];
	$username=$rows["username_cl"];
	$date=$rows["date_transaction"];
	$amount=$rows["amount"];
	///////////////////////////////////////////////////////////////////////////////////////////////////////
      $client_list.="<tr><td>$date</td><td>$username</td><td>$amount</td></tr>";
	 /////////////////////////////////////////////////////////////////////////////////
	}
	}
	else{
		 $client_list="Hakuna Mauzo";
		}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Historia ya mauzo</title>
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
  <?php include_once("header.php");?>
  <div id="pageContent"><br />
  <div align="left" style="margin-left:24px;">
      <h2 align="center">Histria ya Mauzo</h2>
      <table class="table table-bordered" width="92%" border="1" cellspacing="0" cellpadding="6">
      <tr>
       
        <td width="23%" bgcolor="#C5DFFA"><strong>Tarehe</strong></td>
        <td width="19%" bgcolor="#C5DFFA"><strong>Username </strong></td>
        <td width="19%" bgcolor="#C5DFFA"><strong>Kiwango(Tsh/=)</strong></td>
        
      </tr>
      <?php echo"$client_list" ?>
      </table>
    </div>
</div>
  <?php include("footer.php"); ?>
</div>
</body>
</html>