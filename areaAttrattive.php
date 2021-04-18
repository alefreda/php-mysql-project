<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
session_start();
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Area Attrattive</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="input-group">
      <div class="header">
      	<h2>Area Attrattive</h2>
      </div>
      <form action="areaAttrattive.php" method="post">
        <div class="input-group">
          <input type="button" name="button" class="btn" onclick="location.href='visualizzaAttrattive.php'" value="Visualizza le attrattive delle città"></input><br><br>
          <input type="button" name="button" class="btn" onclick="location.href='commenti.php'" value="Leggi i commenti alle attrattive"></input><br><br>
          <input type="button" name="button" class="btn" onclick="location.href='inserimentoAttrattiva.php'" value="Inserisci una attrattiva per <?php echo $_SESSION['citta']; ?>"></input><br><br>
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
