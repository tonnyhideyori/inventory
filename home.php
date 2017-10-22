<?php
//error reporting
error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<?php
include("mysql_connect.php");
if(isset($_GET['id'])){
$sqt=$db->query("DELETE FROM paid");
}
$db->close();
?>
<?php 
/* session_start();  */

 ?>


<?php
//this is for viewing all the list

include("mysql_connect.php");
/*$liste_dynamic="";
$liste_dynami="";
$sql=$db->query("SELECT * FROM bidhaa ORDER BY date_added ASC LIMIT 10");
if(($sql->num_rows)>0){
	$rows=$sql->fetch_all(MYSQLI_ASSOC);
	foreach($rows as $rows){
	$id=$rows["id_art"];
    $name_art=$rows["name_article"];
	$qte=$rows["quantity"];
	$prix=$rows["price"];
	$date_added=strftime("%d /%b /%y",strtotime($rows["date_added"]));
	 $liste_dynami.='
	<div class="container" style="width:900px; padding-top:5px; margin-top:5px;">
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">

	<div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">'.$name_art.'</div>
        <div class="panel-footer">DA '.$prix.' </div>
        <form id="form1" class="form-horizontal" role="form" name="form1" method="post" action="pannie.php">
	    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
                <input type="hidden" name="pid" id="pid" value="'.$id.'" />
        <input type="submit" class="btn btn-info" name="button" id="button" value="au pannie" />

        </div>
        </div>
        </form>
      </div>
    </div>
  </div>';
  
     $liste_dynamic.='<div id="php"><table width="306" border="0" cellpadding="1">
    <tr>
      <td width="140" height="152"> <a href="produit.php?id='.$id.'">
      <td width="140" height="152" valign="top">'.$name_art.'<br />
        DA'.$prix.'<br /><!--<a href="pannie.php?id='.$id.'">achete</a><br/> -->
        <a href="produit.php?id='.$id.'">view</a></td>
    </tr>
  </table></div>';
	}
	}
	else{
		 $liste_dynamic="Desolez! Nous n'avons pas les aricles maintenant";
		}*/
		
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////////DYNAMIC LISTING OF PRODUCT/////////////////////////////////////////////////////////////////////////////
		
		
//this is for viewing all the list
$product_list="";
$sql=$db->query("SELECT * FROM bidhaa ORDER BY date_added DESC");
if(($sql->num_rows)>0){
	$rows=$sql->fetch_all(MYSQLI_ASSOC);
	foreach($rows as $rows){
	$id=$rows["id_art"];
    $name_art=$rows["name_article"];
	$qte=$rows["quantity"];
	$date_added=strftime("%d /%b /%y",strtotime($rows["date_added"]));
	///////////////////////////////////////////////////////////////////////////////////////////////////////
      $product_list.="<tr><td>$date_added</td><td>$name_art</td><td>$qte</td>
	 <td><form id='form1' name='form1' method='post' action='pannie.php'>
        <input type='hidden' name='pid' id='pid' value='".$id."'/>
        <input class='btn btn-info btn-md' type='submit' name='button' id='button' value='Kikapuni' /></form>;</td></tr>";  
	 ////////////////<a href='stockage_edit.php?idp=$id' class='btn btn-info'>badilisha</a>/////////////////////////////////////////////////////////////////
	}
	}
	else{
		 $product_list='<script type="text/javascript"> alert("hauna bidhaa")</script>';
		}
		
		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$db->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home</title>


<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
<link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css"/>
<link rel="stylesheet" href="W3.css" type="text/css" media="screen" />
  <script type="text/javascript" src="jquery-1.12.3.js"></script>
<script type="text/javascript" src="jquery-1.12.3.min.js"></script>

 <script src="js/bootstrap.min.js"></script>
  <style>
  .carousel-inner > .item > img,
  .carousel-inner > .item > a > img {
      width: 70%;
      margin:auto;
	  margin-bottom:10px;
  }
  </style>


<style type="text/css">
.slider{
overflow:hidden;
width:500px;
height:570px;
margin:30px auto;
	 }
.slider img{
	width:500px;
    height:570px;
    display:none;
	}
</style>
</head>
<body data-spy="scroll" data-target="#pageContent" data-offset="50">
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
      <?php echo"$product_list" ?>
      </table>
 </div>
 <?php include("footer.php"); ?>
</div>
</body>
</html>