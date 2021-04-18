<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
session_start();
$tipo = $_SESSION['tipo'];
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Area Eventi</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="input-group">
      <div class="header">
      	<h2>Area Eventi</h2>
      </div>
      <form action="areaEventi.php" method="post">
        <div class="input-group">
          <input type="button" name="button" class="btn" onclick="location.href='visualizzaEventi.php'" value="Cerca un Evento"></input><br><br>
        </div>
        <?php
        $username = $_SESSION['username'];
        $queryInfoUtente = ("SELECT * FROM utente WHERE username='$username'");
        $query2 = mysqli_query($db, $queryInfoUtente);
        $row1 = mysqli_fetch_assoc($query2);
        $_SESSION['tipo'] = $row1['tipologia'];
        $tipologia = $_SESSION['tipo'];
        $_SESSION['citta'] = $row1['residenza'];
        ?>

        <?php if ($tipologia === 'Gestore'): ?>
          <div class="input-group">
            <input type="button" name="button" class="btn" onclick="location.href='inserimentoEvento.php'" value="Crea un evento per la tua Attività"></input><br>
          </div>
        <?php endif; ?>
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
