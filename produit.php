<?php 
//error reporting
error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<?php 
// Check to see the URL variable is set and that it exists in the database
if (isset($_GET['id'])) {
	// Connect to the MySQL database  
    include "mysql_connect.php"; 
	$id = preg_replace('#[^0-9]#i', '', $_GET['id']); 
$sql=$db->query("SELECT * FROM bidhaa WHERE id_art='$id' LIMIT 1");
if(($sql->num_rows)>0){
	$rows=$sql->fetch_all(MYSQLI_ASSOC);
	foreach($rows as $rows){
	$id=$rows["id_art"];
    $name_art=$rows["name_art"];
	$prix=$rows["price"];
	$category=$rows["category"];
	$date_added=strftime("%d /%b /%y",strtotime($rows["date_added"]));
    
	}
	}
	else{
		 echo"Hiyo bidhaa haipo";
		 exit();
		}

	}
		
 else {
	echo "Hakuna kitu.";
	exit();
}
$db->close();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $name_art; ?></title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" media="screen" />



</head>
<body>
<div align="center" id="wrapper">
  <?php include("header.php");?>
  <div id="pageContent">
  <!--<table width="100%" border="0" cellspacing="0" cellpadding="1">
  <tr>
    <td width="20%" valign="top"><a href="image/<?php echo $id; ?>.jpg"><img src="image/<?php echo $id; ?>.jpg" width="142" height="188" alt="<?php echo $name_art; ?>" /></a><br />
      <a href="image/<?php echo $id; ?>.jpg">Full size</a></td>
    <td width="80%" valign="top" align="left"><h3><?php echo $name_art; ?></h3>
      <p><h4><?php echo "Tsh&nbsp;".$prix; ?></h4><br />
        <br />
        <?php echo "$category"; ?> <br />
<br />
        </p>
      <form id="form1" name="form1" method="post" action="pannie.php">
        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
        <input type="submit" name="button" id="button" value="au pannie" style="color:#0000CC" />
      </form>
      </td>
    </tr>
</table> -->

<!--<div style="float:left; margin-top:30px; margin-left:40px; padding:2px;">
<a href="image/<?php echo $id; ?>.jpg">
<img src="image/<?php echo $id; ?>.jpg" width="142" height="188" alt="<?php echo $name_art; ?>" /></a><br />
<a href="image/<?php echo $id; ?>.jpg">Full size</a>
</div>-->

<div style="text-align:left; padding-left:10px; margin-left:200px;margin-top:30px;">
<h3><?php echo $name_art; ?></h3><br />
      <p><h4><?php echo "Tsh&nbsp;".$prix; ?></h4><br />
        <?php echo "$category"; ?> <br />
<br />
        </p>
      <form id="form1" name="form1" method="post" action="pannie.php">
        <input type="hidden" name="pid" id="pid" value="<?php echo $id; ?>" />
        <input class="btn btn-info btn-md" type="submit" name="button" id="button" value="Kapuni" />
      </form>
</div>
  </div>
  <?php include("footer.php");?>
</div>
</body>
</html>