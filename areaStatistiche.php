<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Area Statistiche</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="input-group">
      <div class="header">
      	<h2>Area Statistiche</h2>
      </div>
      <form action="areaStatistiche.php" method="post">
        <div class="input-group">
          <input type="button" name="button" class="btn" onclick="location.href='attrattivaPopolare.php'"  value="Attrattiva più popolare"></input><br><br>
          <input type="button" name="button" class="btn" onclick="location.href='percorsoPopolare.php'"  value="Percorso più popolare"></input><br><br>
          <input type="button" name="button" class="btn" onclick="location.href='utentePopolare.php'"  value="Utente più attivo"></input><br><br>
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
