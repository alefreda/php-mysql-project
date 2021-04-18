<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
session_start();
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Eventi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="input-group">
      <div class="header">
      	<h2>Eventi</h2>
      </div>
      <form action="messaggi.php" method="post">
        <div class="input-group">
          <label>Questi sono gli eventi a cui hai partecipato/parteciperai: </label><br>
        </div>

        <?php
        $username = $_SESSION['username'];

        $queryPartecipazione = ("CALL visualizzaPartecipanti('$username')");
        $query = mysqli_query($db, $queryPartecipazione);
        $count = 0;
        while ($row=mysqli_fetch_assoc($query)) {
          $count++;
          echo 'Evento numero: <strong>'.$count.'</strong><br>';
          $titolo = $row['titoloEvento'];
          $attivita = $row['nomeAttivita'];
          echo 'Titolo: <strong>'.$titolo.'</strong><br>';
          echo 'Attività: <strong>'.$attivita.'</strong><br><br>';
      }
      if ($count==0) {
        echo 'Non partecipi ad alcun evento';
      }
         ?>




        <br>
        <br>
        <br>
        <div>
           <p><input type="button" name="home" class="btn" onclick="location.href='index.php'"  value="Torna alla Home"></input><br></p>
        </div>
      </form>
    </div>
  </body>
</html>
