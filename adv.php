
<!DOCTYPE html>
<?php
session_start();
?>
<html>
<title>NBA Data Management System</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
html,body,h1,h2,h3,h4 {font-family:"Lato", sans-serif}
.mySlides {display:none}
.w3-tag, .fa {cursor:pointer}
.w3-tag {height:15px;width:15px;padding:0;margin-top:6px}
</style>
<body>

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
    <h1><b>Advanced Functions</b></h1>
    <p></p>
  </div>

  <!-- Slideshow -->
  <div class="w3-container">
<!-- 
    <div class="w3-display-container mySlides">
      <img src="/w3images/coffee.jpg" style="width:100%">
      <div class="w3-display-topleft w3-container w3-padding-32">
        <span class="w3-white w3-padding-large w3-animate-bottom">Lorem ipsum</span>
      </div>
    </div>
    <div class="w3-display-container mySlides">
      <img src="/w3images/workbench.jpg" style="width:100%">
      <div class="w3-display-middle w3-container w3-padding-32">
        <span class="w3-white w3-padding-large w3-animate-bottom">Klorim tipsum</span>
      </div>
    </div>
    <div class="w3-display-container mySlides">
      <img src="/w3images/sound.jpg" style="width:100%">
      <div class="w3-display-topright w3-container w3-padding-32">
        <span class="w3-white w3-padding-large w3-animate-bottom">Blorum pipsum</span>
      </div>
    </div>
 -->

    <!-- Slideshow next/previous buttons -->
<!-- 
    <div class="w3-container w3-dark-grey w3-padding w3-xlarge">
      <div class="w3-left" onclick="plusDivs(-1)"><i class="fa fa-arrow-circle-left w3-hover-text-teal"></i></div>
      <div class="w3-right" onclick="plusDivs(1)"><i class="fa fa-arrow-circle-right w3-hover-text-teal"></i></div>
    
      <div class="w3-center">
        <span class="w3-tag demodots w3-border w3-transparent w3-hover-white" onclick="currentDiv(1)"></span>
        <span class="w3-tag demodots w3-border w3-transparent w3-hover-white" onclick="currentDiv(2)"></span>
        <span class="w3-tag demodots w3-border w3-transparent w3-hover-white" onclick="currentDiv(3)"></span>
      </div>
    </div>
 -->
  </div>

  <!-- Grid -->
  <div class="w3-row-padding" id="about">
<!-- 
    <div class="w3-center w3-padding-64">
      <span class="w3-xlarge w3-bottombar w3-border-dark-grey w3-padding-16"></span>
    </div>
 -->

    <div class="w3-third w3-margin-bottom">
      <div class="w3-card-4">
<!--         <img src="/w3images/team1.jpg" alt="John" style="width:100%"> -->
        <div class="w3-container">
          <h3>Ranking</h3>
          <p class="w3-opacity">---Advanced Function 1</p>
          <p>The establish and exhibition of the ranking of players.</p>
          <p><a href="ranking.php" class="w3-button w3-light-grey w3-block">VIEW DETAILS</a></p>
        </div>
      </div>
    </div>

    <div class="w3-third w3-margin-bottom">
      <div class="w3-card-4">
<!--         <img src="/w3images/team2.jpg" alt="Mike" style="width:100%"> -->
        <div class="w3-container">
          <h3>Peak Period</h3>
          <p class="w3-opacity">---Advanced Function 2</p>
          <p>Allow users to send the query and analyze the peak period of a player.</p>
          <p><a href="pp.php" class="w3-button w3-light-grey w3-block">VIEW DETAILS</a></p>
<!--           <p><button class="w3-button w3-light-grey w3-block">VIEW DETAILS</button></p> -->
        </div>
      </div>
    </div>

    <div class="w3-third w3-margin-bottom">
      <div class="w3-card-4">
<!--         <img src="/w3images/team3.jpg" alt="Jane" style="width:100%"> -->
        <div class="w3-container">
          <h3>Player Comparison</h3>
          <p class="w3-opacity">---Advanced Function 3</p>
          <p>Allow users to see the compare the performance between two players.</p>
          <p><a href="chem.php" class="w3-button w3-light-grey w3-block">VIEW DETAILS</a></p>
        </div>
      </div>
    </div>
    
    <div class="w3-third w3-margin-bottom">
      <div class="w3-card-4">
<!--         <img src="/w3images/team1.jpg" alt="John" style="width:100%"> -->
        <div class="w3-container">
          <h3>Key Player</h3>
          <p class="w3-opacity">---Advanced Function 4</p>
          <p>Show the analyze of the key player in a team.</p>
          <p><a href="kplayer.php" class="w3-button w3-light-grey w3-block">VIEW DETAILS</a></p>
        </div>
      </div>
    </div>

    <div class="w3-third w3-margin-bottom">
      <div class="w3-card-4">
<!--         <img src="/w3images/team2.jpg" alt="Mike" style="width:100%"> -->
        <div class="w3-container">
          <h3>True Shooting Percentage</h3>
          <p class="w3-opacity">---Advanced Function 5</p>
          <p>Send a query of the True Shooting percentage.</p>
          <p><a href="tsp.php" class="w3-button w3-light-grey w3-block">VIEW DETAILS</a></p>
<!--           <p><button class="w3-button w3-light-grey w3-block">VIEW DETAILS</button></p> -->
        </div>
      </div>
    </div>

    <div class="w3-third w3-margin-bottom">
      <div class="w3-card-4">
<!--         <img src="/w3images/team3.jpg" alt="Jane" style="width:100%"> -->
        <div class="w3-container">
          <h3>Key Position</h3>
          <p class="w3-opacity">---Advanced Function 6</p>
          <p>The variation trend of key position in a team.</p>
          <p><a href="kposition.php" class="w3-button w3-light-grey w3-block">VIEW DETAILS</a></p>
        </div>
      </div>
    </div>
    
  </div>