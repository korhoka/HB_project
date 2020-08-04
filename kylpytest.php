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



?>
<!DOCTYPE html>
<html lang= "fi">
<head>
    <meta charset="utf-8">
    <title>HB</title>
</head>



<?php


        $Bdate = htmlentities($_POST['Bdate']); //Protect 
        $buy = $_POST['buy'];
        $price = $_POST['priceh'];
        $date= date('Y-m-d');
        $dur = $_POST['duration'];


           if($_POST["selected_service"] >= 0){
               
               if(!empty($_POST['modalOpen'])){
                   //suorita scripti
                 ?>
                <script>
                    document.getElementById('<?php echo $_POST['modalOpen'];?>').style.display = 'block';
                </script>
            <?php

               } 
              
               
               if($_POST['Bdate'] && $_POST['duration'] ){
                   $usercode =$_POST['usercode'];
                   $amount = $price * $dur;
                  $sql = "INSERT INTO hb_uses (p_id, bdate, usercode, dateofuse, duration, bought) VALUES (" . $_POST['pid'] . ", '$date', '$usercode', '$Bdate', '$dur', '$amount')";
                   $insert= mysqli_query($connection,$sql);
                   $sql2 = "UPDATE hb_budjet SET used= used + '$amount', remaining= remaining - '$amount' WHERE usercode='$usercode'";
                   $insert2= mysqli_query($connection,$sql2);
                       
               if($insert == TRUE){
                   echo "<p id='green'>Osto onnistui!</p>";
               }if($insert == FALSE){
                   echo "<p class='alert'>Sinulla on jo tämä palvelu tähän aikaan.</p>";
               }
                   
           }               
             
                           
           }
              ?>
               
