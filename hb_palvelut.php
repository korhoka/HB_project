
<?php
session_start();
if(empty($_SESSION['usercode'])){
     header("LOCATION:hb_login.php");
}
$page= "Palvelut";
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
    
    
    $img1="<img class='img' src='img/kassi.jpg' alt='Kassi' style='width:100%'>";
    $img2="<img class='img' src='img/dinner.jpg' alt='Meal' style='width:100%'>";
    $img3="<img class='img' src='img/talkkari2.jpg' alt='Talkkari' style='width:100%'>";
    $img4="<img class='img' src='img/kylpy.jpg' alt='Bath' style='width:100%'>";
    $img5="<img class='img'  src='img/koti.jpg' alt='Koti' style='width:100%'>";
    $img6="<img class='img'  src='img/taxi.jpg' alt='taksi' style='width:100%'>";
    $img7="<img class='img'  src='img/siivous.jpg' alt='Siivous' style='width:100%'>";
    $img8="<img class='img'  src='img/social.jpg' alt='Ihmiset' style='width:100%'>";
    $img9="<img class='img' src='img/daycare.jpg' alt='Lapset' style='width:100%'>";
    $img10="<img class='img' src='img/clothes.jpg' alt='Vetoketju' style='width:100%'>";
   
    $link1="";
    $link2="";
    $link3="";
    $link4="hb_kylpyp2.php";
    $link5="";
    $link6="";
    $link7="";
    $link8="";
    $link9="";
    $link10="";
    
        
    
    
    
}
if(result == false) {
    echo "query failed :(";
}else {

//echo "ID: " .$row['pid'] . " - Name: " . $row['firstname'] . " " . $row['lastname'] . "<br>";
 }
?>
<!--<html lang= "en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
    <link rel="stylesheet" href="css/hb_style.css">-->
<style>

   h3 {font-size: 23px;}
</style>
<main>
  <!--  <div class="search">
             <input type="text" placeholder="Etsi..">
        </div><br>-->
    <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:2px " >
        <div class="w3-row-padding w3-padding-16 w3-center" id="food">
       <?php
            $fetch= mysqli_query($connection, "SELECT * FROM hb_mainclass"); 
        
            while ($row = mysqli_fetch_assoc($fetch)){ 
                $kk = $row['m_id'];
                echo "<a href='${"link" . $kk}'><div class=' quarter2 margin'>";
                echo ${"img" . $kk};
                echo "<h3 style='padding-bottom:42px;'>" . $row['name'] . " </h3>
            </div></a>";
            }
            ?>    
                
  </div>
    </div>
        
   <!-- Pagination 
  <div class="w3-center w3-padding-32">
    <div class="w3-bar">
      <a href="#" class="w3-bar-item w3-button w3-hover-black">«</a>
      <a href="#" class="w3-bar-item w3-black w3-button">1</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">2</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">3</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">4</a>
      <a href="#" class="w3-bar-item w3-button w3-hover-black">»</a>
    </div>
  </div> -->  
  
    </main>

<?php
include_once 'hb_footer.inc';
