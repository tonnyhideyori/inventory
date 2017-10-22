
<style type="text/css">
#pageHeader div table tr td a {
	font-family: Georgia, "Times New Roman", Times, serif;

	 }

</style>
<link rel="stylesheet" href="style.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/bootstrap.css" type="text/css"/>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"/>
<link rel="stylesheet" href="css/bootstrap-theme.css" type="text/css" />
<link rel="stylesheet" href="css/bootstrap-theme.min.css" type="text/css"/>
<link rel="stylesheet" href="W3.css" type="text/css" media="screen" />
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>

<div id="pageHeader">

<div style="float:left" width="18%"><a href="home.php"><img src="log.jpg" width="189" height="47" alt="logo" /></a><a name="home" id="home"></a></div>
<div style="float:center;height:47px;" width="189%" align="left" >
<form id="form1" name="form1" method="post" action="search_produit.php" style="margin-top:5px; padding-top:5px; ">
      <label for="search"></label>
      <span id="sprytextfield1">
      <input type="text" name="searching" id="searching" size="70" placeholder="Tafuta..." style="padding-left:5px; margin-left:10px " />

      </span>
      <input class="btn btn-success btn-md" type="submit" name="search" id="search" value="Tafuta" />
    </form>

    </div>



  <div class="dropdown" >
   <ul class="nav nav-tabs" style="margin-bottom:1px">
   <li class="active"><a href="home.php" style="width:auto;"><b>NYUMBANI</b></a></li>
   <li class="dropdown">

   <a class="dropdown-toggle" data-toggle="dropdown" href="#" style="width:auto;"><b>KATEGORI</b><span class="caret"></span></a>
   <ul class="dropdown-menu">
      <li ><a href="list_produit.php?id=smartphone" style="width:auto;">SMARTPHONE</a></li>
      <li><a href="list_produit.php?id=tablet" style="width:auto;">TABLET</a></li>
      <li ><a href="list_produit.php?id=laptop" style="width:auto;">LAPTOP</a></li>
   </ul></li>
   <li class="dropdown">
   <a class="dropdown-toggle" data-toggle="dropdown" style="width:auto;" href="#"><b>KAMPUNI</b><span class="caret"></span></a>
   <ul class="dropdown-menu">
      <li ><a href="list_produit.php?id=apple" style="width:auto;">APPLE</a></li>
      <li ><a href="list_produit.php?id=lg" >LG</a></li>
      <li><a href="list_produit.php?id=samsung" style="width:auto;">SAMSUNG</a></li>
      <li><a href="list_produit.php?id=sony" style="width:auto;">SONY</a></li>
   </ul>
   </li>
   <!--<li class="dropdown">
   <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <b>Compte</b><span class="caret"></span></a>
   <ul class="dropdown-menu">
    <li ><a href="login.php">connecté</a></li>
        <li><a href="inscription.php">inscription</a></li>

   </ul>
   </li>-->
   <ul class="nav navbar-nav navbar-right">
        <li class="dropdown" ><a class="dropdown-toggle" data-toggle="dropdown" style="width:auto;" href="#">
        <span class="glyphicon glyphicon-user" ></span><b><?php if(isset($_SESSION['client'])){echo $client;}else{echo "Akaunti Yangu";}?></b></a><ul class="dropdown-menu">
        <li ><a href="login.php" style="width:auto;">Jiunganishe</a></li>
        <li><a href="client.php" style="width:auto;">Akaunti Yangu</a></li>

   </ul></li>
        <li><a href="pannie.php" style="margin-right:20px;height:35px;width:auto;"><span class="glyphicon glyphicon-shopping-cart"></span>Kapuni</a></li>
      </ul>
   </ul>
  </div>
</div>
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
</script>
