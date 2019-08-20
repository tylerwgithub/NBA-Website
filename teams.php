
<!DOCTYPE html>
<?php
session_start();
?>
<html>
<title>NBA Data Management System</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/w3.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/ccs.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/font-awesome.min.css" type="text/css" media="screen">
<style>
html,body,h1,h2,h3,h4 {font-family:"Lato", sans-serif}
.mySlides {display:none}
.w3-tag, .fa {cursor:pointer}
.w3-tag {height:15px;width:15px;padding:0;margin-top:6px}
</style>
<body>
<!-- <script type="text/javascript" src="loader.js"></script> -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- Links (sit on top) -->
<div class="w3-top">
  <div class="w3-row w3-large w3-light-grey">
    <div class="w3-col s2">
      <a href="index.php" class="w3-button w3-block">Home</a>
    </div>
    <div class="w3-col s2">
      <a href="players.php" class="w3-button w3-block">Players</a>
    </div>
    <div class="w3-col s2">
      <a href="teams.php" class="w3-button w3-block">Teams</a>
    </div>
    <div class="w3-col s2">
      <a href="matches.php" class="w3-button w3-block">Matches</a>
    </div>
    <div class="w3-col s2">
      <a href="adv.php" class="w3-button w3-block">Advanced Functions</a>
    </div>
    <div class="w3-col s2">
      <a href="about.php" class="w3-button w3-block">About</a>
    </div>
  </div>
</div>

<!-- Content -->
<div class="w3-content" style="max-width:1100px;margin-top:80px;margin-bottom:80px">

  <div class="w3-panel">
    <h1><b>Teams</b></h1>
<!--     <p></p> -->
<!--   </div> -->

  <!-- Slideshow -->
  <div class="w3-container">
  <ul class="menu">
  
<!-- 
  <form action="search.php" method="post">
Name: <input type="text" name="name"><br>
E-mail: <input type="text" name="email"><br>
<input type="submit" value="Search">
</form>
 -->
          	<li>      
          		<form id="search-form" action="teamsearch.php" method="post"> 
			  		<select name="searchtype" id="searchtype">
				  		<option id="sb">--Search By--</option>
				  		<option id="n">T_ID</option>
				  		<option id="name">Name</option>
				  		<option id="bir">Location</option>
				  		<option id="bir">Division</option>
<!-- 				  		<option id="cuisine">Cuisine</option> -->
			  		</select>
			  		<input type="text" id="tb7" name="searchkey" id="searchkey"/>
			  		<input type="submit" name="searchsubmit" value="Search" class="sub1"> 
			  	</form>
      		</li>
  </div>
  
<?php
// session_start();
$SearchBy = '--Search By--';
$SearchPara = '';
if(isset($_GET['SearchBy'])){
	$SearchBy = $_GET['SearchBy'];
}
if(isset($_GET['SearchPara'])){
	$SearchPara = $_GET['SearchPara'];
}
// echo $SearchBy;
// echo $SearchPara;

$connection = oci_connect($username = 'tongyu',
                          $password = 'wangenyang',
                          $connection_string = '//oracle.cise.ufl.edu/orcl');

if (!$connection) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
else {
if($SearchBy == '--Search By--'){
// 				$SearchPara = strtoupper($SearchPara);
				$sql = 'select * from TEAM ORDER BY T_ID';
				
			}
			
else if($SearchBy == 'T_ID'){
echo $SearchBy;
echo $SearchPara;
				$SearchPara = strtoupper($SearchPara);
				$sql = "select * from TEAM
      where TEAM.$SearchBy = '$SearchPara' ORDER BY T_ID";

}

else if($SearchBy == 'Name'){
echo $SearchBy;
echo $SearchPara;
				$SearchBy = strtoupper($SearchBy);
				$sql = "select * from TEAM
      where TEAM.$SearchBy like '%$SearchPara%' ORDER BY T_ID";

}

else if($SearchBy == 'Location'){
echo $SearchBy;
echo $SearchPara;
				$SearchBy = strtoupper($SearchBy);
				$sql = "select * from TEAM
      where TEAM.$SearchBy like '%$SearchPara%' ORDER BY T_ID";

}

else if($SearchBy == 'Division'){
echo $SearchBy;
echo $SearchPara;
				$SearchBy = strtoupper($SearchBy);
				$sql = "select * from TEAM
      where TEAM.$SearchBy like '%$SearchPara%' ORDER BY T_ID";

}
$stid = oci_parse($connection, $sql);
oci_execute($stid);

// echo "<table border=\"1\">\n";
// echo "<tr>";
// echo "<th>T_ID</th>";
// 
// echo "</tr>\n";


$i=0;
$name = array();
$id = array();
$abb = array();
$loc = array();
$div = array();
print '<table border="1">';
while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
array_push($name, $row['NAME']);
array_push($id, $row['T_ID']);
array_push($loc, $row['LOCATION']);
array_push($abb, $row['ABB']);
array_push($div, $row['DIVISION']);
// $i++;
//    print '<tr>';
//    foreach ($row as $item) {
//        print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
//    }
//    print '</tr>';
}
print '</table>';
// echo $name[0];
// print_r($name[0]);
// print_r($id[0]);
oci_free_statement($stid);

}

oci_close($connection);

?>
<!-- 
<html>
  <head>
 -->
    <!--Load the AJAX API-->
<!--     <script type="text/javascript" src="loader.js"></script> -->

<script type="text/javascript">
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);
      
      var NN = <?php echo json_encode($name); ?>;
   	  var ID = <?php echo json_encode($id); ?>;
   	  var LL = <?php echo json_encode($loc); ?>;
   	  var AB = <?php echo json_encode($abb); ?>;
   	  var DD = <?php echo json_encode($div); ?>;
      var SP = <?php echo json_encode($SearchPara); ?>;
// alert(NN[0]);


      function drawTable() {
      
        var data = new google.visualization.DataTable();
//         data.addColumn('string', 'T_ID');
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Abbreviation');
        data.addColumn('string', 'Location');
        data.addColumn('string', 'Division');
		data.addRows(ID.length);
		var i;
for (i = 0; i < ID.length; i++) { 
// 		data.setCell(parseInt(i), 0, ID[i]);
		data.setCell(parseInt(i), 0, NN[i]);
		data.setCell(parseInt(i), 1, AB[i]);
		data.setCell(parseInt(i), 2, LL[i]);
		data.setCell(parseInt(i), 3, DD[i]);
		
		
}

		

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>
<!--   </head> -->

  <body>
    <!--Div that will hold the pie chart-->
    <div id="table_div"></div>
  </body>
</html>