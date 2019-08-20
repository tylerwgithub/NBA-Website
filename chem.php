
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
    <h1><b>Player Comparison</b></h1>
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
          		<form id="search-form" action="chemsearch.php" method="post"> 
          			<b>Name 1</b>
			  		<input type="text" id="tb7" name="searchkey1" id="searchkey1"/>
			  		<b>Name 2</b>
			  		<input type="text" id="tb7" name="searchkey2" id="searchkey2"/>
			  		<input type="submit" name="searchsubmit" value="Search" class="sub1"> 
			  	</form>
      		</li>
  </div>
  
<?php
// session_start();
$SearchPara1 = 'Kevin Durant';
$SearchPara2 = 'LeBron James';
if(isset($_GET['SearchPara1'])){
	$SearchPara1 = $_GET['SearchPara1'];
}
if(isset($_GET['SearchPara2'])){
	$SearchPara2 = $_GET['SearchPara2'];
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
$sql1 ="select  p_id,name,
cast (offense_ability as decimal(38,2))as offense_ability ,
cast (defense_ability as decimal(38,2))as defense_ability ,
cast (organize_ability as decimal(38,2))as organize_ability ,
cast (influence_in_team as decimal(38,2))as influence_in_team 
from(
select player.p_id as p_id,player.name as name,
(avg(pts)*0.4+avg(ast)*0.05+avg(blk)*0.05) as offense_ability,
(avg(blk)*3+avg(stl)*3)*1.3 as defense_ability,(avg(pts)*0.1+avg(AST)*0.7) as organize_ability,
((avg(pts)*0.4+avg(ast)*0.05+avg(blk)*0.05)*4+((avg(blk)*3+avg(stl)*3)*1.3)*3+(avg(pts)*0.1+avg(AST)*0.7)*3)/10 as influence_in_team
from player,match,schedule
where 
player.p_id = match.p_id 
and schedule.m_id = match.m_id
and player.name like '%$SearchPara1%'
and to_date('5/1/2018','MM/DD/YYYY')>schedule.gamedate
and schedule.gamedate>to_date('9/30/2013','mm/dd/yyyy') 
group by player.name,player.p_id
)";

$sql2 ="select  p_id,name,
cast (offense_ability as decimal(38,2))as offense_ability ,
cast (defense_ability as decimal(38,2))as defense_ability ,
cast (organize_ability as decimal(38,2))as organize_ability ,
cast (influence_in_team as decimal(38,2))as influence_in_team 
from(
select player.p_id as p_id,player.name as name,
(avg(pts)*0.4+avg(ast)*0.05+avg(blk)*0.05) as offense_ability,
(avg(blk)*3+avg(stl)*3)*1.3 as defense_ability,(avg(pts)*0.1+avg(AST)*0.7) as organize_ability,
((avg(pts)*0.4+avg(ast)*0.05+avg(blk)*0.05)*4+((avg(blk)*3+avg(stl)*3)*1.3)*3+(avg(pts)*0.1+avg(AST)*0.7)*3)/10 as influence_in_team
from player,match,schedule
where 
player.p_id = match.p_id 
and schedule.m_id = match.m_id
and player.name like '%$SearchPara2%'
and to_date('5/1/2018','MM/DD/YYYY')>schedule.gamedate
and schedule.gamedate>to_date('9/30/2013','mm/dd/yyyy') 
group by player.name,player.p_id
)";

// echo $SearchPara1;
// echo $SearchPara2;


$stid1 = oci_parse($connection, $sql1);
oci_execute($stid1);
$stid2 = oci_parse($connection, $sql2);
oci_execute($stid2);

$i=0;
$id = array();
$name = array();
$offense = array();
$defense = array();
$organize = array();
$influence = array();
print '<table border="1">';
while ($row = oci_fetch_array($stid1, OCI_RETURN_NULLS+OCI_ASSOC)) {
array_push($id, $row['P_ID']);
array_push($name, $row['NAME']);
array_push($offense, $row['OFFENSE_ABILITY']);
array_push($defense, $row['DEFENSE_ABILITY']);
array_push($organize, $row['ORGANIZE_ABILITY']);
array_push($influence, $row['INFLUENCE_IN_TEAM']);
// $i++;
//    print '<tr>';
//    foreach ($row as $item) {
//        print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
//    }
//    print '</tr>';
}



while ($row = oci_fetch_array($stid2, OCI_RETURN_NULLS+OCI_ASSOC)) {
array_push($id, $row['P_ID']);
array_push($name, $row['NAME']);
array_push($offense, $row['OFFENSE_ABILITY']);
array_push($defense, $row['DEFENSE_ABILITY']);
array_push($organize, $row['ORGANIZE_ABILITY']);
array_push($influence, $row['INFLUENCE_IN_TEAM']);
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
// print_r($id[1]);
// print_r($id[0]);
oci_free_statement($stid1);
oci_free_statement($stid2);

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
      google.charts.load('current', {'packages':['table']});
      google.charts.setOnLoadCallback(drawTable);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      	  var ID = <?php echo json_encode($id); ?>;
          var NN = <?php echo json_encode($name); ?>;
          var OF = <?php echo json_encode($offense); ?>;
          var DE = <?php echo json_encode($defense); ?>;
          var OR = <?php echo json_encode($organize); ?>;
          var IN = <?php echo json_encode($influence); ?>;

      function drawTable() {
      
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'p_id');
        data.addColumn('string', 'Name');
        data.addColumn('string', 'offense_ability');
        data.addColumn('string', 'defense_ability');
        data.addColumn('string', 'organize_ability');
        data.addColumn('string', 'influence_in_team');
		data.addRows(ID.length);
		var i;
for (i = 0; i < ID.length; i++) { 
		data.setCell(parseInt(i), 0, ID[i]);
		data.setCell(parseInt(i), 1, NN[i]);
		data.setCell(parseInt(i), 2, OF[i]);
		data.setCell(parseInt(i), 3, DE[i]);
		data.setCell(parseInt(i), 4, OR[i]);
		data.setCell(parseInt(i), 5, IN[i]);
		
		
}

		

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }






// Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
// alert(YY[0]);

      function drawChart() {

        // Create the data table.
        // var data = new google.visualization.DataTable();
//         data.addColumn('string', 'Topping');
//         data.addColumn('number', 'Total Points');
//         data.addRows([
//           [AG[0], parseInt(SM[0])],
//           [AG[1], parseInt(SM[1])],
//           [AG[2], parseInt(SM[2])],
//           [AG[3], parseInt(SM[3])],
//           [AG[4], parseInt(SM[4])]
//         ]);
		var data = google.visualization.arrayToDataTable([
          ['Name', NN[0], NN[1]],
          ['offense_ability', parseInt(OF[0]), parseInt(OF[1])],
          ['defense_ability', parseInt(DE[0]), parseInt(DE[1])],
          ['organize_ability', parseInt(OR[0]), parseInt(OR[1])],
          ['influence_in_team', parseInt(IN[0]), parseInt(IN[1])]
        ]);
        
// 		data.setCell(parseInt(i), 0, ID[i]);
// 		data.setCell(parseInt(i), 1, NN[i]);
// 		data.setCell(parseInt(i), 2, OF[i]);
// 		data.setCell(parseInt(i), 3, DE[i]);
// 		data.setCell(parseInt(i), 4, OR[i]);
// 		data.setCell(parseInt(i), 5, IN[i]);


        // Set chart options
        var options = {'title':NN[0],
                       'width':600,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
      
      
    </script>
<!--   </head> -->

  <body>
    <!--Div that will hold the pie chart-->
    <div id="table_div"></div>
    <div id="chart_div"></div>
  </body>

</html>