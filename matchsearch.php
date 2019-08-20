
<?php

/*
search by city, name, zipcode here
*/
$Searchtype = $_POST['searchtype'];
$SearchPara = $_POST['searchkey'];

if($Searchtype == '--Search By--'){
	header("Location: matches.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
	exit;
}

if($Searchtype == 'P_ID'){
	header("Location: matches.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
	exit;
}
if($Searchtype == 'Name'){
	header("Location: matches.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
	exit;
}
if($Searchtype == 'Date'){
	header("Location: matches.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
	exit;
}
?>
