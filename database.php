<?php 

?>
<?php 
 if(isset($_GET['idp'])){
$table=array();
$servername="localhost";
$username="root";
$conn=mysqli_connect($servername,$username,'');
if(!$conn){
	die("Connection failed :". mysqli_connect_error());
	}
	$sql="CREATE DATABASE duka";
	if($conn->query($sql)===TRUE){header("location:new_admin.php");
	}
	else echo"error creating database".$conn->error;
	$conn->close();
	//new connection
	$db=new mysqli($servername,$username,'','dukani');
    if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
      } 
$table[]="CREATE TABLE admin(
id INT(11) AUTO_INCREMENT PRIMARY KEY,
username VARCHAR(70) NOT NULL,
password VARCHAR(70) NOT NULL,
last_log DATE)";
$table[]="CREATE TABLE bidhaa(
id_art INT(11) AUTO_INCREMENT PRIMARY KEY,
date_added DATE,
category VARCHAR(70),
mark VARCHAR(70),
name_article VARCHAR(70),
price DOUBLE,
quantity DOUBLE
)";
$table[]="CREATE TABLE client(
id_client INT(11) AUTO_INCREMENT PRIMARY KEY,
password VARCHAR(70) NOT NULL,
prenom_client VARCHAR(70) NOT NULL,
nom_client VARCHAR(70) NOT NULL,
username VARCHAR(70) NOT NULL,
adress_client VARCHAR(100) NOT NULL,
telephone DOUBLE
)";
$table[]="CREATE TABLE paid(
id_art INT(11) AUTO_INCREMENT PRIMARY KEY,
date DATE,
name_art VARCHAR(70) NOT NULL,
price DOUBLE,
qte DOUBLE
)";
$table[]="CREAT TABLE transactions(
id_trans INT(11) AUTO_INCREMENT PRIMARY KEY,
date_transaction DATE,
amount DOUBLE,
username_cl VARCHAR(70) NOT NULL
)";	
foreach($table as $sql){
    $query = $db->query($sql);
}
}
?>


<?php 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Database creation</title>
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
  <div id="pageContent" ><br />
    <h1 align="center"><i>KARIBU KWENYE UKURASA WA DUKA LAKO</i></h1>
    <br/>
    <br />
    <br />
    <h2 align="center"><b>BONYEZA HAPA KUENDELEA</b></h2>
    <br />
    <a href="database.php?idp">
      <button type="button" class="btn btn-success">DATABASE</button>
      <br />
      <br />
    </a></div>
</div>
</body>
</html>