
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
    <h1><b>True Shooting Percentage</b></h1>
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
          		<form id="search-form" action="tspsearch.php" method="post"> 
			  		<select name="fromdate" id="fromdate">
				  		<option id="sb">9/30/2013</option>
				  		<option id="n">9/30/2014</option>
				  		<option id="name">9/30/2015</option>
				  		<option id="bir">9/30/2016</option>
				  		<option id="bir">9/30/2017</option>
<!-- 				  		<option id="cuisine">Cuisine</option> -->
			  		</select>
			  		<select name="todate" id="todate">
				  		<option id="sb">5/1/2014</option>
				  		<option id="n">5/1/2015</option>
				  		<option id="name">5/1/2016</option>
				  		<option id="bir">5/1/2017</option>
				  		<option id="bir">5/1/2018</option>
<!-- 				  		<option id="cuisine">Cuisine</option> -->
			  		</select>
			  		<input type="text" id="tb7" name="searchkey" id="searchkey"/>
			  		<input type="submit" name="searchsubmit" value="Search By Name" class="sub1"> 
			  	</form>
      		</li>
  </div>
  
<?php
// session_start();
$Fromdate = '9/30/2013';
$Todate = '5/1/2014';
$SearchPara = '';
if(isset($_GET['Fromdate'])){
	$Fromdate = $_GET['Fromdate'];
}
if(isset($_GET['Todate'])){
	$Todate = $_GET['Todate'];
}
if(isset($_GET['SearchPara'])){
	$SearchPara = $_GET['SearchPara'];
}
// echo $Fromdate;
// echo $Todate;
// echo $SearchPara;

$connection = oci_connect($username = 'tongyu',
                          $password = 'wangenyang',
                          $connection_string = '//oracle.cise.ufl.edu/orcl');

if (!$connection) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
else {
if($SearchPara == ''){
// 				$SearchPara = strtoupper($SearchPara);
				$sql = "select match.p_id, player.name, cast(avg(PTS/(2*(FGA+0.44*FTA)))*100 as decimal(38, 2)) as t
from match, schedule,player
where match.m_id=schedule.m_id 
and player.p_id=match.p_id
and time!='0' and fta!=0 
and 
to_date('$Todate','MM/DD/yyyy')>GAMEDATE
and
gamedate>to_date('$Fromdate','mm/dd/yyyy')
GROUP BY match.p_id, player.name
order by t desc
";
				
			}
			
else{
// echo $SearchBy;
echo $SearchPara;
// 				$SearchBy = strtoupper($SearchBy);
				$sql = "select match.p_id, player.name, cast(avg(PTS/(2*(FGA+0.44*FTA)))*100 as decimal(38, 2)) as t
from match, schedule,player
where match.m_id=schedule.m_id 
and player.p_id=match.p_id
and time!='0' and fta!=0 
and 
to_date('$Todate','MM/DD/yyyy')>GAMEDATE
and
gamedate>to_date('$Fromdate','mm/dd/yyyy')
and match.NAME = '$SearchPara'
GROUP BY match.p_id, player.name
order by t desc
";

}

// else if($SearchBy == 'Name'){
// echo $SearchBy;
// echo $SearchPara;
// 				$SearchBy = strtoupper($SearchBy);
// 				$sql = "select * from PLAYER
//       where PLAYER.$SearchBy like '%$SearchPara%' ORDER BY P_ID";
// 
// }
// 
// else if($SearchBy == 'Birth'){
// echo $SearchBy;
// echo $SearchPara;
// 				$SearchBy = strtoupper($SearchBy);
// 				$sql = "select * from PLAYER
//       where PLAYER.$SearchBy like '%$SearchPara%' ORDER BY P_ID";
// 
// }
$stid = oci_parse($connection, $sql);
oci_execute($stid);


$i=0;
$name = array();
$tt = array();
$id = array();
$count75 = 0;
$count50 = 0;
$count25 = 0;
$count0 = 0;
print '<table border="1">';
while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
array_push($name, $row['NAME']);
array_push($tt, $row['T']);
array_push($id, $row['P_ID']);
// echo gettype((int)$row['T']);
if ((int)$row['T'] >= 75){
$count75 ++;
}
if ((int)$row['T'] >= 50){
$count50 ++;
}
if ((int)$row['T'] >= 25){
$count25 ++;
}
if ((int)$row['T'] >= 0){
$count0 ++;
}

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
// print_r($tt[0]);
// print_r($count1);
// echo $count1;
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
      
      
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
          var NN = <?php echo json_encode($name); ?>;
          var LL = <?php echo json_encode($tt); ?>;
          var ID = <?php echo json_encode($id); ?>;
          var CC75 = <?php echo json_encode($count75); ?>;
          var CC50 = <?php echo json_encode($count50); ?>;
          var CC25 = <?php echo json_encode($count25); ?>;
          var CC0 = <?php echo json_encode($count0); ?>;
          
          
		function drawTable() {
      
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'P_ID');
        data.addColumn('string', 'Name');
        data.addColumn('string', 'True Shooting Percentage');
//         data.addRows([
//           [N1[0],  T1[0], T2[0]],
//           [N1[1],  T1[1], T2[1]],
//           [N1[2],  T1[2], T2[2]],
//           [N1[3],  T1[3], T2[3]],
//           [N1[4],  T1[4], T2[4]],
//         ]);
		data.addRows(NN.length);
		var i;
for (i = 0; i < NN.length; i++) { 
		data.setCell(parseInt(i), 0, ID[i]);
		data.setCell(parseInt(i), 1, NN[i]);
		data.setCell(parseInt(i), 2, LL[i]);
		
		
}

		

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
      
      
      
      

      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
          ['TSP >= 75', CC75],
          ['TSP >= 50', CC50],
          ['TSP >= 25', CC25],
          ['TSP >= 0', CC0]
//           [NN[4], parseInt(LL[4])]
        ]);


        // Set chart options
        var options = {'title':'True Shooting Percentage',
                       'width':600,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
<!--   </head> -->

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
    <div id="table_div"></div>
    
  </body>

</html>