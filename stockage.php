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
//error reporting
error_reporting(E_ALL);
ini_set('display_errors','1');
?>
<?php
//supprimer un article
if(isset($_GET['supid'])){
	echo'Unataka kufuta hii bidhaa '.$_GET['supid'].'? <a href="stockage.php?ouidel='.$_GET['supid'].'">NDIO</a>|<a href="stockage.php">HAPANA</a>';
	exit();
	}
if(isset($_GET['ouidel'])){
	//remove the article from th system and delete the photo
	//delete from database
	$id_del=$_GET['ouidel'];
	$sql=$db->query("DELETE FROM bidhaa WHERE id_art='$id_del' LIMIT 1");
	//unlink image from database
	$photodelet=("image/$id_del.jpg");
	if(file_exists($photodelet)){
		unlink($photodelet);
		}
		header("location:stockage.php");
	}

?>
<?php
//adding the aryicle to the data base
if(isset($_POST['nom_produit'])){
	$nom_produit=$db->real_escape_string($_POST['nom_produit']);
	$qte=$db->real_escape_string($_POST['quantite']);
	$prix=$db->real_escape_string($_POST['prix']);
	$marque=$db->real_escape_string($_POST['marque']);
	$category=$db->real_escape_string($_POST['category']);
/* 	$sqt=$db->query("SELECT id_art FROM products WHERE name_art='$nom_produit' 1");
 */
 if($sqt=$db->query("SELECT id_art FROM bidhaa WHERE name_article='$nom_produit' LIMIT 1")){
	  if($sqt->num_rows==0){
		  $sql=$db->query("INSERT INTO bidhaa(date_added,category,mark,name_article,price,quantity)VALUES(now(),'$category','$marque','$nom_produit','$prix','$qte')")or die(mysql_error());
	$pid=mysqli_insert_id($db);
	/*$imagename="$pid.jpg";
	move_uploaded_file($_FILES['fileField']['tmp_name'],"image/$imagename");*/
	header("location:stockage.php");
		  }
	   else{
	  echo 'Samahani hakikisha bidhaa uliyoweka,'. '<a href="stockage.php">Bonyeza Hapa</a>';
       exit();
	   }
	}

	}
?>
<?php
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
	 <td><a href='stockage_edit.php?idp=$id' class='btn btn-info'>badilisha</a></td>
	 <td><a href='stockage.php?supid=$id'class='btn btn-danger'>futa</a></td></tr>";
	 /////////////////////////////////////////////////////////////////////////////////
	}
	}
	else{
		 $product_list='<script type="text/javascript"> alert("hauna bidhaa")</script>';
		}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bidhaa</title>
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
    <div align="right" style="margin-right:32px;"><a href="stockage.php#stockForm"><span class="glyphicon glyphicon-plus"></span> Weka bidhaa mpya!</a></div>
<div align="left" style="margin-left:24px;">
      <h2>orodha ya Bidhaa</h2>
      <table class="table table-bordered" width="92%" border="1" cellspacing="0" cellpadding="6">
      <tr>
        <td width="23%" bgcolor="#C5DFFA"><strong>Tarehe kaingizwa</strong></td>
        <td width="19%" bgcolor="#C5DFFA"><strong>Jina la bidhaa</strong></td>
        <td width="19%" bgcolor="#C5DFFA"><strong>Idadi</strong></td>
        <td width="18%" bgcolor="#C5DFFA"><strong>Badilisha</strong></td>
        <td width="21%" bgcolor="#C5DFFA"><strong>Ondoa</strong></td>
      </tr>
      <?php echo"$product_list" ?>
      </table>
    </div>
    <hr />
    <a name="stockForm" id="stockForm"></a>
    <h3 align="center">
    &darr; Ongeza Bidhaa Mpya &darr;
    </h3>
    <form action="stockage.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
    <table width="90%" border="0" cellspacing="0" cellpadding="6">
      <tr>
        <td width="20%" align="right"><label>Jina la Bidhaa</label></td>
        <td width="80%"><span id="sprytextfield1">
          <input name="nom_produit" type="text" id="nom_produit" size="64" />
          <span class="textfieldRequiredMsg">Jina linaitajika.</span></span></td>
      </tr>
      <tr>
        <td align="right"><label>Bei Tsh</label></td>
        <td><span id="sprytextfield2">
          <input name="prix" type="text" id="prix" size="12" />
        <span class="textfieldRequiredMsg">Bei inaitajika.</span><span class="textfieldInvalidFormatMsg">mfumo hautambuliki.</span></span></td>
      </tr>
      <tr>
        <td align="right"><label for="textfield">Idadi</label></td>
        <td>
          <span id="sprytextfield3">
          <input type="text" name="quantite" id="quantite" />
          <span class="textfieldRequiredMsg">Idadi inaitajika.</span><span class="textfieldInvalidFormatMsg">mfumo hautambuliki.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMinValueMsg">The entered value is less than the minimum required.</span></span></td>
      </tr>
      <tr>
        <td align="right"><label>Kategori</label></td>
        <td>
          <select name="category" id="category">
          <option value="tablet">Tablet</option>
           <option value="laptop">Laptop</option>
          <option value="smartphone" selected="selected">Smartphone</option>
          </select>
        </td>
      </tr>
      <tr>
        <td align="right"><label>Jina la kampuni</label></td>
        <td>
          <select name="marque" id="marque">
          <option value="apple">Apple</option>
          <option value="lg">LG</option>
           <option value="sony">Sony</option>
          <option value="samsung" selected="selected">Samsung</option>
          </select>
        </td>
      </tr>
      
      <tr>
        <td>&nbsp;</td>
        <td>
          <input type="submit" name="button" class="btn btn-info" id="button" value="Ongeza" />
        </td>
      </tr>
    </table>
    </form>
    <br />
  <br />
  </div>
  <?php include("footer.php"); ?>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "currency", {validateOn:["blur"]});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {minChars:1, minValue:0});
</script>
</body>
</html>
