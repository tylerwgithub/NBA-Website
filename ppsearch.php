
<?php

/*
search by city, name, zipcode here
*/
$Searchtype = $_POST['searchtype'];
$SearchPara = $_POST['searchkey'];

if($Searchtype == '--Search By--'){
	header("Location: pp.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
	exit;
}

if($Searchtype == 'P_ID'){
	header("Location: pp.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
	exit;
}
if($Searchtype == 'Name'){
	header("Location: pp.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
	exit;
}
if($Searchtype == 'Birth'){
	header("Location: pp.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
	exit;
}
?>
