<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
session_start();
 ?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Messaggi Ricevuti</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
      <h2>Messaggi Ricevuti</h2>
    </div>
    <div class="input-group">
      <form class="" action="index.html" method="post">
        <?php
        $username = $_SESSION['username'];

        $queryMessaggiRicevuti = ("CALL messaggiRicevuti('$username')");
        $query = mysqli_query($db, $queryMessaggiRicevuti);
        $count = 1;
        while ($row=mysqli_fetch_assoc($query)) {
          echo 'Messaggio numero: <strong>'.$count.'</strong><br>';
          $titolo = $row['titolo'];
          $descrizione = $row['descrizione'];
          $mittente = $row['nomeMittente'];
          echo 'Messaggio inviato a: <strong> '.$mittente. '</strong><br>';
          echo 'Titolo: <strong>'.$titolo.'</strong><br>';
          echo 'Testo: <strong>'.$descrizione.'</strong><br><br>';
          $count++;
      }

        ?>
        <div>
          <p> <a href="index.php">Torna alla home</a> </p>
        </div>
      </form>
    </div>
  </body>
</html>
