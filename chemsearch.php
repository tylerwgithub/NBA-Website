
<?php

/*
search by city, name, zipcode here
*/
$SearchPara1 = $_POST['searchkey1'];
$SearchPara2= $_POST['searchkey2'];
header("Location: chem.php?SearchPara1=$SearchPara1&SearchPara2=$SearchPara2");
exit;
// if($Searchtype == '--Search By--'){
// 	header("Location: chem.php?SearchPara1=$SearchPara1&SearchPara2=$SearchPara2");
// 	exit;
// }
// 
// if($Searchtype == 'P_ID'){
// 	header("Location: chem.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
// 	exit;
// }
// if($Searchtype == 'Name'){
// 	header("Location: chem.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
// 	exit;
// }
// if($Searchtype == 'Birth'){
// 	header("Location: chem.php?SearchBy=$Searchtype&SearchPara=$SearchPara");
// 	exit;
// }
?>
