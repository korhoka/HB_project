<!DOCTYPE html>
<html lang= "en">
<head>
    <meta charset="utf-8">
    <style>
        body{
            background-color:  #fea000;
        }
    </style>
    <title> HB LOGOUT </title>
    
    <link rel="stylesheet" href="css/hb_style.css">
</head>
<body>
    
     <h1><br>Henkilökohtainen Budjetointi</h1>

     <img id="logo" src="http://henkilokohtainenbudjetointi.fi/wp-content/uploads/2017/01/logokuva_oranssi_levea.jpg" alt="HB Logo">

<?php
session_start();
$_SESSION = array();

if(ini_get("session.use_cookies")){
    $params = session_get_cookie_params();
    setcookie(session_name(), '',time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
    );
}
    
session_unset();
session_destroy();
    ?>
    <p style="color:white; font-size: 30px;
    text-align: center;">Olet nyt kirjautunut ulos onnistuneesti!</p>
   <div style="color:white; font-size: 20px;
    text-align: center;">Kirjaudu sisään uudelleen <a href="hb_login.php">tästä</a></div>
    </body>
</html>