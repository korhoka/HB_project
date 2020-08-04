<?php
session_start();

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
$usercode = $_SESSION['usercode'];
function circle_distance($lat1, $lon1, $lat2, $lon2) {
  $rad = M_PI / 180;
  return acos(sin($lat2*$rad) * sin($lat1*$rad) + cos($lat2*$rad) * cos($lat1*$rad) * cos($lon2*$rad - $lon1*$rad)) * 6371;// Kilometers
}

function distance($lat1, $lon1, $lat2, $lon2, $unit) {

  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  $unit = strtoupper($unit);

  if ($unit == "K") {
    return ($miles * 1.609344);
  } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
        return $miles;
      }
}

 /*public function DistAB()

      {
          $delta_lat = $this->lat_b - $this->lat_a ;
          $delta_lon = $this->lon_b - $this->lon_a ;

          $earth_radius = 6372.795477598;

          $alpha    = $delta_lat/2;
          $beta     = $delta_lon/2;
          $a        = sin(deg2rad($alpha)) * sin(deg2rad($alpha)) + cos(deg2rad($this->lat_a)) * cos(deg2rad($this->lat_b)) * sin(deg2rad($beta)) * sin(deg2rad($beta)) ;
          $c        = asin(min(1, sqrt($a)));
          $distance = 2*$earth_radius * $c;
          $distance = round($distance, 4);

          $this->measure = $distance;

      }

*/


?>
<!DOCTYPE html>
<html lang= "fi">
<head>
    <meta charset="utf-8">
    <style>

    #image {
        padding-top: 3px;
        width: 38%;
        height: 171px;
    }
    .quarter2 {
        margin-right: 10px; 
    }
    
    
       @media screen and (min-width: 870px){
        .morepadding2{
            float: right;
            max-height: 191px;
            min-height: 191px;
            max-width: 69%;
            min-width: 69%;
        }
    }

    @media screen and (max-width: 869px) {
        .morepadding2{
            float: right;
            max-height: 191px;
            min-height: 191px;
            max-width: 50%;
            min-width: 50%;
        }
    }

    </style>
    <title>HB</title>
