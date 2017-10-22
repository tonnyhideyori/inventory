<?php
error_reporting(E_ALL);
ini_set('display_errors','1');
?>
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
?>
<?php
$content=""; 
$i=0;
$sqt=$db->query("SELECT * FROM paid");
		if(($sqt->num_rows)>0){
		$rows=$sqt->fetch_all(MYSQLI_ASSOC);
		foreach($rows as $rows){
            $name_art=$rows["name_art"];	
			$price=$rows["price"];
			$qt=$rows["qte"];
			$date=$rows["date"];
			$content.="<tr>";
		$content.="<td>$name_art</td><td> $qt</td><td>$price</td>";
		$content.="</tr>";
		$i++;
		}
		
		}
		$i=$i-$i;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>recipt</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" media="screen" />
</head>

<body>
<div align="center" id="wrapper">

<?php include_once("header.php");?>
<div align="center" id="pageContent">
<p ><h4 align="center"><?php if(!empty($qt)){echo"Your order";} else{echo "You haven't order anything go to <a href='home.php'>home</a>";}  ?></h4></p>
<table class="table table-bordered" width="92%" border="1" cellspacing="0" cellpadding="6">
      <tr>
        
        <td width="19%" bgcolor="#C5DFFA"><strong>Nom de l'article</strong></td>
        <td width="19%" bgcolor="#C5DFFA"><strong>Quantiter</strong></td>
        <td width="18%" bgcolor="#C5DFFA"><strong>Price</strong></td>
      </tr>
      <?php echo $content; ?>
      </table>
<br />
<div>
<?php 
if(!empty($qt))
{echo'<div align="center" style=" color:darkblue">
<h4>do you want to save your receipt</h4> 
<a  href="save.php?idp">YES</a>|<a href="home.php?id=me" >NON</a></div>';}
?> 
</div>
</div>
<?php include("footer.php"); ?>

</div>

</body>
<script type="text/javascript">
function gohome(){
	window.location("home.php")
	}
</script>
</html>