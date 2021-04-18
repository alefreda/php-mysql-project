<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Area Privata</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="input-group">
      <div class="header">
      	<h2>Area Privata</h2>
      </div>
      <form action="areaPrivata.php" method="post">
        <div class="input-group">
          <input type="button" name="button" class="btn" onclick="location.href='eventi.php'" value="Eventi a cui Partecipi"></input><br><br>
          <input type="button" name="button" class="btn" onclick="location.href='messaggi.php'" value="Messaggi"></input><br><br>
          <input type="button" name="button" class="btn" onclick="location.href='preferiti.php'" value="I tuoi Preferiti"></input><br><br>
        </div>
        <br>
        <br>
        <br>
        <div>
           <p><input type="button" name="inviaMessaggio" class="btn" onclick="location.href='index.php'"  value="Torna alla Home"></input><br></p>
        </div>
      </form>
    </div>
  </body>
</html>