</head>
<?php

    $image0="<img class='image' src='https://hoitava.fi/wp-content/uploads/2017/08/hoitava-logo2.png' title='Hoitava logo' alt='Hoitava logo'>";
    $image1="<img class='image' src='http://henkilokohtainenbudjetointi.fi/wp-content/uploads/2017/01/logokuva_oranssi_levea.jpg' alt='HB logo'>";
    $image2="<img class='image' src='img/jalkatossu.jpg' alt='Meal'>";
    $image3="<img class='image' src='img/sampo_logo.png' alt='Meal'>";
    $image4="<img class='image' src='img/skh_logo.jpg' alt='skh logo'>";
    $image5="<img class='image' src='img/kanerva2.png' alt='Kainuun kanerva logo'>";
    $image6="<img class='image' src='http://henkilokohtainenbudjetointi.fi/wp-content/uploads/2017/01/logokuva_oranssi_levea.jpg' alt='HB logo'>";
    $image7="<img class='image' src='img/kainuu.jpg' alt='Kainuun logo'>"; 
    
    $link0 ="<a href='https://hoitava.fi/'>https://hoitava.fi/</a>";
    $link1= "";
    $link2="";
    $link3="<a href='https://www.hyvinvointisampo.fi/'>https://www.hyvinvointisampo.fi/</a>";
    $link4="<a href='http://www.kristillistahoivaa.fi/?s=1&p=12'>http://www.kristillistahoivaa.fi</a>";
    $link5="<a href='https://kainuun-kanerva.fi/'>https://kainuun-kanerva.fi</a>";
    $link6="<a href='https://www.simolankotityopalvelut.com/'>https://www.simolankotityopalvelut.com</a>";
    $link7="<a href='https://sote.kainuu.fi/ikaihmiset'>https://sote.kainuu.fi/ikaihmiset</a>";
    
        
         $fetch= mysqli_query($connection, "SELECT p_id, priceh, pricekm, c_id, rate, alkm FROM hb_provide WHERE s_id=10"); 

        while ($row = mysqli_fetch_assoc($fetch)){
            $kk = $row['c_id'];
            $fetch1 = mysqli_query($connection, "SELECT * FROM hb_company WHERE c_id = '$kk'");
            
             $row1 = mysqli_fetch_assoc($fetch1);
            $loc = $row1['longitude'];
             $lac = $row1['latitude'];
            echo "<div id='myBtn$kk' class='quarter3 kborder'>"; 
            echo ${"image" . $kk};
            echo "<div class='morepadding2'>";
            echo "<p style='font-weight:bold;'>" . $row1['c_name'] . "</p><p>" . $row['priceh'] ."€/h +". $row['pricekm'] . "€/km</p>";
            ///////// tähdet ///////////////////
             $rate = $row['rate'];
            $lkm = $row['alkm'];
            $mean = $rate/$lkm;
            
            if(round($mean)==1){
                echo "<p class='gold'>&#9733;</p>";
            }if(round($mean)==2){
                 echo "<p class='gold'>&#9733;&#9733;</p>";
            }if(round($mean)==3){
                 echo "<p class='gold'>&#9733;&#9733;&#9733;</p>";
            }if(round($mean)==4){
                 echo "<p class='gold'>&#9733;&#9733;&#9733;&#9733;</p>";
            }if(round($mean)==5){
                 echo "<p class='gold'>&#9733;&#9733;&#9733;&#9733;&#9733;</p>";
            }
            ///////////////////////////////////////////////////////
            //did user clicked on "Ota paikannus käyttöön" button?
            if($lac > 0 && $loc > 0){
            $et= circle_distance($_POST['userla'], $_POST['userlo'], $lac,$loc);
            echo "<p>Etäisyys: ";
            echo round($et, 2); echo " km</p>";
            } else {
                
            }
            
            echo "</div></div>";



?>

            <div id="myModal<?php echo $kk;?>" class="modal" data-modal=
                 "myModal<?php echo $kk;?>">
                <div class="modal-content">
                    <span class="close" data-modal=
                    "myModal<?php echo $kk;?>">&times;</span>
                    <p style="font-weight:bold;">Kylvetyspalvelu kodin ulkopuolella</p>
                    <div>Yritys: <?php echo $row1['c_name'];?>  <br>Hinta: <?php echo $row['priceh']. "€/h";?>  +<?php echo $row['pricekm'] . "€/km<br>"; ?><br></div>
            
                    <form id="modalForm<?=$kk?>" method="post" action="kylpytest.php">
                        Palvelun käyttöpäivä:<br> <input type="date" min= "<?php echo date('Y-m-d'); ?>" name="Bdate">
                        <p class="modalF">Kesto (h):</p> <br><input class="kesto" type="number" min="1" name="duration"><br>
                        <input type="submit" name="buy" class= "button btn btn-primary" value="Osta"><br><br>
                        <input type="hidden" name="1" value="checked">
                        <input type="hidden" name="clicked" value="whatever">
                        <input type="hidden" name="selected_service" value="<?php echo $kk; ?>">
                        <input type="hidden" name="modalOpen" value="myModal<?php echo $kk;?>">
                        <input type="hidden" name="pid" value="<?php echo $row['p_id'];?>">
                        <input type="hidden" name="priceh" value="<?php echo $row['priceh'];?>">
                        <input type="hidden" name="usercode" value="<?php echo $usercode;?>">
                    </form>
                    <div id="result<?=$kk?>"></div>
            
                    <div style="font-weight:bold;">Yrityksen tiedot:</div><br>
                    
                    <?php
                     echo ${"link" . $kk};
                    if($lac > 0 && $loc > 0){
                    ?>
                    <div><?php echo $row1['c_street'] . ", <br><p style='margin-top:0;'>" . $row1['c_zip'] . " " . $row1['c_city'] . "</p>";?></div>
                    <div>
                   
                    </div>
                    <div id="map<?= $kk ?>" style="width: 100%; height:400px;border: 2px dotted green;"></div>
                    <?php
                    }
                    ?>
    <!-- that script will handle the form submission. -->
                    <script>
                    // get the form and the div to print the result (id must be unique in html!)
        const form<?=$kk?> = document.getElementById('modalForm<?=$kk?>');
      console.log('Form? ' + 'modalForm<?=$kk?>');
      const txt<?=$kk?> = document.getElementById('result<?=$kk?>');

      // will execute when the user press the submit button
      form<?=$kk?>.addEventListener('submit', (event) => { 
        console.log('Why not here?');
        // avoid that the page reload when the user send the form
        event.preventDefault();
          // get the values the user has entered in the from
        const data = new FormData(form<?=$kk?>);
        const bday = data.get('Bdate');
        const dur = data.get('duration');
        // send the data to the php script
        if(bday && dur) {
            console.log('ok values? ' + bday + ' ' + dur);
            //txt.innerHTML = 'Should be ok and we can insert data in DB';
            fetch('kylpytest.php', {
              method: 'post',
              body: data,
            }).then((resp) => {
              return resp.text();
            }).then((html_res) => {
              // print the result from form.php inside the div
              txt<?=$kk?>.innerHTML = html_res + "Voit sulkea ikkunan";
              //const btn = document.getElementById('button');
              //btn.setAttribute("disabled", "disabled");
            });
        } else {
            txt<?=$kk?>.innerHTML = '<span style="color: red; font-weight: bold">Syötä käyttöpäivä ja kesto</span>';
        }
        
        
      }, false);

            </script>

                
                
            <script>
        console.log("so what? ");
        var uluru = {lat: <?php echo $lac; ?>, lng: <?php echo $loc; ?>};
    
        var map = new google.maps.Map(document.getElementById('map<?= $kk ?>'), {
          zoom: 8,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
          console.log(map);
        
            </script>
    
           <?php    
            echo "</div>
            </div>";
             }
?>
                
    <script>
     /* function initMap() {
        var uluru = {lat: -25.363, lng: 131.044};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 4,
          center: uluru
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map
        });
      }*/
    </script>
             <?php
echo "<br>";

               
               
?>
<script>
// Get the modal
/*var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}*/


///////////////////////////////////////////

// assign unique id's to different buttons and then use the id value as class attributes 
// document queryselector is how you get all of the element
// in this example we test the id attribute contains the txt "myBtn" and selects all of the needed elements


var buttonmatches = document.querySelectorAll("div[id*='myBtn']");
var modalmatches = document.querySelectorAll("div[id*='myModal']");
var spanmatches = document.querySelectorAll("span.close");

		
addlisteners();

// loop to add event listeners to all of the buttons

function addlisteners() {
	
var montako = modalmatches.length;

console.log(montako);


for (var i = 0; i < buttonmatches.length; i++) {
		
		console.log('sisällä ollaan');
		

		
        buttonmatches[i].addEventListener("click", function () {
        			
            // to open the correct modal
            // select the div that directly follows the buttonmatch div
            
            	var selector = "div[id='" + this.id  + "']" + " + div";
            console.log('I will query and open the next modal with this data:');
            console.log(selector);
            document.querySelector(selector).style.display = "block";
            
            // OR SINCE WE should have the same amount of matches is each array
            // but this can be error prone..
            //modalmatches[i].style.display = "block";
        });
        
        spanmatches[i].addEventListener("click", function (e) {
            
				var spani = e.target;		
				var kohde = spani.dataset.modal;
				console.log('in the close click'); 
				console.log(kohde);           
            // to close the correct modal
            var selector = "div[id='" + kohde  + "']";
           
            document.querySelector(selector).style.display = "none";
        });      
        
   }

}



// When the user clicks anywhere outside of the modal, close it
// you have to iterate through all of the modals to see if they are open

window.onclick = function(event) {

	for (var i = 0; i < modalmatches.length; i++) {
	    if (event.target == modalmatches[i]) {
    	   modalmatches[i].style.display = "none";
    	    break;
   	 	}
   	 }
}

                </script>
                
