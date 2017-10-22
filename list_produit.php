
<?php
//error reporting
error_reporting(E_ALL);
ini_set('display_errors','1');
?>

<?php
if (isset($_GET['id'])) {
	// Connect to the MySQL database
    include "mysql_connect.php";
	$liste_dynamic="";
	$ids = preg_replace('#[^A-Za-z0-9]#i', '', $_GET['id']);
$sql=$db->query("SELECT * FROM bidhaa WHERE category='$ids' OR mark='$ids'");
if(($sql->num_rows)>0){
	$rows=$sql->fetch_all(MYSQLI_ASSOC);
	foreach($rows as $rows){
	$id=$rows["id_art"];
    $name_art=$rows["name_article"];
	$prix=$rows["price"];
	$marque=$rows["mark"];
	$category=$rows["category"];
	$date_added=strftime("%d /%b /%y",strtotime($rows["date_added"]));
    $liste_dynamic.='<div class="container" style="width:900px;padding-top:5px;margin-top:5px;">
  <div class="row">
    <div class="col-sm-4">
      <div class="panel panel-primary">
        <div class="panel-heading">'.$name_art.'</div>
       <a href="produit.php?id='.$id.'"> <div class="panel-body"><img src="image/'.$id.'.jpg?text=IMAGE" class="img-responsive" style="width:100%" alt="'.$name_art.'"></div></a>
      <div class="panel-footer" align="center">DA'.$prix.'<br/>
		<a href="image/'.$id.'.jpg">Full size</a>
     <form id="form1" class="form-horizontal" role="form" name="form1" method="post" action="pannie.php">
	    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
                <input type="hidden" name="pid" id="pid" value="'.$id.'" />
        <input type="submit" class="btn btn-info" name="button" id="button" value="Kikapuni >>" />
		</div>
  </div>
 </form>
		</div>
      </div>
    </div>
    </div>
    </div>';
	}
	}
	else{
     echo '<h1 style="color:red">hatuna hiyo bidhaa kwa sasa</h1><h4><a href="home.php">click ici</a></h4>';
		 exit();
		}

	}

 else {
echo '<div id=pageContent>Hatuna bidhaa hiyo</div>';
exit();
}

$db->close();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php if ($ids==$category){echo $category;}else{echo $marque;} ?></title>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
<link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css"/>
<script type="text/javascript" src="jquery-1.12.3.js"></script>
<script type="text/javascript" src="jquery-1.12.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>

<body>
<div align="center" id="wrapper">
<?php include_once("header.php");?>
<div  id="pageContent">
<?php echo "$liste_dynamic" ?>
</div>
<?php include("footer.php"); ?>
</div>
</body>
</html>
