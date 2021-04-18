<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
session_start();
 ?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Messaggi Inviati</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
      <h2>Messaggi Inviati</h2>
    </div>
    <div class="input-group">
      <form>
      <?php
      $username = $_SESSION['username'];

      $queryMessaggiInviati = ("CALL messaggiInviati('$username')");
      $query = mysqli_query($db, $queryMessaggiInviati);
      $count = 1;
      while ($row=mysqli_fetch_assoc($query)) {
        echo 'Messaggio numero: <strong>'.$count.'</strong><br>';
        $titolo = $row['titolo'];
        $descrizione = $row['descrizione'];
        $destinatario = $row['nomeDestinatario'];
        echo 'Messaggio inviato a: <strong> '.$destinatario. '</strong><br>';
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
