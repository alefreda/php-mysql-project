<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Messaggi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="input-group">
      <div class="header">
      	<h2>Messaggi</h2>
      </div>
      <form action="messaggi.php" method="post">
        <div class="input-group">
          <label>Seleziona l'operazione da eseguire</label><br>
          <input type="button" name="messInviati" class="btn" onclick="location.href='messaggiRicevuti.php'"  value="Messaggi Ricevuti"></input><br><br>
          <input type="button" name="messRicevuti" class="btn" onclick="location.href='messaggiInviati.php'"  value="Messaggi Inviati"></input><br><br>
          <input type="button" name="inviaMessaggio" class="btn" onclick="location.href='invioMessaggio.php'"  value="Invia Messaggio"></input><br>
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
