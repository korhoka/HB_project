<?php
session_start();
if(empty($_SESSION['usercode'])){
     header("LOCATION:hb_login.php");
}
$page= "Historia";
include_once 'hb_header.php';
$config = parse_ini_file('../valmisledi/config.ini'); 

// Try and connect to the database
$connection = mysqli_connect($config['dbbaddr'],$config['usernamecd'],$config['password'],$config['dbname']);

// If connection was not successful, handle the error
if($connection === false) {
    // Handle error - notify administrator, log to a file, show an error screen, etc.
    echo "Connection to database failed :( ";
    exit ("If we have no database connection, this is end");
}else {
    $usercode = $_SESSION['usercode'];
    mysqli_set_charset($connection, "utf8");
    $fetch= mysqli_query($connection,"SELECT * FROM hb_uses WHERE usercode= '$usercode'");
    //$fetch = mysqli_fetch_array($result);
   
}
echo "<p class='center' style='color:orange; font-size:28px; margin-top:0px;'> Ostetut Palvelut</p>";
$num=0;
 while ($row = mysqli_fetch_assoc($fetch)){
     $kk = $row['p_id'];
     $fetch1 = mysqli_query($connection, "SELECT c_id, s_id FROM hb_provide WHERE p_id = '$kk'");
     $row1 = mysqli_fetch_assoc($fetch1);
     $tt = $row1['c_id'];
     $fetch2 = mysqli_query($connection, "SELECT * FROM hb_company WHERE c_id = '$tt'");
     $row2 = mysqli_fetch_assoc($fetch2);
     $ss= $row1['s_id'];
    $fetch3 = mysqli_query($connection, "SELECT * FROM hb_service WHERE s_id = '$ss'");
     $row3 = mysqli_fetch_assoc($fetch3);
    echo "<div class='quarter4 kborder' style='background-color:white;margin-right: 10px; margin-top: 10px;'>";
     echo "<div>Palvelu: <p id='history' class='box2'>" . $row3['s_name'] . "</p></div><br><div class='hstripes' style='background-color:#fcf4eb;'>Yritys: <p id='history' class='box2'>" . $row2['c_name'] . "</p></div><br><div class='hstripes'>Kesto: <p id='history' class='box2'>" . $row['duration'] . "h</p></div><br><div class='hstripes' class='box2' style='background-color:#fcf4eb;'>Käyttöpäivä: <p id='history' class='box2'>" . date('d.m.Y', strtotime($row['dateofuse'])) . "</p></div>"; ;
     echo "<br>";
     echo "<div class='hstripes'>Ostopäivä: <p id='history' class='box2'>" . date('d.m.Y', strtotime($row['bdate'])) . "</p></div>";
     echo "<div class='hstripes' style='background-color:#fcf4eb; margin-top:0px;'>Maksettu: <p id='history' class='box2'>" . $row['bought'] . "€</p></div>";
     echo "<form  method='post' action= '" . $_SERVER["PHP_SELF"] . "'>";
     echo "<button id='myBtnp$num' class='abutton' name='arvioi' data-modal=
                 'myModalp$num'>Arvioi</button>";
     echo "<input type='hidden' name='modalOpen2' value='myModalp$num'>";
     echo "</form></div>";
     
      
     ?>

   <div id="myModalp<?php echo $num;?>" style="display:none;" class="modalp" data-modal=
                 "myModalp<?php echo $num;?>">
            <div class="modal-contentp">
            <span class="closep" data-modal=
                 "myModalp<?php echo $num;?>">&times;</span>
            <form id="modalFormp" method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>">
                   <p>Tähtien määrä: </p>
                <div class="rating">
              <?php  
     
            if($row['stars'] == NULL){
                ///////// tähdet ///////////////////
            if($row['stars']>=1){
                echo "<label class='starcontainer'><input type='radio' name='rating' value=1><span class='fa fa-star checked'></span></label>";
            } else {
                echo "<label class='starcontainer'><input type='radio' name='rating' value=1><span class='fa fa-star'></span></label>";
            }
     
            if($row['stars']>=2){
                  "<label class='starcontainer'><input type='radio' name='rating' value=2><span class='fa fa-star checked'></span></label>";
            } else {
                echo "<label class='starcontainer'><input type='radio' name='rating' value=2><span class='fa fa-star'></span></label>";
            }
            if($row['stars']>=3){
                  "<label class='starcontainer'><input type='radio' name='rating' value=3><span class='fa fa-star checked'></span></label>";
            } else {
                echo "<label class='starcontainer'><input type='radio' name='rating' value=3><span class='fa fa-star'></span></label>";
            }
            if($row['stars']>=4){
                  "<label class='starcontainer'><input type='radio' name='rating' value=4><span class='fa fa-star checked'></span></label>";
            } else {
                echo "<label class='starcontainer'><input type='radio' name='rating' value=4><span class='fa fa-star'></span></label>";
            }
            if($row['stars']>=5){
                  "<label class='starcontainer'><input type='radio' name='rating' value=5><span class='fa fa-star checked'></span></label>";
            } else {
                echo "<label class='starcontainer'><input type='radio' name='rating' value=5><span class='fa fa-star'></span></label>";
            }
            ///////////////////////////////////////////////////////
            }if($row['stars'] != NULL) {
                
                if($row['stars']==1){
                echo "<p class='gold' style='font-size:35px;'>&#9733;</p>";
            }if($row['stars']==2){
                 echo "<p class='gold' style='font-size:35px;'>&#9733;&#9733;</p>";
            }if($row['stars']==3){
                 echo "<p class='gold' style='font-size:35px;'>&#9733&#9733;&#9733;</p>";
            }if($row['stars']==4){
                 echo "<p class='gold' style='font-size:35px;'>&#9733;&#9733;&#9733;&#9733;</p>";
            }if($row['stars']==5){
                 echo "<p class='gold' style='font-size:35px;'>&#9733;&#9733;&#9733;&#9733;&#9733;</p>";
            }
                
            }else {
                
            }
                ?>
                </div>
                
                
                <p>Vapaa arviointi: </p>
                <?php
                    if($row['freetext'] == NULL){
                ?>
                <textarea name="freetext" cols="40" rows="5" maxlength="500" style="width:96%;"></textarea>
                <input id="button" type="submit" name="save" class= "btn btn-primary" value="Tallenna"><br><br>
                <input type="hidden" name="1" value="check">
                <input type="hidden" name="clicked" value="whatevs">
                <input type="hidden" name="selected_service" value="<?=$kk?>">
                <input type="hidden" name="modalOpen2" value="myModalp<?php echo $num;?>">
            </form>
 
<?php
     
            }else {
                echo "<p>" . $row['freetext'] . "</p>";
            }
     
     if(!empty($_POST['modalOpen2'])){
                   //suorita scripti
                 ?>
                <script>
                    document.getElementById('<?php echo $_POST['modalOpen2'];?>').style.display = 'block';
                </script>
            <?php

               } 
     
     
     if(!empty($_POST['save']) && $_POST["selected_service"] == $kk){
      
         if(!empty($_POST['modalOpen2'])){
                   //suorita scripti
                 ?>
                <script>
                    document.getElementById('<?php echo $_POST['modalOpen2'];?>').style.display = 'block';
                </script>
            <?php
              }
         $date1= date_create(date('Y-m-d'));
         $date2= date_create($row['dateofuse']);
         
       if($date1 < $date2){
           echo "<p id= 'alert'>Palvelu pitää olla käytetty ennen palvelun arviointia.</p>";
       }  
         $usid = $row['us_id'];
        if($_POST['rating'] && $date1 >= $date2){
            $stars = $_POST['rating'];
            if($row['stars'] == NULL){
            $sql = "UPDATE hb_uses SET stars= ". $_POST['rating'] . " WHERE us_id='$usid'";
            $insert= mysqli_query($connection,$sql);
             $sql2 = "UPDATE hb_provide SET rate = rate + '$stars', alkm = alkm +1 WHERE p_id = '$kk'";
            $insert2= mysqli_query($connection,$sql2);

            }    
                
            if($insert == true){
                echo "<p id='green'>Arviointi tallentui!</p>";
            }else {
                echo "Virhe";
            }
                
            }
         /*--------- NOT WORKING ----------------------------
         
         if($_POST['freetext']){
                echo $_POST['freetext'];
                $sql3 = "UPDATE hb_uses SET freetext= ". $_POST['freetext'] . " WHERE us_id='$usid'";
                $insert3= mysqli_query($connection,$sql3);
                
                if($insert3 == true){
                echo "<p id='green'>Arviointi tallentui!</p>";
                }else {
                echo "Virhe";
                }
        }*/ 
           
           
       if($row['stars'] != NULL){
           echo "<p id='green'>Olet jo arvioinut</p>";
       }
     }
     $num++;
     echo "</div></div>";
 }
     
   
