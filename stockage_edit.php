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
if(isset($_GET['idp'])){
$want_id=$_GET['idp'];
$sql=$db->query("SELECT * FROM bidhaa WHERE id_art='$want_id LIMIT 1'");
if(($sql->num_rows)>0){
	$rows=$sql->fetch_all(MYSQLI_ASSOC);
	foreach($rows as $rows){
	$id=$rows["id_art"];
    $name_art=$rows["name_article"];
	$qte=$rows["quantity"];
	$prix=$rows["price"];
	$category=$rows["category"];
	$marque=$rows["mark"];
	$date_added=strftime("%d /%b /%y",strtotime($rows["date_added"]));

	}
	}
	else{
		 echo"hiyo bidhaa haipo";
		 header("location:stockage_edit.php");
		 exit();
		}
	}

?>


<?php
//adding the article to the data base
if(isset($_POST['nom_produit'])){
	$pid=$db->real_escape_string($_POST['thisID']);
	$nom_produit=$db->real_escape_string($_POST['nom_produit']);
	$qte=$db->real_escape_string($_POST['quantite']);
	$prix=$db->real_escape_string($_POST['prix']);
	$marque=$db->real_escape_string($_POST['marque']);
	$category=$db->real_escape_string($_POST['category']);
	$sqt=$db->query("UPDATE bidhaa SET quantity='$qte',name_article='$nom_produit',price='$prix',date_added=now(),category='$category',mark='$marque' WHERE id_art='$pid'");
   if($_FILES['fileField']['tmp_name']!=""){
	$imagename="$pid.jpg";
	move_uploaded_file($_FILES['fileField']['tmp_name'],"image/$imagename");

   }
   header("location:stockage.php");
	exit();
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>stockage edit</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" media="screen" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script>
</head>
<body>
<div align="center" id="wrapper">
  <?php include_once("header.php");?>
  <div id="pageContent"><br />
    <div align="right" style="margin-right:32px;"><a href="stockage.php#stockForm"><span class="glyphicon glyphicon-plus"></span> ajouter nouvelle article</a></div>

    <hr />

    <a name="stockForm" id="stockForm"></a>
    <h3>
    &darr; Modification  d'article &darr;
    </h3>
    <form action="stockage_edit.php" enctype="multipart/form-data" name="myForm" id="myform" method="post">
			<table width="90%" border="0" cellspacing="0" cellpadding="6">
	      <tr>
	        <td width="20%" align="right"><label>Jina la bidhaa</label></td>
	        <td width="80%"><span id="sprytextfield1">
	          <input name="nom_produit" type="text" id="nom_produit" size="64" value="<?php echo $name_art ?>" />
	          <span class="textfieldRequiredMsg">jina la bidhaa linaitajika.</span></span></td>
	      </tr>
	      <tr>
	        <td align="right"><label>Bei Tsh/=</label></td>
	        <td><span id="sprytextfield2">
	          <input name="prix" type="text" id="prix" size="12" value="<?php echo $prix ?>" />
	        <span class="textfieldRequiredMsg">Bei ya bidhaa inaitajika.</span><span class="textfieldInvalidFormatMsg">mfumo haufahamiki.</span></span></td>
	      </tr>
	      <tr>
	        <td align="right"><label for="textfield">idadi</label></td>
	        <td>
	          <span id="sprytextfield3">
	          <input type="text" name="quantite" id="quantite" value="<?php echo $qte; ?>"/>
	          <span class="textfieldRequiredMsg">Une valeur est requise.</span><span class="textfieldInvalidFormatMsg">mfumo haufahamiki.</span><span class="textfieldMinCharsMsg">Minimum number of characters not met.</span><span class="textfieldMinValueMsg">The entered value is less than the minimum required.</span></span></td>
	      </tr>
	      <tr>
	        <td align="right"><label>Categorie</label></td>
	        <td>
	          <select name="category" id="category">
              <option value="<?php echo $category ?>" selected="selected"><?php echo $category ?></option>
	          <option value="tablet">Tablet</option>
	           <option value="laptop">Laptop</option>
	          <option value="smartphone" >Smartphone</option>
	          </select>
	        </td>
	      </tr>
	      <tr>
	        <td align="right"><label>Marque</label></td>
	        <td>
	          <select name="marque" id="marque">
              <option value="<?php echo $marque ?>" selected="selected"><?php echo $marque ?></option>
	          <option value="apple">Apple</option>
	          <option value="lg">LG</option>
	           <option value="sony">Sony</option>
	          <option value="samsung" >Samsung</option>
	          </select>
	        </td>
	      </tr>
	      <tr>
	        <td>&nbsp;</td>
	        <td><input name="thisID" type="hidden" value="<?php echo $id; ?>" />
	          <input type="submit" name="button" class="btn btn-info" id="button" value="Valider" />
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
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "currency", {format:"dot_comma", isRequired:false});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "integer", {minChars:1, minValue:0, isRequired:false});
</script>
</body>
</html>
