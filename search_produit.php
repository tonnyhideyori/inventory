
<?php 
//error reporting
error_reporting(E_ALL);
ini_set('display_errors','1');
?>

<?php
if (isset($_POST['searching'])) {
	// Connect to the MySQL database  
    include "mysql_connect.php";
	$liste_dynamic="";  
/* 	 $name=$_POST['search'];
 */ 
 $name=$_POST['searching'];
/*  if(empty($name)){echo '<div id=pageContent>ecrir qlq chose<h4><a href="home.php#home"></a></h4></div>';	
exit();
} */
$sql=$db->query("SELECT * FROM bidhaa WHERE name_article LIKE '%$name%' ");
if(($sql->num_rows)>0){
	$rows=$sql->fetch_all(MYSQLI_ASSOC);
	foreach($rows as $rows){
	$id=$rows["id_art"];
    $name_art=$rows["name_article"];
	$prix=$rows["price"];
	$qte=$rows["quantity"];
	$category=$rows["category"];
	$date_added=strftime("%d /%b /%y",strtotime($rows["date_added"]));
    $liste_dynamic.="<tr><td>$date_added</td><td>$name_art</td><td>$qte</td>
	 <td><form id='form1' name='form1' method='post' action='pannie.php'>
        <input type='hidden' name='pid' id='pid' value='".$id."'/>
        <input class='btn btn-info btn-md' type='submit' name='button' id='button' value='Kikapuni' /></form>;</td></tr>";
	}
	}
	else{
     $liste_dynamic.="<h1>hatuna hiyobidhaa kwa sasa</h1><h4><a href='home.php'>Bonyeza hapa</a></h4>";	
		}
	 
	
	}
		
 else {
echo '<div id=pageContent>Andika bidhaa<h4><a href="home.php#home">Bonyeza Hapa/a></h4></div>';	
exit();
}

$db->close();	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $name_art; ?></title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
<link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css"/>
<link rel="stylesheet" href="W3.css" type="text/css" media="screen" />
<script type="text/javascript" src="jquery-1.12.3.js"></script>
<script type="text/javascript" src="jquery-1.12.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>

<body>
<div align="center" id="wrapper">
<?php include_once("header.php");?>
<div  id="pageContent">
<table class="table table-bordered" width="92%" border="1" cellspacing="0" cellpadding="6">
      <tr>
        <td width="23%" bgcolor="#C5DFFA"><strong>Tarehe kaingizwa</strong></td>
        <td width="19%" bgcolor="#C5DFFA"><strong>Jina la bidhaa</strong></td>
        <td width="19%" bgcolor="#C5DFFA"><strong>Idadi</strong></td>
        <td width="18%" bgcolor="#C5DFFA"><strong>Nunua</strong></td>
       
      </tr>
      <?php echo"$liste_dynamic" ?>
      </table>
 </div>
<!--<?php echo "$liste_dynamic" ?>-->

<?php include("footer.php"); ?>
</div>
</body>
</html>