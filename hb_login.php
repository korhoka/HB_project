<!DOCTYPE html>
<html lang= "en">
<head>
    <meta charset="utf-8">
    
    <style>
        body{
            background-color:  #fea000;
        }
    
    </style>
    <title> HB LOGIN </title>
    
    <link rel="stylesheet" href="css/hb_style.css">
</head>
<body>
    
     <h1><br>Henkilökohtainen Budjetointi</h1>

     <img id="logo" src="http://henkilokohtainenbudjetointi.fi/wp-content/uploads/2017/01/logokuva_oranssi_levea.jpg" alt="HB Logo">

     <?php
     $config = parse_ini_file('../valmisledi/config.ini');
     $connection = mysqli_connect($config['dbbaddr'],$config['usernamecd'],$config['password'],$config['dbname']);

     //jos menee pieleen, virheilmoitus
     if($connection === false){
         echo "hups, jokin meni pieleen.";
         exit("Yhteyttä kantaan ei voitu muodostaa");
     }

     mysqli_set_charset($connection,"utf-8");
    session_start(['cookie_lifetime' => 3600]);
if(empty($_SESSION['username'])){
    //user is not yet logged in
     ?>

   <form id="mikko2" method="post" action="<?php echo htmlentities($_SERVER["PHP_SELF"]); ?>" style="text-align:center; color: white; font-size: 20px;">
       <h2>Kirjaudu sisään</h2>
    Asiakaskoodi: <input id="mikko1" type="password" name="username">
       <br><br>
       <input id="mikko" type="submit" name="clicked" value="Kirjaudu">
    </form>
    
    <?php
     $username = mysqli_real_escape_string($connection,$_POST['username']); /* prevents a bit of SQL injection */
    
    $usercode = mysqli_query($connection,"SELECT usercode FROM hb_user");
    
     $qry=mysqli_query($connection,"SELECT * FROM hb_user WHERE usercode='$username'");
    
    $dbpwd = password_hash($_POST['username'], PASSWORD_DEFAULT);
     
      if(!empty($_POST['clicked'])){
           if(mysqli_num_rows($qry)==1){
               $_SESSION['usercode']= htmlentities($_POST['username']);   
         header("LOCATION:hb_palvelut.php");
     } else{
               echo "<p id='alert'> Väärä asiakaskoodi</p>";
           }
          
      }
}else {
    echo "Hello " . "! <a href='logout.php'> logout</a>";
}
    
    ?>

<div>
    <br><br><br><br><br><br>
</div>
    </body>
</html>