?>
       
     



<main>
    <script>      
// A $( document ).ready() block.
$( document ).ready(function() {
    console.log( "ready!" );
    
    $('.starcontainer').hover(
            // Handles the mouseover
            function() {
                $(this).find('span').addClass('checked');
                $(this).prevAll().children('span').addClass('checked');
               // $(this).nextAll().removeClass('checked'); 
            },
            // Handles the mouseout
            function() {
                $(this).find('span').removeClass('checked');
                $(this).nextAll().children('span').removeClass('checked'); 
                 $(this).prevAll().children('span').removeClass('checked'); 
                
            }
        );

    $('.starcontainer').click(function() {
        
        $(this).addClass('selected');
        $(this).prevAll().addClass('selected');
        
        $(this).nextAll().removeClass('selected'); 
    });
    
});

        
        
   
var buttonmatches = document.querySelectorAll("button[id*='myBtnp']");
var modalmatches = document.querySelectorAll("div[id*='myModalp']");
var spanmatches = document.querySelectorAll("span.closep");

		
addlisteners();

// loop to add event listeners to all of the buttons

function addlisteners() {
	
var montako = spanmatches.length;

console.log(montako);


for (var i = 0; i < buttonmatches.length; i++) {
		
		//console.log('sisällä ollaan');
		
        buttonmatches[i].addEventListener("click", function (e) {
        			
            // to open the correct modal
            	var buttoni = e.target;		
				var kohde = buttoni.dataset.modal;
				console.log('in the close click'); 
				console.log(kohde);           
            // to close the correct modal
            var selector = "div[id='" + kohde  + "']";
           
            document.querySelector(selector).style.display = "block";
            
            

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
    <pre>
    
    

    </pre>
</main>
<?php
include_once 'hb_footer.inc';
