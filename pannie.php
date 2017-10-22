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
//adding atricle to the pannie
if(isset($_POST['pid'])||isset($_GET['id'])){

	$pid=$_POST['pid'];
	$wasFound = false;
	$i = 0;
/*  	$id= preg_replace('#[^0-9]#i', '', $_GET['id']);
 */
 if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
		$_SESSION["cart_array"] = array(0 => array("item_id" => $pid, "quantity" => 1));
		}
		else{
			foreach ($_SESSION["cart_array"] as $each_item) {
		      $i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "item_id" && $value == $pid) {

					  array_splice($_SESSION["cart_array"], $i-1, 1, array(array("item_id" => $pid, "quantity" => $each_item['quantity'] + 1)));
					  $wasFound = true;
				  }
		      }
	       }
		   if ($wasFound == false) {
			   array_push($_SESSION["cart_array"], array("item_id" => $pid, "quantity" => 1));
		   }
			}
			header("location: pannie.php");
    exit();
	}
?>

<?php
if (isset($_GET['cmd']) && $_GET['cmd'] == "videpannie") {
    unset($_SESSION["cart_array"]);
}
?>


<?php
//removing an article
if (isset($_POST['id_remove']) && $_POST['id_remove'] != "") {
    // Access the array and run code to remove that array index
 	$key_remove = $_POST['id_remove'];
	if (count($_SESSION["cart_array"]) <= 1) {
		unset($_SESSION["cart_array"]);
	} else {
		unset($_SESSION["cart_array"]["$key_remove"]);
		sort($_SESSION["cart_array"]);
	}
}
?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//       if user attempts to modify something to the cart in the cart
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if (isset($_POST['id_mod']) && $_POST['id_mod'] != "") {
	$mod_art=$_POST['id_mod'];
	$qte=$_POST['quantinte'];
	$qte=preg_replace('#[^0-9]#i','',$qte);
	$i=0;
	if($qte>999){
		$qte=999;
		}
		if($qte<1){
		$qte=1;
		}
	foreach ($_SESSION["cart_array"] as $each_item) {
		      //$i++;
		      while (list($key, $value) = each($each_item)) {
				  if ($key == "item_id" && $value == $mod_art) {

					  array_splice($_SESSION["cart_array"], $i, 1, array(array("item_id" => $mod_art, "quantity" => $qte)));
					  $wasFound = true;
				  }
		      }
			  $i++;
	       }
	}


 ?>
<!-- ///////////////////////////////////////////////////////////////////////////////////////////////////// -->

<?php
//showing the articles in the page
$cartOutput = "";
$cartTotal="";
if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    $cartOutput = "<h2 align='center'>Hauna manunuzi</h2>";
}else{
	$i=0;
	foreach ($_SESSION["cart_array"] as $each_item) {

		$art_id=$each_item['item_id'];
		$sqt=$db->query("SELECT * FROM bidhaa WHERE id_art='$art_id' LIMIT 1");
		if(($sqt->num_rows)>0){
		$rows=$sqt->fetch_all(MYSQLI_ASSOC);
		foreach($rows as $rows){
            $name_art=$rows["name_article"];
			$price=$rows["price"];
		}
		$total=$price*$each_item['quantity'];
		$cartTotal=$total+$cartTotal;
		//dynamic table row assembly
		$cartOutput.='<tr>';
		///////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$cartOutput .= '<td><a href="produit.php?id=' . $art_id . '">' . $name_art . '</a></td>';
		////////////////////////<a href="produit.php?id=' . $art_id . '"></br><<img src="image/' . $art_id . '.jpg" alt="' . $name_art . '" width="40" height="52" border="1" /></a>///////////////////////////////////////////////////////////////////////////////////////
		$cartOutput.='<td> Tsh '.$price.'</td>';
		$cartOutput.='<td><form action="pannie.php" method="post" enctype="multipart/form-data">
		<input name="quantinte" type="text" size="3" maxlength="3" value="'.$each_item['quantity'].'" />
		<input name="modbut"'.$art_id .' type="submit" class="btn btn-primary" value="BADILISHA"/>
		<input name="id_mod" type="hidden" value="'.$art_id.'" /></form></td>';
/* 		$cartOutput.='<td>'.$each_item['quantity'].'</td>';*/
 	$cartOutput.='<td> Tsh '.$total.'</td>';
		//////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$cartOutput.='<td><form action="pannie.php" method="post" enctype="multipart/form-data">
		<input name="delbut"'.$art_id .' type="submit" class="btn btn-warning"  value="TOA"/>
		<input name="id_remove" type="hidden" value="'.$i.'" /></form></td>';
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$cartOutput.='</tr>';
		$i++;
		//$cartOutput.="Article ID :".$each_item['item_id']."</br>";
		//$cartOutput.="Article quantite :".$each_item['quantity']."</br>";


		//while (list($key, $value) = each($each_item)) {
			//$cartOutput.="$key:$value";
			//}

		}

		}
		$cartTotal="<div align='center' style='color:brown'><i><b>gharama ya vitu ulivyovichagua ni ".$cartTotal." </i>Tsh.</b></div>";

	}
