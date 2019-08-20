
<?php

/*
search by city, name, zipcode here
*/
$Searchtype = $_POST['searchtype'];
$SearchPara = $_POST['searchkey'];

if($Searchtype == '--Search By--'){
	header("Location: teams.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
	exit;
}

if($Searchtype == 'T_ID'){
	header("Location: teams.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
	exit;
}
if($Searchtype == 'Name'){
	header("Location: teams.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
	exit;
}
if($Searchtype == 'Location'){
	header("Location: teams.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
	exit;
}
if($Searchtype == 'Division'){
	header("Location: teams.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
	exit;
}
?>
