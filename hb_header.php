<?php
session_start();
include_once 'hb_header.php';
// Load configuration as an array. Use the actual location of your configuration file
$config = parse_ini_file('../valmisledi/config.ini'); 
// Try and connect to the database
$connection = mysqli_connect($config['dbbaddr'],$config['usernamecd'],$config['password'],$config['dbname']);
// If connection was not successful, handle the error
if($connection === false) {
    // Handle error - notify administrator, log to a file, show an error screen, etc.
    echo "Connection to database failed :( ";
    exit ("If we have no database connection, this is end");
}else{
mysqli_set_charset($connection, "utf8");
}
/*Select the data base
$db = mysqli_select_db( 'test', $connection );
if ( !$db ) {
  die ( 'Error selecting database ' . test . ' : ' . mysqli_error() );
}*/
// Fetch the data from hb_chart and order by date
$usercode = $_SESSION['usercode'];

$profile = "
  SELECT firstname, lastname FROM hb_user WHERE usercode= '$usercode'";
$rprof = mysqli_query( $connection, $profile );

// All good?
if ( !$rprof ) {
  // Nope
  $message  = 'Invalid query: ' . mysqli_error() . "\n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

$rowprof = mysqli_fetch_assoc( $rprof )

?>
<!DOCTYPE html>
<html lang= "fi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <link rel="stylesheet" href="css/hb_style.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif; font-size: 17px;}s
.w3-bar-block .w3-bar-item {padding:20px;}
    h2 {font-size: 30px;}
</style>
    <title>HB</title>
</head>
<body>

<!-- Sidebar (hidden by default) -->
    <nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:40%;min-width:300px;background-color:white; color:orange;" id="mySidebar">
          <a href="javascript:void(0)" onclick="w3_close()"
        class="w3-bar-item w3-button">&#9747;</a>
        <a href="hb_palvelut.php" <?php echo ($page == "Palvelut") ? 'class="active"' : ''; ?> onclick="w3_close()" class="w3-bar-item w3-button">Palvelut</a>
        <a href="hb_budjetti.php" <?php echo ($page == "Budjetti") ? 'class="active"' : ''; ?> onclick="w3_close()" class="w3-bar-item w3-button">Budjetti</a>
        <a href="hb_historia.php" <?php echo ($page == "Historia") ? 'class="active"' : ''; ?>  onclick="w3_close()" class="w3-bar-item w3-button">Historia</a>
    </nav>
    
     <div class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-right" style="display:none;z-index:2;width:40%;min-width:300px;background-color:white; color:orange; right:0px;" id="myProfile">
        <a href="javascript:void(0)" onclick="w3_close2()"
        class="w3-bar-item w3-button" style="background-color:orange; color:white;">&#9747;</a>
         <a href="hb_palvelut.php" onclick="w3_close()" class="w3-bar-item" style="background-color:orange; height:127px; text-align:center;"><!--<img class="happy" src="img/happywoman.jpg" alt="happywoman" >--></a>
         <div class="w3-bar-item w3-button" style="text-align:center;"><?php echo $rowprof['firstname'] . " " . $rowprof['lastname']; ?></div>
         <a href="logout.php"  class="w3-bar-item w3-button"  style="text-align:center;">Kirjaudu ulos</a>
        
    </div>

<!-- Top menu -->
<div class="w3-top shadow" style="color:white; background-color:orange;">
  <div class="w3-white w3-xlarge" style="max-width:1200px;margin:auto; color:orange;">
    <div class="orange w3-button w3-padding-16 w3-left" onclick="w3_open()">☰</div>
    <div class=" orange w3-right w3-padding-16 w3-margin-right w3-button" onclick="w3_open2()"> &#9702;&#9702;&#9702;</div><div class="orange w3-center w3-padding-16" style="font-size:26px;"><?php echo $page; ?></div>
    
  </div>
</div>
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px " >
      
    </div>
<script>
// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
}
 
function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
}
    
function w3_open2() {
    document.getElementById("myProfile").style.display = "block";
}
 
function w3_close2() {
    document.getElementById("myProfile").style.display = "none";
}
</script>
    


