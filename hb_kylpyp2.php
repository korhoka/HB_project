<?php
session_start();
$page= "Palvelut";
include_once 'hb_header.php';
$config = parse_ini_file('../valmisledi/config.ini'); 

if(empty($_SESSION['usercode'])){
     header("LOCATION:hb_login.php");
}
// Try and connect to the database
$connection = mysqli_connect($config['dbbaddr'],$config['usernamecd'],$config['password'],$config['dbname']);

// If connection was not successful, handle the error
if($connection === false) {
    // Handle error - notify administrator, log to a file, show an error screen, etc.
    echo "Connection to database failed :( ";
    exit ("If we have no database connection, this is end");
}else{
mysqli_set_charset($connection, "utf8");
    $result_1= mysqli_query($connection, "SELECT s_name FROM hb_service where  s_id=7");
    $result_2 = mysqli_query($connection, "SELECT s_name FROM hb_service where  s_id=10");
      
    $row_1 = mysqli_fetch_array($result_1);
    $row_2 = mysqli_fetch_array($result_2);
}


 ?>
<script 
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCdFCHkCCC6br114nMl6CSY2JPUPtriZ7Q">
    </script>
<div class=" w3-left w3-margin-left" style="margin-top:-30px;font-size:12px;"><a href="hb_palvelut.php">Palvelut </a>&#8680; Kylvetyspalvelu</div><br>

<h2 class="center" style="color:orange; margin-top:-17px;">Kylvetyspalvelu</h2>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    
    <div style="margin-bottom:10px;"><input class="float checkbox-round" type="checkbox" name="kaikki"> Valitse kaikki<br></div>
    <div style="margin-bottom:10px;"><input class="float checkbox-round" type="checkbox" name="1"> <?php echo $row_1['s_name']; ?><br></div>
    <div style="margin-bottom:10px;"><input class="float checkbox-round" type="checkbox" name="2"> <?php echo $row_2['s_name']; ?><br></div>
    <input class="float w3-center rajaabtn" type="submit" name="clicked" value="Valitse"><br>
</form>
<br>
<p id="demo"></p>


<?php
$variable = $_POST['variable'];
//echo $_POST['variable'];
$variable2 = $_POST['variable2'];
//$la= "<script>document.writeln(la);";
//$lo= "document.writeln(lo);";


    if($_POST["1"] && $_POST["clicked"] ) { 
        //header("Access-Control-Allow-Origin: *");
        
        
        ?>
        
        <script>
    
    $(document).ready(function() {
    
            
            if (navigator.geolocation) {
       
                var position = navigator.geolocation.getCurrentPosition(showPosition);
                // ja lähetä
    
            } else { 
                // korjaa
                console.log('eiiiii');
                //x.innerHTML = "Geolocation is not supported by this browser.";
    
            }
            
            
        });
    
    
    
var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}



function showPosition(position) {
    var la = position.coords.latitude;
    console.log(la);    
   var lo =position.coords.longitude; 
    console.log(lo); 
    
$.post('test.php', {'userla': la, 'userlo': lo}, function(result){
    
    $('#demo').html(result);
    
});


    
}
    
function sendvariables(la, lo) {
    
    $(document).ready(function() {
        
        var variableToSend = la;
    console.log(la);
        //$.post('hb_kylpyp2.php', {variable: variableToSend});
    //
    console.log(lo);
    var variableToSend2 = lo;
$.post('hb_kylpyp2.php', {'userla': variableToSend, 'userlo': variableToSend2}); 
    
    });
}
    
</script>

    <!--<pre><//?php print_r ($_POST);?></pre>-->
<?php
        
    }
if($_POST["2"] && $_POST["clicked"]){
        
        
        
        ?>
        
        <script>
    
    $(document).ready(function() {
    
            
            if (navigator.geolocation) {
       
                var position = navigator.geolocation.getCurrentPosition(showPosition);
                // ja lähetä
    
            } else { 
                // korjaa
                console.log('eiiiii');
                //x.innerHTML = "Geolocation is not supported by this browser.";
    
            }
            
            
        });
    
    
var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}



function showPosition(position) {
    var la = position.coords.latitude;
    console.log(la);    
   var lo =position.coords.longitude; 
    console.log(lo); 
    
$.post('test2.php', {'userla': la, 'userlo': lo}, function(result){
    
    $('#demo').html(result);
    
});


    
}
    
function sendvariables(la, lo) {
    
    $(document).ready(function() {
        
        var variableToSend = la;
    console.log(la);
        //$.post('hb_kylpyp2.php', {variable: variableToSend});
    //
    console.log(lo);
    var variableToSend2 = lo;
$.post('hb_kylpyp2.php', {'userla': variableToSend, 'userlo': variableToSend2}); 
    
    });
}
    
</script>

   <!-- <pre><//?php print_r ($_POST);?></pre>-->
<?php
        
    }
echo "<br>";

      


if($_POST["kaikki"] && $_POST["clicked"] ) { 
        //header("Access-Control-Allow-Origin: *");
        
        
        ?>
        
        <script>
    
    $(document).ready(function() {
    
            
            if (navigator.geolocation) {
       
                var position = navigator.geolocation.getCurrentPosition(showPosition);
                // ja lähetä
    
            } else { 
                // korjaa
                console.log('eiiiii');
                //x.innerHTML = "Geolocation is not supported by this browser.";
    
            }
            
            
        });
    
    
    
var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}



function showPosition(position) {
    var la = position.coords.latitude;
    console.log(la);    
   var lo =position.coords.longitude; 
    console.log(lo); 
    
$.post('test3.php', {'userla': la, 'userlo': lo}, function(result){
    
    $('#demo').html(result);
    
});


    
}
    
function sendvariables(la, lo) {
    
    $(document).ready(function() {
        
        var variableToSend = la;
    console.log(la);
        //$.post('hb_kylpyp2.php', {variable: variableToSend});
    //
    console.log(lo);
    var variableToSend2 = lo;
$.post('hb_kylpyp2.php', {'userla': variableToSend, 'userlo': variableToSend2}); 
    
    });
}
    
</script>

    <!--<pre><//?php print_r ($_POST);?></pre>-->
<?php
        
    }



               
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




/*function myFunction() {
    $("form").on("submit", function (event) {
        event.preventDefault();
        $.ajax({
            url: "hb_kylpy.php#modalForm",
            type: "POST",
            data: yourData,
            success: function (result) {
                console.log(result)
            }
        });
    })
}*/
</script>
<br>
<br>
<?php
    
include_once 'hb_footer.inc';