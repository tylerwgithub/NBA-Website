
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
    <h1><b>Matches</b></h1>
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
          		<form id="search-form" action="matchsearch.php" method="post"> 
			  		<select name="searchtype" id="searchtype">
				  		<option id="sb">--Search By--</option>
				  		<option id="n">P_ID</option>
				  		<option id="name">Name</option>
				  		<option id="bir">Date</option>
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
				$sql = 'select * from MATCH WHERE ROWNUM <= 1000 ORDER BY Birth';
				
			}
			
else if($SearchBy == 'P_ID'){
echo $SearchBy;
echo $SearchPara;
// 				$SearchBy = strtoupper($SearchBy);
				$sql = "select * from MATCH
      where MATCH.$SearchBy = '$SearchPara' and ROWNUM <= 1000 ORDER BY P_ID";

}

else if($SearchBy == 'Name'){
echo $SearchBy;
echo $SearchPara;
				$SearchBy = strtoupper($SearchBy);
				$sql = "select * from MATCH
      where MATCH.$SearchBy like '%$SearchPara%' and ROWNUM <= 1000 ORDER BY P_ID";

}

else if($SearchBy == 'Date'){
echo $SearchBy;
echo $SearchPara;
				$SearchBy = strtoupper($SearchBy);
				$sql = "select * from MATCH
      where MATCH.Birth like '%$SearchPara%' and ROWNUM <= 1000 ORDER BY M_ID";

}
$stid = oci_parse($connection, $sql);
oci_execute($stid);


$i=0;
$id = array();
$name = array();
$birth = array();
$team = array();
$opp = array();
$wl = array();
$gs = array();
$time = array();
$fg = array();
$fga = array();
$fgp = array();
$threep = array();
$threepa = array();
$threepp = array();
$ft = array();
$fta = array();
$ftp = array();
$orb = array();
$drb = array();
$trb = array();
$ast = array();
$stl = array();
$blk = array();
$tov = array();
$pf = array();
$pts = array();
$abc = array();
print '<table border="1">';
while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
array_push($id, $row['P_ID']);
array_push($name, $row['NAME']);
array_push($birth, $row['BIRTH']);
array_push($team, $row['TEAM']);
array_push($opp, $row['OPP']);
array_push($wl, $row['WL']);
array_push($gs, $row['GS']);
array_push($time, $row['TIME']);
array_push($fg, $row['FG']);
array_push($fga, $row['FGA']);
array_push($fgp, $row['FGP']);
array_push($threep, $row['THREEP']);
array_push($threepa, $row['THREEPA']);
array_push($threepp, $row['THREEPP']);
array_push($ft, $row['FT']);
array_push($fta, $row['FTA']);
array_push($ftp, $row['FTP']);
array_push($orb, $row['ORB']);
array_push($drb, $row['DRB']);
array_push($trb, $row['TRB']);
array_push($ast, $row['AST']);
array_push($stl, $row['STL']);
array_push($blk, $row['BLK']);
array_push($tov, $row['TOV']);
array_push($pf, $row['PF']);
array_push($pts, $row['PTS']);
array_push($abc, $row['+-']);
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
      
      var ID = <?php echo json_encode($id); ?>;
      var NAME = <?php echo json_encode($name); ?>;
   	  var BIRTH = <?php echo json_encode($birth); ?>;
   	  var TEAM = <?php echo json_encode($team); ?>;
   	  var OPP = <?php echo json_encode($opp); ?>;
   	  var WL = <?php echo json_encode($wl); ?>;
   	  var GS = <?php echo json_encode($gs); ?>;
   	  var TIME = <?php echo json_encode($time); ?>;
   	  var FG = <?php echo json_encode($fg); ?>;
   	  var FGA = <?php echo json_encode($fga); ?>;
   	  var FGP = <?php echo json_encode($fgp); ?>;
   	  var THREEP = <?php echo json_encode($threep); ?>;
   	  var THREEPA = <?php echo json_encode($threepa); ?>;
