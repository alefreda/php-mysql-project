<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
 ?>
<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Messaggi Pubblici</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="header">
      <h2>Messaggi Pubblici</h2>
    </div>
    <div class="input-group">
      <form action="messaggiPubblici.php" method="post">
        <?php

        $queryMessaggiPubblici = ("CALL messaggiPubblici()");
        $query = mysqli_query($db, $queryMessaggiPubblici);
        $count = 1;
        while ($row=mysqli_fetch_assoc($query)) {
          echo 'Messaggio numero: <strong>'.$count.'</strong><br>';
          $titolo = $row['titolo'];
          $descrizione = $row['descrizione'];
          $mittente = $row['nomeMittente'];
          $destinatario = $row['nomeDestinatario'];
          echo 'Messaggio inviato da: <strong> '.$mittente. '</strong> a: <strong>'.$destinatario.'</strong><br>';
          echo 'Titolo: <strong>'.$titolo.'</strong><br>';
          echo 'Testo: <strong>'.$descrizione.'</strong><br><br>';
          $count++;
      }//end while

        ?>
        <div>
          <p> <a href="index.php">Torna alla home</a> </p>
        </div>
      </form>
    </div>
  </body>
</html>
