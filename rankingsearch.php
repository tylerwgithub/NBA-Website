
<?php

/*
search by city, name, zipcode here
*/
$Fromdate = $_POST['fromdate'];
$Todate = $_POST['todate'];
$SearchPara = $_POST['searchkey'];

header("Location: ranking.php?Fromdate=$Fromdate&Todate=$Todate&SearchPara=$SearchPara");
exit;
// if($Searchtype == '--Search By--'){
// 	header("Location: tsp.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
// 	exit;
// }
// 
// if($Searchtype == 'P_ID'){
// 	header("Location: tsp.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
// 	exit;
// }
// if($Searchtype == 'Name'){
// 	header("Location: tsp.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
// 	exit;
// }
// if($Searchtype == 'Birth'){
// 	header("Location: tsp.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
// 	exit;
// }
?>
