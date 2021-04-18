<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
session_start();
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Commenti</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="input-group">
      <div class="header">
      	<h2>Visualizza Commenti</h2>
      </div>
      <form action="commenti.php" method="post">
        <div class="input-group">
          <label>Seleziona l'attrattiva: </label><br>
          <select class="input-group" name="attrattiva">
            <?php
            $res=mysqli_query($db, "SELECT DISTINCT nomeAttrattiva FROM commento ORDER BY nomeAttrattiva ASC");
            while ($row=mysqli_fetch_assoc($res)) { ?>
             <option><?php echo $row['nomeAttrattiva']; ?></option>
           <?php } ?>
          </select>
          <button type="submit" name="cerca" class="btn">Cerca</button>
        </div>

        <?php

        if (isset($_POST['cerca'])) {
          $attrattiva = $_POST['attrattiva'];

          $queryCommento = ("CALL visualizzaCommento('$attrattiva')");
          $query = mysqli_query($db, $queryCommento);
          $count = 0;
          while ($row=mysqli_fetch_assoc($query)) {
            $count++;
            echo 'Commento numero: <strong>'.$count.'</strong><br>';
            $testo = $row['testo'];
            $data = $row['dataCommento'];
            $voto = $row['votazione'];
            $autore = $row['usernameUtente'];
            echo 'Scritto da: <strong>'.$autore.'</strong><br>';
            echo 'Il: <strong>'.$data.'</strong><br>';
            echo 'Testo: <strong>'.$testo.'</strong><br>';
            echo 'Voto: <strong>'.$voto.'</strong><br><br>';

        }
        if ($count==0) {
          echo 'Non ci sono commenti';
        }
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
