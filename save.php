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
$content="your order contains  ".PHP_EOL; 
$tot="";
$to=0;
$sqt=$db->query("SELECT * FROM paid");
		if(($sqt->num_rows)>0){
		$rows=$sqt->fetch_all(MYSQLI_ASSOC);
		foreach($rows as $rows){
            $name_art=$rows["name_art"];	
			$price=$rows["price"];
			$qt=$rows["qte"];
			$date=$rows["date"];
			$tot=$price*$qt;
			$to=$tot+$to;
		$content.=" $qt of $name_art  with the price of $price Tsh/=\n ".PHP_EOL;
 	       
		}
       $content.="you total amount is $to Tsh/=".PHP_EOL;
		}
		$content.="$date".PHP_EOL;
		        $fp=fopen("savethis.txt","wb");
                fwrite($fp,$content);
				fclose($fp); 
				header('Content-Disposition: attachment; filename='.$client.'_'.date("d-m-Y H:i:s").'.txt');
				header("Content-type: text");
			    readfile('savethis.txt');
		?>
<?php if(isset($_GET['idp'])){
$sqt=$db->query("DELETE FROM paid");


}
//header("location:home.php");
?>