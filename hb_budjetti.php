
<?php
session_start();
if(empty($_SESSION['usercode'])){
     header("LOCATION:hb_login.php");
}
$page= "Budjetti";
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

$query = "
  SELECT bought, bdate
  FROM hb_uses WHERE usercode= '$usercode'
  ORDER BY bdate";
$result = mysqli_query( $connection, $query );

// All good?
if ( !$result ) {
  // Nope
  $message  = 'Invalid query: ' . mysqli_error() . "\n";
  $message .= 'Whole query: ' . $query;
  die( $message );
}

$query2 = "
  SELECT *
  FROM hb_budjet WHERE usercode= '$usercode'";
$result2 = mysqli_query($connection, $query2);



// Print out rows
/*while ( $row = mysqli_fetch_assoc( $result ) ) {
 echo $row['bought'] . ' | ' . $row['bdate'] . "<br>";
}*/
// Close the connection
//mysqli_close($connection);
// Print out rows
$prefix = '';
/*echo "[ <br>";
while ( $row = mysqli_fetch_assoc( $result ) ) {
  echo $prefix . " { <br>";
  echo '  "date": "' . $row['bdate'] . '",' . "<br>";
  echo '  "value": ' . $row['bought'] .  "<br>";
  echo " }";
  $prefix = ", <br>";
}
echo "<br>]";*/
?>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>


<h2 class="center" style="color:orange;">Budjetin käyttö</h2>
<br>

<!-- Budjet boxes -->

<div class="flex-container center">
	<main>
	<div class="txt-box color1 budgetfont" style="margin-right: -40px;">
        <?php 
        while ( $row2 = mysqli_fetch_assoc( $result2 ) ) {
		echo"<h4>Myönnetty</h4>";
		echo"<p> " . $row2['given'] ."€
		</p>";
	echo"</div>";
	echo "<div class='txt-box color2 budgetfont' style='float:right; margin-right:-10px;'>";
		echo "<h4>Käytetty</h4>";
		echo "<p>" . $row2['used'] . "€</p>";
	echo "</div>";
	echo "<div class='txt-boxj color3 budgetfont'>";
		echo "<h4>Jäljellä</h4>";
		echo "<p>" . $row2['remaining'] . "€
		</p>";
        }
        ?>
	   </div>
	</main>
</div>
<br>
<br>
<!-- Chart info --
<p class="atleft">
	Skaalaa eteenpäin
</p>

<p class="atright">
	Skaalaa taaksepäin
</p>-->

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>

<!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv", {
    "type": "serial",
    "theme": "light",
    "marginRight":80,
    "autoMarginOffset":20,
    "dataDateFormat": "YYYY-MM-DD HH:NN",
    "colors": [
		"#ac1900",
		"#e65100",
		"#ffbb93"
    ],
    "dataProvider": [      
        
        <?php $prefix = '';
while ( $row = mysqli_fetch_assoc( $result ) ) {
  echo $prefix . " { \n";
  echo '  "date": "' . $row['bdate'] . '",';
  echo '  "value": ' . $row['bought'] ;
  echo " }";
  $prefix = ",\n";
}
?>
    
    ],
     
    "valueAxes": [{
        "axisAlpha": 0,
        "guides": [{
            "fillAlpha": 0.1,
            "fillColor": "#888888",
            "lineAlpha": 0,
            "toValue": 16,
            "value": 10
        }],
        "position": "left",
        "tickLength": 0
    }],
    "graphs": [{
        "balloonText": "[[category]]<br><b><span style='font-size:14px;'>Käytetty: [[value]]</span></b>",
        "bullet": "round",
        "bulletSize": 9,
        "dashLength": 6,
        "colorField":"color",
	"lineThickness": 3,
	"minBulletSize": 2,
	"title": "graph",
        "valueField": "value"
    }],
    "trendLines": [{
        "finalDate": "2018-31-12",
        "finalValue": 300,
        "initialDate": "2018-01-01",
        "initialValue": 300,    
	"lineThickness": 3,
        "lineColor": "#ff8a65"
    }/* {
        "finalDate": "2012-01-22 12",
        "finalValue": 10,
        "initialDate": "2012-01-17 12",
        "initialValue": 16,
        "lineColor": "#ff8a65"
    }*/],
    "chartScrollbar": {
        "scrollbarHeight":3,
        "offset":-1,
        "backgroundAlpha":0.1,
        "backgroundColor":"#888888",
        "selectedBackgroundColor":"#bbbbbb",
        "selectedBackgroundAlpha":1
    },
    "chartCursor": {
        "fullWidth":true,
        "valueLineEabled":true,
        "valueLineBalloonEnabled":true,
        "valueLineAlpha":0.5,
        "cursorAlpha":0
    },
    "categoryField": "date",
    "categoryAxis": {
        "parseDates": true,
        "axisAlpha": 0,
        "gridAlpha": 0.1,
        "minorGridAlpha": 0.1,
        "minorGridEnabled": true
    },
    "export": {
        "enabled": true
     }
});
chart.addListener("dataUpdated", zoomChart);
function zoomChart(){
    //TODO inject php
    //Select min date and select max date
    chart.zoomToDates(new Date(2018, 0, 23), new Date(2018, 11, 27));
}
</script>

<!-- Chart HTML command -->
<div id="chartdiv"></div>				

<pre>

</pre>

<!-- More chart info -->
<div class="center"><pre>





</pre>
	<img src="img/chartinfo.jpg" title="Kaavio info" alt="Kaavio info" width="291" height="28">
</div>

<pre>


</pre>
<br><br>
<?php

include_once 'hb_footer.inc';
  
  


  
