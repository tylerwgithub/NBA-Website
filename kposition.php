
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
    <h1><b>Key Position</b></h1>
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
          		<form id="search-form" action="kpositionsearch.php" method="post"> 
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
<!-- 			  		<input type="text" id="tb7" name="searchkey" id="searchkey"/> -->
			  		<input type="submit" name="searchsubmit" value="Search" class="sub1"> 
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
// echo 'lalala';
// 				$SearchPara = strtoupper($SearchPara);
// echo $Fromdate;
// echo $Todate;
// echo $SearchPara;
				$sql = "with
R0 as (
        select match.m_id,match.t_id,match.p_id,gamedate,position,match.PTS,player.name as p_name
        from match
        inner join player on player.p_id = match.p_id
        inner join schedule on schedule.m_id = match.m_id
        where schedule.gamedate > to_date('$Fromdate','MM/DD/yyyy')
        and schedule.gamedate < to_date('$Todate','mm/dd/yyyy')),
R1 as (
        select position,SUM(PTS) as points
        from R0
        group by position
        order by SUM(PTS) DESC),
R2 as (
        select count(distinct m_id) as num_match 
        from R0)
select position, cast(points/num_match as decimal(38,2)) as Points from R1,R2
";

			}
			
// else{
// // echo $SearchBy;
// echo $SearchPara;
// // 				$SearchBy = strtoupper($SearchBy);
// 				$sql = "select * from(
// select name, cast(avg(PTS)as decimal(38, 2)) as t, 
// cast(avg(ast)as decimal(38, 2)) as t2,
// cast(avg(trb)as decimal(38, 2)) as t3,
// cast(avg(stl)as decimal(38, 2)) as t4,
// cast(avg(blk)as decimal(38, 2)) as t5
// from match, schedule
// where match.m_id=schedule.m_id 
// and time!='0'
// and 
// to_date('$Todate','MM/DD/yyyy')>GAMEDATE
// and
// gamedate>to_date('$Fromdate','mm/dd/yyyy')
// GROUP BY p_id, name
// order by t desc)
// where rownum <=50
// ";
// 
// }

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
$p1 = array();
$p2 = array();
// $count75 = 0;
// $count50 = 0;
// $count25 = 0;
// $count0 = 0;
print '<table border="1">';
while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
array_push($p1, $row['POSITION']);
array_push($p2, $row['POINTS']);



$i++;
//    print '<tr>';
//    foreach ($row as $item) {
//        print '<td>'.($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp').'</td>';
//    }
//    print '</tr>';
}
print '</table>';



// echo $name[0];
// print_r($name1[0]);
// print_r($t1[0]);
// print_r($t2[0]);
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
      
   	  var P1 = <?php echo json_encode($p1); ?>;
   	  var P2 = <?php echo json_encode($p2); ?>;
      var SP = <?php echo json_encode($SearchPara); ?>;
// alert(T1[0]);
      function drawTable() {
      
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Points');
//         data.addRows([
//           [N1[0],  T1[0], T2[0]],
//           [N1[1],  T1[1], T2[1]],
//           [N1[2],  T1[2], T2[2]],
//           [N1[3],  T1[3], T2[3]],
//           [N1[4],  T1[4], T2[4]],
//         ]);
		data.addRows(P1.length);
		var i;
for (i = 0; i < P1.length; i++) { 
		data.setCell(parseInt(i), 0, P1[i]);
		data.setCell(parseInt(i), 1, P2[i]);
		
		
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
          [P1[0], parseInt(P2[0])],
          [P1[1], parseInt(P2[1])],
          [P1[2], parseInt(P2[2])],
          [P1[3], parseInt(P2[3])],
          [P1[4], parseInt(P2[4])],
          [P1[5], parseInt(P2[5])],
          [P1[6], parseInt(P2[6])]
//           ['TSP >= 50', CC50],
//           ['TSP >= 25', CC25],
//           ['TSP >= 0', CC0]
//           [NN[4], parseInt(LL[4])]
        ]);


        // Set chart options
        var options = {'title':'Key Position',
                       'width':600,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
      
      
    </script>
  </head>
  <body>
    <div id="table_div"></div>
    <div id="chart_div"></div>
  </body>
  
<!-- 
    <script type="text/javascript">
	
      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
          var NN = <?php echo json_encode($name); ?>;
          var LL = <?php echo json_encode($avg); ?>;
          var SP = <?php echo json_encode($SearchPara); ?>;
alert(CC1);

      function drawChart() {

        // Create the data table.
//         var data = new google.visualization.DataTable();
//         data.addColumn('string', 'Topping');
//         data.addColumn('number', 'Slices');
//         data.addRows([
//           [NN[0], parseInt(LL[0]),'silver'],
//           [NN[1], parseInt(LL[1])],
//           [NN[2], parseInt(LL[2])],
//           [NN[3], parseInt(LL[3])],
//           [NN[4], parseInt(LL[4])]
//         ]);
var data = google.visualization.arrayToDataTable([
         ['Element', 'Average Points', { role: 'style' }],
         [NN[0], parseInt(LL[0]),'gold'],            // RGB value
         [NN[1], parseInt(LL[1]),'silver'],            // English color name
         [NN[2], parseInt(LL[2]),'#b87333'],
         [NN[3], parseInt(LL[3]),'#76A7FA'],
         [NN[4], parseInt(LL[4]),'#76A7FA'] // CSS-style declaration
      ]);


        // Set chart options
        var options = {'title':'Key Player',
                       'width':600,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
<!~~   </head> ~~>

  <body>
    <!~~Div that will hold the pie chart~~>
    <div id="chart_div"></div>
  </body>
 -->

</html>