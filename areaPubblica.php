<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Area Pubblica</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="input-group">
      <div class="header">
      	<h2>Area Pubblica</h2>
      </div>
      <form action="areaPubblica.php" method="post">
        <div class="input-group">
          <input type="button" name="button" class="btn" onclick="location.href='visualizzaUtente.php'"  value="Cerca Utente"></input><br><br>
          <input type="button" name="button" class="btn" onclick="location.href='visualizzaGestore.php'"  value="Cerca Gestore"></input><br><br>
          <input type="button" name="button" class="btn" onclick="location.href='messaggiPubblici.php'"  value="Visualizza tutti i messaggi pubblici"></input><br><br>
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