?>

<?php
/* script for buying products*/
$p=""; 
if(isset($_GET['bu'])&&$_GET['bu']=="buy"){
	
	if (!isset($_SESSION["cart_array"]) || count($_SESSION["cart_array"]) < 1) {
    header("location:pannie.php");
}else{
	$cartTotal="";
	$i=0;
	foreach ($_SESSION["cart_array"] as $each_item) {
        $q=$each_item['quantity'];
		$art_id=$each_item['item_id'];
		$sqt=$db->query("SELECT * FROM bidhaa WHERE id_art='$art_id' LIMIT 1");
		if(($sqt->num_rows)>0){
		$rows=$sqt->fetch_all(MYSQLI_ASSOC);
		foreach($rows as $rows){
            $name_art=$rows["name_article"];	
			$price=$rows["price"];
			$qt=$rows["quantity"];
			$idx=$rows["id_art"];
		}
		if($qt<$q){
			 echo "<script>alert('Umezidisha kiwango cha manunuzi. Unaweza nunua idadi  $qt ya  $name_art');
			 window.location.href='pannie.php'
			 </script>";
			 exit();
			}
		else{
		$total=$price*$each_item['quantity'];
		$cartTotal=$total+$cartTotal;
		
		
	$tot=floatval($cartTotal);
	$sql=$db->query("SELECT * FROM client WHERE username='$client' AND password='$password' AND id_client='$clientID' LIMIT 1");
    if(($sql->num_rows)>0){
	$rows=$sql->fetch_all(MYSQLI_ASSOC);
	foreach($rows as $rows){
	$id=$rows["id_client"];
    $name=$rows["username"];
	$adress=$rows["adress"];
	
	$tel=$rows["telephone"];
	
	}
	 
	}
    $sq=$db->query("UPDATE bidhaa SET quantity='$qt'-'$q' WHERE id_art='$idx'");
	$sql=$db->query("INSERT INTO paid(name_art,qte,price,date)VALUES('$name_art','$q','$price',now())"); 
	$i++;      
             }
			 
       
		   }
        
		 }
		 header("location:receipt.php");
  }
 $sql=$db->query("INSERT INTO transactions(username_cl,date_transaction,amount)VALUES('$name',now(),'$tot')");
	    unset($_SESSION["cart_array"]);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Kikapuni</title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css" media="screen" />
<link rel="stylesheet" href="W3.css" type="text/css" media="screen" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationTextarea.js" type="text/javascript"></script></head>
<body>
<div align="center" id="wrapper">
  <?php include("header.php");?>
  <div id="pageContent">
    <div style="margin:24px; text-align:left;">

    <br />
    <table class="table table-bordered" width="92%" border="1" cellspacing="0" cellpadding="6">
      <tr>
        <td width="23%" bgcolor="#C5DFFA"><strong>Bidhaa</strong></td>
        <td width="19%" bgcolor="#C5DFFA"><strong>Bei</strong></td>
        <td width="19%" bgcolor="#C5DFFA"><strong>Idadi</strong></td>
        <td width="18%" bgcolor="#C5DFFA"><strong>Jumla</strong></td>
        <td width="21%" bgcolor="#C5DFFA"><strong>Toa</strong></td>
      </tr>
     <?php echo $cartOutput; ?>
     
    </table>
          <?php echo $p; ?>

     <?php  echo $cartTotal?>
    <br />
    <br />
<?php //echo $pp_checkout_btn; ?>
    <br />
    <br />
    <a href="pannie.php?cmd=videpannie"><button class="btn btn-info btn-md">Safisha Kikapu</button></a>
    <a href="pannie.php?bu=buy">
    <!--<form>-->
    <input class="btn btn-success btn-md" type="submit"  name="buy" id="buy" style="float:right" value="Nunua" /><!--</form>--></a>
   </div>
   <br />
  </div>
  <?php include("footer.php");?>
</div>
</body>
</html>
