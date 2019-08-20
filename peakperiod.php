
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
<script type="text/javascript" src="loader.js"></script>
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
    <h1><b>Players</b></h1>
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
          		<form id="search-form" action="playersearch.php" method="post"> 
			  		<select name="searchtype" id="searchtype">
				  		<option id="sb">--Search By--</option>
				  		<option id="n">P_ID</option>
				  		<option id="name">Name</option>
				  		<option id="bir">Birth</option>
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
echo $SearchBy;
echo $SearchPara;

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
				$sql = 'select * from PLAYER ORDER BY P_ID';
				
			}
			
else if($SearchBy == 'P_ID'){
echo $SearchBy;
echo $SearchPara;
// 				$SearchBy = strtoupper($SearchBy);
				$sql = "select * from PLAYER
      where PLAYER.$SearchBy = '$SearchPara' ORDER BY P_ID";

}

else if($SearchBy == 'Name'){
echo $SearchBy;
echo $SearchPara;
				$SearchBy = strtoupper($SearchBy);
				$sql = "select * from PLAYER
      where PLAYER.$SearchBy like '%$SearchPara%' ORDER BY P_ID";

}

else if($SearchBy == 'Birth'){
echo $SearchBy;
echo $SearchPara;
				$SearchBy = strtoupper($SearchBy);
				$sql = "select * from PLAYER
      where PLAYER.$SearchBy like '%$SearchPara%' ORDER BY P_ID";

}
$stid = oci_parse($connection, $sql);
oci_execute($stid);


$i=0;
$name = array();
$id = array();
print '<table border="1">';
while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
array_push($name, $row['NAME']);
array_push($id, $row['P_ID']);
// $i++;
   print '<tr>';
   foreach ($row as $item) {
       print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
   }
   print '</tr>';
}
print '</table>';
// echo $name[0];
print_r($name[0]);
print_r($id[0]);
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
	
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
          var NN = <?php echo json_encode($name); ?>;
          var LL = <?php echo json_encode($id); ?>;
// alert(NN[0]);

      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          [NN[0], parseInt(LL[0])],
          [NN[1], parseInt(LL[1])],
          [NN[2], parseInt(LL[2])],
          [NN[3], parseInt(LL[3])],
          [NN[4], parseInt(LL[4])]
        ]);


        // Set chart options
        var options = {'title':'Players',
                       'width':600,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
<!--   </head> -->

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>