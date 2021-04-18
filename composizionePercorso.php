<?php
$db = mysqli_connect('localhost', 'root', '', 'seemycity');
session_start();
 ?>

<!DOCTYPE html>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Composizione Percorso</title>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <div class="input-group">
      <div class="header">
      	<h2>Visualizza le attrattive di un percorso</h2>
      </div>
      <form action="composizionePercorso.php" method="post">
        <div class="input-group">
          <label>Seleziona il percorso: </label><br>
          <select class="input-group" name="percorso">
            <?php
            $res=mysqli_query($db, "SELECT DISTINCT nomePercorso FROM composizionepercorso ORDER BY nomePercorso ASC");
            while ($row=mysqli_fetch_assoc($res)) { ?>
             <option><?php echo $row['nomePercorso']; ?></option>
           <?php } ?>
          </select>
          <button type="submit" name="cerca" class="btn">Cerca</button>
        </div>

        <?php

        if (isset($_POST['cerca'])) {
          $nomePercorso = $_POST['percorso'];

          $queryPercorso = ("CALL composizionePercorso('$nomePercorso')");
          $query = mysqli_query($db, $queryPercorso);
          $count = 0;
          while ($row=mysqli_fetch_assoc($query)) {
            $count++;
            echo 'Attrattiva numero: <strong>'.$count.'</strong><br>';
            $nomeAttrattiva = $row['nomeAttrattiva'];
            $durata = $row['durata'];
            echo 'Nome attrattiva: <strong>'.$nomeAttrattiva.'</strong><br>';
            echo 'Durata: <strong>'.$durata.'</strong><br>';

        }
        if ($count==0) {
          echo 'Non ci sono attrattive';
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