var THREEPP = <?php echo json_encode($threepp); ?>;
var FT = <?php echo json_encode($ft); ?>;
var FTA = <?php echo json_encode($fta); ?>;
var FTP = <?php echo json_encode($ftp); ?>;
var ORB = <?php echo json_encode($orb); ?>;
var DRB = <?php echo json_encode($drb); ?>;
var TRB = <?php echo json_encode($trb); ?>;
var AST = <?php echo json_encode($ast); ?>;
var STL = <?php echo json_encode($stl); ?>;
var BLK = <?php echo json_encode($blk); ?>;
var TOV = <?php echo json_encode($tov); ?>;
var PF = <?php echo json_encode($pf); ?>;
var PTS = <?php echo json_encode($pts); ?>;
var ABC = <?php echo json_encode($abc); ?>;
// 
//       var SP = <?php echo json_encode($SearchPara); ?>;
// alert(NN);
// alert(ID);
// alert(BI);
// alert(TE);
      function drawTable() {
      
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'P_ID');
        data.addColumn('string', 'NAME');
        data.addColumn('string', 'DATE');
        data.addColumn('string', 'TEAM');
        data.addColumn('string', 'OPP');
data.addColumn('string', 'WL');
data.addColumn('string', 'GS');
data.addColumn('string', 'TIME');
data.addColumn('string', 'FG');
data.addColumn('string', 'FGA');
data.addColumn('string', 'FGP');
data.addColumn('string', '3P');
data.addColumn('string', '3PA');
data.addColumn('string', '3PP');
data.addColumn('string', 'FT');
data.addColumn('string', 'FTA');
data.addColumn('string', 'FTP');
data.addColumn('string', 'ORB');
data.addColumn('string', 'DRB');
data.addColumn('string', 'TRB');
data.addColumn('string', 'AST');
data.addColumn('string', 'STL');
data.addColumn('string', 'BLK');
data.addColumn('string', 'TOV');
data.addColumn('string', 'PF');
data.addColumn('string', 'PTS');
data.addColumn('string', '+-');
		data.addRows(ID.length);
		var i;
for (i = 0; i < ID.length; i++) { 
		data.setCell(parseInt(i), 0, ID[i]);
		data.setCell(parseInt(i), 1, NAME[i]);
		data.setCell(parseInt(i), 2, BIRTH[i]);
		data.setCell(parseInt(i), 3, TEAM[i]);
		data.setCell(parseInt(i), 4, OPP[i]);
data.setCell(parseInt(i), 5, WL[i]);
data.setCell(parseInt(i), 6, GS[i]);
data.setCell(parseInt(i), 7, TIME[i]);
data.setCell(parseInt(i), 8, FG[i]);
data.setCell(parseInt(i), 9, FGA[i]);
data.setCell(parseInt(i), 10, FGP[i]);
data.setCell(parseInt(i), 11, THREEP[i]);
data.setCell(parseInt(i), 12, THREEPA[i]);
data.setCell(parseInt(i), 13, THREEPP[i]);
data.setCell(parseInt(i), 14, FT[i]);
data.setCell(parseInt(i), 15, FTA[i]);
data.setCell(parseInt(i), 16, FTP[i]);
data.setCell(parseInt(i), 17, ORB[i]);
data.setCell(parseInt(i), 18, DRB[i]);
data.setCell(parseInt(i), 19, TRB[i]);
data.setCell(parseInt(i), 20, AST[i]);
data.setCell(parseInt(i), 21, STL[i]);
data.setCell(parseInt(i), 22, BLK[i]);
data.setCell(parseInt(i), 23, TOV[i]);
data.setCell(parseInt(i), 24, PF[i]);
data.setCell(parseInt(i), 25, PTS[i]);
data.setCell(parseInt(i), 26, ABC[i]);
		
		
}

		

        var table = new google.visualization.Table(document.getElementById('table_div'));

        table.draw(data, {showRowNumber: true, width: '100%', height: '100%'});
      }
    </script>

  <body>
    <!~~Div that will hold the pie chart~~>
    <div id="table_div"></div>
  </body>
 -->
</html>